<?php
require("./model/categoryManager.php");

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
