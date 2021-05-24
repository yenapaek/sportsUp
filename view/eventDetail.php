<?php
$title = "Event Detail";
$style = '<link href="./public/css/events.css" rel="stylesheet" /> <link href="./public/css/eventDetail.css" rel="stylesheet" />';

ob_start();
// print_r($eventDetail);
if (is_array($eventDetail) || is_object($eventDetail)) {
    foreach ($eventDetail as $event) : ?>
        <section id="eventDetail">
            <div class="eventName">
                <p><?= $event['eventName'] ?></p>
                <div class="dividerRed"></div>
            </div>
            
            <div class="eventMainBox">
                <div class="eventPicture">
                    <!-- #TODO categoryImg -->
                    <!-- <p>Picture :<?= $event['picture'] ?></p> -->
                    <img src="./public/images/sports/acro-sports.jpeg" alt="">
                    <p class="descriptionBox">Description : <?= $eventDetail['0']['eventDescription'] ?></p>
                </div>
                
                <div class="eventRightBox">
                    <p>Host : <?= $event['organizerId'] ?></p>
                    <div class="dividerGrey"></div>
                    <p>Up to <?= $event['playerNumber'] ?> people</p>
                    <div class="dividerGrey"></div>
                    <p><?= $event['eventDate'] ?></p>
                    <div class="dividerGrey"></div>
                    <p>Duration : <?= $event['duration'] ?> hours</p>
                    <div class="dividerGrey"></div>
                    
                
                    <?php if(!is_null($event['fee'])){ ?>
                        <p>Fee : <?= $event['fee'] ?></p>
                        <div class="dividerGrey"></div>
                    <?php
                    }
                    ?>
                    <p>City : <?= $event['city'] ?></p>

                    <section class="editDeleteBtns">
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
                    <div class="attendBtn">
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
                </div>
            </div>
        </section>
        
        
<?php endforeach;
} 

$content = ob_get_clean();
require("template.php");
?>