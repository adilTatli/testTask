<?php
declare(strict_types = 1);

include_once ('../vendor/autoload.php');

use App\Helpers\Router;
use App\Middleware\AuthMiddleware;

session_start();

$router = new Router();

$router->addRoute('/', 'App\Controllers\UserController@index');
$router->addRoute('/login', 'App\Controllers\UserController@login');
$router->addRoute('/account', 'App\Controllers\AccountController@index', [AuthMiddleware::class]);

$currentUrl = $_SERVER['REQUEST_URI'];

$router->route($currentUrl);


