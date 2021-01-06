<?php

namespace appClasses;

use appClasses\parentClasses\Manipulate;

class Handler
{
    public function __invoke(Manipulate $manipulate)
    {
        $manipulate->processImageManipulation();
    }
}