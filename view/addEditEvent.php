<?php
$title = "Sports Up - Create Event";
$style = '<link href="./public/css/addEditEvent.css" rel="stylesheet" />';
ob_start();
print_r($infos);
?>  
<div id="addEditEvent">

    <h1><?= $formTitle ?> an event</h1>
    <div class="eventForm">
    <div class="formFirstPart">     
        <form action="index.php" method="POST">
            <input hidden name="action" value="<?= $form ?>">
            <input hidden name="eventId" value="<?= isset($infos[0]['id']) ? $infos[0]['id'] : '';?>">
            <label for="eventName">Event Name</label>
            <input type="text" id="eventName" name="eventName" value="<?= isset($infos[0]["name"])? $infos[0]['name'] : '';?>">

            <label for="sportCategory">Choose category</label>
            <select name="sportCategory" id="sportCategory">
                <option value="<?= !empty($infos[0]["categoryId"]) ? $infos[0]['categoryId'] : 'default';?> " selected > <?= !empty($infos[0]["categoryName"]) ? $infos[0]['categoryName'] :"Select Your Sport";?></option>
                <?php foreach ($categories as $category) : ?>
                    <option value="<?=$category["id"]; ?>"><?=$category["name"]; ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="eventPicture">Select Image for you event</label>
            <input type="file" id="eventPicture" name="eventPicture" accept="image/png, image/jpeg">

            <label for="city">City + address</label>
            <input type="text" id="city" name="city" value="<?= isset($infos[0]["city"])?$infos[0]["city"] :'' ; ?>">

            <label for="maxPlayers">How many people can join your event?</label>
            <input type="number" min="1" id="maxPlayers" name="maxPlayers" value="<?= isset($infos[0]["playerNumber"])?$infos[0]["playerNumber"]:''; ?>">

            <label for="eventDate">When </label>
            <input type="datetime-local" id="eventDate" placeholder="Date" name="eventDate" value ="<?= isset($infos[0]["eventDate"])?$infos[0]["eventDate"]:''; ?>">        
        </div>            
        <div class="formSecondPart">            

            <label for="eventDuration">Duration</label>
            <input type="number" min="1" id="eventDuration" name="eventDuration" value="<?= isset($infos[0]["duration"])?$infos[0]["duration"]:'';?>">
            
            <?php 
                if(isset($infos[0]["premium"])){
            ?>
                <label for="eventFee">Fee</label>
                <input type="text" id="eventFee" name="eventFee" value="<?= isset($infos[0]["fee"])?$infos[0]["fee"]:'';?>" >
            <?php
            }else{
            ?>
               <input  type="hidden" id="eventFee" name="eventFee" value="" >
            <?php
            }
            ?>

            <label for="eventDescription">Description</label>
            <input type="text" id="eventDescription" class="eventDescription" name="eventDescription" value="<?= isset($infos[0]["description"])?$infos[0]["description"]:''; ?>">
            
        
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