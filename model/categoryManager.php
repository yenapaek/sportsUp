<?php

// require("manager.php");

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
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage 
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
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage 
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
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage 
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
        "SELECT c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%b %d %Y %Hh %imin') as eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage 
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