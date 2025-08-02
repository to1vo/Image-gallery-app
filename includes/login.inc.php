<?php

if(isset($_POST['login'])){
    // Data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Tehdään objekti
    include "../classes/database.classes.php";
    include "../classes/login.classes.php";
    include "../classes/login-contr.classes.php";
    $login = new LoginContr($username, $password);

    // Kirjaudutaan sisään
    $login->loginUser();

    // Etusivulle
    header('location: ../gallery.php?error=none');
}