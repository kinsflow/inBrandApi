<?php

namespace api;

use appClasses\manipulateImages\Resize;

require_once '../vendor/autoload.php';
$request_method = $_SERVER['REQUEST_METHOD'];
try {
    if ($request_method === 'POST') {

        $handler = new Handler();

        return $handler(new Resize($_FILES['pics']));
    } else {
        throw new \Exception("Incorrect method $request_method. Method POST is required for this request");
    }
} catch (\Exception $exception) {
    echo 'Caught exception: ' . $exception->getMessage();
}
