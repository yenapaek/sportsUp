<div id="top">
    <div class="topLeft">
        <?php
        if (!isset($_SESSION['userId'])){
            $logoLink = "index.php?action=landing";
        } else {
            $logoLink = "";
        }
        ?>
        <a href=<?= $logoLink ?>>
            <div class="logo">
                <img src="./public/images/logo.png" alt="">
            </div>
        </a>
    </div>

    <div class="topRight">
        <div class="openMenu"><i class="fas fa-bars"></i></div>
        <nav class="rightBox">
            <?php if (!isset($_SESSION['userId'])){
            ?>
                <a href="index.php?action=landing"><strong>Home</strong> <i id ="responsiveMenu" class="fas fa-home"></i> </a>
            <?php
            } else {
            ?>
                <a href="index.php?action=profile" id="profileNavBar"><strong>Profile</strong> <i id ="responsiveMenu" class="fas fa-id-badge"></i></a>
            <?php 
            }
            ?>
            <a href="index.php?action=events"><strong>Events</strong> <i id ="responsiveMenu" class="far fa-calendar-check"></i> </a>
            <a href="index.php?action=aboutUs"><strong>About Us</strong> <i id ="responsiveMenu" class="fas fa-users-cog"></i></a>
            <a href="index.php?action=premium"><strong>PREMIUM<i class="fas fa-crown"></i></strong> <i id ="responsiveMenu" class="fas fa-crown"></i></a>
            <?php if (isset($_SESSION['userId'])) {
            ?>
                <a href="index.php?action=logout"><strong>Log Out</strong><i id ="responsiveMenu" class="fas fa-sign-out-alt"></i> </a>
            <?php
            } else {
            ?>
                <a href="index.php?action=signUp" class="signUpBtn"><strong>Sign Up</strong><i id ="responsiveMenu" class="fas fa-sign-in-alt"></i> </a>
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