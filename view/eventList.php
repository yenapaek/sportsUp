<?php
if (isset($events)) {
if (is_array($events) || is_object($events)) {
    foreach ($events as $event) : ?>
        <div class="card">
        <?php 
        if(isset($_SESSION['userId'])) { 
            if ($event['isHeart']) { ?>
            <div class="favorite">
                <span class="favorites" dataUserId="<?= $_SESSION['userId'] ?>" dataEventId="<?= $event['eventId'] ?>"><i class="fas fa-heart"></i></span>
            </div>
            <?php } else { ?>
            <div class="favoriteTwo">
                <span class="favorites" dataUserId="<?= $_SESSION['userId'] ?>" dataEventId="<?= $event['eventId'] ?>"><i class="far fa-heart"></i></span>
            </div>
            <?php }} ?>
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
                        $btnAction = "signUp"; 
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
}} elseif (isset($attendingArray)) {
if (is_array($attendingArray) || is_object($attendingArray)) {
    foreach ($attendingArray as $event) : ?>
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
                        $btnAction = "signUp"; 
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
}}
?>