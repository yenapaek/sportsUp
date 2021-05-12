<?php
    require("./model/categoryManager.php");

    function categoriesInfo($userId) {
        $categories  = categoriesInfoModel();
        $eventsSelectFavorites = eventsFavorites($userId);
        $eventsSelect = defaultSearch($userId);
        require("./view/events.php");
    }

    function eventsSearchInput($name) {
        $eventsSelect = inputSelectSearch($name, false);
        require("./view/eventList.php");
    }

    function eventsSearchSelect($sportName) {
        $eventsSelect = inputSelectSearch($sportName, true);
        require("./view/eventList.php");
    } 

    function eventsSearchPopularity() {
        $eventsSelect = searchPopularity();
        require("./view/eventList.php");
    }

    function eventsSearchRecently() {
        $eventsSelect = searchRecently();
        require("./view/eventList.php");
    }

    function eventsFavorite($userId, $eventId) {
        favoriteAdd($userId, $eventId);
    }

    function eventsSearchFavorites($userId) {
        $eventsSelectFavorites = eventsFavorites($userId);
        require("./view/eventList.php");
    }

    