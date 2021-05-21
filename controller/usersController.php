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
    $eventsSelect = $eventManager->myEventsModel($userId);
    $attendingEvents = $userManager->displayAttendingEvents($userId);
    $suggestionEvents = $eventManager->suggestionEventsModel($userId);
    $suggestionArticles = '';
    $categories = $userManager->categoriesInfoModel(true);
    require('./view/profile.php');
}

function addAttendingEvent($userId, $eventId)
{
    $userManager = new UserManager();
    $userManager->addAttendingEventModel($userId, $eventId);
    header("Location: index.php?action=eventDetail&eventId=" . $eventId);
}

function addMySport($userId, $categoryId)
{
    $userManager = new UserManager();
    $userManager->addMySportModel($userId, $categoryId);
}

/**
 * signInAndUpPage is here to redirect you to the right form to sign in or Up, 
 *
 * @param  mixed $param can be 'signIn' or 'signUp'
 * @param  mixed $goPrem check if the when we go to those page we clicked on premium first
 * @param  mixed $plan can be 'false' or 'month' or 'year'
 * @return void
 */
function signInAndUpPage($param, $goPrem, $plan)
{
    $title = $param;
    if ($param && $goPrem) {
        $goPrem;
        $plan;
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
    $userManager = new UserManager();
    $newUser = $userManager->newUserModel($user, $email, $pass, $conf);

    $title = $newUser ? 'signIn' : 'signUp';
    if ($newUser && $goPrem) {
        $goPrem;
        $plan;
    }

    require("./view/signInAndUp.php");
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
    $userManager = new UserManager();
    $userInfo = $userManager->manualLoginModel($email, $pass);
    if ($userInfo && $goPrem && $plan) {
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

/**
 * premium redirect you to the right page and prefilled information according if it's monthly or yearly plan
 *
 * @param  mixed $whichPlan
 * @return void
 */
function premium($whichPlan)
{
    $userManager = new UserManager();
    $userInfo = isset($_SESSION['userId']) ? $userManager->myProfileModel($_SESSION['userId']) : '';
    $link = $whichPlan ? 'premiumCheckOut.php' : 'premium.php';
    $pricing = $whichPlan === 'month' ? '9.99' : '99';
    $expirationDate = $whichPlan ? new \DateTime('1 ' . $whichPlan) : '';

    require("./view/" . $link);
}

/**
 * premiumSubscription allow you to update the table when the user subscribe to premium
 * the id of the user, the date of the moment the user subscribe and also the expiration date
 *
 * @param  mixed $expDate
 * @return void
 */
function premiumSubscription($expDate)
{
    $userManager = new UserManager();
    $premiumUser = $userManager->becomePremium($expDate, $_SESSION['userId']);
    header("Location: index.php?action=profile");
}
