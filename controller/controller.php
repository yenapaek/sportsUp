 <?php
   require_once("userManager.php");
   require_once("kakaoAPIManager.php");

   function landing(){
   }

   function login(){
      require("./view/login.php");
   }

   function profile(){
      require("./view/login.php");
   }

   function createprofile(){
   }

   function addKakaoUserController($kakaoUserData){
      $status = addKakaoUser($kakaoUserData);
      if(!$status){
         throw new Exception("Error. Unable to add new Kakao user.");
     }else {
         // header("Location: index.php?action=");    

     }
   }
