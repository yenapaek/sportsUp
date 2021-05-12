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
 * displaySportsCategories
 *
 * @return array all sports categories
 */
function displaySportsCategories()
{
    $db = dbConnect();
    $req = $db->query("SELECT * FROM categories");
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
    $req = $db->prepare("INSERT INTO mysports(null, :userId,:categoryId)");
    $req->bindParam(':userId', $userId, PDO::PARAM_STR);
    $req->bindParam(':categoryId', $categoryId, PDO::PARAM_STR);
    $req->execute();
    $req->closeCursor();
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
function attendingEventsModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT *
    FROM events
    JOIN myEvents ON myEvents.eventId = events.id
    WHERE myEvents.userid = ?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $attendingEvents = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $attendingEvents;
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

    $req = $db->prepare("SELECT *
    FROM events
    JOIN mysports ON mysports.categoryId=events.categoryId
    WHERE mysports.userId = ?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $suggestionEvents = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $suggestionEvents;
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
