<?php
$title = "Event Detail";
$style = '<link href="./public/css/events.css" rel="stylesheet" />';

ob_start();
print_r($eventId);
if (is_array($eventDetail) || is_object($eventDetail)) {
    foreach ($eventDetail as $event) : ?>
        <section>
            <p>Name : <?= $event['name'] ?></p>
            <p>ID : <?= $event['organizerId'] ?></p>
            <p>Picture :<?= $event['picture'] ?></p>
            <p>PlayerMax : <?= $event['playerNumber'] ?></p>
            <p>EventDate <?= $event['eventDate'] ?></p>
            <p>Duration :<?= $event['duration'] ?></p>
            <p>Description : <?= $event['description'] ?></p>
            <p>Fee : <?= $event['fee'] ?></p>
            <p>City : <?= $event['city'] ?></p>
        </section>
        <div>
            <a href="index.php?action=attendEvent&eventId=<?= $event['id'] ?>" class="card-btn">Attend Event</a>
        </div>
        <section>
            <?php
            if ($event['organizerId'] == $_SESSION['userId']) :
            ?>
                <div>
                    <a href="index.php?action=editEvent =<?= $event['id'] ?>"><i class="far fa-edit"></i></a>
                    <a href="index.php?action=deleteEvent&deleteEventId=<?= $event['id'] ?>"><i class='far fa-trash-alt'></i></a>
                </div>
            <?php endif; ?>
        </section>
<?php endforeach;
} 

$content = ob_get_clean();
require("template.php");
?>