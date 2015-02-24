<?php

$database = include __DIR__ . '/config/database.php';
require_once __DIR__.'/vendor/autoload.php';

session_start();

// les routes
$routes = include __DIR__.'/config/routes.php';

use Service\Connect;
use Service\Router;

$conn = Connect::setDB($database); // récupérer par la classe Controller

$router = new Router;
$router->addRoute($routes);

 
    
$uri=  parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
define('URI',$uri); /* define permet de cree une constant pour tous le scope , les pages*/
