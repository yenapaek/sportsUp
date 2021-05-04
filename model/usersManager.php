<?php
require('./model/manager.php');

function newUserModel($user, $email, $pass, $conf)
{
    $submittable = true;

    $user = addslashes(htmlspecialchars(htmlentities(trim($user))));
    $email = addslashes(htmlspecialchars(htmlentities(trim($email))));

    if (strlen($user) < 6) {
        $submittable = false;
    }
    if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
        $submittable = false;
    }
    if ($pass !== $conf) {
        $submittable = false;
    }

    $db = dbConnect();

    $req = $db->prepare("SELECT * FROM users WHERE userName=? OR email=?");
    $req->bindParam(1, $user, PDO::PARAM_STR);
    $req->bindParam(2, $email, PDO::PARAM_STR);
    $req->execute();
    $userExist = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    if (!$userExist and $submittable) {

        $hash = password_hash($pass, PASSWORD_DEFAULT);
        $req = $db->prepare("INSERT INTO  users (userName,email,password, dateSignUp) VALUES(:userName, :email, :hash, NOW())");
        $req->bindParam(":userName", $user, \PDO::PARAM_STR);
        $req->bindParam(":email", $email, \PDO::PARAM_STR);
        $req->bindParam(":hash", $hash, \PDO::PARAM_STR);
        $status = $req->execute();
        $req->closeCursor();
        return $status;
    }
}

function manualLoginModel($email, $pass)
{
    $db = dbConnect();

    $req = $db->prepare("SELECT password FROM users WHERE email=?");
    $req->bindParam(1, $email, PDO::PARAM_STR);
    $req->execute();
    $info = $req->fetch(PDO::FETCH_ASSOC);
    $req->closeCursor();

    if ($info) {
        return password_verify($pass, $info['password']);
    }
    return false;
}

#TODO: Build kakao user profile creation. Currently, this function only creates a basic user from info taken from Kakao API call
function kakaoAPICallModel($authCode){
    $tokens = getTokens($authCode);
    $kakaoUserObj = requestKakaoAPIUserData($tokens['access_token']);
    $kakaoId = $kakaoUserObj['kakaoId'];

    if (!kakaoUserExists($kakaoId)){
        addNewKakaoUser($kakaoUserObj);
    }
    return $kakaoId;
}


#TODO: deal with errors when making requests

function getTokens($authCode){
    $url = 'https://kauth.kakao.com/oauth/token'; // API Link

    $grantType = 'authorization_code';
    $param = 'grant_type=authorization_code&client_id=37fea6edf3b24bab4469275577842ba5&redirect_uri=https://127.0.0.1/sportsEvent/model/oauth.php&code='.$authCode;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $param);

    $output = curl_exec($curl);
    $outputJSON = json_decode($output);

    $tokens['access_token'] = $outputJSON->access_token;
    $tokens['refresh_token'] = $outputJSON->refresh_token;

    curl_close($curl);
    return $tokens;
}

function requestKakaoAPIUserData($accessToken){
    $url = 'https://kapi.kakao.com/v2/user/me';

    $headers = array(
      'Authorization: Bearer '.$accessToken,
      'Content-Type: application/x-www-form-urlencoded',
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $output = curl_exec($curl);
    $apiUserObj = json_decode($output);

    curl_close($curl);

    $kakaoUserObj = createKakaoUserObj($apiUserObj);

    return $kakaoUserObj;
}

function createKakaoUserObj($apiUserObj) {
    $kakaoUserObj['kakaoId'] = $apiUserObj->id;
    $kakaoUserObj['dateConnected'] = $apiUserObj->connected_at;
    $kakaoUserObj['userName'] = ($apiUserObj->properties)->nickname;
    $kakaoUserObj['avatar'] = ($apiUserObj->properties)->thumbnail_image;
    $kakaoUserObj['email'] = ($apiUserObj->kakao_account)->email;
    return $kakaoUserObj;
}

function getKakaoUser($kakaoId) {
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM users WHERE kakaoId = :kakaoId");
    $req->bindParam(":kakaoId", $kakaoId, PDO::PARAM_STR);
    $req->execute();
    $kakaoUserData = $req->fetch(PDO::FETCH_OBJ);
    return $kakaoUserData;
} 

function kakaoUserExists($kakaoId){
    return $status = getKakaoUser($kakaoId) ? 1 : 0;
}

function addNewKakaoUser($kakaoUserObj) {
    $db = dbConnect();
    $kakaoId = $kakaoUserObj['kakaoId'];
    $req = $db->prepare("INSERT INTO users(id, userName, firstName, lastName, email, avatar, password, dateSignUp, birthDate, nationality, city, kakaoId, eventAttended)
                        VALUES(null, :userName, null, null, :email, :avatar, null, NOW(), null, null, null, :kakaoId, null)");
    $req->bindParam("userName", $kakaoUserObj['userName'], PDO::PARAM_STR);
    $req->bindParam("email", $kakaoUserObj['email'], PDO::PARAM_STR);
    $req->bindParam("avatar", $kakaoUserObj['avatar'], PDO::PARAM_STR);
    $req->bindParam("kakaoId", $kakaoId, PDO::PARAM_STR);

    $req->execute();
    $req->closeCursor();
}

#TODO: switch authcode request from JS to REST API
// function requestAuthCode() {
//     $url = 'https://kauth.kakao.com/oauth/authorize'; // API Link

//     $RESTAPIClientId = '37fea6edf3b24bab4469275577842ba5';
//     $redirectUri = 'https//127.0.0.1/sportsEvent/oauth.php';
//     $responseType = 'code';
//     $param = 'client_id='.$RESTAPIClientId.
//             '&redirect_uri='.$redirectUri.
//             '&response_type='.$responseType;
//     $curl = curl_init();
//     curl_setopt($curl, CURLOPT_URL, $url);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     // curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//     $output = curl_exec($curl);
//     // $apiUserObj = json_decode($output);
//     curl_close($curl);
// }




