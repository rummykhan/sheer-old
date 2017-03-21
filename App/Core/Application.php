<?php

namespace App\Core;

use App\Router\Router;

class Application extends Container
{
    protected $request = null;
    protected $router = null;

    public function __construct()
    {
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

        $controller = $this->build($controller);

        $content =  $controller->$action();

        print_r($content);

    }
}