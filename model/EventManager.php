<?php
require_once("Manager.php");
class EventManager extends Manager {

    /**
     * eventSearch
     *
     * @param  mixed $search
     * @param  mixed $name
     * @return Array event info including whether a user is attending the event or not
     */
    function eventSearch($search, $name)
    {
        $userId = isset($_SESSION['userId']) ? $_SESSION['userId'] : "";

        $db = $this->dbConnect();
        $query = "SELECT DISTINCT e.id AS eventId,
                    e.name AS eventName,
                    e.organizerId AS organizerId,
                    c.name AS categoryName,
                    DATE_FORMAT(e.eventDate, '%a, %b %e, %l:%i %p') AS eventDate,
                    e.playerNumber AS playerNumber,
                    e.duration AS duration,
                    e.description AS eventDescription,
                    e.fee AS fee,
                    e.city AS city,
                    c.image AS categoryImage,
                (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) AS howMany,
                (SELECT COUNT(eventId) AS attendingStatus FROM attendingevents WHERE eventId=e.id AND userId=:userId) AS attendingStatus,
                (SELECT heart from wishlist WHERE eventId=e.id) AS isHeart
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

            case "hostingEvents":
                $add = " WHERE organizerId=:userId";
                break;
            case "attendingEvents":
                $add = " JOIN attendingevents a ON a.eventId = e.id WHERE a.userId =:userId HAVING attendingStatus = 1";
                break;

            case "wishlist":
                $add = " JOIN wishlist a ON a.eventId = e.id WHERE a.userId =:userId";
                break;

            case "eventDetail":
                $add = " WHERE e.id = '$name'";
                break;
                
            default:
                $add = " ORDER BY eventDate DESC";
                break;
        }
        $req = $db->prepare($query . $add);
        $req->bindParam(":userId", $userId, PDO::PARAM_INT);

        $req->execute();
        $events = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $events;
    }
    /**
     * suggestEvents
     *
     * @param  mixed $userId
     * @return array event suggestions for user based on mySports.
     */
    function suggestEvents($userId)
    {
        $db = $this->dbConnect();

        #TODO check for attending count = 0;
        $query = "SELECT DISTINCT e.id AS eventId,
                    e.name AS eventName,
                    e.organizerId AS organizerId,
                    c.name AS categoryName,
                    DATE_FORMAT(e.eventDate, '%a, %b %e, %l:%i %p') AS eventDate,
                    e.playerNumber AS playerNumber,
                    e.duration AS duration,
                    e.description AS eventDescription,
                    e.fee AS fee,
                    e.city AS city,
                    c.image AS categoryImage,
                (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) AS howMany,
                (SELECT COUNT(eventId) AS attendingStatus FROM attendingevents WHERE eventId=e.id AND userId=:userId) AS attendingStatus 
                FROM events e
                JOIN mysports mS ON mS.categoryId=e.categoryId
                JOIN categories c ON mS.categoryId=c.id
                WHERE mS.userId = :userId AND organizerId != :userId
                HAVING attendingStatus = 0";
        $req = $db->prepare($query);            
        $req->bindParam(":userId", $userId, PDO::PARAM_STR);
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