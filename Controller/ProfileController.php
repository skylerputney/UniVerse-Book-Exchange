<?php

include_once $basePath . "/Controller/MessagesMenuController.php";

class ProfileController{
    private $model;
    use MessagesMenuController;

	public function __construct(profileModel $model){
		$this->model = $model;

		//Route user to login page if not logged in
		if(!isset($_SESSION['user_id']) && !$this->model->fetchUserByID($_SESSION['user_id'])){
			header("Location: /login");
		}
	}

}