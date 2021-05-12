<?php

/**
 * myProfileModel
 *
 * @param  mixed $userId
 * @return array all the informations of the user's profile.
 */
function myProfileModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT * FROM users WHERE id=?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $infoProfile = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $infoProfile;
}

/**
 * mySportsModel
 *
 * @param  mixed $userId 
 * @return array all the sports the user is interested in.
 */
function mySportsModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT c.name AS category_name
    FROM categories c
    JOIN mySports mS 
    ON c.id = mS.categoryId
    WHERE userId=?");

    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $mySports = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $mySports;
}

/**
 * myEventsModel
 *
 * @param  mixed $userId
 * @return array all the events the user created.
 */
function myEventsModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT * FROM events WHERE organizerId=?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $myEvents = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $myEvents;
}

/**
 * myArticlesModel
 *
 * @param  mixed $userId
 * @return array all the articles the user posted.
 */
function myArticlesModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT * FROM articles WHERE userId=?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $myArticles = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $myArticles;
}

/**
 * editUserModel allow you to update the profile information
 *
 * @param  mixed $firstName
 * @param  mixed $lastName
 * @param  mixed $email
 * @param  mixed $date
 * @param  mixed $city
 * @return void
 */
function editUserModel($firstName, $lastName, $email, $date, $city)
{
    $db = dbConnect();

    $req = $db->prepare("UPDATE users SET firstName=:firstName, lastName=:lastName,email=:email,birthDate=:birthDate,city=:city WHERE id =:id");
    $req->bindparam('firstName', $firstName, PDO::PARAM_STR);
    $req->bindparam('lastName', $lastName, PDO::PARAM_STR);
    $req->bindparam('email', $email, PDO::PARAM_STR);
    $req->bindparam('birthDate', $date, PDO::PARAM_STR);
    $req->bindparam('city', $city, PDO::PARAM_STR);
    $req->bindparam('id', $_SESSION['userId'], PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();
}

/**
 * editUserAvatarModel allow you to update the avatar of the user
 *
 * @param  mixed $avatar
 * @return void
 */
function editUserAvatarModel($avatar)
{
    $db = dbConnect();

    if ($_FILES['file']['error'] > 0)  $error = 'Error during the upload';
    if ($_FILES['file']['size'] > 2000)  $error = 'Size of your file is too big';

    $validation_extensions = array('jpg', 'jpeg', 'png');
    $upload_extension = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));

    $path = './public/images/profile/allUsersProfilePics/file/';
    mkdir($path . "/{$_SESSION['userId']}/", 0777, true);
    $path = "$path/{$_SESSION['userId']}/";
    $name = "{$_SESSION['userId']}.{$upload_extension}";

    $result = move_uploaded_file($_FILES['file']['tmp_name'], "$path/$name");
    $req = $db->prepare("UPDATE users SET avatar=:avatar WHERE id =:id");
    $req->bindparam('avatar', $name, PDO::PARAM_STR);
    $req->bindparam('id', $_SESSION['userId'], PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();

}
