<?php

    // require("manager.php");

    function categoriesInfoModel () {
        $dataBase = dbConnect();
        $rawResponse = $dataBase->query("SELECT name FROM categories");
        $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
        $rawResponse->closeCursor();
        return $infoArray;
    }

    function inputSearch($name) {
        $dataBase = dbConnect();
        $rawResponse = $dataBase->prepare("SELECT * FROM events WHERE name = :name");
        $rawResponse->execute(array('name' => $name));
        $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
        $rawResponse->closeCursor();
        return $infoArray;
    }

    function selectSearch($sportName) {
        $dataBase = dbConnect();
        $rawResponse = $dataBase->query(
            "SELECT c.name AS categoryName, e.name AS eventName, e.picture as picture, e.eventDate as eventDate 
            FROM events e
            JOIN categories c
            ON e.categoryId = c.id
            WHERE c.name = '$sportName'"
        );
        $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);  
        $rawResponse->closeCursor();
        return $infoArray;
    }

