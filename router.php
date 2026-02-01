<?php
use Core\Response;
$routes = require basePath('routes.php');

function routeToController($uri, $routes): void
{
    if (array_key_exists($uri, $routes)) {
        require basePath($routes[$uri]);
    } else {
        abort();
    }
}

function abort($code = Response::NOT_FOUND): void
{
    http_response_code($code);
    require basePath("views/$code.php");
    die();
}

$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

routeToController($uri, $routes);