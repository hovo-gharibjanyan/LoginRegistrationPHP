<?php
require __DIR__ . '/../vendor/autoload.php';


use App\Core\Router;



$router = new Router();
$router->route($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
