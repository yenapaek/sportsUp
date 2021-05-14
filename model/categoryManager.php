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
             (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) as howMany
            FROM events e
            JOIN categories c ON e.categoryId = c.id";

    switch ($search) {
        case "input":
            $add = " WHERE e.name LIKE '%$name%'";
            break;

        case "select":
            $add = " WHERE c.name = '$name'";
            break;

        default:
            $add = "";
            break;
    }
    $rawResponse = $dataBase->query($query . $add);
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}
