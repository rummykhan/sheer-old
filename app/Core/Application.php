<?php

namespace App\Core;

/**
 * Class Application
 * @package App\Core
 */
class Application extends Container
{
    /**
     * @var Request|null
     */
    protected $request = null;
    /**
     * @var Router|null
     */
    protected $router = null;

    /**
     * @array $instances
     */
    protected $instances = [];

    /**
     * Application constructor.
     */
    public function __construct()
    {
        // Bootstrap the application services.
        $this->bootstrap();

        // At application start initialize the new request
        $this->request = $this->get('request');

        // At application start initialize the Router
        $this->router = $this->get('router');
    }

    /**
     * Check if the incoming url match
     * in the given dictionary
     * @return bool
     */
    public function urlMatched()
    {
        return $this->router->match($this->request);
    }

    /**
     * Once url is matched, we can get the target Controller
     * and render the response for the user.
     * @return mixed
     */
    public function sendResponse()
    {
        // Get controller and action from the dictionary related to current url
        list($controller, $action) = $this->router->getTarget();

        // Get controller object.
        $controller = $this->build($controller);

        // get Response from controller action
        $content = $controller->$action();

        // render the Response
        return $content->render();
    }

    /**
     * Bootstrap the application Core Services
     */
    private function bootstrap()
    {
        $aliases = [
            'request' => 'App\Core\Request',
            'router' => 'App\Core\Router'
        ];

        foreach ($aliases as $alias => $class) {
            // Add an instance to the instances array
            $this->addInstance($alias, $this->build($class));
        }
    }

    /**
     * Add an instance to the instances array
     *
     * @param string $alias
     * @param object $instance
     */
    public function addInstance($alias, $instance)
    {
        $this->instances[$alias] = $instance;
    }

    /**
     * Checks if it has the object already, return that
     * otherwise build the object and return that.
     *
     * @param string $name
     * @return object
     */
    public function get($name)
    {
        // if we have the object already no need to create another
        if( isset($this->instances[$name]) ){
            return $this->instances[$name];
        }

        // we know this is not in the instances
        $instance = $this->build($name);

        // Add an instance to the instances array
        $this->addInstance($name, $instance);

        // return object
        return $instance;
    }
}