<?php

class LoginController{
	private $model;
	
	public function __construct(LoginModel $model){
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
     * @brief Updates user and password info in model and attemps to find user in database
     *          if user is found, routes user to home page and displays listings
     *          if user is not found, adds the 'invalidLogin' status to the model for display purposes
     */
	public function validateLogin(){
		if(!empty($_POST['username'])){
			$this->model->username($_POST['username']);
		}
		if(!empty($_POST['password'])){
			$this->model->password($this->hashPassword($_POST['password']));
		}

		$user = $this->model->fetchUser();

		if ($user) {
			$newSessionId = session_create_id();
			session_id($newSessionId);

			$_SESSION['username'] = $user['username'];
			$_SESSION['user_id'] = $user['id'];
			$_SESSION['last_regeneration'] = time();

			header('Location: /home?action=getListings');
			die();
		} else {
			$this->model->addStatus("invalidLogin");
		}
	}

    /**
     * @brief Function that can be called in a route to add the 'accountCreated' status to the login model
     *          for display purposes
     */
	public function accountCreated(){
		$this->model->addStatus("accountCreated");
	}

	/**
	 * @brief Function that can be called in a route to end user's session and add the 'loggedOut' status to the login model
	 *			for display purposes
	 */
	public function loggedOut(){
		$this->model->addStatus("loggedOut");
	}

}