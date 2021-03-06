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
                    <img src="<?= $event['categoryImage'] ?>" alt="category image">
                    <p class="descriptionBox">Description : <?= $eventDetail['0']['eventDescription'] ?></p>
                </div>

                <div class="eventRightBox">
                    <p>Host : <?= $event['organizerName']; ?></p>
                    <div class="dividerGrey"></div>
                    <p>Up to <?= $event['playerNumber'] ?> people</p>
                    <div class="dividerGrey"></div>
                    <p><?= date('D, M d, g:i a', strtotime($event["eventDate"])); ?></p>
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
                    <div class="dividerGrey"></div>
                    <p>Attending : <?= $event['howMany']; ?> / <?= $event['playerNumber']; ?> </p>
                    <?php
                        if (!empty($event['howMany']) && !empty($event['playerNumber']) && $event['howMany'] >= $event['playerNumber']){
                    ?>
                        <div class="dividerGrey"></div>
                        <p class="eventFullMsg">Event is full.</p>
                    <?php
                        } 
                    ?>
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
                        if (!empty($event['attendingStatus']) > 0) {
                            $attendingAction = "cancelAttendingEvent";
                            $attendingBtnMsg = "Cancel Attending";
                        }elseif(!empty($event['attendingStatus']) == 0 && !empty($event['howMany']) < !empty($event['playerNumber'])) {
                            $attendingAction = "attendEvent";
                            $attendingBtnMsg = "Attend Event";
                        } 
                        else {
                            $attendingAction = "";
                            $attendingBtnMsg = "Event Full";
                        }
                        ?>
                        <a href="index.php?action=<?= $attendingAction ?>&eventId=<?= $event['eventId'] ?>&source=<?php if (!isset($_GET['action'])) {
                                                                                                                        echo "eventDetail";
                                                                                                                    } else {
                                                                                                                        echo $_GET['action'];
                                                                                                                    } ?>" class="card-btn"
                                                                                                                    <?php
                                                                                                                    if (empty($attendingAction)){
                                                                                                                    ?>
                                                                                                                        onclick='return false;';
                                                                                                                        style="background-color: grey;"
                                                                                                                    <?php
                                                                                                                    }
                                                                                                                    ?>
                                                                                                                    >
                                                                                                                    <?= $attendingBtnMsg ?></a>
                    </div>
                </div>
            </div>
        </section>
        </div>
        </div>
        </section>

        <section id="allMessage">
            <div id="comment">
                <section id="formSection">
                    <form id="formComment" method="post" onsubmit="return false">
                        <input type="hidden" name="action" value="postComment">
                        <input type="hidden" name="eventIdAdd" value="<?= $event['eventId']; ?>">

                        <label for="commentAdd">Comment :</label>
                        <div class="toBeARow">
                            <input type="text" name="commentAdd" id="commentAdd">
                            <input type="submit" value="Send" onclick="addComment(<?= $event['eventId']; ?>)">
                        </div>
                    </form>
                </section>

                <?php include("eventDetailListMessage.php"); ?>

            </div>
            <div id="whosComing">
                <p>Who's coming :  </p>

                <!-- <div class="dividerGrey"></div> -->
                <?php
                foreach ($usersAttending as $user) {
                ?>
                    <p> <?= $user['userNameAtt']; ?></p>

                <?php
                }
                ?>
            </div>
        </section>
<?php endforeach;
}
?>
<script src="./public/js/eventDetails.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>