<?php

namespace appClasses\manipulateImages;

use appClasses\parentClasses\Manipulate;
use database\repository\ImageRepository;
use traits\SendApiResponses;

class Rotate extends Manipulate
{
    use SendApiResponses;

    private $degree;

    public function __construct($image_id, $degree)
    {
        parent::__construct($image_id);
        $this->degree = $degree;
    }

    public function processImageManipulation()
    {
        $image_repo = new ImageRepository();

        $selected_image_address = $image_repo->getById((integer)$this->image_id)->fetch_assoc();
        $image_path = $image_repo->getImageFromFile($selected_image_address['file_path']);

        $this->rotate($image_path);
    }

    public function rotate($image)
    {

        $original_image = imagecreatefromjpeg($image);
        $rotated_image = imagerotate($original_image, $this->degree, 0);
        header("Content-type: image/png");

        imagejpeg($rotated_image, $image, 90);

        echo $this->successResponse("Image Rotated Successful");
    }
}