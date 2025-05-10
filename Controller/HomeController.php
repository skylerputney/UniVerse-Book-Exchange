<?php

include_once $basePath . "/Controller/CreateListingController.php";
include_once $basePath . "/Controller/ListingController.php";
include_once $basePath . "/Controller/MessagesMenuController.php";

class HomeController{
	private $model;
    use CreateListingController;
    use ListingController;
	use MessagesMenuController;

	public function __construct(HomeModel $model){
		$this->model = $model;

		//Route user to login page if not logged in
		if(!isset($_SESSION['user_id']) && !$this->model->fetchUserByID($_SESSION['user_id'])){
			header("Location: /login");
		}

		//Retrieve listings and add them to model for display purposes
        if(empty($this->model->getCurrentListings())){
            $this->getListings();
        }

	}

	








}