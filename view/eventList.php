<?php
if (is_array($events) || is_object($events)) {
    foreach ($events as $event) : ?>
        <div class="card">
            <img src="<?= $event["categoryImage"] ?>" alt="card background" class="card-img">
            <div class="card-text">
                <h2><?= $event["eventName"] ?></h2>
                <p class="category-name"><?= $event["categoryName"] ?></p>
                <p class="event-date"><?= $event["eventDate"] ?></p>
                <p><?= $event["howMany"] ?> join out of <?= $event["playerNumber"] ?></p>
                <?php
                #TODO check if user is attending event if true, change content of button?
                #TODO add attendEventAction msg - check in db
                ?>
                <a href="index.php?action=eventDetail&eventId=<?= $event['eventId'] ?>" class="card-btn" eventId="<?= $event['eventId'] ?>">Attend Event</a>
                <?php
                if ($event['organizerId'] == $_SESSION['userId']) :
                ?>
                    <div>
                        <a href=""><i class="far fa-edit"></i></a>
                        <a href="index.php?action=deleteEvent&deleteEventId=<?= $event['eventId'] ?>"><i class="far fa-trash-alt"></i></a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
<?php endforeach;
}
