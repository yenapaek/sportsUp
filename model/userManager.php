<?php

function dbConnect() {
    try {
        return new PDO(
            "mysql:host=127.0.0.1;dbname=sportsevent;charset=utf8",
            "root",
            "",
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
        );
    } catch (Exception $e) {
        die("Error: " . $e->getMessage());
    }
} 

function getKakaoUser($kakaoId) {
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM users WHERE kakaoId = :kakaoId");
    $req->bindParam(":kakaoId", $kakaoId, PDO::PARAM_STR);
    $req->execute();
    $kakaoUserData = $req->fetch(PDO::FETCH_OBJ);
    return $kakaoUserDataa;
} 

function kakaoUserExists($kakaoId){
    return $status = getKakaoUser($kakaoId) ? 1 : 0;
}

function addKakaoUser($kakaoUserData) {
    $db = dbConnect();
    $kakaoId = $kakaoUserData['kakaoId'];
    if (!kakaoUserExists($kakaoId)){
        $req = $db->prepare("INSERT INTO users(id, userName, firstName, lastName, email, avatar, password, dateSignUp, birthDate, nationality, city, kakaoId, eventAttended)
                                            VALUES(null, :userName, null, null, :email, :avatar, null, NOW(), null, null, null, :kakaoId, null)");
        $req->bindParam("userName", $kakaoUserData['userName'], PDO::PARAM_STR);
        $req->bindParam("email", $kakaoUserData['email'], PDO::PARAM_STR);
        $req->bindParam("avatar", $kakaoUserData['avatar'], PDO::PARAM_STR);
        // $req->bindParam("dateSignUp", $kakaoUserData['dateSignUp'], PDO::PARAM_STR);
        $req->bindParam("kakaoId", $kakaoId, PDO::PARAM_STR);

        $req->execute();
        $req->closeCursor();
    }
    return $status;
}




