<?php
require_once("Manager.php");
class EventManager extends Manager {

    /**
     * myEventsModel
     *
     * @param  mixed $userId
     * @return array all the events the user created.
     */
    function myEventsModel($userId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT e.*, c.*, DATE_FORMAT(e.eventDate, '%a, %b %e, %l:%i %p') AS eventDate, e.id AS eventId, e.name AS eventName, c.name AS categoryName, c.image AS categoryImage,
        (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) as howMany
        FROM events e 
        JOIN categories c ON e.categoryId = c.id
        WHERE organizerId=?");

        $req->bindParam(1, $userId, PDO::PARAM_STR);
        $req->execute();
        $myEvents = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $myEvents;
    }

    function eventSearch($search, $name)
    {

        $dataBase = $this->dbConnect();
        $query = "SELECT e.id AS eventId, e.organizerId AS organizerId, c.name AS categoryName, e.name AS eventName, DATE_FORMAT(e.eventDate, '%a, %b %e, %l:%i %p') AS eventDate, e.playerNumber as playerNumber, e.duration as duration, c.image as categoryImage,
                (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) as howMany,
                (SELECT heart from attendingEvents WHERE eventId=e.id) AS isHeart
                FROM events e
                JOIN categories c ON e.categoryId = c.id";

        switch ($search) {
            case "input":
                $add = " WHERE e.name LIKE '%$name%'";
                break;

            case "select":
                $add = " WHERE c.name = '$name'";
                break;

            case "popularity":
                $add = " ORDER BY howMany DESC";
                break;

            case "myEvents":
                $add = " JOIN attendingEvents a ON a.eventId = e.id WHERE a.userId = $name";
                break;

            case "myHostingEvents":
                $add = " WHERE e.organizerId = $name";
                break;

            default:
                $add = " ORDER BY eventDate DESC";
                break;
        }
        $rawResponse = $dataBase->query($query . $add);
        $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
        $rawResponse->closeCursor();
        return $infoArray;
    }

    /**
     * suggestionEventsModel
     *
     * @param  mixed $userId
     * @return array event suggestions for user based on mySports.
     */
    function suggestionEventsModel($userId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT events.*, DATE_FORMAT(events.eventDate, '%a, %b %e, %l:%i %p') AS eventDate, events.id AS eventId, categories.name AS categoryName, events.name AS eventName, categories.image AS categoryImage,
                (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=events.id) as howMany
        FROM events
        JOIN mysports ON mysports.categoryId=events.categoryId
        JOIN categories ON mysports.categoryId=categories.id
        WHERE mysports.userId = ?");
        $req->bindParam(1, $userId, PDO::PARAM_STR);
        $req->execute();
        $suggestionEvents = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $suggestionEvents;
    }

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
        $db = $this->dbConnect();
        $req = $db->prepare("INSERT INTO events(name, categoryId, picture, organizerId, playerNumber, duration, description, eventDate, fee, city)
                        VALUES(:name, :categoryId, :picture, :organizerId, :playerNumber, :eventDuration, :eventDescription, :eventDate, :eventFee, :city)");

        $req->bindparam('name', $name, PDO::PARAM_STR);
        $req->bindparam('organizerId', $_SESSION['userId'], PDO::PARAM_INT);
        $req->bindparam('categoryId', $categoryId, PDO::PARAM_INT);
        $req->bindValue('picture', null, PDO::PARAM_STR);
        $req->bindparam('city', $city, PDO::PARAM_STR);
        $req->bindparam('playerNumber', $playerNumber, PDO::PARAM_INT);
        $req->bindparam('eventDuration', $duration, PDO::PARAM_STR);
        $req->bindparam('eventDescription', $description, PDO::PARAM_STR);
        $req->bindparam('eventDate', $eventDate, PDO::PARAM_STR);
        $req->bindparam('eventFee', $fee, PDO::PARAM_STR);

        $submittable = $req->execute();
        $req->closeCursor();

        if ($submittable) {
            $req = $db->prepare("SELECT id FROM events WHERE name=? AND categoryId=? ");
            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->bindParam(2, $categoryId, PDO::PARAM_INT);

            $req->execute();
            $eventId = $req->fetch(PDO::FETCH_ASSOC);
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
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT events.*, DATE_FORMAT(events.eventDate, '%a, %b %e, %l:%i %p') AS eventDate FROM events WHERE id=? ");
        $req->bindParam(1, $idEvent, PDO::PARAM_INT);

        $req->execute();
        $event  = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $event;
    }

    /**
     * #TODO delete on CASCADE
     * deleteEventModel allow you to delete an event
     *
     * @param  mixed $eventId
     * @return void
     */
    function deleteEventModel($eventId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("DELETE FROM events WHERE id=? ");
        $req->bindParam(1, $eventId, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();

        $req = $db->prepare("DELETE FROM attendingevents WHERE eventId=?");
        $req->bindParam(1, $eventId, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }
}