<?php $style = "./public/css/signInAndUp.css"; ?>

<?php ob_start(); ?>

<p><a href="index.php">Back to HOMEPAGE</a></p>
<div id="bothForm">
    <h1><?= $title ?></h1>
    <?php if ($title === 'signIn') { ?>

        <section id="signInFormSection">
            <div>
                <form id="signInForm" action="index.php" method="post">
                    <input type="hidden" name="action" value="signInSubmit">
                    <div>
                        <label for="emailSignIn">Email :</label>
                        <input type="text" name="emailSignIn" id="emailSignIn" autofocus>
                    </div>
                    <div>
                        <label for="passwordSignIn">Password :</label>
                        <input type="password" name="passwordSignIn" id="passwordSignIn">
                    </div>
                    <input type="submit" value="Sign In">
                </form>
            </div>
            <div>
                <img src="./public/images/ball.png" alt="signIn image">
            </div>
            <div>
                <a id="kakao-login-btn-en" onclick="loginWithKakao();">
                    <img src="./public/images/kakaoLoginBtnEN.png" width="222"/>
                </a>
            </div>
        </section>
    <?php
    } else {
    ?>
        <section id="signUpFormSection">
            <div>
                <img src="./public/images/ball.png" alt="signUp image">
            </div>
            <div>
                <form id="signUpForm" action="index.php" method="post">
                    <input type="hidden" name="action" value="signUpSubmit">
                    <div>
                        <label for="userNameSignUp">UserName :</label>
                        <input type="text" name="userNameSignUp" id="userNameSignUp" autofocus onkeyup="inputVerification(this.id)">
                    </div>
                    <div>
                        <label for="emailSignUp">Email :</label>
                        <input type="text" name="emailSignUp" id="emailSignUp" onkeyup="inputVerification(this.id)">
                    </div>
                    <div>
                        <label for="passwordSignUp">Password :</label>
                        <input type="password" name="passwordSignUp" id="passwordSignUp" onkeyup="inputVerification(this.id)" autocomplete="off">
                    </div>
                    <div>
                        <label for="passwordConfSignUp">Password Confirmation :</label>
                        <input type="password" name="passwordConfSignUp" id="passwordConfSignUp" onkeyup="inputVerification(this.id)" autocomplete="off">
                    </div>
                    <input type="submit" value="Sign Up">
                </form>
            </div>
        </section>
</div>
<?php
    }
?>
<script src="./public/js/signInAndUpVerification.js"></script>
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script>
    Kakao.init('339cdea24a4c89c54473cb56876710ec');
    // console.log(Kakao.isInitialized());
</script>
<script src="./public/js/kakaoLogin.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>
