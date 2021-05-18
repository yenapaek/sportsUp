<?php
class Manager {
    protected function dbConnect()
    {
        $host = '127.0.0.1';
        $dbName = 'sportsevent';
        $login = 'root';
        $pwd = ''; // MAC USER SHOULD PUT A PWD PROBABLY 'root'

        return new PDO("mysql:host=" . $host . ";dbname=" . $dbName . ";charset=utf8", $login, $pwd);
    }

    /**Categories */
    /**
     * categoriesInfoModel
     *
     * @param Boolean $fromUser loading the categories without the ones of the user; related to profile
     * 
     * @return array all sports categories
     */  
    function categoriesInfoModel($fromUser)
    {
        $dataBase = $this->dbConnect();
        $query = "SELECT * FROM categories c ";
        if($fromUser) {
            $userId = $_SESSION['userId'];
            $query .= " WHERE c.id NOT IN (SELECT c.id FROM categories c JOIN mysports mS ON c.id = mS.categoryId WHERE mS.userId = ?)";
        }
        $query.= " order by name";
        $rawResponse = $dataBase->prepare($query);
        if($fromUser) {
            $rawResponse->bindParam(1, $userId, PDO::PARAM_INT);
        }
        $rawResponse->execute();
        $infoArray = $rawResponse->fetchAll(PDO::FETCH_ASSOC);
        $rawResponse->closeCursor();
        return $infoArray;
    }
}