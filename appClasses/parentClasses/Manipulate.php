<?php

namespace appClasses\parentClasses;

abstract class Manipulate
{
    public $image;

    public function __construct($image)
    {
        $this->image = $image;
    }

    abstract public function processImageManipulation();
}