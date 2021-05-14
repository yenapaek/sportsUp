<?php
require("./model/categoryManager.php");
require("./model/addEditEventManager.php");

function eventsInfo($search, $name)
{
    $categories  = categoriesInfoModel();
    $events = eventSearch($search, $name);
    $howManyPplJoin = howManyPplJoin(2);

    if ($search ==  "default") {
        require("./view/events.php");
    } else {
        require("./view/eventList.php");
    }
}

function categoriesInfo2()
{
    $categories  = categoriesInfoModel();
    // $eventsSelect = defaultSearch(false);
    require("./view/addEditEvent.php");
}

function createEvent($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee)
{
    createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee);
}
