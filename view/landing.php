<?php
$title = "Sports Up - Home";
$style = '<link href="./public/css/landing.css" rel="stylesheet" />
 <link href="./public/css/bottomLanding.css" rel="stylesheet" />';

ob_start();
?>
<div id="mainContent">
    <div id="firstSection">
        <div id="banner1" class="banner">
            <img src="./public/images/landing/banner1.jpeg" alt="banner image 1">
            <div class="text-box text-box1">
                <h1>Global events</h1>
                <span></span>
                <p>Enjoy with friends global events as a Ligue Football match! </p>
            </div>
        </div>
        <div id="banner2" class="banner">
            <img src="./public/images/landing/banner2.jpeg" alt="banner image 2">
            <div class="text-box text-box2">
                <h1>Users events</h1>
                <span></span>
                <p>Want to have friends to workout together ? </p>
                <p>Create a public event to find your teammates !</p>
            </div>
        </div>
        <div id="banner3" class="banner">
            <img src="./public//images/landing/banner3.jpg" alt="banner image 3">
            <div id="text-box3" class="text-box text-box3">
                <h1>Join our community!</h1>
                <span></span>
                <p>Meet and make new friends with similar interests</p>
            </div>
        </div>
        <div id="banner4" class="banner">
            <img src="./public//images/landing/banner4.jpg" alt="banner image 4">
            <div class="text-box text-box4">
                <h1>Premium Feature </h1>
                <span></span>
                <p>Become Premium member !</p>
                <p>Create and secure the transactions through our global events!</p>
            </div>
        </div>
        <!-- BUTTON -->
        <!-- <div class="box">
            <a href="index.php?action=signUp" class="btn btn-white btn-animation-1">Sign Up</a> 
        </div> -->

    </div>

</div>
<div id="secondSection">

    <div class="secondPhoto">
        <img src="./public/images/landing/photo1.jpg" alt="">
    </div>
    <div class="secondText">
        <p>
            SportsUp is a community of sports lovers.
            Join us to enjoy activities and make new friends !
        </p>
        <p>
            You want to propose an event like seeing a professional baseball team match ?
        </p>
        <p>
            You can become premium member in order to propose global events including a participation fee.
        </p>
        <p>
            Being premium member will insure that your transactions will be secured through our Website!
        </p>
        <div class="boxContainer">
            <div class="box1">
                <a href="index.php?action=signUp" class="btn btn-white btn-animation-1">Join Us</a>
            </div>
        </div>
    </div>

</div>
<div id="thirdSection">
    <?php require('premiumPlanView.php'); ?>
</div>
</div>


<?php
$content = ob_get_clean();
require("template.php");
?>