 <?php

  require_once("./model/profileManager.php");
  #ToDo move line 3 to a different controller and profile function. 

  function landing()
  {
    require("./view/landing.php");
  }
  function aboutUs()
  {
    require("./view/aboutUs.php");
  }

  /**
   * profile
   *
   * @param  mixed $userId
   * @return array all the informations of the user's profil.
   * @return array $mySports all the sports the user is interested in.
   */
  function profile($userId)
  {
    $infoProfil = myProfilModel($userId);
    $mySports = mySportsModel($userId);
    $myEvents = myEventsModel($userId);
    $attendingEvents = '';
    $suggestionEvents = '';
    $articles = myArticlesModel($userId);
    $suggestionArticles = '';

    require('./view/profile.php');
  }
