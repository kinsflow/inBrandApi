<?php


namespace appClasses\manipulateImages;


use appClasses\parentClasses\Manipulate;
use database\repository\ImageRepository;
use traits\SendApiResponses;

class Export extends Manipulate
{
    use SendApiResponses;

    private $format;

    public function __construct($image_id, $format)
    {
        parent::__construct($image_id);
        $this->format = $format;
    }

    public function processImageManipulation()
    {
        $image_repo = new ImageRepository();

        $selected_image_address = $image_repo->getById((integer)$this->image_id)->fetch_assoc();
        $image_path = $image_repo->getImageFromFile($selected_image_address['file_path']);
        $this->exportImage($image_path);
    }

    public function exportImage($image)
    {
        $file = file_get_contents($image);
        $file_ext = substr(mime_content_type($image), strpos(mime_content_type($image), "/") + 1);
        $file_name = pathinfo($image)['basename'];

        $new_image = file_put_contents('../images/'.$file_name, $file);

//        switch ($this->format) {
//            case 'jpeg':
//                imagejpeg($new_image, $image, 90)
//        }
    }
}