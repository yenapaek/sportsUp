<?php $style = '<link href="./public/css/signInAndUp.css" rel="stylesheet" />'; ?>
<?php ob_start(); ?>

<div id="bothForm">
    <div id="toggleForm">
        <p>SIGN UP</p>
        <label class="switch">
            <input type="checkbox" id="checkboxSlider">
            <span class="slider round"></span>
        </label>
        <p>LOG IN</p>
    </div>

    <?php 
        echo "New user is created: ".$newUser;
        if ($title === 'signIn') { 
    ?>
        <h1>LOG IN</h1>
        <section id="signInFormSection">
            <div>
                <form id="signInForm" class="form" action="index.php" method="post">
                    <input type="hidden" name="action" value="signInSubmit">
                    <input type="hidden" name="goPrem" value="<?= isset($goPrem) ?>">
                    <input type="hidden" name="q" value="<?= isset($plan) ? $plan : '' ?>">

                    <div class="formControl">
                        <label for="emailSignIn">Email</label>
                        <input type="email" placeholder="yourMail@provider.com" id="emailSignIn" name="emailSignIn" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="formControl">
                        <label for="passwordSignIn">Password</label>
                        <input type="password" placeholder="Password" id="passwordSignIn" name="passwordSignIn" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>

                    <button>Log In</button>
                </form>

            </div>
            <div class="kakaoDiv">
                <h1>Or</h1>
                <p>
                    <input type="image" id="kakao-login-btn" src="./public/images/signInAndUp/kakaoLoginBtnEN.png" onclick="loginWithKakao();"></input>
                </p>
            </div>
        </section>
        <?php
    } else {
        echo "go prem: ".$goPrem;
        // if (!$goPrem) {
        if (!empty($goPrem)) {

        ?>
            <h1>SIGN UP</h1>
            <h2>You must create an account before going premium</h2>
        <?php
        } else {
        ?>
            <h1>SIGN UP</h1>
        <?php
        }
        ?>

        <section id="signUpFormSection">
            <div class="kakaoDiv">
                <h1>Or</h1>
                <p>
                    <input type="image" id="kakao-login-btn" src="./public/images/signInAndUp/kakaoLoginBtnEN.png" onclick="loginWithKakao();"></input>
                </p>
                <p style="text-align: center;">
                    <img style="width: 200px; height: 200px;" type="image" id="kakao-login-btn" src="./public/images/error/kakao.png" />
                </p>
            </div>
            <div>
                <form id="signUpForm" class="form" action="index.php" method="post">
                    <input type="hidden" name="action" value="signUpSubmit">
                    <input type="hidden" name="goPrem" value="<?= isset($goPrem) ?>">
                    <input type="hidden" name="q" value="<?= isset($plan) ? $plan : '' ?>">

                    <div class="formControl">
                        <label for="userNameSignUp">Username</label>
                        <input type="text" placeholder="username" id="userNameSignUp" name="userNameSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="formControl">
                        <label for="emailSignUp">Email</label>
                        <input type="email" placeholder="yourMail@provider.com" id="emailSignUp" name="emailSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="formControl">
                        <label for="passwordSignUp">Password</label>
                        <input type="password" placeholder="Password" id="passwordSignUp" name="passwordSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <div class="formControl">
                        <label for="passwordConfSignUp">Password check</label>
                        <input type="password" placeholder="Password two" id="passwordConfSignUp" name="passwordConfSignUp" />
                        <i class="fas fa-check-circle"></i>
                        <i class="fas fa-exclamation-circle"></i>
                        <small>Error message</small>
                    </div>
                    <button>Sign Up</button>
                </form>
            </div>
        </section>

    <?php
    }
    ?>
</div>
<script src="./public/js/signInAndUpVerification.js"></script>
<script src="https://developers.kakao.com/sdk/js/kakao.js"></script>
<script>
    Kakao.init('339cdea24a4c89c54473cb56876710ec');
</script>
<script src="./public/js/kakaoLogin.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>