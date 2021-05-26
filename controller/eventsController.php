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
    $eventPageChecker = true;
    if ($search ==  "default") {
        require("./view/events.php");
    } else {
        require("./view/eventList.php");
    }
}

// show information about event to set up for adding/editing event
function categoriesInfo2($eventId = false)
{
    $eventManager =  new EventManager();
    $categories  =  $eventManager->categoriesInfoModel(false);
    if ($eventId) {
        $eventDetail =  $eventManager->eventSearch('eventDetail', $eventId);
    } else {
        $eventDetail =  $eventManager->eventSearch('addEditEventDetail', '');
    }
    $form = $eventId ? 'editEvent' : 'addEvent';
    $formTitle = $eventId ? 'Update' : 'Create';
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
function createEvent($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $fee, $description)
{
    $eventManager =  new EventManager();
    $event = $eventManager->createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $fee, $description);
    eventDetail($event['id']);
}

function editEvent($eventId, $name, $categoryId, $city, $playerNumber, $eventDate, $duration, $fee, $description)
{
    $eventManager =  new EventManager();
    $eventId = $eventManager->editEventModel($eventId, $name, $categoryId, $city, $playerNumber, $eventDate, $duration, $fee, $description);
    eventDetail($eventId);
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
    $eventDetail = $eventManager->eventSearch('eventDetail', $eventId);
    $usersAttending = $eventManager->usersAttending($eventId);

    $eventMessage = $eventManager->selectComment($eventId);
    require("./view/eventDetail.php");
}

/**
 * deleteEvent allow you to delete one event
 *
 * @param  mixed $eventId
 * @return void
 */
function deleteEvent($eventId, $source)
{
    $eventManager =  new EventManager();
    $eventManager->deleteEventModel($eventId);
    if ($source === "eventDetail") {
        $source = "profile";
    }
    header("Location: index.php?action={$source}");
}

/**
 * postComment allow you to post a comment on a specific event
 *
 * @param  mixed $userId
 * @param  mixed $eventId
 * @param  mixed $comment
 * @return array of all the coment of this event
 */
function postComment($userId, $eventId, $comment)
{
    $eventManager = new EventManager();
    $eventMessage = $eventManager->postComment($userId, $eventId, $comment);
    require("./view/eventDetailListMessage.php");
}

/**
 * deleteComment allow you to delete a comment of a specific event
 *
 * @param  mixed $commentId
 * @return array all the comment of this event
 */
function deleteComment($commentId, $eventId)
{
    $eventManager = new EventManager();
    $eventManager->deleteComment($commentId, $eventId);
    $eventDetail = $eventManager->eventSearch('eventDetail', $eventId);

}
