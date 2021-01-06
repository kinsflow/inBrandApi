<?php

use database\QueryController;

class GetImageByIdRepo{
    public function __invoke($id)
    {
        $query = "Select * from"
        $query_controller = new QueryController();
        $query_controller->select()
    }
}