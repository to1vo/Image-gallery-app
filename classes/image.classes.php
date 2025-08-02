<?php

class Image extends Dbh {

    protected function setImage($title, $desc, $imgfullname){
        $stmt = $this->connect()->prepare('UPDATE gallery SET titleGallery = ?, descGallery = ? WHERE imgFullNameGallery = ?;');

        if(!$stmt->execute(array($title, $desc, $imgfullname))){
            $stmt = null;
            header("location: gallery.php");
            exit();
        }
    }

}