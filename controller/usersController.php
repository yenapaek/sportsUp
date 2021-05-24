<?php
require_once("./model/UserManager.php");
require_once("./model/EventManager.php");
/**
 * profile
 *
 * @param  mixed $userId
 * @return array all the informations of the user's profile.
 * @return array $mySports all the sports the user is interested in.
 */
function profile($userId)
{
    $userManager = new UserManager();
    $eventManager = new EventManager();
    $infoProfile = $userManager->myProfileModel($userId);
    $mySports = $userManager->mySportsModel($userId);
    $hostingEvents= $eventManager->eventSearch('hostingEvents','');
    $attendingEvents = $eventManager->eventSearch('attendingEvents','');
    $suggestionEvents = $eventManager->suggestEvents($userId);
    $categories = $userManager->categoriesInfoModel(true);
    require('./view/profile.php');
}

function attendEvent($eventId)
{
    $userManager = new UserManager();
    $userManager->addAttendingEvent($eventId);
    header("Location: index.php?action=eventDetail&eventId={$eventId}");
}

function cancelAttendingEvent($eventId, $source)
{
    $userManager = new UserManager();
    $userManager->removeAttendingEvent($eventId);
    if ($source === "eventDetail"){
        $source = "eventDetail&eventId={$eventId}";
    }
    header("Location: index.php?action={$source}");
}

function addMySport($userId, $categoryId)
{
    $userManager = new UserManager();
    $userManager->addMySportModel($userId, $categoryId);
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
    $userManager = new UserManager();
    $newUser = $userManager->newUserModel($user, $email, $pass, $conf);
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
    $userManager = new UserManager();
    $userInfo = $userManager->manualLoginModel($email, $pass);
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
    $userManager = new UserManager();
    $kakaoUserId = $userManager->kakaoAPICallModel($authCode);
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
    $userManager = new UserManager();
    $userManager->editUserModel($firstName, $lastName, $email, $date, $city);
}

/**
 * editProfileAvatar allow you to update picture
 *
 * @param  mixed $avatar
 * @return void
 */
function editProfileAvatar($avatar)
{
    $userManager = new UserManager();
    $userManager->editUserAvatarModel($avatar);
}

function logout()
{
    if ($_SESSION["access_token"]) {
        $userManager = new UserManager();
        $userManager->kakaoLogout();
    }
    session_destroy();
    header("Location: index.php?action=landing");
}
