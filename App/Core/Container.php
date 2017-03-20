<?php

namespace App\Core;

use ReflectionClass;

class Container
{
    public function make($class)
    {
        $reflector = new ReflectionClass($class);
        $constructor = $reflector->getConstructor();

        if (!is_null($constructor)) {

        }

        exit($class);
    }

    public function call($obj, $method)
    {

    }
}