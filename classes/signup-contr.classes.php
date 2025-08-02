<?php

class SignupContr extends Signup {

    private $username;
    private $password;
    private $passwordrepeat;
    private $email;

    public function __construct($username, $password, $passwordrepeat, $email){
        $this->username = $username;
        $this->password = $password;
        $this->passwordrepeat = $passwordrepeat;
        $this->email = $email;
    }

    public function signupUser(){
        if($this->emptyInput() == false){
            header('location: ../signup.php?error=Empty input');
            exit();
        }
        if($this->invalidUsername() == false){
            header('location: ../signup.php?error=Username not allowed');
            exit();
        }
        if($this->usernameTakenCheck() == false){
            header('location: ../signup.php?error=Username or email already taken');
            exit();
        }
        if($this->passwordLength() == false){
            header('location: ../signup.php?error=Password is too short');
            exit();
        }
        if($this->passwordMatch() == false){
            header('location: ../signup.php?error=Passwords dont match');
            exit();
        }
        if($this->invalidEmail() == false){
            header('location: ../signup.php?error=Email is incorrect');
            exit();
        }
        $this->setUser($this->username, $this->password, $this->email);
    }

    private function emptyInput(){
        $result;
        if(empty($this->username) || empty($this->password) || empty($this->passwordrepeat) || empty($this->email)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidUsername(){
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->username)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function invalidEmail(){
        $result;
        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordLength(){
        $result;
        if(strlen($this->password) < 5){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function passwordMatch(){
        $result;
        if($this->password !== $this->passwordrepeat){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    private function usernameTakenCheck(){
        $result;
        if(!$this->checkUser($this->username, $this->email)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}