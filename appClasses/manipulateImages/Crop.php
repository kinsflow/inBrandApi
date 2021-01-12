<?php

namespace appClasses\manipulateImages;

use appClasses\parentClasses\Manipulate;
use database\repository\ImageRepository;
use traits\SendApiResponses;

class Crop extends Manipulate
{
    use SendApiResponses;

    private $height;
    private $width;

    public function __construct($image_id, $height, $width)
    {
        parent::__construct($image_id);
        $this->height = $height;
        $this->width = $width;
    }

    public function processImageManipulation()
    {
        $image_repo = new ImageRepository();

        $selected_image_address = $image_repo->getById((integer)$this->image_id)->fetch_assoc();
        $image_path = $image_repo->getImageFromFile($selected_image_address['file_path']);

        $this->cropImage($image_path);
    }

    public function cropImage($image)
    {
        $targ_w = 200;
        $targ_h = 45;

        $original_image = imagecreatefromjpeg($image);
        $new_image = imagecreatetruecolor($targ_w, $targ_h);
        imagecopyresampled($new_image, $original_image, 0, 0, 0, 0, $targ_w, $targ_h, $this->width, $this->height);

        imagejpeg($new_image, $image, 90);

        echo $this->successResponse("Image Cropped Successful");
    }
}