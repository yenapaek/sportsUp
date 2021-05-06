<?php $style = "./public/css/signInAndUp.css"; ?>

<?php ob_start(); ?>

<p><a href="index.php">Back to HOMEPAGE</a></p>
<div id="bothForm">
    <h1><?= $title ?></h1>
    <?php if ($title === 'signIn') { ?>

        <section id="signInFormSection">
            <div>
                <form id="signInForm" class="form" action="index.php" method="post">
                    <input type="hidden" name="action" value="signInSubmit">

                    <div class="form-control">
                        <label for="emailSignIn">Email</label>
                        <input type="email" placeholder="yourMail@provider.com" id="emailSignIn" name="emailSignIn" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="form-control">
                        <label for="passwordSignIn">Password</label>
                        <input type="password" placeholder="Password" id="passwordSignIn" name="passwordSignIn" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>

                    <button>Submit</button>
                </form>
                <div>
                    <input type="image" id="kakao-login-btn" src="./public/images/kakaoLoginBtnEN.png" onclick="loginWithKakao();"></input>
                </div>
            </div>
            <div>
                <img src="./public/images/signInAndUp/ball.png" alt="signIn image">
            </div>
            <!-- <div>
                <a id="kakao-login-btn-en" onclick="loginWithKakao();">
                    <img src="./public/images/kakaoLoginBtnEN.png" width="222"/>
                </a>
            </div> -->
        </section>
    <?php
    } else {
    ?>
        <section id="signUpFormSection">
            <div>
                <img src="./public/images/signInAndUp/ball.png" alt="signUp image">
            </div>
            <div>
                <form id="signUpForm" class="form" action="index.php" method="post">
                    <input type="hidden" name="action" value="signUpSubmit">
                    <div class="form-control">
                        <label for="userNameSignUp">Username</label>
                        <input type="text" placeholder="username" id="userNameSignUp" name="userNameSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="form-control">
                        <label for="emailSignUp">Email</label>
                        <input type="email" placeholder="yourMail@provider.com" id="emailSignUp" name="emailSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="form-control">
                        <label for="passwordSignUp">Password</label>
                        <input type="password" placeholder="Password" id="passwordSignUp" name="passwordSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="form-control">
                        <label for="passwordConfSignUp">Password check</label>
                        <input type="password" placeholder="Password two" id="passwordConfSignUp" name="passwordConfSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <button>Submit</button>
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
