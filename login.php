<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Kakao JavaScript SDK</title>
    <script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
    <script>
        // Initialize SDK with JavaScript key for your app. 
        Kakao.init('339cdea24a4c89c54473cb56876710ec');

        // Check if the initialization is successfully done.
        console.log(Kakao.isInitialized());
    </script>
</head>
<body> 
  <?php
    $auth_code = include('oauth.php');
    // echo 'Authorization Code: '.$auth_code;
    // echo "<br>";

    // header("Access-Control-Allow-Origin: *");
    $url = 'https://kauth.kakao.com/oauth/token'; // API Link
    
    $auth_data = array(
      'grant_type' => 'authorization_code',
      'client_id' => '37fea6edf3b24bab4469275577842ba5', // REST API key
      'redirect_uri' => 'https://127.0.0.1/sportsEvent/oauth.php',
      'code' => $auth_code,
      // 'client_secret' => '4Ju15p8RUww2ImFQnFUTpGzyK2tljf7k',
    );

    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, [
      'Content-Type: application/x-www-form-urlencoded'
    ]);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $auth_data);

    // curl_setopt($curl, CURLOPT_HTTPHEADER, $auth_data);
    $output = curl_exec($curl);
    $output_json = json_decode($output);

    curl_close($curl);
    print_r($output_json);

  ?>
  <p id="token-result"></p>

  <script>
      // fetch('https://kauth.kakao.com/oauth/token', {
      //   method: 'post',
      //   headers: {
      //       'Authorization': 'Bearer ',
      //       'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8'
      //   }
      // }).then(response => console.log(response));


    // var xhr = new XMLHttpRequest();
    // xhr.open('POST', 'https://kauth.kakao.com/oauth/token');
    // xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=utf-8');
    // var param = 'grant_type=authorization_code&client_id=37fea6edf3b24bab4469275577842ba5&redirect_uri=https%3A%2F%2F127.0.0.1%2FsportsEvent%2Flogin.php&code='.$auth_code.'client_secret=4Ju15p8RUww2ImFQnFUTpGzyK2tljf7k';

    // var code = encodeURIComponent();

    // xhr.send(param);

    // xhr.addEventlistener('readystatechange', function() { // The constant DONE belong to the object XMLHttpRequest, it's not GLOBAL
    //   if (xhr.readyState === XMLHttpRequest.DONE) {
    //       console.log('done');
    //   }
    // });

      function displayToken() {
          const token = getCookie('authorize-access-token');
          if(token) {
            Kakao.Auth.setAccessToken(token);
            Kakao.Auth.getStatusInfo(({ status }) => {
              if(status === 'connected') {
                document.getElementById('token-result').innerText = 'login success. token: ' + Kakao.Auth.getAccessToken();
              } else {
                Kakao.Auth.setAccessToken(null);
              }
            });
          }
      }
      function getCookie(name) {
          const value = "; " + document.cookie;
          const parts = value.split("; " + name + "=");
          if (parts.length === 2) return parts.pop().split(";").shift();
      }
      displayToken();
  </script>
</body>