<?php
$title = "Sports Up - Create Event";
$style = '<link href="./public/css/addEditEvent.css" rel="stylesheet" />';
ob_start();
?>
<div id="addEditEvent">
    <div class="eventForm">
        <form action="index.php" method="POST">
            <input hidden name="action" value="createEvent">
            
            <label for="eventName">event Name</label>
            <input type="text" id="eventName" name="eventName" value="my event">

            <label for="sportCategory">Choose category</label>
            <select name="sportCategory" id="sportCategory">
                <option value="default" selected disabled>Select Your Sport</option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?= $category["id"]; ?>"><?= $category["name"]; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="eventPicture">Select Image for you event</label>
            <input type="file" id="eventPicture" name="eventPicture" accept="image/png, image/jpeg">

            <label for="city">City</label>
            <input type="text" id="city" name="city" value="Seoul">

            <label for="maxPlayers">How many people can join your event?</label>
            <input type="number" id="maxPlayers" name="maxPlayers" value="5">

            <label for="eventDate">When </label>
            <input type="date" id="eventDate" name="eventDate">

            <label for="eventDuration">Duration</label>
            <input type="number" id="eventDuration" name="eventDuration" value="3">

            <label for="eventDescription">Description</label>
            <input type="text" id="eventDescription" name="eventDescription" value="footbal event">

            <label for="eventFee">Fee</label>
            <input type="text" id="eventFee" name="eventFee" value="355">


            <input type="submit" id="btn" name="btn" value="Create">

        </form>
    </div>
</div>



<?php
$content = ob_get_clean();
require("template.php");
?>