<?php
$title = "Sports Up - Home";
$style = '<link href="./public/css/landing.css" rel="stylesheet" /> <link href="./public/css/bottomLanding.css" rel="stylesheet" />';

ob_start();
?>
<div id="mainContent">
    <div id="firstSection">
        <div id="banner1" class="banner">
            <img src="./public/images/landing/banner1.jpeg" alt="banner image 1">
            <div class="text-box text-box1">
                <h1>Discover global events</h1>
                <span></span>
                <p>Find new friends to attend  Global sport Events </p>
            </div>
        </div>
        <div id="banner2" class="banner">
            <img src="./public/images/landing/banner2.jpeg" alt="banner image 2">
            <div class="text-box text-box2">
                <h1>Join outdoors events everyday!</h1>
                <span></span>
                <p>Make new friends with simmilar interests</p>
            </div>
        </div>
        <div id="banner3" class="banner">
            <img src="./public//images/landing/banner3.jpg" alt="banner image 3">
            <div id="text-box3" class="text-box text-box3">
                <h1>Join our community!</h1>
                <span></span>
                <p>Face new challenges, exchange experience!</p>
            </div>
        </div>
        <div id="banner4" class="banner">
            <img src="./public//images/landing/banner4-2.jpeg" alt="banner image 4">
            <div class="text-box text-box4">
                <h1>PREMIUM members</h1>
                <span></span>
                <p>Become a PREMIUM member and create 
                    your own sport events!</p>
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
            Are you ready for to meet and make new friends, face new challanges and expirience?
        </p>
        <div class="boxContainer">
            <div class="box1">
                <a href="index.php?action=signUp" class="btn btn-white btn-animation-1">Join Us</a>
            </div>
        </div>
    </div>

</div>
<div id="thirdSection">
    <div class="background">
        <div class="container">
            <div class="panel pricing-table">

                <div class="pricing-plan">
                    <img src="https://s22.postimg.cc/8mv5gn7w1/paper-plane.png" alt="" class="pricing-img">
                    <h2 class="pricing-header">Free</h2>
                    <ul class="pricing-features">
                        <li class="pricing-features-item">Unlimited Access to private Event</li>
                        <li class="pricing-features-item">Create Private Event Only</li>
                    </ul>
                    <span class="pricing-price">Free</span>
                    <a href="index.php?action=signUp" class="pricing-button">Sign up</a>
                </div>

                <div class="pricing-plan">
                    <img src="https://s28.postimg.cc/ju5bnc3x9/plane.png" alt="" class="pricing-img">
                    <h2 class="pricing-header">1 Month</h2>
                    <ul class="pricing-features">
                        <li class="pricing-features-item">Unlimited Access to Private & Global Event</li>
                        <li class="pricing-features-item">Create paid Event</li>
                    </ul>
                    <span class="pricing-price">$9.99</span>
                    <a href="#/" class="pricing-button is-featured">Try now</a>
                </div>

                <div class="pricing-plan">
                    <img src="https://s21.postimg.cc/tpm0cge4n/space-ship.png" alt="" class="pricing-img">
                    <h2 class="pricing-header">1 Year</h2>
                    <ul class="pricing-features">
                        <li class="pricing-features-item">Unlimited Access to Private & Global Event</li>
                        <li class="pricing-features-item">Create paid Event</li>
                    </ul>
                    <span class="pricing-price">$99</span>
                    <a href="#/" class="pricing-button">Try now</a>
                </div>

            </div>
        </div>
    </div>
</div>
</div>


<?php
$content = ob_get_clean();
require("template.php");
?>