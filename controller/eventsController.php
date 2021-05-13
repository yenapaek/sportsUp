<?php
    require("./model/categoryManager.php");

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