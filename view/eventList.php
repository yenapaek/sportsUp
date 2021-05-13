<?php

if (is_array($events) || is_object($events)) {
    foreach ($events as $event) : ?>
        <div class="card">
            <img src="<?= $event["categoryImage"] ?>" alt="card background" class="card-img">
            <h2><?= $event["eventName"] ?></h2>
            <p class="job-title"><?= $event["categoryName"] ?></p>
            <p class="about"><?= $event["eventDate"] ?></p>
            <p><?= $howManyPplJoin["howMany"] ?> join out of <?= $event["playerNumber"] ?></p>
            <a href="#" class="btn btn-white btn-animation-1">See More</a>
        </div>
<?php endforeach;
}
