<?php 
$title = "Sports Up - Create Event";
$style = '<link href="./public/css/createEvent.css" rel="stylesheet" />';

ob_start();
?>
<div id="createEvent">
    <div class="eventForm">
        <form action="./model/createEventManager.php" method="POST">
            <label for="eventName">event Name</label>
            <input type="text" id="eventName" name="eventName">
        
            <label for="sportCategory">Choose category</label>
            <select name="sportCategory" id="sportCategory">
                <option value="2">Acro Sports</option>
                <option value="3">Archery</option>
                <option value="4">Ball over net games</option>
                <option value="9">Baseball</option>
                <option value="10">Basketball</option>
                <option value="8">Board Sports</option>
                <option value="7">Catching Sports</option>
                <option value="11">Cue Sports</option>
                <option value="5">Cycling</option>
                <option value="13">Football</option>
                <option value="1">Matrial Art</option>
                <option value="6">Mountains</option>
                <option value="12">Weapon Sports</option>
            </select>
            
            <label for="eventPicture">Select Image for you event</label>
            <input type="file" id="eventPicture" name="eventPicture" accept="image/png, image/jpeg">

            <label for="hostName">Your name</label>
            <input type="text" id="hostName" name="hostName">

            <label for="maxPlayers">How many people can join your event?</label>
            <input type="number" id="maxPlayers" name="maxPlayers">

            <label for="eventDate">When </label>
            <input type="date" id="eventDate" name="eventDate">

            <label for="eventDuration">Duration</label>
            <input type="number" id="eventDuration" name="eventDuration">

            <label for="eventDiscription">Discription</label>
            <input type="text" id="eventDiscription" name="eventDiscription">

            <label for="eventFee">Fee</label>
            <input type="text" id="eventFee" name="eventFee">


        <input type="submit" id="btn" name="btn" value="Create">
        
        </form>
    </div>
</div>



<?php
    $content = ob_get_clean();
    require("template.php");
?>