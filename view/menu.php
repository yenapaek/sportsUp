<div id="top">
    <div class="topLeft">
        <a href="index.php?action=landing">
            <div class="logo">
                <img src="./public/images/logo.png" alt="">
            </div>
        </a>
        <!-- <div class="sup">
            <a href="index.php?action=landing">
                <h1>SPORTS UP</h1>
            </a>
        </div> -->
    </div>

    <div class="topRight">
        <div class="openMenu"><i class="fas fa-bars"></i></div>
        <nav class="rightBox">
            <a href="index.php?action=landing"><strong>Home</strong> </a>
            <a href="index.php?action=events"><strong>Events</strong> </a>
            <a href="index.php?action=aboutUs"><strong>About Us</strong></a>
            <a href="index.php"><strong>SHOP</strong></a>
            <?php if (isset($_SESSION['userId'])) {
            ?>
                <a href="index.php?action=profile" id="profileNavBar"><strong>Profile</strong></a>
                <a href="index.php?action=logout"><strong>Log Out</strong> </a>
            <?php
            } else {
            ?>
                <a href="index.php?action=signUp" id="signUpBtn"><strong>Sign Up</strong> </a>
            <?php
            }
            ?>
            <div class="animation start-home"></div>
            <div class="closeMenu"><i class="fas fa-times"></i></div>
        </nav>
    </div>


</div>
<!-- <div id="fixedBtn">
    <a href="#"><strong>+</strong> </a>
</div> -->
<script src="./public/js/menu.js"></script>