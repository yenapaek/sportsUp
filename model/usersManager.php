<?php

require('./model/manager.php');

function newUserModel($user, $email, $pass, $conf)
{
    $submittable = true;

    $user = addslashes(htmlspecialchars(htmlentities(trim($user))));
    $email = addslashes(htmlspecialchars(htmlentities(trim($email))));

    if (strlen($user) < 6) {
        $submittable = false;
    }
    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
        $submittable = false;
    }
    if ($pass !== $conf) {
        $submittable = false;
    }

    $db = dbConnect();

    $req = $db->prepare("SELECT * FROM users WHERE userName=? OR email=?");
    $req->bindParam(1, $user, PDO::PARAM_STR);
    $req->bindParam(2, $email, PDO::PARAM_STR);
    $req->execute();
    $userExist = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    if (!$userExist and $submittable) {

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $req = $db->prepare("INSERT INTO  users (userName,email,password, dateSignUp) VALUES(:userName, :email, :hash, NOW())");
        $req->bindParam(":userName", $user, \PDO::PARAM_STR);
        $req->bindParam(":email", $email, \PDO::PARAM_STR);
        $req->bindParam(":hash", $hash, \PDO::PARAM_STR);
        $status = $req->execute();
        $req->closeCursor();
        return $status;
    }
}

function manualLoginModel($email, $pass)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT password FROM users WHERE email=?");
    $req->bindParam(1, $email, PDO::PARAM_STR);
    $req->execute();
    $info = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    if ($info) {
        return password_verify($pass, $info['password']);
    }
    return false;
}
