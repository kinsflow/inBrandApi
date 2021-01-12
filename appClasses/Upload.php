<?php

namespace appClasses;

use database\QueryController;
use traits\SendApiResponses;

class Upload
{
    use SendApiResponses;

    public function __invoke(array $image)
    {
        if (isset($image) && ($image['type'] == 'image/jpeg' || $image['type'] == 'image/png')) {
            $image_basename = 'images/' . time() . basename($image['name']);
            $current_date_time = date('Y-m-d H:i:s');
            move_uploaded_file($image['tmp_name'], '../' . $image_basename);

            $query = "insert into tb_photo_locations (file_path, created_at, updated_at) values ('$image_basename', '$current_date_time', '$current_date_time')";
            $query_controller = new QueryController();
            $query_controller->insert($query);

            echo $this->successResponse("Image Uploaded Successfully");
        } else {
            echo $this->failureResponse("Unacceptable file format", 422);
            exit();
        }
    }
}