<?php
// echo "<pre>";
// print_r($events);
// echo "<pre>";
if (!empty($eventsSelect)) {
    foreach ($eventsSelect as $event): ?>
        <div class="card">
                <img src="<?= $event["categoryImage"] ?>" alt="card background" class="card-img">
                
                <h1><?= $event["eventName"] ?></h1>
                <p class="job-title"><?= $event["categoryName"] ?></p>
                <p class="about"><?= $event["eventDate"] ?></p>
                <a href="#" class="btn btn-white btn-animation-1">Want to join in?</a>
        </div>
    <?php endforeach;
}