<?php
session_start();
require("./controller/usersController.php");
require("./controller/eventsController.php");
try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
    switch ($action) {
        case "landing":
            if (!isset($_SESSION['userId'])) {
                require("./view/landing.php");
            } else {
                profile($_SESSION['userId']);
            }
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
            if (!empty($_REQUEST['eventId'])) {
                categoriesInfo2($_REQUEST['eventId']);
            } else {
                categoriesInfo2();
            }
            break;
        case "addEvent":
            createEvent(
                $_POST['eventName'],
                $_POST['sportCategory'],
                $_POST['city'],
                $_POST['maxPlayers'],
                $_POST['eventDate'],
                $_POST['eventDuration'],
                $_POST['eventFee'],
                $_POST['eventDescription']
            );
            break;
        case "editEvent":
            editEvent(
                $_REQUEST['eventId'],
                $_POST['eventName'],
                $_POST['sportCategory'],
                $_POST['city'],
                $_POST['maxPlayers'],
                $_POST['eventDate'],
                $_POST['eventDuration'],
                $_POST['eventFee'],
                $_POST['eventDescription']
            );
            break;

        case "postComment":
            if (!empty($_SESSION['userId']) && !empty($_POST['eventIdAdd']) && !empty($_POST['commentAdd'])) {
                postComment($_SESSION['userId'], $_POST['eventIdAdd'], $_POST['commentAdd']);
            }
            break;
        case "deleteComment":
            if (!empty($_REQUEST['commentIdDel'])) {
                deleteComment($_REQUEST['commentIdDel'], $_REQUEST['eventIdDel']);
            }
            break;
        case "signIn":
        case "signUp":
            $goPrem = false;
            $plan = false;
            if (!empty($_REQUEST['goPrem'])) {
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
            if (!isset($_SESSION['userId'])) {
                require("./view/landing.php");
            } else {
                profile($_SESSION['userId']);
            }
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
        case "oauth":
            kakaoAPICall($_REQUEST['code']);
            break;
        case "events":
            eventsInfo('default', true);
            break;
        case "eventDetail":
            if (!isset($_SESSION['userId'])) {
                require("./view/landing.php");
            } else {
                eventDetail($_REQUEST['eventId']);
            }
            break;
        case "deleteEvent":
            deleteEvent($_REQUEST['deleteEventId'], $_REQUEST['source']);
            break;
        case "attendEvent":
            if (!empty($_REQUEST['eventId'])) {
                attendEvent($_REQUEST['eventId']);
            } else {
                throw new Exception("Error with attending event.");
            }
            break;
        case "cancelAttendingEvent":
            if (!empty($_REQUEST['eventId'])) {
                cancelAttendingEvent($_REQUEST['eventId'], $_REQUEST['source']);
            } else {
                throw new Exception("Error with attending event.");
            }
            break;
        case "searchSubmit":
            if (isset($_REQUEST['searchEvent'])) {
                eventsInfo("input", $_REQUEST['searchEvent']);
            } elseif (isset($_REQUEST['sportCriteria'])) {
                eventsInfo("select", $_REQUEST['sportCriteria']);
            } elseif (isset($_REQUEST['searchPopularity'])) {
                eventsInfo("popularity", null);
            } elseif (isset($_REQUEST['attendingEvents'])) {
                eventsInfo("attendingEvents", null);
            } elseif (isset($_REQUEST['hostingEvents'])) {
                eventsInfo("hostingEvents", null);
            } elseif (isset($_REQUEST['wishlist'])) {
                eventsInfo("wishlist", null);
            }
            break;
        
        case "favoriteCreation":
            if (isset($_REQUEST['favoriteUser']) && (isset($_REQUEST['favoriteEvent']))) {
                eventsFavorite($_REQUEST['favoriteUser'], $_REQUEST['favoriteEvent']);
            } else {
                throw new Exception("Error with favorites.");
                eventsInfo("select", $_REQUEST['sportCriteria']);
            }
            break;
        case "favoriteElimination":
            if (isset($_REQUEST['favoriteUser']) && (isset($_REQUEST['favoriteEvent']))) {
                eventsFavoriteElimination($_REQUEST['favoriteUser'], $_REQUEST['favoriteEvent']);
            } else {
                throw new Exception("Error with favorites.");
                eventsInfo("select", $_REQUEST['sportCriteria']);
            }
            break;
        case "submitPremium":
            if (!empty($_POST['cardHolder']) && !empty($_POST['cardNumber']) && !empty($_POST['expirationCard']) && !empty($_POST['cvc'])) {
                premiumSubscription($_POST['expDate']);
            }
            break;
        case "logout":
            logout();
            break;
        default:
            if (!isset($_SESSION['userId'])) {
                require("./view/landing.php");
            } else {
                profile($_SESSION['userId']);
            }
            break;
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    $file = $e->getFile();
    $line = $e->getLine();
    require('./view/error.php');
}


// switch (e.target.classList.value) {
//     case 'far fa-heart':    e.target.classList.value = 'fas fa-heart';
//                             loadFile('Favorite', favorites[i].getAttribute('dataUserId'), favorites[i].getAttribute('dataEventId'));
//                             break;

//     case 'fas fa-heart' :   e.target.classList.value = 'far fa-heart';
//                             loadFile('FavoriteEliminate', favorites[i].getAttribute('dataUserId'), favorites[i].getAttribute('dataEventId'));
//                             break;

//     default: return;
// }


// switch (true) {
//     case e.target.value == 'Sport' && !checker: sportSelect.hidden = false;
//                                                 searchInput.setAttribute("type", "hidden");
//                                                 checker = true;
//                                                 break;

//     case e.target.value == 'Event': sportSelect.hidden = true;
//                                     searchInput.setAttribute("type", "text");
//                                     checker = false;
//                                     break;

//     case e.target.value == 'Popularity':    searchInput.setAttribute("type", "hidden");
//                                             sportSelect.hidden = true;
//                                             break;

//     case e.target.value == 'MyEvents':  searchInput.setAttribute("type", "hidden")
//                                         break;

//     default: return;
// }