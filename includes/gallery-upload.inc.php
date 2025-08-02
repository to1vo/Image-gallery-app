<?php
include "../classes/database.classes.php";
include "get-gallery.inc.php";
session_start();
 
if(isset($_POST['submit'])){
    $newFileName = $_POST['filename'];
    if(empty($_POST['filename'])){
        $newFileName = "img";
    } else {
        $newFileName = strtolower(str_replace(" ", "-", $newFileName));
    }
    $imageTitle = $_POST['filetitle'];
    $imageDesc = $_POST['filedesc'];
    $file = $_FILES['file'];

    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileType = $file['type'];
    $fileError = $file['error'];
    $fileSize = $file['size'];

    if(empty($fileName)){
        header("location: ../upload.php?upload=No file given");
        exit();
    }

    $fileExt = explode(".", $fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg", "jpeg", "png");

    if(in_array($fileActualExt, $allowed)){
        if($fileError === 0){
            if($fileSize < 2000000){
                $imageFullName = $newFileName . "." . uniqid("", true) . "." . $fileActualExt;
                $fileDestination = "../img/gallery/" . $imageFullName;

                if(empty($imageTitle)){
                    header("location: ../upload.php?upload=You need to give title to the image");
                    exit();
                } else {
                    $imageOrder = getImageOrder();
                    $setImageOrder = $imageOrder + 1;

                    $sql = "INSERT INTO gallery (titleGallery, descGallery, imgFullNameGallery, orderGallery, userGallery) VALUES (?, ?, ?, ?, ?);";
                    $conn = new Dbh();
                    $stmt = $conn->connect()->prepare($sql);
                    if(!$stmt->execute(array($imageTitle, $imageDesc, $imageFullName, $setImageOrder, $_SESSION['username']))){
                        $stmt = null;
                        header("location: ../gallery.php?error=stmtfailed");
                        exit();
                    }
                    move_uploaded_file($fileTmpName, $fileDestination);

                    header("location: ../upload.php?success=Image uploaded successfully");
                    }
                }
            } else {
                echo "File size is too big!";
                exit();
            }
        } else {
            echo "You had an error!";
            exit();
        }
    } else {
        echo "Incorrect file type!";
        exit();
    }