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
                    if (!empty($_SESSION['userId'])) {
                        $btnAction = "eventDetail&eventId=".$event['eventId'];
                    } else {
                        $btnAction = "signUp";
                    }
                ?>
                <a href="index.php?action=<?= $btnAction; ?>" class="card-btn" target="_blank">View Event</a>
                <?php
                    if (!empty($_SESSION['userId']) && !isset($attending) && $event['organizerId'] == $_SESSION['userId']):
                ?>
                        <div class="hostIconText">
                            <div class="hotsIcon">
                                <i class="fas fa-user-tag"></i> 
                            </div>
                            <div class="hostText">
                                You are hosting this event
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