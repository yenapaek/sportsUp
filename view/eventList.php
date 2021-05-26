<?php
if (is_array($events) || is_object($events)) {
    foreach ($events as $event) : ?>
        <div class="card">
        <?php 
            if(isset($_SESSION['userId']) && isset($eventPageChecker)) { 
                if ($event['isHeart']) { ?>
                    <div class="favorite">
                        <span class="favorites" dataUserId="<?= $_SESSION['userId'] ?>" dataEventId="<?= $event['eventId'] ?>"><i class="fas fa-heart"></i></span>
                    </div>
        <?php   } else { ?>
                    <div class="favoriteTwo">
                        <span class="favorites" dataUserId="<?= $_SESSION['userId'] ?>" dataEventId="<?= $event['eventId'] ?>"><i class="far fa-heart"></i></span>
                    </div>
        <?php   }
            } ?>
            <img src="<?= $event["categoryImage"] ?>" alt="card background" class="card-img">
            <div class="card-text">
                <h2><?= $event["eventName"] ?></h2>
                <p class="category-name"><?= $event["categoryName"] ?></p>
                <p class="event-date"><?= date('D, M d, g:i a', strtotime($event["eventDate"])); ?></p>
                <p><?= $event["howMany"] ?> join out of <?= $event["playerNumber"] ?></p>
                <?php
                    if (!empty($_SESSION['userId'])) {
                        $btnAction = "eventDetail&eventId=".$event['eventId'];
                    } else {
                        $btnAction = "signUp";
                    }
                ?>
                <?php
                    if (!empty($event['isExpired']) && isset($myHostingEventsChecker)){
                ?>
                    <a href="" onclick="return false;" class="expired-card-btn">Expired Event</a>
                <?php   
                    } else {
                ?>
                    <a href="index.php?action=<?= $btnAction; ?>" class="card-btn" target="_blank">View Event</a>
                <?php
                    }
                    if (!empty($_SESSION['userId']) && !isset($attending) && $event['organizerId'] == $_SESSION['userId']):
                ?>
                        <div class="hostIconText">
                            <div class="hotsIcon">
                                <i class="fas fa-user-tag"></i> 
                            </div>
                        
                        </div>
                        <div class="insideIconEventCard">
                            <a href="index.php?action=addEditEvent&eventId=<?= $event['eventId']?>"><i class="far fa-edit"></i></a>
                            <a href="index.php?action=deleteEvent&deleteEventId=<?= $event['eventId']; ?>&source=<?= $_GET['action']; ?>" class='deleteEventBtn'><i class="far fa-trash-alt"></i></a>
                        </div>
                <?php
                    endif; 
                    if (!empty($event['attendingStatus']) && $event['attendingStatus']>0):
                ?>
                    <div>
                        <a href="index.php?action=cancelAttendingEvent&eventId=<?= $event['eventId']; ?>&source=<?= $_GET['action']; ?>"><i class="far fa-calendar-times"></i></a>
                    </div>
                <?php
                    endif; 
                ?>
            </div>
        </div>
<?php endforeach;
}
