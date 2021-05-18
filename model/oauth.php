<?php 
    session_start();
    if (isset($_GET['code'])){
        $_SESSION['code'] = $_GET['code'];
        header("Location:http://127.0.0.1/sportsEvent/index.php?action=kakaoAPICall");
    }
