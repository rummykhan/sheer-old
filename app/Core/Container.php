<?php

namespace App\Core;

use ReflectionClass;

class Container
{
    protected function getDependencies(array $parameters)
    {
        $dependencies = [];

        foreach ($parameters as $parameter) {

            $class = $parameter->getClass()->name;

            $dependencies[] = $this->build($parameter->getClass()->name);
        }

        return $dependencies;
    }

    public function build($class)
    {
        $reflector = new ReflectionClass($class);

        $constructor = $reflector->getConstructor();

        if (is_null($constructor)) {
            return new $class();
        }

        $dependencies = $this->getDependencies($constructor->getParameters());

        return $reflector->newInstanceArgs($dependencies);
    }
}