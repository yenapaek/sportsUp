<?php 

if ($_GET['code']){
    echo $_GET['code'];
    $location = 'login.php';
} else if ($_GET['access_token']){
    echo $_GET['access_token'];
    // $location = 'login.php';
}

// header('Location: '.$location);