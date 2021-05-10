<div id="top">
    <div class="top-left">
        <div class="logo">
            <img src="./public/images/logo.png" alt="">
        </div>
        <div class="sup">
            <a href="index.php?action=landing">
                <h1>SPORTS UP</h1>
            </a>
        </div>
    </div>

    <div class="top-right">
        <nav class="rightBox">
            <a href="index.php?action=landing"><strong>Home</strong> </a>
            <a href="index.php?action=events"><strong>Events</strong> </a>
            <a href="index.php?action=aboutUs"><strong>About Us</strong></a>
            <a href="index.php"><strong>SHOP</strong></a>
            <?php if (isset($_SESSION['userId'])) {
            ?>
                <a href="index.php?action=profile" id="profileNavBar"><img src="./public/images/landing/avatar.png" alt="Avatar" class="avatar"><strong>Profile</strong></a>
                <a href="index.php?action=logout"><strong>Log Out</strong> </a>
            <?php
            } else {
            ?>
                <a href="index.php?action=signUp" id="signUpBtn"><strong>Sign Up</strong> </a>
            <?php
            }
            ?>
            <div class="animation start-home"></div>
        </nav>
    </div>
</div>