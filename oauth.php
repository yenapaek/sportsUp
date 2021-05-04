<?php 
session_start();

if ($_GET['code']){
    echo 'Code: '.$_GET['code']."<br>";
    $_SESSION['auth_code'] = $_GET['code'];
    echo 'Session: '.$_SESSION['auth_code'];
}
header("Location: login.php");