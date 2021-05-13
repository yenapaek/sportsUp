<?php

function categoriesInfoModel()
{
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query("SELECT name FROM categories");
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

function defaultSearch()
{
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.id AS eventId, e.name AS eventName, e.eventDate as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

// #TODO if there is a userid then change 

function inputSearch($name)
{
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.id AS eventId, e.name AS eventName, e.eventDate as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id
            WHERE e.name = '$name'"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}

function selectSearch($sportName)
{
    $dataBase = dbConnect();
    $rawResponse = $dataBase->query(
        "SELECT c.name AS categoryName, e.id AS eventId, e.name AS eventName, e.eventDate as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id
            WHERE c.name = '$sportName'"
    );
    $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
    $rawResponse->closeCursor();
    return $infoArray;
}
