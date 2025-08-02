<?php

class ProfileContr extends Profile {

    private $username;
    private $info;

    public function __construct($username, $info){
        $this->username = $username;
        $this->info = $info;
    }

    public function updateProfile(){

        if($this->emptyInput() == false){
            header('location: ../edit-profile.php?error=Empty input');
            exit();
        }
        if($this->invalidUsername() == false){
            header('location: ../edit-profile.php?error=Username not allowed');
            exit();
        }
        session_start();
        if($this->usernameTakenCheck() == false && $this->username != $_SESSION['username']){
            header('location: ../edit-profile.php?error=Username already taken');
            exit();
        }
        $this->updateUserProfile($this->username, $this->info);
    }

    private function emptyInput(){
        $result;
        if(empty($this->username)){
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