<?php

session_start();
session_unset();
session_destroy();

// Etusivulle
header('location: ../gallery.php');