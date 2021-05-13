<?php

try {
    $db = new PDO('mysql:host=localhost;dbname=sportsevent;charset=utf8', "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
  } catch(Exception $e) {
      die("Error : ". $e->getMessage());
  }

$name = $_POST['eventName'];
$categoryID = $_POST['sportCategory'];
$picture = $_POST['eventPicture'];
$organizerId = $_SESSION['userId'];
$playerNumber = $_POST['maxPlayers'];
$eventDate = $_POST['eventDate'];
$duration = $_POST['eventDuration'];
$description = $_POST['eventDescription'];
$fee = $_POST['eventFee'];

$req = $db->prepare("INSERT INTO events(name, categoryId, picture, organizerId, playerNumber, eventDate, duration, description, fee)
 VALUES(:name, :categoryId, :picture, :organizerId, :playerNumber, :eventDate, :duration, :description, :fee)");
$req->execute(array(
    'name' => $name,
    'categoryId' => $categoryID,
    'picture' => $picture,
    'organizerId' => $organizerId,
    'playerNumber' => $playerNumber,
    'eventDate' => $eventDate,
    'duration' => $duration,
    'description' => $description,
    'fee' => $fee
    ));
header('location:index.php'); 
?> 