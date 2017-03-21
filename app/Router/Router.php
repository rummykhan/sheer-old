<?php

namespace App\Router;

use App\Core\Request;

class Router
{
    protected $routes = null;
    protected $request = null;
    protected $route = null;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->updateRoutes();
    }

    public function updateRoutes()
    {
        $this->routes = require '../routes/routes.php';
    }

    public function match(Request $request)
    {
        return $this->matchRoute();
    }

    protected function matchRoute()
    {
        return $this->routeExists() &&
            $this->methodMatched() &&
            $this->requestTargetExists();
    }

    private function routeExists()
    {
        if (!isset($this->routes[$this->request->getPath()])) {
            return false;
        }

        $this->updateCurrentRoute($this->routes[$this->request->getPath()]);

        return true;
    }

    private function updateCurrentRoute(array $route)
    {
        $this->route = $route;
    }

    private function methodMatched()
    {
        return isset($this->route[$this->request->getRequestMethod()]);
    }

    private function requestTargetExists()
    {
        $controller = $this->route[$this->request->getRequestMethod()];

        list($controller, $action) = explode('@', $controller);

        return class_exists($controller); //&& method_exists(new $controller(), $action)
    }

    public function getTarget()
    {
        return explode('@', $this->route[$this->request->getRequestMethod()]);
    }
}