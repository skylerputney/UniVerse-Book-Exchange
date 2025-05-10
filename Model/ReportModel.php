<?php

require_once $basePath . "/Model/UserModel.php";

trait ReportModel{

    use UserModel;


     /**
     * @brief Inserts a report into the database utilizing parameters passed from ReportController
     * @param $reportedListingID ID of Listing reported
     * @param $reportedUserID ID of User being reported
     * @param $reporterUserID ID of User doing the reporting
       @param $reportMessage Message contents of report
     * @return $data True if inserted, false otherwise
     */
    public function insertReport($reportedListingID, $reportedUserID, $reporterUserID, $reportMessage){
        $query = "INSERT INTO reports (reportedListingID, reportedUserID, reporterUserID, reportMessage, creationDate) VALUES (?, ?, ?, ?, ?)";
        $data = $this->db->query($query, [$reportedListingID, $reportedUserID, $reporterUserID, $reportMessage, date("Y-m-d H:i:s")]);
        echo $data;
        return $data;
    }

    /**
     * @brief Fetches Report from the database matching reportedListingID and reporterUserID
     * @param $reportedListingID ID of Listing reported
     * @param $reporterUserID ID of User who did the reporting
     * @return Associative array with Report info, NULL if does not exist
     */
    public function fetchReport($reportedListingID, $reporterUserID) {
        $query = "SELECT * FROM reports WHERE reportedListingID = ? AND reporterUserID = ?";
        $data = $this->db->query($query, [$reportedListingID, $reporterUserID]);
        return isset($data[0]) ? $data[0] : NULL;
    }

    /**
     * @brief Fetches all Reports from the database for a particular ListingID
     * @param $listingID ID of the Listing to fetch Reports for
     * @return $data Array of associative arrays of Report information, NULL if no Reports found
     */
    public function fetchListingReports($listingID){
        $query = "SELECT * FROM reports WHERE reportedListingID = ?";
        $data = $this->db->query($query, [$listingID]);
        return isset($data) ? $data : NULL;
    }

    /**
     * @brief Removes a Report with a matching id from the database
     * @param $reportID id of Report to delete
     * @return $data True if Report deleted, False if nothing affected
     */
    public function deleteReport($reportID){
        $query = "DELETE FROM reports WHERE id = ?";
        $data = $this->db->query($query, [$reportID]);
        return $data;
    }
}