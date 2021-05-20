<?php
$title = "Event Detail";
$style = '<link href="./public/css/events.css" rel="stylesheet" />';

ob_start();

if (is_array($eventDetail) || is_object($eventDetail)) {
    foreach ($eventDetail as $event) : ?>
        <section>
            <p>Name : <?= $event['eventName'] ?></p>
            <p>Event Id : <?= $event['eventId'] ?></p>
            <p>Host Id : <?= $event['organizerId'] ?></p>
            <p>Picture :<? if(!isset($event['picture'])){ echo $event['categoryImage']; } ?></p>
            <p>PlayerMax : <?= $event['playerNumber'] ?></p>
            <p>EventDate <?= $event['eventDate'] ?></p>
            <p>Duration :<?= $event['duration'] ?></p>
            <p>Description : <?= $event['eventDescription'] ?></p>
            <p>Fee : <?= $event['fee'] ?></p>
            <p>City : <?= $event['city'] ?></p>
        </section>
        <div>
            <a href="index.php?action=attendEvent&eventId=<?= $event['eventId'] ?>" class="card-btn">Attend Event</a>
        </div>
        <section>
            <?php
                if (!empty($_SESSION['userId']) && $event['organizerId'] == $_SESSION['userId']):
            ?>
                <div>
                    <a href=""><i class="far fa-edit"></i></a>
                    <a href="index.php?action=deleteEvent&deleteEventId=<?= $event['eventId']; ?>"><i class="far fa-trash-alt"></i></a>
                </div>
            <?php
                elseif (!empty($event['attendingStatus']) && $event['attendingStatus']>0):
            ?>
                <div>
                    <a href="index.php?action=cancelAttendingEvent&eventId=<?= $event['eventId']; ?>"><i class="far fa-calendar-times"></i></a>
                </div>
            <?php
                endif; 
            ?>
        </section>
<?php endforeach;
} 

$content = ob_get_clean();
require("template.php");
?>