<?php
$title = "Event Detail";
$style = '<link href="./public/css/events.css" rel="stylesheet" /> <link href="./public/css/eventDetail.css" rel="stylesheet" />';

ob_start();
if (is_array($eventDetail) || is_object($eventDetail)) {
    foreach ($eventDetail as $event) : ?>
        <section id="eventDetail">
            <div class="eventName">
                <p><?= $event['eventName'] ?></p>
                <div class="dividerRed"></div>
            </div>
            
            <div class="eventMainBox">
                <div class="eventPicture">
                    <img src="<?= $event['categoryImage'] ?>" alt="categoryName">
                </div>
                
                <div class="eventRightBox">
                    <p>Host : <?= $event['organizerId'] ?></p>
                    <div class="dividerGrey"></div>
                    <p>How many can attend? : <?= $event['playerNumber'] ?></p>
                    <div class="dividerGrey"></div>
                    <p>When? <?= date('D, M d, g:i a', strtotime($event["eventDate"])); ?></p>
                    <div class="dividerGrey"></div>
                    <p>Duration :<?= $event['duration'] ?></p>
                    <div class="dividerGrey"></div>
                    
                
                    <?php if(!is_null($event['fee'])){ ?>
                        <p>Fee : <?= $event['fee'] ?></p>
                        <div class="dividerGrey"></div>
                    <?php
                    }
                    ?>
                    <p>City : <?= $event['city'] ?></p>
                    <div class="dividerGrey"></div>
                    <p>Description : <?= $event['eventDescription'] ?></p>
                </div>
            </div>
        </section>
        <div>
            <?php
                if (!empty($event['attendingStatus']) && $event['attendingStatus']>0){
                    $attendingAction = "cancelAttendingEvent";
                    $attendingBtnMsg = "Cancel Attending";
                } else {
                    $attendingAction = "attendEvent";
                    $attendingBtnMsg = "Attend Event";
                }
            ?>
            <a href="index.php?action=<?= $attendingAction ?>&eventId=<?= $event['eventId'] ?>&source=<?php if(!isset($_GET['action'])){ echo "eventDetail";}else {echo $_GET['action'];} ?>" class="card-btn"><?= $attendingBtnMsg ?></a>
        </div>
        <section>
            <?php
                if (!empty($_SESSION['userId']) && $event['organizerId'] == $_SESSION['userId']):
            ?>
                <div>
                    <a href="index.php?action=addEditEvent&eventId=<?= $event['eventId'] ?>"><i class="far fa-edit"></i></a>
                    <a href="index.php?action=deleteEvent&deleteEventId=<?= $event['eventId']; ?>&source=<?php if(!isset($_GET['action'])){ echo "eventDetail";}else {echo $_GET['action'];} ?>" class='deleteEventBtn'><i class="far fa-trash-alt"></i></a>
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