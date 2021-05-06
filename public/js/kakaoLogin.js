const loginWithKakao = () => {
    console.log("redirecting to login.php");
    Kakao.Auth.authorize({
        redirectUri: 'https://127.0.0.1/sportsEvent/model/oauth.php'
    });
};