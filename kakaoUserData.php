<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Kakao JavaScript SDK</title>
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
    <script>
        Kakao.init('339cdea24a4c89c54473cb56876710ec');
        console.log(Kakao.isInitialized());
    </script>
</head>
<body> 
  <?php
  session_start();
    if (isset($_SESSION['auth_code'])){
      $auth_code = $_SESSION['auth_code'];
      echo $auth_code."<br>";

      $url = 'https://kauth.kakao.com/oauth/token'; // API Link

      $param = 'grant_type=authorization_code&client_id=37fea6edf3b24bab4469275577842ba5&redirect_uri=https%3A%2F%2F127.0.0.1%2FsportsEvent%2Foauth.php&code='.$auth_code;

      $curl = curl_init();

      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_POST, true);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
      ]);
      curl_setopt($curl, CURLOPT_POSTFIELDS, $param);

      $output = curl_exec($curl);
      $output_json = json_decode($output);

      echo "<pre>";
      print_r($output_json);
      echo "</pre>";
      echo "<br>";

      $_SESSION['access_token'] = $output_json->access_token;
      $_SESSION['refresh_token'] = $output_json->refresh_token;

      curl_close($curl);
      print_r($_SESSION);


    } else {
      echo "Error.";
    }
/******************** USER INFORMATION REQUEST ********************/
    if (isset($_SESSION['access_token'])){
      $url = 'https://kapi.kakao.com/v2/user/me';
      $headers = array(
        'Authorization: Bearer '.$_SESSION['access_token'],
        'Content-Type: application/x-www-form-urlencoded',
      );

      $curl = curl_init();
      
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);


      $output = curl_exec($curl);
      $output_json = json_decode($output);
      echo "<pre>";
      print_r($output_json);
      echo "</pre>";
      echo "<br>";
      curl_close($curl);
    } else {
      echo "Error.";
    }
  ?>
</body>