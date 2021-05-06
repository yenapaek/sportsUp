<?php 
session_start();

if (isset($_GET['code'])){
    $_SESSION['code'] = $_GET['code'];
    echo $_SESSION['code'];
    header("Location: ../index.php?action=kakaoAPICall");
}