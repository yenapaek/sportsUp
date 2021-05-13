<?php
// echo "<pre>";
// print_r($events);
// echo "<pre>";f
if (!empty($eventsSelect)) {
    foreach ($eventsSelect as $event): ?>
        <div class="card">
                <img src="<?= $event["categoryImage"] ?>" alt="card background" class="card-img">
                
                <h1><?= $event["eventName"] ?></h1>
                <p class="job-title"><?= $event["categoryName"] ?></p>
                <p class="about"><?= $event["eventDate"] ?></p>
                <?php 
                    #TODO check if user is attending event if true, change content of button?
                    #TODO add attendEventAction msg - check in db
                ?>
                <a href="#" class="btn btn-white btn-animation-1" eventId="<?= $event['eventId'] ?>">Attend Event</a>
                <!-- #TODO a post - send event id to index -->
        </div>
    <?php endforeach;
}