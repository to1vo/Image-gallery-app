<?php
    session_start();
    if(isset($_POST['downloadimage'])){
        $img = $_GET['img'];
        $desc = $_GET['desc'];
        $title = $_GET['title'];
        // Jos ei ole kirjautunut
        if(!isset($_SESSION['username'])){
            // kirjautumis sivu
            header('location: ../login.php');
        }

        $filename = str_replace("'", "", $img);
        $filepath = '../'.$filename;
        if(file_exists($filepath)){
            // Ladataan tiedosto
            header("Cache-Control: public");
            header("Content-Type: image/jpg");
            header("Content-Disposition: attachment; filename=$filename");

            readfile($filepath);
        } else {
            echo 'Tiedostoa ei ole';
        }
    }