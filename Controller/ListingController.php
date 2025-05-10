<?php

require_once $basePath . "/Controller/ReportController.php";

trait ListingController
{
    use ReportController;
    /**
     * @brief Fetches listings, matching searchParam if set, and adds listings to the model for display purposes
     */
    public function getListings()
    {

        //Check for search parameters
        if (!empty($_POST['searchParam'])) {
            $this->model->searchParam($_POST['searchParam']);
        }

        //Retrieve listings matching searchParam from database
        $listings = $this->model->fetchListings();

        //Add listings to model so they can be displayed in view
        foreach ($listings as $listing) {
            if (!in_array($listing, $this->model->getCurrentListings() ?? []))
                $this->model->addCurrentListing($listing);
        }
    }

    public function sortListings()
    {


        $listings = $this->model->fetchListings();

        if (isset($_POST['sameUniversity'])) {
            if (!empty($_SESSION['user_id'])) {
                $listings = $this->model->fetchListingsByUserUniversity();
            }
        }

        if (isset($_POST['bestMatch'])) {
            $listings = $this->model->fetchListings();
        } elseif (isset($_POST['newest'])) {
            usort($listings, function ($a, $b) {
                return strtotime($b['creationDate']) - strtotime($a['creationDate']);
            });
        } elseif (isset($_POST['lowestPrice'])) {
            usort($listings, function ($a, $b) {
                return $a['bookPrice'] - $b['bookPrice'];
            });
        } elseif (isset($_POST['highestPrice'])) {
            usort($listings, function ($a, $b) {
                return $b['bookPrice'] - $a['bookPrice'];
            });
        }


        // Update the model's listings with the sorted order
        $this->model->setCurrentListings($listings);
    }


    public function saveCurrentListing()
    {
        if (!empty($_SESSION['user_id'])) {
            $this->model->userID($_SESSION['user_id']);

            if (!empty($_POST['saveListing'])) {
                $this->model->listingID($_POST['saveListing']);
            }

            $alreadySaved = $this->model->fetchSavedListing();
            if (!$alreadySaved) {
                $this->model->saveListing();
            }
        }
    }

    public function unsaveCurrentListing()
    {
        if(!empty($_SESSION['user_id'])){
            $this->model->userID($_SESSION['user_id']);

            if (!empty($_POST['unsaveListing'])) {
                $this->model->listingID($_POST['unsaveListing']);
            }
            $this->model->unsaveListing();
            header("Refresh:0");
        }
    }

    public function remove()
    {
        if (isset($_POST['sellerID']) && $_POST['sellerID'] == $_SESSION['user_id']) {
            $data = $this->model->remove($_POST['listingID']);
            header("Refresh:0");
            return isset($data) ? $data : NULL; // Ensure that subsequent code is not executed
        }
    }

    
}
