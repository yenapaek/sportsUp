<?php
$title = "Sports Up - Create Event";
$style = '<link href="./public/css/addEditEvent.css" rel="stylesheet" />';
ob_start();
?>  
<div id="addEditEvent">

    <h1><?= $formTitle ?> an event</h1>
    <div class="eventForm">
    <div class="formFirstPart">     
        <form action="index.php" method="POST">
            <input hidden name="action" value="<?= $form ?>">
            <input hidden name="eventId" value="<?= isset($eventDetail[0]['eventId']) ? $eventDetail[0]['eventId'] : '';?>">
            <label for="eventName">Event Name</label>
            <input type="text" id="eventName" name="eventName" value="<?= isset($eventDetail[0]["eventName"])? $eventDetail[0]['eventName'] : '';?>">

            <label for="sportCategory">Choose category</label>
            <select name="sportCategory" id="sportCategory">
                <option value="<?= !empty($eventDetail[0]["categoryId"]) ? $eventDetail[0]['categoryId'] : 'default';?> " selected > <?= !empty($eventDetail[0]["categoryName"]) ? $eventDetail[0]['categoryName'] :"Select Your Sport";?></option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?=$category["id"]; ?>"><?=$category["name"]; ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="eventPicture">Select Image for you event</label>
            <input type="file" id="eventPicture" name="eventPicture" accept="image/png, image/jpeg">

            <label for="city">City + address</label>
            <input type="text" id="city" name="city" value="<?= isset($eventDetail[0]["city"])?$eventDetail[0]["city"] :'' ; ?>">

            <label for="maxPlayers">How many people can join your event?</label>
            <input type="number" min="1" id="maxPlayers" name="maxPlayers" value="<?= isset($eventDetail[0]["playerNumber"])?$eventDetail[0]["playerNumber"]:''; ?>">

            <label for="eventDate">When </label>
            <input type="datetime-local" id="eventDate" placeholder="Date" name="eventDate" value ="<?= isset($eventDetail[0]["eventDate"])?$eventDetail[0]["eventDate"]:''; ?>">        
        </div>            
        <div class="formSecondPart">            

            <label for="eventDuration">Duration</label>
            <input type="number" min="1" id="eventDuration" name="eventDuration" value="<?= isset($eventDetail[0]["duration"])?$eventDetail[0]["duration"]:'';?>">
            
            <?php 
                if(isset($eventDetail[0]["premiumId"])){
            ?>
                <label for="eventFee">Fee</label>
                <input type="text" id="eventFee" name="eventFee" value="<?= isset($eventDetail[0]["fee"])?$eventDetail[0]["fee"]:'';?>" >
            <?php
            }else{
            ?>
               <input  type="hidden" id="eventFee" name="eventFee" value="" >
            <?php
            }
            ?>

            <label for="eventDescription">Description</label>
            <input type="text" id="eventDescription" class="eventDescription" name="eventDescription" value="<?= isset($eventDetail[0]["eventDescription"])?$eventDetail[0]["eventDescription"]:''; ?>">
            
        
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