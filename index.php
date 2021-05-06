<?php

require("./controller/controller.php");
require("./controller/usersController.php");
require("./controller/eventsController.php");

try {
    $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
    switch ($action) {
        case "landing":
            landing();
            break;
        case "aboutUs":
            aboutUs();
            break;
        case "signIn":
        case "signUp":
            signInAndUpPage($_REQUEST['action']);
            break;

        case "profile":
            profile(1); // #TODO Parameter should be replaced after we implement the loggin ID
            break;

        case "signInSubmit":
            if (!empty($_POST['emailSignIn']) && !empty($_POST['passwordSignIn'])) {
                manualLogin($_POST['emailSignIn'], $_POST['passwordSignIn']);
            } else {
                throw new Exception("Please fill again the form");
            }
            break;
        case "signUpSubmit":
            if (!empty($_POST['userNameSignUp']) && !empty($_POST['emailSignUp']) && !empty($_POST['passwordSignUp']) && !empty($_POST['passwordConfSignUp'])) {
                newUser($_POST['userNameSignUp'], $_POST['emailSignUp'], $_POST['passwordSignUp'], $_POST['passwordConfSignUp']);
            } else {
                throw new Exception("Please fill again the form");
            }
            break;
        case "kakaoAPICall":
            session_start();
            if (isset($_SESSION['code'])) {
                kakaoAPICall($_SESSION['code']);
            } else {
                throw new Exception("Error with Kakao Login.");
            }
            break;
        case "events":
            categoriesInfo();
            break;

        case "searchSubmit":
            if (isset($_REQUEST['searchEvent'])) {
                eventsSearchInput($_REQUEST['searchEvent']);
            } elseif (isset($_REQUEST['sportCriteria'])) {
                eventsSearchSelect($_REQUEST['sportCriteria']);
            }
            break;

        default:
            landing();
            break;
    }
} catch (Exception $e) {
    $message = $e->getMessage();
    $code = $e->getCode();
    $file = $e->getFile();
    $line = $e->getLine();
    require('./view/error.php');
}
