<?php
require_once("./model/usersManager.php");
require_once("./model/profileManager.php");

/**
 * profile
 *
 * @param  mixed $userId
 * @return array all the informations of the user's profile.
 * @return array $mySports all the sports the user is interested in.
 */
function profile($userId){
    $infoProfile = myProfileModel($userId);
    $mySports = mySportsModel($userId);
    $myEvents = myEventsModel($userId);
    $attendingEvents = '';
    $suggestionEvents = suggestionEventsModel($userId);
    $articles = myArticlesModel($userId);
    $suggestionArticles = '';
    $categories = displaySportsCategories();
    require('./view/profile.php');
}

function addMySport($userId, $categoryId){
    addMySportModel($userId, $categoryId);
    // $mySports = mySportsModel($userId);
    // header("Location: index.php?action=profile");
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

/**
 * kakaoAPICall
 *
 * @param  mixed $authCode
 * @return 
 */
function kakaoAPICall($authCode){
    $kakaoUserId = kakaoAPICallModel($authCode);
    if ($kakaoUserId) {
        $title = "You get in";
        #TODO need to implement what to do if u logged IN

        $_SESSION['userId'] = $kakaoUserId;
        header("Location: index.php?action=profile");
    } else {
        $title = 'signIn';
        header("Location: index.php?action=signIn");
    }
}

function logout()
{
    if($_SESSION["access_token"]){
        kakaoLogout();
    }
    session_destroy();
    header("Location: index.php?action=landing");
}
