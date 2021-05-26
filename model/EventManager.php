<?php
require_once("Manager.php");
class EventManager extends Manager
{

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

        $expiredChecker = "";
        if ($search != "attendingEvents" && $search != "wishlist") {
            $expiredChecker = " WHERE eventDate BETWEEN curdate() - INTERVAL DAYOFWEEK(curdate())+1 DAY AND curdate() + INTERVAL DAYOFWEEK(curdate())+12 MONTH";
        }

        $db = $this->dbConnect();
        $add = "";
        $query = "SELECT DISTINCT e.id AS eventId,
                    e.name AS eventName,
                    e.organizerId AS organizerId,
                    c.name AS categoryName,
                    c.id AS categoryId,
                    e.eventDate AS eventDate,
                    e.playerNumber AS playerNumber,
                    e.duration AS duration,
                    e.description AS eventDescription,
                    e.fee AS fee,
                    e.city AS city,
                    c.image AS categoryImage,
                    u.premiumId AS premiumId,
                (SELECT COUNT(eventId) AS howMany FROM attendingevents WHERE eventId=e.id) AS howMany,
                (SELECT COUNT(eventId) AS attendingStatus FROM attendingevents WHERE eventId=e.id AND userId=:userId) AS attendingStatus,
                (SELECT heart from wishlist WHERE eventId=e.id AND userId=:userId) AS isHeart
                FROM events e 
                JOIN categories c ON e.categoryId = c.id
                JOIN users u ON u.id = e.organizerId {$expiredChecker}";
        switch ($search) {
            case "input":
                $add = " AND e.name LIKE '%$name%'";
                break;
            case "select":
                $add = " AND c.name = '$name'";
                break;
            
            case "popularity":
                $add = " ORDER BY howMany DESC";
                break;

            case "hostingEvents":
                $add = " AND organizerId=:userId";
                break;
            case "attendingEvents":
                $add = " JOIN attendingevents a ON a.eventId = e.id WHERE eventDate BETWEEN curdate() - INTERVAL DAYOFWEEK(curdate())+1 DAY AND curdate() + INTERVAL DAYOFWEEK(curdate())+12 MONTH AND a.userId =:userId HAVING attendingStatus = 1";
                break;

            case "wishlist":
                $add = " JOIN wishlist w ON w.eventId = e.id WHERE eventDate BETWEEN curdate() - INTERVAL DAYOFWEEK(curdate())+1 DAY AND curdate() + INTERVAL DAYOFWEEK(curdate())+12 MONTH AND w.userId =:userId";
                break;

            case "eventDetail":
                $add = " AND e.id = '$name'";
                break;
            case "addEditEventDetail":
                $query = "SELECT u.premiumId AS premiumId FROM users u JOIN premium p ON u.id = p.userId WHERE u.id = :userId";
                break;
            case "premium":
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
                    c.id AS categoryId,
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
    function createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $fee, $description)
    {

        $name = addslashes(htmlspecialchars(htmlentities(trim($name))));
        $city = addslashes(htmlspecialchars(htmlentities(trim($city))));
        $description = addslashes(htmlspecialchars(htmlentities(trim($description))));

        $db = $this->dbConnect();
        $userId = $_SESSION['userId'];
        $req = $db->prepare("INSERT INTO events(name, categoryId, picture, organizerId, playerNumber, duration, description, eventDate, fee, city)
                        VALUES(:name, :categoryId, :picture, :organizerId, :playerNumber, :eventDuration, :eventDescription, :eventDate, :eventFee, :city)");

        $req->bindparam(':name', $name, PDO::PARAM_STR);
        $req->bindparam(':organizerId', $userId, PDO::PARAM_INT);
        $req->bindparam(':categoryId', $categoryId, PDO::PARAM_INT);
        $req->bindValue(':picture', null, PDO::PARAM_STR);
        $req->bindparam(':city', $city, PDO::PARAM_STR);
        $req->bindparam(':playerNumber', $playerNumber, PDO::PARAM_INT);
        $req->bindparam(':eventDuration', $duration, PDO::PARAM_INT);
        $req->bindparam(':eventDescription', $description, PDO::PARAM_STR);
        $req->bindparam(':eventDate', $eventDate, PDO::PARAM_STR);
        $req->bindparam(':eventFee', $fee, PDO::PARAM_STR);

        $submittable = $req->execute();
        $req->closeCursor();

        if ($submittable) {
            $req = $db->prepare("SELECT * FROM events WHERE name=? AND categoryId=? ");
            $req->bindParam(1, $name, PDO::PARAM_STR);
            $req->bindParam(2, $categoryId, PDO::PARAM_INT);

            $req->execute();
            $event = $req->fetch(PDO::FETCH_ASSOC);
            $req->closeCursor();

            return $event;
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

    function editEventModel($eventId, $name, $categoryId, $city, $playerNumber, $eventDate, $duration, $fee, $description)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("UPDATE events SET name=:name, categoryId=:categoryId, playerNumber=:playerNumber, eventDate=:eventDate, duration=:duration, description=:description, fee=:fee, city=:city WHERE id=:id");
        $req->bindparam(':id', $eventId, PDO::PARAM_INT);
        $req->bindparam(':name', $name, PDO::PARAM_STR);
        // $req->bindparam('organizerId', $_SESSION['userId'], PDO::PARAM_INT);
        $req->bindparam(':categoryId', $categoryId, PDO::PARAM_INT);
        // $req->bindparam('picture', $picture, PDO::PARAM_STR);
        $req->bindparam(':city', $city, PDO::PARAM_STR);
        $req->bindparam(':playerNumber', $playerNumber, PDO::PARAM_INT);
        $req->bindparam(':duration', $duration, PDO::PARAM_INT);
        $req->bindparam(':description', $description, PDO::PARAM_STR);
        $req->bindparam(':eventDate', $eventDate, PDO::PARAM_STR);
        $req->bindparam(':fee', $fee, PDO::PARAM_STR);

        $req->execute();
        $req->closeCursor();

        return $eventId;
    }

    /**
     * postComment allow you post a comment on the eventdetail page
     *
     * @param  mixed $userId
     * @param  mixed $eventId
     * @param  mixed $comment
     * @return array of the message of this event
     */
    function postComment($userId, $eventId, $comment)
    {
        $db = $this->dbConnect();

        $messageDate = date("Y-m-d H:i");

        $req = $db->prepare("INSERT INTO minichats(eventId, userId, messageDate, message)
                        VALUES(:eventId, :userId, :messageDate, :message)");

        $req->bindparam(':eventId', $eventId, PDO::PARAM_INT);
        $req->bindparam(':userId', $userId, PDO::PARAM_INT);
        $req->bindparam(':messageDate', $messageDate, PDO::PARAM_STR);
        $req->bindparam(':message', $comment, PDO::PARAM_STR);

        $submittable = $req->execute();
        $req->closeCursor();

        if ($submittable) {
            return $this->selectComment($eventId);
        } else {
            return false;
        }
    }

    /**
     * selectComment allow you to get all the comments from a specific event
     *
     * @param  mixed $eventId
     * @return array of the message of this event
     */
    function selectComment($eventId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT users.*, minichats.id as id, minichats.*
        FROM minichats 
        JOIN users ON users.id = minichats.userId
        WHERE eventId=?
        ORDER BY minichats.id DESC");
        $req->bindParam(1, $eventId, PDO::PARAM_INT);

        $req->execute();
        $eventMessage = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $eventMessage;
    }

    /**
     * deleteComment allow you to delete a comment from a specific event
     *
     * @param  mixed $commentId
     * @param  mixed $eventId
     * @return void
     */
    function deleteComment($commentId, $eventId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("DELETE FROM minichats WHERE id=? ");
        $req->bindParam(1, $commentId, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();

        return $this->selectComment($eventId);
    }
}
