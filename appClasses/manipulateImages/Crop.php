<?php

namespace appClasses\manipulateImages;

use appClasses\parentClasses\Manipulate;

class Crop extends Manipulate
{
    public function processImageManipulation()
    {
        var_dump('from crop.php', $this->image_id);
    }
}