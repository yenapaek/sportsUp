<?php

// require("manager.php");

function categoriesInfoModel()
{
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query("SELECT name FROM categories ORDER BY name");
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

function defaultSearch($userId)
{
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage, e.id as eventId 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}


function inputSelectSearch($name, $isForSelect)
{
    $where = '';

    $where = $isForSelect ? 'c.name' : 'e.name';

    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage, e.id as eventId 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id
            WHERE $where LIKE '%$name%'"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

function searchPopularity() {
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage, e.id as eventId 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id
            WHERE e.playerNumber >= 10
            ORDER BY playerNumber DESC"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

function searchRecently() {
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage, e.id as eventId
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id
            WHERE eventDate BETWEEN curdate() - INTERVAL DAYOFWEEK(curdate())+7 DAY
            AND curdate()"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

function favoriteAdd($userId, $eventId) {
    $dataBase = dbConnect();
    $rawRequest = $dataBase->prepare(
        "INSERT INTO favorites(userId, eventId) VALUES(:userID, :eventID)"
    );
    $rawRequest->execute(array(
        'userID' => $userId,
        'eventID' => $eventId
    ));
    $rawRequest->closeCursor();
}

function eventsFavorites($userId) {
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage, e.id as eventId 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id
            JOIN favorites f
            ON f.userId = e.id
            WHERE f.userId = $userId"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}