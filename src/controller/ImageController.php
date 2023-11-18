<?php 
class ImageController
{
    private $imageModel;

    public function __construct($imageModel)
    {
        $this->imageModel = $imageModel;
    }

}