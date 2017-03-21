<?php

require '../vendor/autoload.php';

$application = new \App\Core\Application();
$handler = new \App\Exceptions\Handler();

set_exception_handler([$handler, 'handle']);

if ($application->urlMatched()) {
    return $application->sendResponse();
}

throw new Exception('Route not found exception!');