<?php

namespace Core;

use Exception;

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    public function direct($uri, $requestType)
    {
        if (!array_key_exists($uri, $this->routes[$requestType])) {
            
            throw new Exception('No route defined for this URI.');
        }
        $arguments = explode('@', $this->routes[$requestType][$uri]);

        return $this->callAction(...$arguments);
    }

    protected function callAction($controller, $action)
    {
        $namespacedController = "App\\Controllers\\{$controller}";
        $controller = new $namespacedController;

        if (!method_exists($controller, $action)) {

            throw new Exception(
                
                "{$controller} does not respond to the {$action} action."
            );
        }

        return $controller->$action();
    }
}
