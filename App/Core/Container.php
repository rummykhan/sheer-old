<?php

namespace App\Core;

use ReflectionClass;

class Container
{
    protected $stack = [];

    protected function build($class)
    {
        $reflector = new ReflectionClass($class);
        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class();
        }

        $this->stack[] = $class;

        $dependencies = $constructor->getParameters();


        foreach ($parameters as $parameter) {

            echo $parameter->getName();
            echo '<br>';
            echo $parameter->getClass()->getNamespaceName();
            echo '<br>';
            echo $parameter->getClass();
            echo '<br>';
        }


        exit('');
    }

    public function create($class)
    {
        return $this->build($class);
    }

    public function call($obj, $method)
    {

    }
}