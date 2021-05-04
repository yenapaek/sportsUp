<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <title>Login with Kakao</title>
    <script src="https://developers.kakao.com/sdk/js/kakao.js">
    </script>
    <script>
            // Initialize SDK with JavaScript key for your app. 
        Kakao.init('339cdea24a4c89c54473cb56876710ec');

        // Check if the initialization is successfully done.
        console.log(Kakao.isInitialized());
    </script>
</head>
<body>
    <h1>Login with Kakao</h1>
    <!-- add an action to the onlick -->
    <!-- <a id="custom-login-btn" onclick="loginWithKakao();">
        <img src="//k.kakaocdn.net/14/dn/btqCn0WEmI3/nijroPfbpCa4at5EIsjyf0/o.jpg" width="222"/>
    </a>
    <script type="text/javascript">
        function loginWithKakao() {
            console.log("redirecting to login.php");
            Kakao.Auth.authorize({
                redirectUri: 'https://127.0.0.1/sportsEvent/oauth.php'
            });
        };
    </script> -->
    <form id="kakaoLoginForm" action="kakaoLogin.php" method="post">
        <input type="hidden" name="action" value="kakaoLoginSubmit">
        <input type="image" src="../public/images/kakaoLoginBtnEN.png" id="kakao-login" alt="Kakao Login">
    </form>
    <?php
        $action = isset($_REQUEST['action']) ? $_REQUEST['action'] : null;
        if($action === 'kakaoLoginSubmit') {
    ?>
        <script type="text/javascript">
            console.log("redirecting to login.php");
            Kakao.Auth.authorize({
                redirectUri: 'https://127.0.0.1/sportsEvent/oauth.php'
            });
        </script>
    <?php
        //     $url = 'https://kauth.kakao.com/oauth/authorize?client_id=37fea6edf3b24bab4469275577842ba5'.'&redirect_uri=https//127.0.0.1/sportsEvent/oauth.php'.'&response_type=code';        
        //     $curl = curl_init();
        //     curl_setopt($curl, CURLOPT_URL, $url);
        //     curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        //     curl_setopt($curl, CURLOPT_HEADER, true); 
        //     curl_setopt($curl, CURLOPT_NOBODY, true);
        //     $header_data= curl_getinfo($curl);
        //     $output = curl_exec($curl);
        //     $httpstatus = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        //     curl_close($curl);

        //     echo "Errors: ".curl_error($curl)."<br>"; # Print errors if any
        //     echo "Status: ".$httpstatus."<br>"; # Print Response Status Code
        //     print_r($header_data);
        //     // var_dump($output); # Print Response Data
        //     // $output_json = json_decode($output);
        //     // print_r($output_json);
        //     echo "hello";
        }
    ?>
</body>
</html>