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
    $attendingEvents = displayAttendingEvents($userId);
    $suggestionEvents = suggestionEventsModel($userId);
    $articles = myArticlesModel($userId);
    $suggestionArticles = '';
    $categories = displaySportsCategories($userId);
    require('./view/profile.php');
}

function addAttendingEvent($userId, $eventId)
{
    addAttendingEventModel($userId, $eventId);
    header("Location: index.php?action=eventDetail&eventId=" . $eventId);
}

function addMySport($userId, $categoryId)
{
    addMySportModel($userId, $categoryId);
}

function signInAndUpPage($param, $goPrem, $plan)
{
    $title = $param;
    if ($param && $goPrem) {
        $goPrem = $goPrem;
        $plan = $plan;
    }

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
function newUser($user, $email, $pass, $conf, $goPrem, $plan)
{
    $newUser = newUserModel($user, $email, $pass, $conf);

    $title = $newUser ? 'signIn' : 'signUp';

    if ($newUser && $goPrem) {
        $goPrem;
        $plan;
    }

    require("./view/signInAndUp.php");

    // if ($newUser) {
    //     if ($goPrem) {
    //         $goPrem = $goPrem;
    //         $plan = $plan;
    //         header("Location: index.php?action=signIn&goPrem=" . $goPrem . "&q=" . $plan);
    //     }
    //     header("Location: index.php?action=signIn");
    // } else {
    //     header("Location: index.php?action=signUp");
    // }
}

/**
 * manualLogin allow you to connect with your email and password the user created his account with
 *
 * @param  mixed $email
 * @param  mixed $pass
 * @return void
 */
function manualLogin($email, $pass, $goPrem, $plan)
{
    $userInfo = manualLoginModel($email, $pass);
    if ($userInfo && $goPrem) {
        $_SESSION['userId'] = $userInfo['id'];
        header("Location: index.php?action=premium&q=$plan");
    } elseif ($userInfo) {
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

function logout()
{
    if ($_SESSION["access_token"]) {
        kakaoLogout();
    }
    session_destroy();
    header("Location: index.php?action=landing");
}
