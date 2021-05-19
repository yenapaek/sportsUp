<?php
$title = "Sports Up - Create Event";
$style = '<link href="./public/css/addEditEvent.css" rel="stylesheet" />';
ob_start();
$formSubmition='addEvent';
$formTitle='Create';
if(isset($_REQUEST['editMode']))
{
    $formSubmition='editEvent';
$formTitle='Update';
}

?>
<div id="addEditEvent">

    <h1><?= $formTitle?> an event</h1>
    <div class="eventForm">
    <div class="formFirstPart">     
        <form action="index.php" method="POST">
            <input hidden name="action" value="<?php $formSubmition ?>">
            <input hidden name="eventId" value="<?php isset($infos[0]['id'])?>">
            <label for="eventName">Event Name</label>
            <input type="text" id="eventName" name="eventName" value="<?= isset($infos[0]["name"]);?>">

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
            <input type="text" id="city" name="city" value="<?= isset($infos[0]["city"]); ?>">

            <label for="maxPlayers">How many people can join your event?</label>
            <input type="number" id="maxPlayers" name="maxPlayers" value="<?= isset($infos[0]["playerNumber"]); ?>">

            <label for="eventDate">When </label>
            <input type="date" id="eventDate" name="eventDate" value ="<?= isset($infos[0]["eventDate"]); ?>">        
        </div>            
        <div class="formSecondPart">            

            <label for="eventDuration">Duration</label>
            <input type="number" id="eventDuration" name="eventDuration" value="<?= isset($infos[0]["duration"]);?>">

            <label for="eventFee">Fee</label>
            <input type="text" id="eventFee" name="eventFee" value="<?= isset($infos[0]["fee"]);?>">

            <label for="eventDescription">Description</label>
            <input type="text" id="eventDescription" class="eventDescription" name="eventDescription" value="<?= isset($infos[0]["description"]); ?>">
        
            <div class="btnForm">      
                <input type="submit" id="btn" class="btn btn-white btn-animation-1" name="btn" value="<?= $formTitle?>">
            </div>
        </div>                
        </form>
    </div>
</div>



<?php
$content = ob_get_clean();
require("template.php");
?>