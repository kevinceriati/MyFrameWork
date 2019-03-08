<?php

require __DIR__ . "/../vendor/autoload.php";

use \Core\Request;
use \Core\Router\Router;
use \Core\Router\Route;
use \App\Controller\UsersController;
$request = Request::createFromGlobals();

$router = new Router($request);

try {
    $router
        ->addRoute(new Route("testsFoo", "/tests/foo", [], \App\Controller\TestsController::class, "foo"))
        ->addRoute(new Route("testsBar", "/tests/bar/:param", ["param" => "[\w]+"], \App\Controller\TestsController::class, "bar"))
        ->addRoute(new Route("testsRedirectionRedirected", "/tests/redirection/:param", ["param" => "[\w]+"], \App\Controller\TestsController::class, "redirection"))
        ->addRoute(new Route("index", "/index", [], UsersController::class, "index"))
        ->addRoute(new Route("login", "/login", [], UsersController::class, "login"))
        ->addRoute(new Route("logout", "/logout", [], UsersController::class, "logout"));

    $route = $router->getRouteByRequest();
    $route->call($request, $router);
} catch (\Exception $e) {
    echo $e->getMessage();
}




