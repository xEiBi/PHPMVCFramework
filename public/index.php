<?php
/**
 * User: xEiBi
 * Date: 20/12/2020
 * Time: 08:28 p. m.
 */

// Helps to include the classes with the namespaces
require_once __DIR__ . '/../vendor/autoload.php';

// Require classes with namespaces
use app\controllers\AuthController;
use app\controllers\SiteController;
use app\core\Application;

// Send parameter to the constructor
$app = new Application(dirname(__DIR__));

// Applied method get through Application class with $path and $callback
// $app->router->get('/', 'home');
$app->router->get('/', [SiteController::class, 'home']);
// This method is for pass more parameters that the previous method
$app->router->get('/contact', [SiteController::class, 'contact']);
// Applied method post through Application class with $path and $callback
$app->router->post('/contact', [SiteController::class, 'handleContact']);

$app->router->get('/login', [AuthController::class, 'login']);
$app->router->post('/login', [AuthController::class, 'login']);
$app->router->get('/register', [AuthController::class, 'register']);
$app->router->post('/register', [AuthController::class, 'register']);

// Applied run method that applied resolve method of Router class
$app->run();