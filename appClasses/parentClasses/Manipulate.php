<?php

namespace appClasses\parentClasses;

abstract class Manipulate
{
    public $image_id;

    public function __construct($image_id)
    {
        $this->image_id = $image_id;
    }

    abstract public function processImageManipulation();
}