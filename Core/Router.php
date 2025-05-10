<?php

class Router{
	private $routes = [];

	public function __construct(){
		//$routes key is name of the route, ex. /route
		$this->routes['login'] = new Route('LoginModel', 'LoginView', 'LoginController');
		$this->routes['signup'] = new Route('SignupModel', 'SignupView', 'SignupController');
		$this->routes[''] = new Route('SignupModel', 'SignupView', 'SignupController');
		$this->routes['home'] = new Route('HomeModel', 'HomeView', 'HomeController');
		$this->routes['account'] = new Route('AccountModel', 'AccountPageView', 'AccountPageController');
        $this->routes['profile'] = new Route('ProfileModel', 'ProfileView', 'ProfileController');
		$this->routes['saved-listings'] = new Route('SavedListingsModel', 'SavedListingsView', 'SavedListingsController');
		$this->routes['your-listings'] = new Route('YourListingsModel', 'YourListingsView', 'YourListingsController');
		$this->routes['edit-account'] = new Route('AccountPageModel', 'AccountPageView', 'AccountPageController');
		$this->routes['terms-of-service'] = new Route('TermsOfServiceModel', 'TermsOfServiceView', 'TermsOfServiceController');
	}

	public function getRoute($routeName){
		$routeName = strtolower($routeName);
		return $this->routes[$routeName];
	}
}

class Route{
	public $model;
	public $view;
	public $controller;

	public function __construct($model, $view, $controller){
		$this->model = $model;
		$this->view = $view;
		$this->controller = $controller;
	}
}
