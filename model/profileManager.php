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
    JOIN mysports mS 
    ON c.id = mS.categoryId
    WHERE userId=?");

    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $mySports = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $mySports;
}

/**
 * displaySportsCategories
 *
 * @return array all sports categories
 */

#TODO filter out categories existing for user
function displaySportsCategories($userId)
{
    $db = dbConnect();
    $req = $db->prepare("SELECT *
    FROM categories c
    WHERE c.id
    NOT IN (SELECT c.id
            FROM categories c
            JOIN mysports mS
            ON c.id = mS.categoryId
            WHERE mS.userId = ?)");
    $req->bindParam(1, $userId, PDO::PARAM_INT);
    $req->execute();
    $categories = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $categories;
}

/**
 * addMySports
 *
 * @param mixed $userId
 * @return void
 */
function addMySportModel($userId, $categoryId)
{
    $db = dbConnect();
    $req = $db->prepare("SELECT COUNT(*) FROM mysports WHERE userId = ? AND categoryId = ?");
    $req->bindParam(1, $userId, PDO::PARAM_INT);
    $req->bindParam(2, $categoryId, PDO::PARAM_INT);
    $req->execute();
    $mySportsCount = $req->fetchColumn();
    $req->closeCursor();

    if ($mySportsCount == 0) {
        $req = $db->prepare("INSERT INTO mysports(userId, categoryId) VALUES(?, ?)");
        $req->bindParam(1, $userId, PDO::PARAM_INT);
        $req->bindParam(2, $categoryId, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }
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

    $req = $db->prepare("SELECT e.*, c.*, DATE_FORMAT(e.eventDate, '%a, %b %e, %l:%i %p') AS eventDate, e.id AS eventId, e.name AS eventName, c.name AS categoryName, c.image AS categoryImage,
    (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) as howMany
    FROM events e 
    JOIN categories c ON e.categoryId = c.id
    WHERE organizerId=?");

    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $myEvents = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $myEvents;
}

/**
 * attendingEventsModel
 *
 * @param  mixed $userId
 * @return array all the events the user is attending.
 */
function displayAttendingEvents($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT events.*, DATE_FORMAT(events.eventDate, '%a, %b %e, %l:%i %p') AS eventDate, events.id AS eventId, categories.name AS categoryName, events.name AS eventName, categories.image AS categoryImage,
        (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=events.id) as howMany
    FROM events
    JOIN attendingevents ON attendingevents.eventId = events.id
    JOIN categories ON events.categoryId=categories.id
    WHERE attendingevents.userid = ?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $attendingEvents = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $attendingEvents;
}

/**
 * attendEventsModel
 * checks if user is already attending an event before inserting
 *
 * @param  mixed $userId
 * @return void
 */
function addAttendingEventModel($userId, $eventId)
{
    $db = dbConnect();
    $req = $db->prepare("SELECT COUNT(*) FROM attendingevents WHERE userId = ? AND eventId = ?");
    $req->bindParam(1, $userId, PDO::PARAM_INT);
    $req->bindParam(2, $eventId, PDO::PARAM_INT);
    $req->execute();
    $attendingEventsCount = $req->fetchColumn();
    $req->closeCursor();

    if ($attendingEventsCount ==  0) {
        $req = $db->prepare("INSERT INTO attendingevents(id, userId, eventId) VALUES (null, ?, ?)");
        $req->bindParam(1, $userId, PDO::PARAM_INT);
        $req->bindParam(2, $eventId, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }
}

/**
 * suggestionEventsModel
 *
 * @param  mixed $userId
 * @return array event suggestions for user based on mySports.
 */
function suggestionEventsModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT events.*, DATE_FORMAT(events.eventDate, '%a, %b %e, %l:%i %p') AS eventDate, events.id AS eventId, categories.name AS categoryName, events.name AS eventName, categories.image AS categoryImage,
            (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=events.id) as howMany
    FROM events
    JOIN mysports ON mysports.categoryId=events.categoryId
    JOIN categories ON mysports.categoryId=categories.id
    WHERE mysports.userId = ?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $suggestionEvents = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $suggestionEvents;
}

/**
 * myArticlesModel allow you to retrieve all the infos from articles where the user created them.
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