<?php
    require("./model/categoryManager.php");
    require("./model/addEditEventManager.php");

    function categoriesInfo() {
        $categories  = categoriesInfoModel();
        $eventsSelect = defaultSearch(false);
        require("./view/events.php");
    }

    function eventsSearchInput($name) {
        $eventsSelect = inputSearch($name);
        require("./view/eventList.php");
    }

    function eventsSearchSelect($sportName) {
        $eventsSelect = selectSearch($sportName);
        require("./view/eventList.php");
    } 

    function categoriesInfo2() {
        $categories  = categoriesInfoModel();
        $eventsSelect = defaultSearch(false);
        require("./view/addEditEvent.php");
    }

    function createEvent($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee) {
        createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee);
    }   