<?php

use appClasses\Images;

require_once '../vendor/autoload.php';

$request_method = $_SERVER['REQUEST_METHOD'];
try {
    if ($request_method === 'GET') {
        $fetch_image = new Images();

        if (isset($_GET['id'])) {
            $fetch_image->getAnImage($_GET['id']);
        } else {
            $fetch_image->getAllImage();
        }
    } else {
        throw new Exception("Incorrect method $request_method. Method GET is required for this request");
    }
} catch (Exception $exception) {
    echo 'Caught exception: ' . $exception->getMessage();
}