<?php

function categoriesInfoModel()
{
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query("SELECT * FROM categories order by name");
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

function eventSearch($search, $name)
{
    $dataBase = dbConnect();
    $query = "SELECT e.id AS eventId, e.organizerId AS organizerId, c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%a, %b %e, %l:%i %p') AS eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage,
            (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) as howMany,
            (SELECT heart from favorites WHERE eventId=e.id) AS isHeart
            FROM events e
            JOIN categories c ON e.categoryId = c.id";

    switch ($search) {
        case "input":
            $add = " WHERE e.name LIKE '%$name%'";
            break;

        case "select":
            $add = " WHERE c.name = '$name'";
            break;

        case "popularity":
            $add = " ORDER BY howMany DESC";
            break;

        case "myEvents":
            $add = " JOIN attendingEvents a ON a.userId = e.id WHERE a.userId = $name";
            break;

        default:
            $add = " ORDER BY eventDate DESC";
            break;
    }
    $rawResponse = $dataBase->query($query . $add);
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

// Getting the last 7 days items from the events list - WHERE eventDate BETWEEN curdate() - INTERVAL DAYOFWEEK(curdate())+7 DAY AND curdate()

function favoriteAdd($userId, $eventId) {
    $dataBase = dbConnect();
    $rawRequest = $dataBase->prepare(
        "INSERT INTO favorites(userId, eventId, heart) VALUES(:userID, :eventID, true)"
    );
    $rawRequest->execute(array(
        'userID' => $userId,
        'eventID' => $eventId
    ));
    $rawRequest->closeCursor();
}

function favoriteElimination($userId, $eventId) {
    $dataBase = dbConnect();
    $rawRequest = $dataBase->query(
        "DELETE FROM favorites WHERE userId = $userId"
    );
    // $rawRequest->execute(array(
    //     'userID' => $userId,
    //     'eventID' => $eventId
    // ));
    $rawRequest->closeCursor();
}