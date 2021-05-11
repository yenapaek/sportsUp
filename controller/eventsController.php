<?php
    require("./model/categoryManager.php");

    function categoriesInfo() {
        $categories  = categoriesInfoModel();
        $eventsSelect = defaultSearch(false);
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

    