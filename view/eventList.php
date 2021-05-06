<?php
// echo "<pre>";
// print_r($events);
// echo "<pre>";
if (!empty($eventsSelect)) {
    foreach ($eventsSelect as $event): ?>
        <div id="cardWrapper">
            <div id="image">
                <img src="<?php //$event["picture"]; ?>" alt="">
            </div>
            <div id="cardInfo">
                <div id="cardInfoContainer">
                    <p> <?= $event["eventName"]; ?> </p>
                    <div id="cardAditionalInfo">
                        <span> <?= $event["eventDate"]; ?> </span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
}
if (!empty($eventsInput)) {
    foreach ($eventsInput as $event): ?>
        <div id="cardWrapper">
            <div id="image">
                <img src="<?php //$event["picture"]; ?>" alt="">
            </div>
            <div id="cardInfo">
                <div id="cardInfoContainer">
                    <p> <?= $event["name"]; ?> </p>
                    <div id="cardAditionalInfo">
                        <span> <?= $event["eventDate"]; ?> </span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach;
}