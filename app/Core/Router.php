<?php

namespace App\Core;

/**
 * Class Router
 * @package App\Core
 */
class Router
{
    /**
     * @var null
     */
    protected $routes = null;
    /**
     * @var Request|null
     */
    protected $request = null;
    /**
     * @var null
     */
    protected $route = null;

    /**
     * Router constructor.
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        // Update the current request.
        $this->request = $request;

        // Update routes from the file.
        $this->updateRoutes();
    }

    /**
     * Get the routes from routes file.
     */
    public function updateRoutes()
    {
        $this->routes = require '../routes/routes.php';
    }

    /**
     * Match the Request with the routes dictionary
     *
     * @param Request $request
     * @return bool
     */
    public function match(Request $request)
    {
        return $this->matchRoute();
    }

    /**
     * Match the route path, method and target Controller
     *
     * @return bool
     */
    protected function matchRoute()
    {
        return $this->routeExists() &&
            $this->methodMatched() &&
            $this->requestTargetExists();
    }

    /** Check if the route path exists or not.
     * @return bool
     */
    private function routeExists()
    {
        if (!isset($this->routes[$this->request->getPath()])) {
            return false;
        }

        $this->updateCurrentRoute($this->routes[$this->request->getPath()]);

        return true;
    }

    /**
     * Update the current route for further application usage.
     *
     * @param array $route
     */
    private function updateCurrentRoute(array $route)
    {
        $this->route = $route;
    }

    /**
     * Checks if the method of the request matched with the method in the dictionary
     *
     * @return bool
     */
    private function methodMatched()
    {
        return isset($this->route[$this->request->getRequestMethod()]);
    }

    /**
     * Checks if the target controller exists or not.
     *
     * @return bool
     */
    private function requestTargetExists()
    {
        $controller = $this->route[$this->request->getRequestMethod()];

        list($controller, $action) = explode('@', $controller);

        return class_exists($controller); //&& method_exists(new $controller(), $action)
    }

    /**
     * Get the target Controller and Action method.
     * @return array
     */
    public function getTarget()
    {
        return explode('@', $this->route[$this->request->getRequestMethod()]);
    }
}