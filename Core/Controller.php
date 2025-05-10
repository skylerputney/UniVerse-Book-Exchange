<?php

class Controller{
	private $controller;
	private $view;
	private $db;

	/**
	 * @brief Obtains a route and instantiates appropriate components for said route; calls controller action if applicable
	 *
	 */
	public function __construct(Router $router, $routeName, $action = null, Database $db){
		global $basePath;

		//Obtain route based on name
		$route = $router->getRoute($routeName) ?? '';

		//Obtain component names from Router
		$modelName = $route->model;
		$controllerName = $route->controller;
		$viewName = $route->view;

		//Require each component
		require_once $basePath . "/Model/$modelName" . ".php";
		require_once $basePath . "/Controller/$controllerName" . ".php";
		require_once $basePath . "/View/$viewName" . ".php";
		require_once $basePath . "/View/Navbar.php";

		//Instantiate each component
		$model = new $modelName($db);
		$this->controller = new $controllerName($model);
		$this->view = new $viewName($model);

		//Run controller action if specified
		if(!empty($action)){
			$this->controller->{$action}();
		}
		if(!empty($_POST['action'])){
			$this->controller->{$_POST['action']}();
		}
	}

	/**
	 * @brief Displays the current page user is on
	 */
	public function display(){
		return  $this->view->display();
	}
}