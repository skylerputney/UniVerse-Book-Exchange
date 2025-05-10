<?php
require_once 'config.php';

ini_set('session.use_only_cookies' , 1);
ini_set('session.use_strict_mode', 1);

global $basePath;
$basePath = BASE_PATH;

session_set_cookie_params([
    'lifetime' => 1800,
    'domain' => $_SERVER['HTTP_HOST'],
    'path' => '/',
    'secure' => false,
    'httponly' => true
]);

session_start();

require_once 'config_session.php';

//Include configuration file





require_once $basePath . "/Core/Controller.php";
require_once $basePath . "/Core/Router.php";
require_once $basePath . "/Core/Database.php";



$controller = new Controller(new Router, $_GET['route'] ?? '', isset($_GET['action']) ? $_GET['action'] : null, new Database);
echo $controller->display();