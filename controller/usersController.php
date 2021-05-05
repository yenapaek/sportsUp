<?php
require_once("./model/usersManager.php");


function signInAndUpPage($param)
{
    $title = $param;
    require("./view/signInAndUp.php");
}

function newUser($user, $email, $pass, $conf)
{
    $newUser = newUserModel($user, $email, $pass, $conf);
    if ($newUser) {
        header("Location: index.php?action=signIn");
    } else {
        header("Location: index.php?action=signUp");
    }
}

function manualLogin($email, $pass)
{
    $login = manualLoginModel($email, $pass);
    if ($login) {
        $title = "You get in";
        #TODO need to implement what to do if u logged IN
    }
    require("./view/profile.php"); 
}

function kakaoAPICall($authCode){
    $kakaoId = kakaoAPICallModel($authCode);
    if ($kakaoId) {
        $title = $kakaoId." logged in";
        #TODO need to implement what to do if u logged IN
    } else {
        $title = "error";
    }
    require("./view/profile.php"); 
}
