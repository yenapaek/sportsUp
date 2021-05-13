<?php 
    session_start();
    if (isset($_GET['code'])){
        echo "hello";
        $_SESSION['code'] = $_GET['code'];
        echo $_SESSION['code'];
        header("Location:http://127.0.0.1/sportsEvent/index.php?action=kakaoAPICall");
    }
