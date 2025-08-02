<?php

class ImageContr extends Image {

    private $title;
    private $desc;
    private $imgfullname;

    public function __construct($title, $desc, $imgfullname){
        $this->title = $title;
        $this->desc = $desc;
        $this->imgfullname = $imgfullname;
    }

    public function updateImage(){
        $this->setImage($this->title, $this->desc, $this->imgfullname);
    }

}