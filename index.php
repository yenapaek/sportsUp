<?php
session_start();
require("./controller/usersController.php");
require("./controller/eventsController.php");

try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
    switch ($action) {
        case "landing":
            require("./view/landing.php");
            break;
        case "premium":
            if (!empty($_REQUEST['q'])) {
                premium($_REQUEST['q']);
            } else {
                premium(false);
            }
            break;
        case "aboutUs":
            require("./view/aboutUs.php");
            break;
        case "addEditEvent":
            categoriesInfo2();
            break;
        case "createEvent":
            createEvent(
                $_POST['eventName'],
                $_POST['sportCategory'],
                $_POST['city'],
                $_POST['maxPlayers'],
                $_POST['eventDate'],
                $_POST['eventDuration'],
                $_POST['eventDescription'],
                $_POST['eventFee']
            );
            break;
        case "signIn":
        case "signUp":
            $goPrem = false;
            $plan = false;
            if (isset($_REQUEST['goPrem'])) {
                $goPrem = true;
                $plan = $_REQUEST['q'];
            }
            signInAndUpPage(
                $_REQUEST['action'],
                $goPrem,
                $plan
            );
            break;
        case "profile":
            profile($_SESSION['userId']);
            break;
        case "addMySport":
            if (!empty($_POST['categoryId'])) {
                addMySport($_SESSION['userId'], $_POST['categoryId']);
            } else {
                throw new Exception("Error with category.");
            }
            break;
        case "editProfileAvatar":
            editProfileAvatar($_FILES['file']);
            break;
        case "editProfileInfo":
            editProfile(
                $_POST['first'],
                $_POST['last'],
                $_POST['email'],
                $_POST['date'],
                $_POST['city']
            );
            break;
        case "signInSubmit":
            if (!empty($_POST['emailSignIn']) && !empty($_POST['passwordSignIn'])) {
                $goPrem = false;
                $plan = false;
                if (isset($_REQUEST['goPrem'])) {
                    $goPrem = true;
                    $plan = $_REQUEST['q'];
                }
                manualLogin(
                    $_POST['emailSignIn'],
                    $_POST['passwordSignIn'],
                    $goPrem,
                    $plan
                );
            } else {
                throw new Exception("Please fill again the form");
            }
            break;
        case "signUpSubmit":
            if (!empty($_POST['userNameSignUp']) && !empty($_POST['emailSignUp']) && !empty($_POST['passwordSignUp']) && !empty($_POST['passwordConfSignUp'])) {
                $goPrem = false;
                $plan = false;

                if (!empty($_POST['goPrem'])) {
                    $goPrem = true;
                    $plan = $_POST['q'];
                }
                newUser(
                    $_POST['userNameSignUp'],
                    $_POST['emailSignUp'],
                    $_POST['passwordSignUp'],
                    $_POST['passwordConfSignUp'],
                    $goPrem,
                    $plan
                );
            } else {
                throw new Exception("Please fill again the form");
            }
            break;
        case "kakaoAPICall":
            if (isset($_SESSION['code'])) {
                kakaoAPICall($_SESSION['code']);
            } else {
                throw new Exception("Error with Kakao Login.");
            }
            break;
        case "events":
            eventsInfo("default", true);
            break;
        case "eventDetail":
            eventDetail($_REQUEST['eventId']);
            break;
        case "deleteEvent":
            deleteEvent($_REQUEST['deleteEventId']);
            break;
        case "attendEvent":
            if (!empty($_REQUEST['eventId'])) {
                addAttendingEvent($_SESSION['userId'], $_REQUEST['eventId']);
            } else {
                throw new Exception("Error with attending event.");
            }
            break;
        case "searchSubmit":
            if (isset($_REQUEST['searchEvent'])) {
                eventsInfo("input", $_REQUEST['searchEvent']);
            } elseif (isset($_REQUEST['sportCriteria'])) {
                eventsInfo("select", $_REQUEST['sportCriteria']);
            }
            break;
        case "submitPremium":

            break;
        case "logout":
            logout();
            break;
        default:
            require("./view/landing.php");
            break;
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    $file = $e->getFile();
    $line = $e->getLine();
    require('./view/error.php');
}
