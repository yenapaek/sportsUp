 <?php

    require_once("./model/profileManager.php");

    function landing()
    {
        require("./view/landing.php");
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

        require("./view/profile.php");
    }
