<?php
if(isset($_POST['profileupdate'])){
    
    include "../classes/database.classes.php";

    $file = $_FILES['avatarfile'];
    $fileName = $file['name'];
    if(!empty($fileName)){
        $fileTmpName = $file['tmp_name'];
        $fileType = $file['type'];
        $fileError = $file['error'];
        $fileSize = $file['size'];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        $allowed = array("jpg", "jpeg", "png");

        if(in_array($fileActualExt, $allowed)){
            if($fileError === 0){
                if($fileSize < 2000000){
                    $imageFullName = "profile-picture." . uniqid("", true) . "." . $fileActualExt;
                    $fileDestination = '../img/user/'.$imageFullName;
                    session_start();
                    $conn = new Dbh();
                    $stmt = $conn->connect()->prepare('SELECT usersImg FROM users WHERE usersUsername = ?;');
                    if(!$stmt->execute(array($_SESSION['username']))){
                        $stmt = null;
                        header("location: gallery.php?error=stmtfailed");
                        exit();
                    }
                    if($stmt->rowCount() != 0){
                        $img = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        if($img[0]['usersImg'] != 'default-user-img.png'){
                            unlink('../img/user/'.$img[0]['usersImg']);
                        }
                    }


                    $stmt = $conn->connect()->prepare('UPDATE users SET usersImg = ? WHERE usersUsername = ?;');
                    if(!$stmt->execute(array($imageFullName, $_SESSION['username']))){
                        $stmt = null;
                        header("location: gallery.php?error=stmtfailed");
                        exit();
                    }
                    move_uploaded_file($fileTmpName, $fileDestination);
                }
            } else {
                header("location: edit-profile.php?error=There was an error uploading the file");
            }
        } else {
            header("location: edit-profile.php?error=Incorrect file type");
        }
    }

    $newusername = $_POST['username'];
    $userinfo = $_POST['userinfo'];
    
    include "../classes/profile.classes.php";
    include "../classes/profile-contr.classes.php";
    $profile = new ProfileContr($newusername, $userinfo);

    $profile->updateProfile();

    header("location: ../user-info.php?user=$newusername");

} else {
    header("location: ../gallery.php");
}