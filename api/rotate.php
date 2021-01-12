<?php

namespace api;

use appClasses\Handler;
use appClasses\manipulateImages\Rotate;

require_once '../vendor/autoload.php';
$request_method = $_SERVER['REQUEST_METHOD'];
try {
    if ($request_method === 'POST') {

        $handler = new Handler();

        return $handler(new Rotate($_GET['id'], $_GET['degree']));
    } else {
        throw new \Exception("Incorrect method $request_method. Method POST is required for this request");
    }
} catch (\Exception $exception) {
    echo 'Caught exception: ' . $exception->getMessage();
}