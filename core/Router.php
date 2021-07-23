<?php

namespace Core;

use Exception;

class Router
{
    public $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * Load
     *
     * @param string $file file
     *
     * @return mixed
     */
    public static function load($file)
    {
        $router = new static;
        require $file;
        return $router;
    }

    /**
     * Load
     *
     * @param string $uri        uri
     * @param string $controller controller
     *
     * @return mixed
     */
    public function get($uri, $controller)
    {
        $this->routes['GET'][$uri] = $controller;
    }

    /**
     * Post
     *
     * @param string $uri        uri
     * @param string $controller controller
     *
     * @return mixed
     */
    public function post($uri, $controller)
    {
        $this->routes['POST'][$uri] = $controller;
    }

    /**
     * Direct
     *
     * @param string $uri         uri
     * @param string $requestType requestType
     *
     * @return mixed
     */
    public function direct($uri, $requestType)
    {
        if (!array_key_exists($uri, $this->routes[$requestType])) {
            throw new Exception('No route defined for this URI.');
        }
        $arguments = explode('@', $this->routes[$requestType][$uri]);

        return $this->callAction(...$arguments);
    }

    /**
     * Call action
     *
     * @param string $controller controller
     * @param string $action     action
     *
     * @return mixed
     */
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
