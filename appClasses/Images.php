<?php


namespace appClasses;

use database\repository\GetImageByIdRepo;
use traits\SendApiResponses;

class Images
{
    use SendApiResponses;

    protected $protocol;

    public function __construct()
    {
        $this->protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }

    public function getAnImage($id)
    {
        $image_repo = new GetImageByIdRepo;
        $selected_image_path = $image_repo($id)->fetch_assoc()["file_path"];

        $selected_image = $this->structureImage($selected_image_path);
        echo $this->successResponse($selected_image);
    }

    public function getAllImage()
    {
        echo "get all image";
    }

    protected function structureImage($image_path)
    {
        $docs_root = $_SERVER['SERVER_NAME'];
        return $this->protocol . "://" . $docs_root . '/' . $image_path;
    }
}