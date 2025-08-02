<?php

class Profile extends Dbh {

    public function updateUserProfile($username, $info){
        session_start();
        $stmt = $this->connect()->prepare('UPDATE users SET usersUsername = ?, usersInfo = ? WHERE usersUsername = ?;');

        if(!$stmt->execute(array($username, $info, $_SESSION['username']))){
            $stmt = null;
            header('location: ../edit-profile.php?error=stmtfailed');
            exit();
        }

        $stmt = $this->connect()->prepare('UPDATE gallery SET userGallery = ? WHERE userGallery = ?;');

        if(!$stmt->execute(array($username, $_SESSION['username']))){
            $stmt = null;
            header('location: ../edit-profile.php?error=stmtfailed');
            exit();
        }

        $_SESSION['username'] = $username;
    }

    protected function checkUser($username, $email){
        $stmt = $this->connect()->prepare('SELECT usersUsername FROM users WHERE usersUsername = ?;');

        if(!$stmt->execute(array($username))){
            $stmt = null;
            header("location: ../signup.php?error=stmtfailed");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0){
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }

        return $resultCheck;
    }   

}