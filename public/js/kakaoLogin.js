const loginWithKakao = () => {
    Kakao.Auth.authorize({
        redirectUri: 'http://127.0.0.1/sportsEvent/index.php?action=oauth'
    });
};