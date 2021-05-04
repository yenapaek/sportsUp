<?php 
$title = "About Us";
$style = "./public/css/aboutUs.css";

ob_start();
?>
<section>
    <div class="container">
        <h1 class="heading">Meet the team</h1>
        <div class="card-wrapper">
            <div class="card">
                <img src="./public/images/aboutUs/city.jpg" alt="card background" class="card-img">
                <img src="./public/images/aboutUs/profile1.jpg" alt="profile image" class="profile-img">
                <h1>Alexis</h1>
                <p class="job-title">Job title</p>
                <p class="about">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente quis, 
                    animi possimus adipisci facilis laudantium fugit sed, 
                    deserunt odit inventore ipsam illo doloribus laborum ea, 
                    aliquid labore voluptatibus. Impedit, soluta?
                </p>
                <a href="#" class="btn btn-white btn-animation-1">Contact</a>
                <ul class="social-media">
                    <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                </ul>
            </div>
            <div class="card">
                <img src="./public/images/aboutUs/city.jpg" alt="card background" class="card-img">
                <img src="./public/images/aboutUs/yena.png" alt="profile image" class="profile-img">
                <h1>Yena</h1>
                <p class="job-title">Job title</p>
                <p class="about">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente quis, 
                    animi possimus adipisci facilis laudantium fugit sed, 
                    deserunt odit inventore ipsam illo doloribus laborum ea, 
                    aliquid labore voluptatibus. Impedit, soluta?
                </p>
                <a href="#" class="btn btn-white btn-animation-1">Contact</a>
                <ul class="social-media">
                    <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                </ul>
            </div>
            <div class="card">
                <img src="./public/images/aboutUs/city.jpg" alt="card background" class="card-img">
                <img src="./public/images/aboutUs/Oscar.png" alt="profile image" class="profile-img">
                <h1>Oscar</h1>
                <p class="job-title">Job title</p>
                <p class="about">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente quis, 
                    animi possimus adipisci facilis laudantium fugit sed, 
                    deserunt odit inventore ipsam illo doloribus laborum ea, 
                    aliquid labore voluptatibus. Impedit, soluta?
                </p>
                <a href="#" class="btn btn-white btn-animation-1">Contact</a>
                <ul class="social-media">
                    <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                </ul>
            </div>
            <div class="card">
                <img src="./public/images/aboutUs/city.jpg" alt="card background" class="card-img">
                <img src="./public/images/aboutUs/Ronnie.jpg" alt="profile image" class="profile-img">
                <h1>Ronnie</h1>
                <p class="job-title">Job title</p>
                <p class="about">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente quis, 
                    animi possimus adipisci facilis laudantium fugit sed, 
                    deserunt odit inventore ipsam illo doloribus laborum ea, 
                    aliquid labore voluptatibus. Impedit, soluta?
                </p>
                <a href="#" class="btn btn-white btn-animation-1">Contact</a>
                <ul class="social-media">
                    <li><a href="#"><i class="fab fa-facebook-square"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php
    $content = ob_get_clean();
    require("template.php");
?>