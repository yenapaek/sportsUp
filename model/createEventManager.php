<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=sportsevent;charset=utf8', "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch(Exception $e) {
      die("Error : ". $e->getMessage());
  }

$name = $_POST['eventName'];
$categoryID = $_POST['sportCategory'];
$picture = $_POST['eventPicture'];
$organizerId = $_POST['hostName'];
$playerNumber = $_POST['maxPlayers'];
$eventDate = $_POST['eventDate'];
$duration = $_POST['eventDuration'];
$description = $_POST['eventDiscription'];
$fee = $_POST['eventFee'];
// $latitude = $POST['']
// $longtitude = $POST['']

$req = $db->prepare("INSERT INTO events(name, categoryID, picture, organizerId, playerNumber, eventDate, duration, fee)
 VALUES(:name, :categoryID, :picture, :organizerId, :playerNumber, :eventDate, :duration, :fee)");
$req->execute(array(
    'name' => $name,
    'categoryId' => $categoryID,
    'picture' => $picture,
    'organizerId' => $organizerId,
    'playerNumber' => $playerNumber,
    'eventDate' => $eventDate,
    'duration' => $duration,
    'fee' => $fee
    ));
header('location:index.php'); 
?> 