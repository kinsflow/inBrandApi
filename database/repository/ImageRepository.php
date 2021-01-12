<?php namespace database\repository;

use database\QueryController;

class ImageRepository // todo: Create a repository Interface and flip all dependencies
{
    protected $protocol;

    public function __construct()
    {
        $this->protocol = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != "off") ? "https" : "http";
    }

    public function getById(int $id)
    {
        $query = "select * from tb_photo_locations where id = '$id'";

        $query_controller = new QueryController();
        return $query_controller->select($query);
    }

    public function getAll()
    {
        $query = "SELECT id, file_path as image FROM tb_photo_locations";
        $query_controller = new QueryController();
        return $query_controller->select($query);
    }

    public function getImageByPathName($image_path)
    {
        $docs_root = $_SERVER['SERVER_NAME'];
        return $this->protocol . "://" . $docs_root . '/' . $image_path;
    }

    public function getImageFromFile($image_path)
    {
        return '../' . $image_path;
    }

}