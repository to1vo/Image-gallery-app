<?php

    function getGalleryByUserAndFetch($username){
        $conn = new Dbh();
        $stmt = $conn->connect()->prepare('SELECT * FROM gallery WHERE userGallery = ? ORDER BY idGallery DESC;');
        if(!$stmt->execute(array($username))){
            $stmt = null;
            header("location: gallery.php?error=stmtfailed");
            exit();
        }

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $images;
    }

    function getAllFromGallery(){
        $conn = new Dbh();
        $stmt = $conn->connect()->prepare('SELECT * FROM gallery ORDER BY idGallery DESC');
        if(!$stmt->execute()){
            $stmt = null;
            header("location: gallery.php?error=stmtfailed");
            exit();
        }

        $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $images;
    }

    function getImageOrder(){
        $conn = new Dbh();
        $stmt = $conn->connect()->prepare('SELECT * FROM gallery');
        if(!$stmt->execute()){
            $stmt = null;
            header("location: gallery.php?error=stmtfailed");
            exit();
        }
        return $stmt->rowCount();
    }

    function getGalleryByImgnameAndFetch($img){
        $conn = new Dbh();
        $stmt = $conn->connect()->prepare('SELECT * FROM gallery WHERE imgFullNameGallery = ?;');
        if(!$stmt->execute(array($img))){
            $stmt = null;
            header("location: gallery.php?error=stmtfailed");
            exit();
        }

        $image = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $image;
    }