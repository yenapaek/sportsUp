<?php 
$title = "Sport Events";
$style = "./public/css/landing.css";

ob_start();
?>

<div id="mainContent">
    <div class = "firstSection">
        <div class="banner1">
            <img src="./public/images/landing/banner1.jpeg" alt="banner image 1">
            <div class="text-box text-box1">
                <h1>Big events</h1>
                <span></span>
                <p>Find upcoming Global sport Events </p>
            </div>
        </div>
        <div class="banner2">
            <img src="./public/images/landing/banner2.jpeg" alt="banner image 2">
            <div class="text-box text-box2">
                <h1>Users events</h1>
                <span></span>
                <p>Join events of SportsUp community</p>
            </div>
        </div>
        <div class="banner3">
            <img src="./public//images/landing/banner3.jpeg" alt="banner image 3">
            <div class="text-box text-box3">
                <h1>Join our community!</h1>
                <span></span>
                <p>Meet and make new friends with simmilar interests</p>
            </div>
        </div>
        <div class="banner4">
            <img src="./public//images/landing/banner4-1.jpg" alt="banner image 4">
            <div class="text-box text-box4">
                <h1>Shop</h1>
                <span></span>
                <p>Buy, sell or exchange sport inventory with other SportsUp members!</p>
            </div>
        </div>
        <!-- BUTTON -->
        <div class="box">
            <a href="#" class="btn btn-white btn-animation-1">Sign Up</a> 
        </div>

    </div>
    <div id="secondSection">
        <div class="cards">
            <div class="card">
                <div class="imgBx">
                    <img src="./public/images/landing/card1.jpg" alt="card picture">
                    <a href="#"><h2>Global Events</h2></a>
                </div>
                <div class="cardText">
                    
                    <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas possimus, 
                    asperiores perspiciatis vero atque ratione distinctio soluta maiores facilis quis 
                    consequatur itaque iure cumque repudiandae sapiente saepe ex pariatur consectetur!</p>
                </div>
            </div>  
            <div class="card">
                <div class="imgBx">
                    <img src="./public/images/landing/card2.png" alt="card picture">
                    <a href="#"><h2>Private Events</h2></a>
                </div>
                <div class="cardText">
                    
                    <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas possimus, 
                    asperiores perspiciatis vero atque ratione distinctio soluta maiores facilis quis 
                    consequatur itaque iure cumque repudiandae sapiente saepe ex pariatur consectetur!</p>
                </div>
            </div>  
            <div class="card">
                <div class="imgBx">
                    <img src="./public/images/landing/card3.png" alt="card picture">
                    <a href="#"><h2>Shop</h2></a>
                </div>
                <div class="cardText">
                    
                    <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas possimus, 
                    asperiores perspiciatis vero atque ratione distinctio soluta maiores facilis quis 
                    consequatur itaque iure cumque repudiandae sapiente saepe ex pariatur consectetur!</p>
                </div>
            </div>               
        </div>
        <div>

        </div>
    </div>
    <div id="thirdSection">
        
        <div class="photo">
            <img src="./public/images/landing/photo1.jpg" alt="">
        </div>
        
        <div class="box1">
            <a href="#" class="btn btn-white btn-animation-1">Sign Up</a> 
        </div>
    </div>       
</div>


<?php
    $content = ob_get_clean();
    require("template.php");
?>