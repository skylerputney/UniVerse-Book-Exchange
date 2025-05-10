<?php

class SignupController{
	private $model;

	public function __construct(SignupModel $model){
		$this->model = $model;
	}

    /**
     * @brief Hashes user-input password
     * @param $password user input password
     * @return string hashed version of password
     */
	private function hashPassword($password){
		return hash('sha256', $password);
	}

    /**
     * @brief Checks to see password meets length, capitalization, number, special char. requirements
     * @param $password Password to check
     * @return true (1) if password valid, false (0) if not
     */
	private function checkPassReqs($password){
		 $pass_requirements = preg_match('/^(?=.*\d)(?=.*[a-zA-Z])(?=.*[A-Z])(?=.*[-\#\$\.\%\&\*\!])(?=.*[a-zA-Z]).{8,16}$/', $password);
		 return $pass_requirements;
	}

    /**
     * @brief If post request contains signup-info, adds it to the signup model, attempts to fetch a user from the model with that username and password
     *              if account with username/email exists or if password doesn't meet requirements, adds error to model for display purposes,
     *              and if the model is free from errors, inserts the User into the database and if successful, routes the user to the login page with
     *              an appropriate 'account created' display message
     */
	public function validateSignup(){
		if(!empty($_POST['username'])){
			$this->model->username($_POST['username']);
		}
		if(!empty($_POST['password'])){
			$this->model->password($this->hashPassword($_POST['password']));
		}
		if(!empty($_POST['email'])){
			$this->model->email($_POST['email']);
		}
		if(!empty($_POST['university'])){
			$this->model->university($_POST['university']);
		}
		$user = $this->model->fetchUser();
		if($user){
			$this->model->addError("accountDupe");
		}
		if(!($this->checkPassReqs($_POST['password']))){
			$this->model->addError("invalidPass");
		}

		if(empty($this->model->getErrors())){
			$savedUser = $this->model->insertUser();

			//Route to home if user was successfully saved
			if($savedUser){
				header("Location: /terms-of-service");
			}
		}
	}
	
}
