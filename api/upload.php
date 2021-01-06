<?php

use appClasses\Upload;

require_once '../vendor/autoload.php';

$request_method = $_SERVER['REQUEST_METHOD'];
try {
    if ($request_method === 'POST') {
        $pics = $_FILES['pics'];

        $upload_image = new Upload();
        $upload_image($pics);
    } else {
        throw new Exception("Incorrect method $request_method. Method POST is required for this request");
    }
} catch (Exception $exception) {
    echo 'Caught exception: ' . $exception->getMessage();
}