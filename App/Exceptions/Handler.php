<?php

namespace App\Exceptions;

use Exception;

class Handler
{
    public function handle($exception)
    {
        echo '<pre>';
        print_r($exception->getMessage());
        print_r(debug_backtrace());
    }
}