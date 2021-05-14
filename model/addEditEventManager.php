<?php

function createEventModel($name, $categoryId, $city, $playerNumber, $eventDate, $duration, $description, $fee)
{
    $db = dbConnect();
    $picture = null;
    $req = $db->prepare("INSERT INTO events(name, categoryId, picture, organizerId, playerNumber, duration, description, eventDate, fee, city)
                        VALUES(:name, :categoryId, :picture, :organizerId, :playerNumber, :eventDuration, :eventDescription, :eventDate, :eventFee, :city)");
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
