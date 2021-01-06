<?php

namespace appClasses\manipulateImages;

use appClasses\parentClasses\Manipulate;
use traits\SendApiResponses;

class Resize extends Manipulate
{
    use SendApiResponses;
    public function processImageManipulation()
    {
        var_dump('from resize.php', $this->image);
    }
}