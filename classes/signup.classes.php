<?php

class Signup extends Dbh {

    protected function setUser($username, $password, $email){
        $stmt = $this->connect()->prepare('INSERT INTO users (usersUsername, usersPassword, usersEmail, usersImg) VALUES (?, ?, ?, ?);');

        $defaultProfilePicture = 'default-user-img.png';
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        if(!$stmt->execute(array($username, $hashedPassword, $email, $defaultProfilePicture))){
            $stmt = null;
            header('location: ../signup.php?error=stmtfailed');
            exit();
        }

        $stmt = null;
    }

    protected function checkUser($username, $email){
        $stmt = $this->connect()->prepare('SELECT usersUsername FROM users WHERE usersUsername = ? OR usersEmail = ?;');

        if(!$stmt->execute(array($username, $email))){
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