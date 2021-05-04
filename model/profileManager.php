<?php


/**
 * myProfilModel
 *
 * @param  mixed $userId
 * @return array all the informations of the user's profil.
 */
function myProfilModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT * FROM users WHERE id=?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $infoProfil = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $infoProfil;
}


/**
 * mySportsModel
 *
 * @param  mixed $userId 
 * @return array all the sports the user is interested in.
 */
function mySportsModel($userId)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT c.name AS category_name
    FROM categories c
    JOIN mySports mS 
    ON c.id = mS.categoryId
    WHERE userId=?");
    $req->bindParam(1, $userId, PDO::PARAM_STR);
    $req->execute();
    $mySports = $req->fetchAll(PDO::FETCH_ASSOC);
    $req->closeCursor();
    return $mySports;
}
