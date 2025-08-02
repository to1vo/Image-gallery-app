<?php
    if(isset($_POST['imageupdate'])){
        $title = $_POST['title'];
        $desc = $_POST['desc'];
        $imgfullname = $_GET['imgfullname'];

        include "../classes/database.classes.php";
        include "../classes/image.classes.php";
        include "../classes/image-contr.classes.php";
        $image = new ImageContr($title, $desc, $imgfullname);

        $image->updateImage();

        session_start();
        $username = $_SESSION['username'];
        header("location: ../user-settings.php?user=$username");

    }