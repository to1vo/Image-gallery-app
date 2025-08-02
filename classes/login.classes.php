<?php

class Login extends Dbh {

    protected function getUser($username, $password){
        $stmt = $this->connect()->prepare('SELECT usersPassword FROM users WHERE usersUsername = ?;');

        if(!$stmt->execute(array($username))){
            $stmt = null;
            header('location: ../login.php?error=stmtfailed');
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header('location: ../login.php?error=User not found');
            exit();
        }

        $passwordHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $passwordHashed[0]["usersPassword"]);

        if($checkPassword == false){
            $stmt = null;
            header('location: ../login.php?error=Wrong password');
            exit();
        } elseif($checkPassword == true){
            $stmt = $this->connect()->prepare('SELECT * FROM users WHERE usersUsername = ? AND usersPassword = ?;');

            if(!$stmt->execute(array($username, $passwordHashed[0]["usersPassword"]))){
                $stmt = null;
                header('location: ../login.php?error=stmtfailed');
                exit();
            }

            if($stmt->rowCount() == 0){
                $stmt = null;
                header("location: ../login.php?error=User not found");
                exit();
            }

            $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

            session_start();
            $_SESSION['userid'] = $user[0]['usersId'];
            $_SESSION['username'] = $user[0]['usersUsername'];

            $stmt = null;
        }

    }

}