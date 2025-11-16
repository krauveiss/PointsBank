<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . "/../functions.php";

require base_path('classes/Router.php');
$router = new Router();

$path = parse_url($_SERVER['REQUEST_URI'])['path'];
$method = $_POST['__method'] ?? $_SERVER['REQUEST_METHOD'];

require base_path('routes.php');
$router->route($path, $method);
