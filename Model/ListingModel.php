<?php

require_once $basePath . "/Model/UserModel.php";
require_once $basePath . "/Model/ReportModel.php";

trait ListingModel {
    private $db;
    private $searchParam;
    private $listings;
    private $university;
    private $userID;
    private $listingID;
    use UserModel;
    use ReportModel;

    /**
     * @brief Initializes Model's database property
     * @param $db Database connection to utilize
     */
    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * @brief Returns listings currently stored in model for display purposes
     * @return $this->listings Array of associative arrays of listing information
     */
    public function getCurrentListings() {
        return $this->listings;
    }

    /**
     * @brief Stores a listing in the model for display purposes
     * @param $listing Listing to store in model (Associative array of listing info)
     */
    public function addCurrentListing($listing) {
        $this->listings[] = $listing;
    }

    /**
     * @brief Stores the listings within model for display purposes
     * @param $listings Array of listings to store in model (Array of associative array of listing info)
     */
    public function setCurrentListings($listings) {
        $this->listings = $listings;
    }

    /**
     * @brief Sets the model's search parameter for database query purposes
     * @param $searchParam Search parameter for listings
     */
    public function searchParam($searchParam) {
        $this->searchParam = $searchParam;
    }

    /**
     * @brief Returns the model's search parameter
     * @return $this->searchParam search parameter
     */
    public function getSearchParam() {
        return $this->searchParam;
    }

    /**
     * @brief Sets the model's university for database query purposes
     * @param $university
     */
    public function setUniversity($university) {
        $this->university = $university;
    }

    /**
     * @brief Sets the model's listingID for database query purposes
     * @param $listingID
     */
    public function listingID($listingID) {
        $this->listingID = $listingID;
    }

    /**
     * @brief Sets the model's userID for database query purposes
     * @param $userID
     */
    public function userID($userID) {
        $this->userID = $userID;
    }


    /**
     * @brief Fetches all listings from the database with authorName or bookName matching searchParam, if it's set
     * @return $data Array of associative arrays of listing information
     */
    public function fetchListings() {
        $query = "SELECT * from listings JOIN users ON listings.sellerID = users.id";
        $params = [];

        if ($this->searchParam) {
            $query .= " WHERE (bookName LIKE ? OR bookAuthor like ? OR users.university like ?)";
            $params = ['%' . $this->searchParam . '%', '%' . $this->searchParam . '%', '%' . $this->searchParam . '%'];
        }

        $data = $this->db->query($query, $params);
        return $data;
    }

    /**
     * @brief Fetches saved listing from database where userID and listingID matched those stored within the model
     * @return Associative array of listing info, NULL if no listing found
     */
    public function fetchSavedListing() {
        $query = "SELECT * FROM savedlistings WHERE userID = ? AND listingID = ?";
        $data = $this->db->query($query, [$this->userID, $this->listingID]);
        return isset($data) ? $data : NULL;
    }

    /**
     * @brief Fetches saved listing from database where userID and listingID matched parameters
     * @param $listingID ID of listing to fetch 
     * @param $userID ID of user who created listing
     * @return $data Associative array of savedListing data if exists, NULL if not
     */
    public function fetchSavedListingByID($listingID, $userID){
        $query = "SELECT * FROM savedlistings WHERE userID = ? AND listingID = ?";
        $data = $this->db->query($query, [$userID, $listingID]);
        return isset($data) ? $data : NULL;
    }

    /**
     * @brief Saves a listing into the database using userID, listingID stored within model
     * @return True|False based on db insertion success
     */
    public function saveListing() {
        $query = "INSERT INTO savedlistings (userID, listingID) VALUES (?, ?)";
        $data = $this->db->query($query, [$this->userID, $this->listingID]);
        return $data;
    }

    /**
     * @brief Removes a listing from the database matching userID, listingID stored within model
     * @return True|False based on db deletion success
     */
    public function unsaveListing(){
        $query = "DELETE FROM savedlistings WHERE listingID = ? AND userID = ?";
        $data = $this->db->query($query, [$this->listingID, $this->userID]);
        return isset($data) ? $data : NULL;
    }

    /**
     * @brief Fetches listings where the current user's university matches selling user's university
     * @return Array of associatve arrays of listing data, NULL if not found
     */
    public function fetchListingsByUserUniversity() {
        $query = "SELECT * FROM listings JOIN users ON listings.sellerID = users.id";
        $query .= " WHERE users.university = ?;";
        $user = $this->fetchUserByID($_SESSION['user_id']);
        $data = $this->db->query($query, [$user['university']]);
        return $data;
    }

    /**
     * @brief Removes a listing from database where listingID matches that stored within model
     * @return True|False based on db deletion success
     */
    public function remove($listingID){
			$query = "DELETE FROM listings WHERE listingID = ?";
			$data = $this->db->query($query, [$listingID]);
			return $data;
	}
}
