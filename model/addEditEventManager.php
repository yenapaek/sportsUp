<?php

// try {
//     $db = new PDO('mysql:host=localhost;dbname=sportsevent;charset=utf8', "root", "", array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
//   } catch(Exception $e) {
//       die("Error : ". $e->getMessage());
//   }

// $name = $_POST['eventName'];
// $categoryId = $_POST['sportCategory'];
// $picture = $_FILES['eventPicture'];
// $organizerId = $_SESSION['userId'];
// $playerNumber = $_POST['maxPlayers'];
// $eventDate = $_POST['eventDate'];
// $duration = $_POST['eventDuration'];
// $description = $_POST['eventDescription'];
// $fee = $_POST['eventFee'];
// $city = $_POST['city'];
// $eventPhotoPath = ['./public/images/profile/allUsersProfilePics/file/'];


function createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee)
{
    $db = dbConnect();
    $picture = null;
    $req = $db->prepare("INSERT INTO events(name, categoryId, picture, organizerId, city, playerNumber, duration, description, eventDate, fee)
                        VALUES(:name, :categoryId, :picture, :organizerId, :city, :playerNumber, :eventDuration, :eventDescription, :eventDate, :eventFee)");
    // $req->bindparam('id', $_SESSION['userId'], PDO::PARAM_STR);
    $req->bindparam('name', $name, PDO::PARAM_STR);
    $req->bindparam('organizerId', $_SESSION['userId'], PDO::PARAM_INT);
    $req->bindparam('categoryId', $categoryId, PDO::PARAM_INT);
    $req->bindparam('picture', $picture, PDO::PARAM_STR);
    $req->bindparam('city', $city, PDO::PARAM_STR);
    $req->bindparam('playerNumber', $playerNumber, PDO::PARAM_INT);
    $req->bindparam('eventDuration', $duration, PDO::PARAM_STR);
    $req->bindparam('eventDescription', $description, PDO::PARAM_STR);
    $req->bindparam('eventDate', $eventDate, PDO::PARAM_STR);
    $req->bindparam('eventFee', $fee, PDO::PARAM_STR);
    
    $req->execute();
    $req->closeCursor();
}

// $req = $db->prepare("INSERT INTO events(name, categoryId, picture, organizerId, playerNumber, eventDate, duration, description, fee)
//  VALUES(:name, :categoryId, :picture, :organizerId, :playerNumber, :eventDate, :duration, :description, :fee)");
// $req->execute(array(
//     'name' => $name,
//     'categoryId' => $categoryID,
//     'picture' => $picture,
//     'city' => $city,
//     'playerNumber' => $playerNumber,
//     'eventDate' => $eventDate,
//     'duration' => $duration,
//     'description' => $description,
//     'fee' => $fee
//     ));
// header('location:index.php'); 
// ?> 