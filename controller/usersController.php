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
function profile($userId)
{
    $infoProfile = myProfileModel($userId);
    $mySports = mySportsModel($userId);
    $eventsSelect = myEventsModel($userId);
    $attendingEvents = '';
    $suggestionEvents = suggestionEventsModel($userId);
    #TODO create a view for this 2
    $articles = myArticlesModel($userId);
    $suggestionArticles = '';
    $howManyPplJoin = howManyPplJoin(2);
    $categories = displaySportsCategories();
    require('./view/profile.php');
}

function addMySport($userId, $categoryId)
{
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
 * newUser allow you to create a new user
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
 * manualLogin allow you to connect with your email and password the user created his account with
 *
 * @param  mixed $email
 * @param  mixed $pass
 * @return void
 */
function manualLogin($email, $pass)
{
    $userInfo = manualLoginModel($email, $pass);
    if ($userInfo) {
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
function kakaoAPICall($authCode)
{
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


/**
 * editProfile allow you to update you profile informations
 *
 * @param  mixed $newInfos
 * @return void
 */
function editProfile($firstName, $lastName, $email, $date, $city)
{
    editUserModel($firstName, $lastName, $email, $date, $city);
}

/**
 * editProfileAvatar allow you to update picture
 *
 * @param  mixed $avatar
 * @return void
 */
function editProfileAvatar($avatar)
{
    editUserAvatarModel($avatar);
}
