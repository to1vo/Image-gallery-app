<?php

    function checkUserByName($username){
        $conn = new Dbh();
        $stmt = $conn->connect()->prepare('SELECT * FROM users WHERE usersUsername = ?;');
        if(!$stmt->execute(array($username))){
            $stmt = null;
            header("location: gallery.php?error=stmtfailed");
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: gallery.php?error=usernotfound'); 
            exit();
        }
    }

    function getUserAndFetch($username){
        $conn = new Dbh();
        $stmt = $conn->connect()->prepare('SELECT * FROM users WHERE usersUsername = ?;');
        if(!$stmt->execute(array($username))){
            $stmt = null;
            header("location: gallery.php?error=stmtfailed");
            exit();
        }
        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $user;
    }

    function getUserImage($username){
        $conn = new Dbh();
        $stmt = $conn->connect()->prepare('SELECT usersImg FROM users WHERE usersUsername = ?;');
        if(!$stmt->execute(array($username))){
            $stmt = null;
            header("location: gallery.php?error=stmtfailed");
            exit();
        }
        $userImg = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $userImg;
    }