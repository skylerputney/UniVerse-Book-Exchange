<?php

include_once $basePath . "/Controller/ListingController.php";
include_once $basePath . "/Controller/MessagesMenuController.php";

class SavedListingsController{
	private $model;
	use ListingController;
    use MessagesMenuController;

	public function __construct(SavedListingsModel $model){
		$this->model = $model;

		//Route user to login page if not logged in
		if(!isset($_SESSION['user_id']) && !$this->model->fetchUserByID($_SESSION['user_id'])){
			header("Location: /login");
		}

		//Retrieve your saved listings and add them to model for display purposes
        if(empty($this->model->getCurrentSavedListings())){
		$this->getSavedListings();
		}
	}

    /**
     * @brief Fetches your saved listings, and adds listings to the model for display purposes
     */
	public function getSavedListings() {
		//Check for search parameters
		if(!empty($_POST['searchParam'])) {
			$this->model->searchParam($_POST['searchParam']);
		}

		//Retrieve listings matching UserID from database
		$listings = $this->model->fetchSavedListings();

		//Add listings to model so they can be displayed in view
		foreach($listings as $listing){
            $listingID = $listing['listingID'];
            $currentListing = $this->model->fetchSavedListing($listingID);
			if (empty($currentListing)){
			}else{
				if(!in_array($currentListing, $this->model->getCurrentSavedListings() ?? []))
				$this->model->addSavedListing($currentListing);
			}
		}
	}

    public function sortListings(){

		$listings = $this->model->getCurrentSavedListings();


        if(isset($_POST['bestMatch'])){
			$this->model->getCurrentSavedListings();
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
        $this->model->setCurrentSavedListings($listings);
	}
}