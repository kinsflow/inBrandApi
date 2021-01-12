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
        $binary = imagecreatefromstring(file_get_contents($image));
        $img_name = $this->removeExtensionFromImage($image);
        $image_quality = 90;

        switch ($this->format) {
            case 'jpeg':
                $binary = imagecreatefromstring(file_get_contents($image));
                imageJpeg($binary, '../images/' . $img_name . '.' . $this->format, $image_quality);
                return $img_name . '.' . $this->format;

            case 'png':
                $image_quality = floor(10 - ($image_quality / 10));
                ImagePNG($binary, '../images/' . $img_name . '.' . $this->format, $image_quality);
                return $img_name . '.' . $this->format;

            case 'pdf':


            default:
                return false;
        }
    }

    public function removeExtensionFromImage($image)
    {
        $extension = $this->getImageType($image); //get extension
        $only_name = basename($image, '.' . $extension); // remove extension
        return $only_name;
    }

    protected function getImageType($target_file)
    {
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        return $imageFileType;
    }
}