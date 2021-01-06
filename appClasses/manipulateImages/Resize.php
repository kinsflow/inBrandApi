<?php

namespace appClasses\manipulateImages;

use appClasses\parentClasses\Manipulate;
use database\repository\GetImageByIdRepo;
use traits\SendApiResponses;

class Resize extends Manipulate
{
    use SendApiResponses;

    public function processImageManipulation()
    {
        $get_image_repo = new GetImageByIdRepo;

        $selected_image = $get_image_repo((integer)$this->image_id)->fetch_assoc();
        var_dump(($selected_image));
    }
}