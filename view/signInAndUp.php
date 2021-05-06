<?php $style = "./public/css/signInAndUp.css"; ?>

<?php ob_start(); ?>

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
            </div>
            <div>
                <img src="./public/images/signInAndUp/ball.png" alt="signIn image">
            </div>
        </section>
        <div>
            <h1>YENA's sign IN form</h1>
        </div>

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
        <div>
            <h1>YENA's sign UP form</h1>
        </div>
</div>
<?php
    }
?>

<script src="./public/js/signInAndUpVerification.js"></script>
<?php $content = ob_get_clean(); ?>
<?php require("template.php"); ?>