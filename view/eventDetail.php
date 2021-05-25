<?php
$title = "Event Detail";
$style = '<link href="./public/css/events.css" rel="stylesheet" /> <link href="./public/css/eventDetail.css" rel="stylesheet" />';
ob_start();
?>

<pre>

</pre>
<?php
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
                </div>

                <div class="eventRightBox">
                    <p>Host : <?= $event['organizerId']; ?></p>
                    <div class="dividerGrey"></div>
                    <p>How many can attend? : <?= $event['playerNumber']; ?></p>
                    <div class="dividerGrey"></div>
                    <p>When? <?= $event['eventDate']; ?></p>
                    <div class="dividerGrey"></div>
                    <p>Duration :<?= $event['duration']; ?></p>
                    <div class="dividerGrey"></div>


                    <?php if (!is_null($event['fee'])) { ?>
                        <p>Fee : <?= $event['fee']; ?></p>
                        <div class="dividerGrey"></div>
                    <?php
                    }
                    ?>
                    <p>City : <?= $event['city'] ?></p>
                    <div class="dividerGrey"></div>
                    <p>Description : <?= $event['eventDescription']; ?></p>
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
        <div>
            <?php
            if (!empty($event['attendingStatus']) && $event['attendingStatus'] > 0) {
                $attendingAction = "cancelAttendingEvent";
                $attendingBtnMsg = "Cancel Attending";
            } else {
                $attendingAction = "attendEvent";
                $attendingBtnMsg = "Attend Event";
            }
            ?>
            <a href=" index.php?action=<?= $attendingAction ?>&eventId=<?= $event['eventId'] ?>&source=<?php if (!isset($_GET['action'])) {
                                                                                                            echo "eventDetail";
                                                                                                        } else {
                                                                                                            echo $_GET['action'];
                                                                                                        } ?>" class="card-btn"><?= $attendingBtnMsg ?></a>
        </div>
        <section>
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
<?php endforeach;
}
?>
<script src="./public/js/eventDetails.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>