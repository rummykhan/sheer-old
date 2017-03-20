<?php

require '../vendor/autoload.php';

$application = new \App\Core\Application();

echo '<pre>';
if ($application->urlMatched()) {
    return $application->sendResponse();
}

throw new Exception('Route not found exception!');