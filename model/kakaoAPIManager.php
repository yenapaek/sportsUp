<?php
#TODO: change to camelCase

function getTokens($auth_code){
    $url = 'https://kauth.kakao.com/oauth/token'; // API Link

    $grant_type = 'authorization_code';
    $REST_API_client_id = '37fea6edf3b24bab4469275577842ba5';
    $redirect_uri = 'https%3A%2F%2F127.0.0.1%2FsportsEvent%2Foauth.php';
    $param = 'grant_type='.$grant_type.
            '&client_id='.$REST_API_client_id.
            '&redirect_uri='.$redirect_uri.
            '&code='.$auth_code;

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $param);

    $output = curl_exec($curl);
    $output_json = json_decode($output);

    $tokens['access_token'] = $output_json->access_token;
    $tokens['refresh_token'] = $output_json->refresh_token;

    curl_close($curl);
    return $tokens;
}

function requestKakaoUserData($access_token){
    $url = 'https://kapi.kakao.com/v2/user/me';

    $headers = array(
      'Authorization: Bearer '.$access_token,
      'Content-Type: application/x-www-form-urlencoded',
    );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

    $output = curl_exec($curl);
    $apiUserObj = json_decode($output);

    curl_close($curl);

    #TODO: Need to check in db that user doesn't exist before creating obj
    // $kakaoUserObj = createKakaoUserDataObj($apiUserObj);

    return $apiUserObj;
}

function createKakaoUserDataObj($apiUserObj) {
    $kakaoUserData['kakaoId'] = $apiUserObj->id;
    $kakaoUserData['dateSignUp'] = $apiUserObj->connected_at;
    $kakaoUserData['userName'] = ($apiUserObj->properties)->nickname;
    $kakaoUserData['avatar'] = ($apiUserObj->properties)->thumbnail_image;
    $kakaoUserData['email'] = ($apiUserObj->kakao_account)->email;

    return $kakaoUserDataObj;
}

#TODO: switch authcode request from JS to REST API
// function getAuthCode() {
//     $url = 'https://kauth.kakao.com/oauth/authorize'; // API Link

//     $REST_API_key = '37fea6edf3b24bab4469275577842ba5';
//     $redirect_uri = 'https%3A%2F%2F127.0.0.1%2FsportsEvent%2Foauth.php';
//     $response_type = 'code';
//     $param = 'client_id='.$REST_API_key.
//             '&redirect_uri='.$redirect_uri.
//             '&response_type='.$response_type;
    
//     curl_setopt($curl, CURLOPT_URL, $url);
//     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

//     $output = curl_exec($curl);
//     $apiUserObj = json_decode($output);

//     curl_close($curl);

// }
