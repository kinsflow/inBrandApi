<?php

namespace appClasses\manipulateImages;

use appClasses\parentClasses\Manipulate;

class Rotate extends Manipulate
{
    public function processImageManipulation()
    {
        var_dump('from rotate.php', $this->image);
    }
}