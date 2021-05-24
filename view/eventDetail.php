<?php
$title = "Event Detail";
$style = '<link href="./public/css/events.css" rel="stylesheet" /> <link href="./public/css/eventDetail.css" rel="stylesheet" />';

ob_start();
// print_r($eventDetail);
if (is_array($eventDetail) || is_object($eventDetail)) {
    foreach ($eventDetail as $event) : ?>
        <section id="eventDetail">
            <div class="eventName">
                <p><?= $event['name'] ?></p>
                <div class="dividerRed"></div>
            </div>
            
            <div class="eventMainBox">
                <div class="eventPicture">
                    <!-- <p>Picture :<?= $event['picture'] ?></p> -->
                    <img src="./public/images/sports/acro-sports.jpeg" alt="">
                    <p class="descriptionBox">Description : <?= $event['description'] ?></p>
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
                    <div class="attendBtn">
                        <a href="index.php?action=attendEvent&eventId=<?= $event['id'] ?>" class="card-btn">Attend Event</a>
                    </div>
                    <section class="editDeleteBtns">
                        <?php
                        if ($event['organizerId'] == $_SESSION['userId']) :
                        ?>
                            <div>
                                <a href="index.php?action=addEditEvent&eventId=<?= $event['id'] ?>"><i class="far fa-edit"></i></a>
                                <a href="index.php?action=deleteEvent&deleteEventId=<?= $event['id'] ?>"><i class='far fa-trash-alt'></i></a>
                            </div>
                        <?php endif; ?>
                    </section>                 
                </div>
            </div>
        </section>
        
<?php endforeach;
} 

$content = ob_get_clean();
require("template.php");
?>