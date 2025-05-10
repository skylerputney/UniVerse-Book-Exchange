<?php

require_once $basePath . "/View/ReportView.php";

class ListingView {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    /**
     * @brief Returns a modal to view all info/interact with Listing for particular lisitngID
     * @param $listing Listing to generate modal for
     */
    public function getModal($listing) {
        // Listing seller
        $seller = $this->model->fetchUserByID($listing['sellerID']);
        // Modal for each listing
        $html = "<div id=\"viewListingModal" . $listing['listingID'] . "\" class=\"modal fade\">";
        $html .= "<div class=\"modal-dialog\">";
        $html .= "<div class=\"modal-content\">";
        $html .= "<div class=\"modal-header\">";
        $html .= "<h4 class=\"modal-title\">" . $listing['bookName'] . "</h4>";
        //X button
        $html .= "<span tabindex=\"0\" class=\"close\" onclick=\"closeModal('viewListingModal" . $listing['listingID'] . "')\">&times;</span>";
        $html .= "</div>";
        $html .= "<div class=\"modal-body\" style=\"display: flex;\">";

        // Left side (Image)
        $html .= "<div style=\"flex: 0 0 33%;\">";
        $html .= "<div style=\"width: 100%; padding-bottom: 100%; position: relative;\">";
        $html .= "<div style=\"width: 100%; height: 100%; border: 2px solid black; position: absolute; top: 0; left: 0;\">";
        $html .= "<img src=\"" . $listing['bookImg'] . "\" alt=\"" . $listing['bookName'] . "\" style=\"width: 100%; height: 100%; object-fit: contain; max-width: 100%; max-height: 100%;\">";
        $html .= "</div>";
        $html .= "</div>";
        $html .= "</div>";

        // Space between the image and information
        $html .= "<div style=\"flex: 0 0 5%;\"></div>";

        // Right side (Information)
        $html .= "<div style=\"flex: 1;\">";
        $html .= "<div style=\"margin-top: 10px;\">"; // Adjusted margin for spacing
        $html .= "<p><strong>Author:</strong> " . $listing['bookAuthor'] . "</p>";
        $html .= "<p><strong>Price:</strong> $" . $listing['bookPrice'] . "</p>";
        $html .= "<p><strong>Seller Name:</strong> " . $seller['username'] . "</p>";
        $html .= "<p><strong>Seller Email:</strong> " . $seller['email'] . "</p>";
        $html .= "</div>";
        $html .= "</div>";

        $html .= "</div>";

        // Footer with Contact Seller button and Save button
        $html .= "<div class=\"modal-footer\" style=\" display:flex; justify-content:center;\">";

        //Conditionally display Delete button
        if($_SESSION['user_id'] == $listing['sellerID']){
            $html .= "<form method=\"POST\">";
            $html .= '<input type="hidden" name="action" value="remove">';
            $html .= '<input type="hidden" name="sellerID" value="' . $listing['sellerID'] . '">';
            $html .= '<input type="hidden" name="listingID" value="' . $listing['listingID'] . '">';
            $html .= "<button class=\"btn btn-danger rounded\">Delete</button>";
            $html .= "</form>";
        }

        // Report button
        if($_SESSION['user_id'] != $listing['sellerID']){
            //If user has not already created a report, display button to do so
            $report = $this->model->fetchReport($listing['listingID'], $_SESSION['user_id']);
            if(!isset($report)){
                $html .= '<div style="flex: 1;">';
                $html .= '<button class="btn violet-button open-modal" data-modal-id="reportModal">Report</button>';
                $html .= '</div>';
            }
            else{
                //Button to delete report
                $html .= '<div style="flex: 1;">';
                $html .= '<form method="POST" action="?action=deleteReport">';
                $html .= '<input type="hidden" name="reportID" value="' . $report['id'] . '">';
                $html .= '<button type="submit" id="deleteReport" class="btn violet-button">Delete Report</button>';
                $html .= "</form>";
                $html .= '</div>';
                }
        }

        //Conditional Button for Saving listing
        //Doesn't display if it is your own listing
        //displays unsave if it's already saved
        //displays save if not
        $html .= "<form method=\"POST\">";
        $alreadySaved = $this->model->fetchSavedListingByID($listing['listingID'], $_SESSION['user_id']);
        if($_SESSION['user_id'] == $listing['sellerID']){
            $html .= "";
            $html .= "</form>";
        }
        elseif($alreadySaved){
            $html .= "<input type=\"hidden\" name=\"action\" value=\"unsaveCurrentListing\">";
            $html .= "<input type=\"hidden\" name=\"unsaveListing\" value= \"" . $listing['listingID'] . "\">";
            $html .= "<button type=\"submit\" class=\"btn save-listing violet-button\">Unsave</button>";
            $html .= "</form>";
        }
        elseif(!$alreadySaved){
            $html .= "<input type=\"hidden\" name=\"action\" value=\"saveCurrentListing\">";
            $html .= "<input type=\"hidden\" name=\"saveListing\" value= \"" . $listing['listingID'] . "\">";
            $html .= "<button type=\"submit\" class=\"btn save-listing violet-button\">Save For Later</button>";
            $html .= "</form>";
        }

        //Contact seller button
        if ($_SESSION['user_id'] != $listing['sellerID']) {
            $currentURL = strtok($_SERVER['REQUEST_URI'], '?');
            $html .= "<form action=\"$currentURL\" method=\"GET\">";
            $html .= "<input type=\"hidden\" name=\"messages\" value=\"\">";
            $html .= "<button class=\"btn contact-seller-button violet-button\" name=\"otherUserID\" value=\"" . $listing['sellerID'] . "\" type=\"submit\" >Contact Seller</button>";
            $html .= "</form>";
        }

        $html .= "</div>";

        $html .= "</div></div>";
        $html .= "</div>";
        $html .= "</div></div></div>";

        //Attach Report Modal
        $reportModal = new ReportView($this->model);
        $html .= $reportModal->displayReport($listing);

        //Styling
        $html .= '<head><link rel="stylesheet" href="../View/Styles/ListingView.css"></head>';

        //Attach any alerts
        if($this->model->hasStatus('reportSuccessful')){
            $html .= '<div class="alert alert-success alert-dismissible" id="reportSuccessful" style="position: fixed; bottom: 10px; right: 10px;">';
            $html .= '<span style="float: right; cursor: pointer;" onclick="this.parentElement.style.display=\'none\'">&times;</span>';
            $html .= 'Report created!';
            $html .= '</div>';
        }
        if($this->model->hasStatus('reportDeleted')){
            $html .= '<div class="alert alert-success alert-dismissible" id="reportDeleted" style="position: fixed; bottom: 10px; right: 10px;">';
            $html .= '<span style="float: right; cursor: pointer;" onclick="this.parentElement.style.display=\'none\'">&times;</span>';
            $html .= 'Report deleted!';
            $html .= '</div>';
        }

        return $html;



    }













}