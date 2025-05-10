<?php

include_once $basePath . "/Controller/ListingController.php";
include_once $basePath . "/Controller/MessagesMenuController.php";

class YourListingsController{
	use ListingController;
    use MessagesMenuController;
	private $model;

	public function __construct(YourListingsModel $model){
		$this->model = $model;

		//Route user to login page if not logged in
		if(!isset($_SESSION['user_id']) && !$this->model->fetchUserByID($_SESSION['user_id'])){
			header("Location: /login");
		}

		//Retrieve your listings and add them to model for display purposes
        if(empty($this->model->getYourCurrentListings())){
		$this->getYourListings();
		}
	}

    /**
     * @brief Fetches your listings, and adds listings to the model for display purposes
     */
	public function getYourListings() {
		//Check for search parameters
		if(!empty($_POST['searchParam'])) {
			$this->model->searchParam($_POST['searchParam']);
		}

		//Retrieve listings matching UserID from database
		$listings = $this->model->fetchListings();

		//Add listings to model so they can be displayed in view
		foreach($listings as $listing){
			if(!in_array($listing, $this->model->getYourCurrentListings() ?? []))
				$this->model->addYourListing($listing);

		}
	}

    public function sortListings(){

		$listings = $this->model->fetchListings();


        if(isset($_POST['bestMatch'])){
			$this->model->fetchListings($listings);
        } elseif(isset($_POST['newest'])){
            usort($listings, function($a, $b) {
        		return strtotime($b['creationDate']) - strtotime($a['creationDate']);
   			 });
        } elseif(isset($_POST['lowestPrice'])){
			usort($listings, function($a, $b) {
				return $a['bookPrice'] - $b['bookPrice'];
			});
        } elseif(isset($_POST['highestPrice'])){
				usort($listings, function($a, $b) {
					return $b['bookPrice'] - $a['bookPrice'];
				});
			}

        // Update the model's listings with the sorted order
        $this->model->setYourCurrentListings($listings);
	}
}

