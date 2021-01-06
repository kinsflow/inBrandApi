<?php


namespace database\repository;

use database\QueryController;

class GetAllImageRepo
{
    public function __invoke()
    {
        $query = "select * from tb_photo_locations where id = '1'";
        $query_controller = new QueryController();
        return $query_controller->select($query);
    }
}