<?php
    require("./model/categoryManager.php");

    function categoriesInfo() {
        $categories  = categoriesInfoModel();
        $eventsSelect = defaultSearch(false);
        require("./view/events.php");
    }

    function eventsSearchInput($name) {
        $eventsSelect = inputSearch($name, false);
        require("./view/eventList.php");
    }

    function eventsSearchSelect($sportName, true) {
        $eventsSelect = inputSearch($sportName);
        require("./view/eventList.php");
    } 

    