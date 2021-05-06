<?php

    try {
        $dataBase = new PDO('mysql:host=localhost;dbname=sportsevent;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE => PDO:: ERRMODE_EXCEPTION));
    } catch (Exception $exception) {
        die('Error :' . $exception->getMessage());
    }


    $list = array(
        array("Martial Arts", "./public/images/sports/martial-arts.jpeg"),
        array("Acro Sports", "./public/images/sports/acro-sports.jpeg"),
        array("Archery", "./public/images/sports/archery.jpeg"),
        array("Ball over net games", "./public/images/sports/ball-over-net-games.jpeg"),
        array("Cycling", "./public/images/sports/cycling.jpeg"),
        array("Mountains", "./public/images/sports/mountain.jpeg"),
        array("Catching sports", "./public/images/sports/catching-sports.jpeg"),
        array("Board sports", "./public/images/sports/over-a-board-sports.jpeg"),
        array("Baseball", "./public/images/sports/baseball.jpeg"),
        array("Basketball", "./public/images/sports/basketball.jpeg"),
        array("Cue sports", "./public/images/sports/cue-sports.jpeg"),
        array("Weapons sports", "./public/images/sports/weapon-sports.jpeg"),
        array("Football", "./public/images/sports/football.jpeg"),
    );



    // Iterating through $list to add sports categories to the data base.
    for ($i=0; $i < COUNT($list); $i++) { 
        for ($j=0; $j < 1; $j++) { 
            $request = $dataBase->prepare("INSERT INTO categories(name, image) VALUES(:sportName, :image)");
            $request->bindParam(":sportName", $list[$i][0], \PDO::PARAM_STR);
            $request->bindParam(":image", $list[$i][1], \PDO::PARAM_STR);

            $request->execute();
        }
    }

?>