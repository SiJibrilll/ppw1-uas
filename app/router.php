<?php

$routes = require_once __DIR__ . "/../app/routes.php";

$method = $_SERVER['REQUEST_METHOD'];
$page = parse_url($_SERVER['REQUEST_URI'])['path'] == '/' ? '/home' : parse_url($_SERVER['REQUEST_URI'])['path'];

// Match route
if (isset($routes[$method][$page])) {
    [$controller, $action] = explode('@', $routes[$method][$page]);

    // Build controller path
    $controllerFile = __DIR__ . '/../app/controllers/' . $controller . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;

        // Run the controller action
        if (class_exists($controller) && method_exists($controller, $action)) {
            $controllerInstance = new $controller();
            $controllerInstance->$action();
        } else {
            http_response_code(500);
            echo "Controller or action not found.";
        }
    } else {
        http_response_code(404);
        echo "404 Not Found.";
    }
} else {
    http_response_code(404);
    echo "404 Not Found";
}
