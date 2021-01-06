<?php

namespace api;

use appClasses\parentClasses\Manipulate;

class Handler
{
    public function __invoke(Manipulate $manipulate)
    {
        $manipulate->processImageManipulation();
    }
}