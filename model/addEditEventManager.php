<?php

/**
 * createEventModel allow us to create a new event
 *
 * @param  mixed $name
 * @param  mixed $categoryId
 * @param  mixed $city
 * @param  mixed $playerNumber
 * @param  mixed $eventDate
 * @param  mixed $duration
 * @param  mixed $description
 * @param  mixed $fee
 * @return int the id of the event you just created.
 */
function createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee)
{
    $db = dbConnect();
    $submittable = true;
    try {

        $picture = null;
        $req = $db->prepare("INSERT INTO events(name, categoryId, picture, organizerId, playerNumber, duration, description, eventDate, fee, city)
                        VALUES(:name, :categoryId, :picture, :organizerId, :playerNumber, :eventDuration, :eventDescription, :eventDate, :eventFee, :city)");

        $req->bindparam('name', $name, PDO::PARAM_STR);
        $req->bindparam('organizerId', $_SESSION['userId'], PDO::PARAM_INT);
        $req->bindparam('categoryId', $categoryId, PDO::PARAM_INT);
        $req->bindparam('picture', $picture, PDO::PARAM_STR);
        $req->bindparam('city', $city, PDO::PARAM_STR);
        $req->bindparam('playerNumber', $playerNumber, PDO::PARAM_INT);
        $req->bindparam('eventDuration', $duration, PDO::PARAM_STR);
        $req->bindparam('eventDescription', $description, PDO::PARAM_STR);
        $req->bindparam('eventDate', $eventDate, PDO::PARAM_STR);
        $req->bindparam('eventFee', $fee, PDO::PARAM_STR);

        $req->execute();
        $req->closeCursor();
    } catch (Exception $e) {
        $submittable = false;
    }

    if ($submittable) {
        $req = $db->prepare("SELECT id FROM events WHERE name=? AND categoryId=? ");
        $req->bindParam(1, $name, PDO::PARAM_STR);
        $req->bindParam(2, $categoryId, PDO::PARAM_INT);

        $eventId = $req->execute();
        $req->closeCursor();

        return $eventId;
    }
}

/**
 * selectEvent allow you to select all the information of a specific event
 *
 * @param  mixed $idEvent
 * @return array of all the information of a specific event
 */
function selectEvent($idEvent)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT events.*, DATE_FORMAT(events.eventDate, '%a, %b %e, %l:%i %p') AS eventDate FROM events WHERE id=? ");
    $req->bindParam(1, $idEvent, PDO::PARAM_INT);
    $req->execute();
    $event  = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();

    return $event;
}

/**
 * deleteEventModel allow you to delete an event 
 *
 * @param  mixed $eventId
 * @return void
 */
function deleteEventModel($eventId)
{
    $db = dbConnect();

    $req = $db->prepare("DELETE FROM events WHERE id=? ");
    $req->bindParam(1, $eventId, PDO::PARAM_INT);
    $req->execute();
    $req->closeCursor();
}
