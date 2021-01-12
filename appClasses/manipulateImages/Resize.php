<?php

namespace appClasses\manipulateImages;

use appClasses\parentClasses\Manipulate;
use database\repository\ImageRepository;
use traits\SendApiResponses;

class Resize extends Manipulate
{
    use SendApiResponses;

    private $max_res;

    public function __construct($image_id, $max_res)
    {
        parent::__construct($image_id);

        $this->max_res = $max_res;
    }

    public function processImageManipulation()
    {
        $image_repo = new ImageRepository();

        $selected_image_address = $image_repo->getById((integer)$this->image_id)->fetch_assoc();
        $image_path = $image_repo->getImageFromFile($selected_image_address['file_path']);
        $this->resizeImage($image_path);

    }

    private function resizeImage($image)
    {
        $original_image = imagecreatefromjpeg($image);


        $original_width = imagesx($original_image);
        $original_height = imagesy($original_image);

        $ratio = $this->max_res / $original_width;
        $new_width = $this->max_res;
        $new_height = $original_height * $ratio;

        if ($new_height > $this->max_res) {
            $ratio = $this->max_res / $original_height;
            $new_height = $this->max_res;
            $new_width = $original_width * $ratio;
        }

        if ($original_image) {
            $new_image = imagecreatetruecolor($new_width, $new_height);
            imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $new_width, $new_height, $original_width, $original_height);

            imagejpeg($new_image, $image, 90);

            echo $this->successResponse("Image Resizing Successful");

        }
    }
}