<?php

if(isset($_POST['signup'])){
    // Käyttäjän tiedot
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordrepeat = $_POST['passwordrepeat'];
    $email = $_POST['email'];

    // Tehdään objekti
    include "../classes/database.classes.php";
    include "../classes/signup.classes.php";
    include "../classes/signup-contr.classes.php";
    $signup = new SignupContr($username, $password, $passwordrepeat, $email);

    // Luodaan käyttäjä
    $signup->signupUser();

    // Takaisin login sivulle
    header('location: ../login.php?success=Account created successfully!');
}