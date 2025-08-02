<?php
$titleWords = explode(" ", strtolower($image['titleGallery']));
$descWords = explode(" ", strtolower($image['descGallery']));
// Title
foreach($titleWords as $word){
    if(in_array($word, $searchWords)){
        $results = true;
        break;
    }
}
// Desc
foreach($descWords as $word){
    if(in_array($word, $searchWords)){
        $results = true;
        break;
    }
}