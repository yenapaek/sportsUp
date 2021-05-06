<?php
    require("./model/categoryManager.php");

    function categoriesInfo() {
        $categories  = categoriesInfoModel();
        require("./view/events.php");
    }

    function eventsSearchInput($name) {
        $eventsInput = inputSearch($name);
        require("./view/eventList.php");
    }

    function eventsSearchSelect($sportName) {
        $eventsSelect = selectSearch($sportName);
        require("./view/eventList.php");
    } 