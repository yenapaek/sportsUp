<?php

// function dbConnect(){
//     try {
//         return new PDO(
//             "mysql:host=127.0.0.1;dbname=sportsevent;charset=utf8",
//             "root",
//             "",
//             array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
//         );
//     } catch (Exception $e) {
//         die("Error: ".$e->getMessage());
//     }
// } 

// function getKakaoUser($kakaoId) {
//     $db = dbConnect();
//     $req = $db->prepare("SELECT * FROM users WHERE kakaoId = :kakaoId");
//     $req->bindParam(":kakaoId", $kakaoId, PDO::PARAM_STR);
//     $req->execute();

//     $userData = $req->fetch(PDO::FETCH_OBJ);
//     return $userData;
// }
// function kakaoUserExists($kakaoId){
//     // if(getKakaoUser($kakaoId) == null){
//     //     return "null";
//     // }else {
//     //     return "true";
//     // }
//     return $status = getKakaoUser($kakaoId) ? 1 : 0;
// }

// $userData = getKakaoUser('171449932');
// print_r($userData);
// print_r(kakaoUserExists('714499327'));

function getAuthCode() {
    $url = 'https://kauth.kakao.com/oauth/authorize'; // API Link

    $REST_API_key = '37fea6edf3b24bab4469275577842ba5';
    $redirect_uri = 'https%3A%2F%2F127.0.0.1%2FsportsEvent%2Foauth.php';
    $response_type = 'code';
    $param = 'client_id='.$REST_API_key.
            '&redirect_uri='.$redirect_uri.
            '&response_type='.$response_type;
    $curl = curl_init(); 
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);

    $output = curl_exec($curl);
    $apiUserObj = json_decode($output);

    curl_close($curl);
}
getAuthCode();
