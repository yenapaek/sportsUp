<?php 
    session_start();
    if (isset($_GET['code'])){
        echo "hello";
        $_SESSION['code'] = $_GET['code'];
        echo $_SESSION['code'];
        header("Location:http://localhost/sportsEvent/index.php?action=kakaoAPICall");
    }
