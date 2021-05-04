<?php
    $title = "Profile";
    ob_start();
?>
<h1>Login with Kakao</h1>
<a id="custom-login-btn" onclick="loginWithKakao();">
    <img src="//k.kakaocdn.net/14/dn/btqCn0WEmI3/nijroPfbpCa4at5EIsjyf0/o.jpg" width="222"/>
</a>
<script src="https://developers.kakao.com/sdk/js/kakao.js">
    // Initialize SDK with JavaScript key for your app. 
    Kakao.init('339cdea24a4c89c54473cb56876710ec');

    // Check if the initialization is successfully done.
    console.log(Kakao.isInitialized());
</script>
<script type="text/javascript">
    function loginWithKakao() {
        // console.log("redirecting to login.php");
        Kakao.Auth.authorize({
            redirectUri: 'https://127.0.0.1/sportsEvent/oauth.php'
        });
    };
</script>
<?php
    $content = ob_clean();
    require("template.php");
?>