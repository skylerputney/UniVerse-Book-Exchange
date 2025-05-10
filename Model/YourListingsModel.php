<?php

include_once $basePath . "/Model/ListingModel.php";
require_once $basePath . "/Model/MessagesMenuModel.php";

class YourListingsModel{
	private $db;
	private $yourListings;
    private $sellerID;
    private $statusAry;
    private $searchParam;
    private $listingModel;
    use ListingModel;
    use MessagesMenuModel;


	public function __construct($db){
		$this->db = $db;
        $this->sellerID = $_SESSION['user_id'];
        $this->searchParam = "";
	}

    /**
     * @brief Fetches your listings from the database with authorName or bookName matching searchParam, if it's set
     * @return $data Array of associative arrays of listing information
     */
	public function fetchListings(){
		$query = "SELECT * from listings JOIN users ON listings.sellerID = users.id";
		$params = [];

            $query .= " WHERE (bookName LIKE ? OR bookAuthor like ? OR users.university like ?) and listings.sellerID like ?";
            $params = ['%' . $this->searchParam . '%', '%' . $this->searchParam . '%', '%' . $this->searchParam . '%', $this->sellerID ];

		$data = $this->db->query($query, $params);
		return $data;
	}

    /**
     * @brief Returns listings currently stored in model for display purposes
     * @return $this->listings Array of associative arrays of listing information
     */
	public function getYourCurrentListings(){
		return $this->yourListings;
	}

    public function setYourCurrentListings($listings) {
        $this->yourListings = $listings;
	}

    /**
     * @brief Stores  a listing in the model for display purposes
     * @param $listing Listing to store in model (Associative array of listing info)
     */
	public function addYourListing($listing){
		$this->yourListings[] = $listing;
	}

    /**
     * @brief Returns any statuses stored within the model
     * @return Array of statuses (Strings)
     */
    public function getStatusAry() {
        return $this->statusAry;
    }

    /**
     * @brief Stores a new status within the model
     * @param $status Status to add to the model (String)
     */
    public function addStatus($status) {
        $this->statusAry[] = $status;
    }
    
    /**
     * @brief Returns true if status stored within model's statusAry
     * @return true | false
     */
    public function hasStatus($status){
        if($this->statusAry == NULL){
            return false;
        }
        return in_array($status, $this->statusAry);
    }

    public function fetchUserByID($id){
        $query = "SELECT * FROM users WHERE id = ?";
        $data = $this->db->query($query, [$id]);
        return $data[0];
    }

    public function fetchUser(){
        $query = "SELECT * FROM users WHERE id = ?";
        $data = $this->db->query($query, [$this->sellerID]);
        return $data[0];
    }

    public function searchParam($searchParam){
		$this->searchParam = $searchParam;
	}

    /**
     * @brief Returns the model's search parameter
     * @return $this->searchParam search parameter
     */
    public function getSearchParam(){
        return $this->searchParam;
    }
}
