<?php
require_once("./model/usersManager.php");
require_once("./model/profileManager.php");

/**
 * profile
 *
 * @param  mixed $userId
 * @return array all the informations of the user's profil.
 * @return array $mySports all the sports the user is interested in.
 */
function profile($userId)
{
    $infoProfil = myProfilModel($userId);
    $mySports = mySportsModel($userId);
    $myEvents = myEventsModel($userId);
    $attendingEvents = '';
    $suggestionEvents = '';
    $articles = myArticlesModel($userId);
    $suggestionArticles = '';

    require('./view/profile.php');
}

function signInAndUpPage($param)
{
    $title = $param;
    require("./view/signInAndUp.php");
}


/**
 * newUser
 *
 * @param  mixed $user
 * @param  mixed $email
 * @param  mixed $pass
 * @param  mixed $conf
 * @return void
 */
function newUser($user, $email, $pass, $conf)
{
    $newUser = newUserModel($user, $email, $pass, $conf);
    if ($newUser) {
        header("Location: index.php?action=signIn");
    } else {
        header("Location: index.php?action=signUp");
    }
}

/**
 * manualLogin
 *
 * @param  mixed $email
 * @param  mixed $pass
 * @return void
 */
function manualLogin($email, $pass)
{
    $userInfo = manualLoginModel($email, $pass);
    if ($userInfo) {
        $title = "You get in";
        #TODO need to implement what to do if u logged IN
        
        $_SESSION['userId'] = $userInfo['id'];
        header("Location: index.php?action=profile");
    } else {
        $title = 'signIn';
        header("Location: index.php?action=signIn");
    }
}

function kakaoAPICall($authCode)
{
    $kakaoId = kakaoAPICallModel($authCode);
    if ($kakaoId) {
        $title = $kakaoId . " logged in";
        #TODO need to implement what to do if u logged IN
    } else {
        $title = "error";
    }
    header("Location: index.php?action=profile");
}
