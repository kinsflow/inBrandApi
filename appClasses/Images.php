<?php


namespace appClasses;

use database\repository\ImageRepository;
use traits\SendApiResponses;

class Images
{
    use SendApiResponses;



    public function getAnImage($id)
    {
        $image_repo = new ImageRepository();
        $fetch_response = $image_repo->getById($id)->fetch_assoc();
        $selected_image_path = $fetch_response["file_path"];

        $selected_image = $image_repo->getImageByPathName($selected_image_path);

        $arr = [];
        $arr['id'] = $fetch_response['id'];
        $arr['image'] = $selected_image;


        echo $this->successResponse($arr);
    }

    public function getAllImage()
    {
        $image_repo = new ImageRepository();
        $fetch_response = $image_repo->getAll();
        while($row = $fetch_response->fetch_object()) {
            $row->image = $image_repo->getImageByPathName($row->image);
            $arr[] = $row;
        }
        echo $this->successResponse($arr);
    }


}