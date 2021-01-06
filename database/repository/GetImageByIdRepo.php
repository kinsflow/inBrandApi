<?php

namespace database\repository;

use database\QueryController;

/**
 * Class GetImageByIdRepo
 * @package database\repository
 */
class GetImageByIdRepo
{
    public function __invoke($id)
    {
        $query = "select * from tb_photo_locations where id = '$id'";

        $query_controller = new QueryController();
        return $query_controller->select($query);
    }
}