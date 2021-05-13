<?php 
$title = "Sports Up - Home";
$style = '<link href="./public/css/landing.css" rel="stylesheet" />';

ob_start();
?>
<div id="mainContent">
    <div id = "firstSection">
        <div id="banner1" class="banner">
            <img src="./public/images/landing/banner1.jpeg" alt="banner image 1">
            <div class="text-box text-box1">
                <h1>Big events</h1>
                <span></span>
                <p>Find upcoming Global sport Events </p>
            </div>
        </div>
        <div id="banner2" class="banner">
            <img src="./public/images/landing/banner2.jpeg" alt="banner image 2">
            <div class="text-box text-box2">
                <h1>Users events</h1>
                <span></span>
                <p>Join events of SportsUp community</p>
            </div>
        </div>
        <div id="banner3" class="banner">
            <img src="./public//images/landing/banner3.jpg" alt="banner image 3">
            <div id="text-box3" class="text-box text-box3">
                <h1>Join our community!</h1>
                <span></span>
                <p>Meet and make new friends with simmilar interests</p>
            </div>
        </div>
        <div id="banner4" class="banner">
            <img src="./public//images/landing/banner4.jpg" alt="banner image 4">
            <div class="text-box text-box4">
                <h1>Shop</h1>
                <span></span>
                <p>Buy, sell or exchange sport inventory with other SportsUp members!</p>
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
                Lorem ipsum dolor sit amet consectetur adipisicing elit.
                Sint ab quae sit enim! Error, expedita?
                Doloribus ipsum cum ab sunt culpa nemo voluptate exercitationem.
                Esse excepturi cum deleniti ea laudantium?
            </p>
            <div class="boxContainer">
                <div class="box1">
                    <a href="index.php?action=signUp" class="btn btn-white btn-animation-1">Join Us</a> 
                </div>
            </div>
        </div>
        
    </div>  
    <div id="thirdSection">
        
    </div>     
</div>


<?php
    $content = ob_get_clean();
    require("template.php");
?>
