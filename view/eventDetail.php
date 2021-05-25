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
                    <!-- #TODO categoryImg -->
                    <!-- <p>Picture :<?= $event['picture'] ?></p> -->
                    <img src="<?= $event['categoryImage'] ?>" alt="categoryName">
                    <p class="descriptionBox">Description : <?= $eventDetail['0']['eventDescription'] ?></p>
                </div>

                <div class="eventRightBox">
                    <p>Host : <?= $event['organizerId']; ?></p>
                    <div class="dividerGrey"></div>
                    <p>Max Number <?= $event['playerNumber'] ?> people</p>
                    <p>Number: <?= $event['howMany'] ?>currently attending</p>
                    <div class="dividerGrey"></div>
                    <p ><?= date('D, M d, g:i a', strtotime($event["eventDate"])); ?></p>
                    <div class="dividerGrey"></div>
                    <p>Duration : <?= $event['duration'] ?> hours</p>
                    <div class="dividerGrey"></div>


                    <?php if (!is_null($event['fee'])) { ?>
                        <p>Fee : <?= $event['fee']; ?></p>
                        <div class="dividerGrey"></div>
                    <?php
                    }
                    ?>
                    <p>City : <?= $event['city'] ?></p>
                    <section class="editDeleteBtns">
                        <?php
                        if (!empty($_SESSION['userId']) && $event['organizerId'] == $_SESSION['userId']) :
                        ?>
                            <div>
                                <a href="index.php?action=addEditEvent&eventId=<?= $event['eventId'] ?>"><i class="far fa-edit"></i></a>
                                <a href="index.php?action=deleteEvent&deleteEventId=<?= $event['eventId']; ?>&source=<?php if (!isset($_GET['action'])) {
                                                                                                                            echo "eventDetail";
                                                                                                                        } else {
                                                                                                                            echo $_GET['action'];
                                                                                                                        } ?>" class='deleteEventBtn'><i class="far fa-trash-alt"></i></a>
                            </div>
                        <?php
                        endif;
                        ?>
                    </section>
                    <div class="attendBtn">
                        <?php
                        if (!empty($event['attendingStatus']) && $event['attendingStatus'] > 0) {
                            $attendingAction = "cancelAttendingEvent";
                            $attendingBtnMsg = "Cancel Attending";
                        } else {
                            $attendingAction = "attendEvent";
                            $attendingBtnMsg = "Attend Event";
                        }
                        if (!empty($event['howMany']) && !empty($event['playerNumber']) && $event['howMany'] >= $event['playerNumber']){
                            $attendingAction = "";
                            $eventFull = true;
                            $attendingBtnMsg = "Event Full";
                        }
                        ?>
                        <a href="index.php?action=<?= $attendingAction ?>&eventId=<?= $event['eventId'] ?>&source=<?php if (!isset($_GET['action'])) {
                                                                                                                        echo "eventDetail";
                                                                                                                    } else {
                                                                                                                        echo $_GET['action'];
                                                                                                                    } ?>" class="card-btn <?php if(isset($eventFull)){ echo "eventFull"; } ?>"><?= $attendingBtnMsg ?></a>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </div>
        </section>
        <section>
            <form id="formComment" method="post" onsubmit="return false">
                <input type="hidden" name="action" value="postComment">
                <input type="hidden" name="eventIdAdd" value="<?= $event['eventId']; ?>">

                <label for="commentAdd">Comment :</label>
                <input type="text" name="commentAdd" id="commentAdd">
                <input type="submit" value="Send" onclick="addComment(<?= $event['eventId']; ?>)">
            </form>
        </section>
        <section id="allMessage">
            <?php include("eventDetailListMessage.php"); ?>
        </section>






<?php endforeach;
}
?>
<script src="./public/js/eventDetails.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>