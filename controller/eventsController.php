<?php
require_once("./model/EventManager.php");

/**
 * eventsInfo allow you to populate the select in the create event page
 *
 * @param  mixed $search
 * @param  mixed $name
 * @return void
 */
function eventsInfo($search, $name)
{
    $eventManager =  new EventManager();
    $categories  =  $eventManager->categoriesInfoModel(false);
    $events =  $eventManager->eventSearch($search, $name);
    if ($search ==  "default") {
        require("./view/events.php");
    } else {
        require("./view/eventList.php");
    }
}

function categoriesInfo2($eventId)
{
    if ($eventId){
       $infos = selectEvent($eventId);
    }
    $eventManager =  new EventManager();
    $categories  =  $eventManager->categoriesInfoModel(false);
    require("./view/addEditEvent.php");
}

/**
 * createEvent allow you to create a new event and then redirect you to this event
 *
 * @param  mixed $name
 * @param  mixed $categoryId
 * @param  mixed $city
 * @param  mixed $playerNumber
 * @param  mixed $eventDate
 * @param  mixed $duration
 * @param  mixed $description
 * @param  mixed $fee
 * @return void 
 */
function createEvent($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee)
{
    $eventManager =  new EventManager();
    $eventId = $eventManager->createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee);
    // eventDetail($eventId['id']);
}

function editEvent($eventId)
{
    $eventId = editEventModel($eventId);
    eventDetail($eventId['id']);
}


/**
 * eventDetail call the database to get the information of one event
 *
 * @param  mixed $eventId
 * @return void
 */
function eventDetail($eventId)
{
    $eventManager =  new EventManager();
    $eventDetail = $eventManager->selectEvent($eventId);
    require("./view/eventDetail.php");
}

/**
 * deleteEvent allow you to delete one event
 *
 * @param  mixed $eventId
 * @return void
 */
function deleteEvent($eventId)
{
    $eventManager =  new EventManager();
    $eventManager->deleteEventModel($eventId);
    header("Location: index.php?action=events");
}
