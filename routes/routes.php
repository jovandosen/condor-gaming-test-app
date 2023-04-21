<?php

// Request method
$method = $_SERVER['REQUEST_METHOD'];

// Request URI
$uri = $_SERVER["REQUEST_URI"];

// Define routes
$routes = [
    '/' => 'home',
    '/php-info' => 'php-info',
    '/users' => 'users',
    '/users-api' => 'users-api',
    '/user' => 'user',
    '/curl-post' => 'curl-post'
];

$routeFound = false;
$routeName = '';

foreach($routes as $key => $value) {
    if($uri == $key) {
        $routeFound = true;
        $routeName = $value;
        break;
    }
}

if($routeFound) {
    require_once __DIR__ . '/../pages/' . $routeName . '.php';
} else {
    header("HTTP/1.0 404 Not Found");
    echo 'Error 404: Page not found.';
    die();
}