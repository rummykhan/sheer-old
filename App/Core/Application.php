<?php

namespace App\Core;

use App\Router\Router;

class Application
{
    protected $container = null;
    protected $request = null;
    protected $router = null;

    public function __construct()
    {
        $this->container = new Container();
        $this->request = new Request();
        $this->router = new Router($this->request);
    }

    public function urlMatched()
    {
        return $this->router->match($this->request);
    }

    public function sendResponse()
    {
        list($controller, $action) = $this->router->getTarget();

        $controller = $this->container->make($controller);

        return $this->container->call($controller, $action);
    }
}