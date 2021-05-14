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
                #TODO clean up changing action
                    if(!empty($_SESSION['userId'])){
                        $btnAction = "eventDetail&eventId=".$event['eventId']; 
                    } else {
                        $btnAction = "signInAndSignUp"; 
                    }
                ?>
                <a href="index.php?action=<?= $btnAction; ?>" class="card-btn" target="_blank">View Event</a>
                <?php
                    if (!empty($_SESSION['userId']) && $event['organizerId'] == $_SESSION['userId']):
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
