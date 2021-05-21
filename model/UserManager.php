<?php
require_once('./model/Manager.php');
class UserManager extends Manager {


    /**
     * newUserModel allow you to create a new user manually.
     *
     * @param  mixed $user
     * @param  mixed $email
     * @param  mixed $pass
     * @param  mixed $conf
     * @return Boolean according if it success to insert or not
     */
    function newUserModel($user, $email, $pass, $conf)
    {
        $submittable = true;

        $user = addslashes(htmlspecialchars(htmlentities(trim($user))));
        $email = addslashes(htmlspecialchars(htmlentities(trim($email))));

        if (strlen($user) < 6) {
            $submittable = false;
        }
        if (!preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $email)) {
            $submittable = false;
        }
        if ($pass !== $conf) {
            $submittable = false;
        }

        $db = $this->dbConnect();

        $req = $db->prepare("SELECT * FROM users WHERE userName=? OR email=?");
        $req->bindParam(1, $user, PDO::PARAM_STR);
        $req->bindParam(2, $email, PDO::PARAM_STR);
        $req->execute();
        $userExist = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        if (!$userExist and $submittable) {

            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $req = $db->prepare("INSERT INTO  users (userName,email,password, dateSignUp) VALUES(:userName, :email, :hash, NOW())");
            $req->bindParam(":userName", $user, \PDO::PARAM_STR);
            $req->bindParam(":email", $email, \PDO::PARAM_STR);
            $req->bindParam(":hash", $hash, \PDO::PARAM_STR);
            $status = $req->execute();
            $req->closeCursor();
            return $status;
        } 
    }

    /**
     * manualLoginModel allow you to connect manually with email and password
     *
     * @param  mixed $email
     * @param  mixed $pass
     * @return Boolean if u successfully login or not
     */
    function manualLoginModel($email, $pass)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT * FROM users WHERE email=?");
        $req->bindParam(1, $email, PDO::PARAM_STR);
        $req->execute();
        $userInfo = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        if ($userInfo) {
            if (password_verify($pass, $userInfo['password'])) {
                return $userInfo;
            }
        }
        return false;
    }
    
    /**
     * kakaoAPICallModel allows user to login and sign-up using Kakao
     *
     * @param  mixed $authCode
     * @return Integer user Id
     */
    function kakaoAPICallModel($authCode)
    {
        $tokens = $this->getTokens($authCode);
        $_SESSION["access_token"] = $tokens['access_token'];
        $kakaoUserObj = $this->requestKakaoAPIUserData($tokens['access_token']);
        $kakaoId = $kakaoUserObj['kakaoId'];

        if (!$this->kakaoUserExists($kakaoId)) {
            $this->addNewKakaoUser($kakaoUserObj);
        }
        $kakaoUserInfo = $this->getKakaoUser($kakaoId);
        $kakaoUserId = $kakaoUserInfo->id;
        return $kakaoUserId;
    }
    
    /**
     * getTokens
     *
     * @param String $authCode
     * @return Array $tokens stores 'access_token' and 'refresh_token'
     */
    private function getTokens($authCode)
    {
        $url = 'https://kauth.kakao.com/oauth/token';
        $param = 'grant_type=authorization_code&client_id=37fea6edf3b24bab4469275577842ba5&redirect_uri=http://127.0.0.1/sportsEvent/index.php?action=oauth&code=' . $authCode;

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type: application/x-www-form-urlencoded']);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $param);

        $output = curl_exec($curl);
        $outputJSON = json_decode($output);

        $tokens['access_token'] = $outputJSON->access_token;
        $tokens['refresh_token'] = $outputJSON->refresh_token;

        curl_close($curl);
        return $tokens;
    }
    
    /**
     * requestKakaoAPIUserData uses access token to request user info to create user
     *
     * @param String $accessToken
     * @return Object $kakaoUserObj  - 
     */
    private function requestKakaoAPIUserData($accessToken)
    {
        $url = 'https://kapi.kakao.com/v2/user/me';

        $headers = array(
            'Authorization: Bearer ' . $accessToken,
            'Content-Type: application/x-www-form-urlencoded',
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        $output = curl_exec($curl);
        $apiUserObj = json_decode($output);

        curl_close($curl);

        $kakaoUserObj = $this->createKakaoUserObj($apiUserObj);

        return $kakaoUserObj;
    }

    private function createKakaoUserObj($apiUserObj)
    {
        $kakaoUserObj['kakaoId'] = $apiUserObj->id;
        $kakaoUserObj['dateConnected'] = $apiUserObj->connected_at;
        $kakaoUserObj['userName'] = ($apiUserObj->properties)->nickname;
        $kakaoUserObj['avatar'] = ($apiUserObj->properties)->thumbnail_image;
        $kakaoUserObj['email'] = ($apiUserObj->kakao_account)->email;
        return $kakaoUserObj;
    }

    private function getKakaoUser($kakaoId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT * FROM users WHERE kakaoId = :kakaoId");
        $req->bindParam(":kakaoId", $kakaoId, PDO::PARAM_STR);
        $req->execute();
        $kakaoUserData = $req->fetch(PDO::FETCH_OBJ);
        $req->closeCursor();
        return $kakaoUserData;
    }

    private function kakaoUserExists($kakaoId)
    {
        return $this->getKakaoUser($kakaoId) ? true : false;
    }

    private function addNewKakaoUser($kakaoUserObj)
    {
        $db = $this->dbConnect();
        $kakaoId = $kakaoUserObj['kakaoId'];
        $req = $db->prepare("INSERT INTO users(id, userName, firstName, lastName, email, avatar, password, dateSignUp, birthDate, nationality, city, kakaoId, eventAttended)
                            VALUES(null, :userName, null, null, :email, :avatar, null, NOW(), null, null, null, :kakaoId, null)");
        $req->bindParam("userName", $kakaoUserObj['userName'], PDO::PARAM_STR);
        $req->bindParam("email", $kakaoUserObj['email'], PDO::PARAM_STR);
        $req->bindParam("avatar", $kakaoUserObj['avatar'], PDO::PARAM_STR);
        $req->bindParam("kakaoId", $kakaoId, PDO::PARAM_STR);

        $req->execute();
        $req->closeCursor();
    }

    private function kakaoUnLink()
    {
        $token = $_SESSION["access_token"];
        $url = 'https://kapi.kakao.com/v1/user/unlink';

        $headers = array(
            'Authorization: Bearer ' . $token,
        );

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        curl_exec($curl);
        curl_close($curl);
    }

    function kakaoLogout()
    {
        $this->kakaoUnLink();
        $url = 'https://kapi.kakao.com/oauth/logout?client_id=37fea6edf3b24bab4469275577842ba5 HTTP/1.1';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_exec($curl);
        curl_close($curl);
    }
    /**
     * myProfileModel
     *
     * @param  mixed $userId
     * @return array all the informations of the user's profile.
     */
    function myProfileModel($userId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT * FROM users WHERE id=?");
        $req->bindParam(1, $userId, PDO::PARAM_STR);
        $req->execute();
        $infoProfile = $req->fetch(PDO::FETCH_ASSOC);
        $req->closeCursor();

        return $infoProfile;
    }
    /**
     * mySportsModel
     *
     * @param  mixed $userId 
     * @return array all the sports the user is interested in.
     */
    function mySportsModel($userId)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("SELECT c.name AS category_name
        FROM categories c
        JOIN mysports mS 
        ON c.id = mS.categoryId
        WHERE userId=?");

        $req->bindParam(1, $userId, PDO::PARAM_STR);
        $req->execute();
        $mySports = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $mySports;
    }

    /**
     * addMySports
     *
     * @param mixed $userId
     * @return void
     */
    function addMySportModel($userId, $categoryId)
    {
        $db = $this->dbConnect();
        $req = $db->prepare("SELECT COUNT(*) FROM mysports WHERE userId = ? AND categoryId = ?");
        $req->bindParam(1, $userId, PDO::PARAM_INT);
        $req->bindParam(2, $categoryId, PDO::PARAM_INT);
        $req->execute();
        $mySportsCount = $req->fetchColumn();
        $req->closeCursor();

        if ($mySportsCount == 0) {
            $req = $db->prepare("INSERT INTO mysports(userId, categoryId) VALUES(?, ?)");
            $req->bindParam(1, $userId, PDO::PARAM_INT);
            $req->bindParam(2, $categoryId, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        }
    }

    /**
     * addAttendingEvent
     * checks if user is already attending an event before inserting
     *
     * @param  mixed $userId
     * @return void
     */
    function addAttendingEvent($eventId)
    {
        $db = $this->dbConnect();
        $userId = $_SESSION['userId'];
        $req = $db->prepare("SELECT COUNT(*) FROM attendingevents WHERE userId = ? AND eventId = ?");
        $req->bindParam(1, $userId, PDO::PARAM_INT);
        $req->bindParam(2, $eventId, PDO::PARAM_INT);
        $req->execute();
        $attendingEventsCount = $req->fetchColumn();
        $req->closeCursor();

        if ($attendingEventsCount == 0){
            $req = $db->prepare("INSERT INTO attendingevents(id, userId, eventId) VALUES (null, ?, ?)");
            $req->bindParam(1, $userId, PDO::PARAM_INT);
            $req->bindParam(2, $eventId, PDO::PARAM_INT);
            $req->execute();
            $req->closeCursor();
        }
    }

    /**
     * cancelAttendingEvent
     * removes an event from a user's attending event list
     *
     * @param  Integer $eventId
     * @return void
     */
    function removeAttendingEvent($eventId)
    {
        $db = $this->dbConnect();
        $userId = $_SESSION['userId'];
        $req = $db->prepare("DELETE FROM attendingevents WHERE userId = ? AND eventId = ?");
        $req->bindParam(1, $userId, PDO::PARAM_INT);
        $req->bindParam(2, $eventId, PDO::PARAM_INT);
        $req->execute();
        $req->closeCursor();
    }


    /**
     * editUserModel allow you to update the profile information
     *
     * @param  mixed $firstName
     * @param  mixed $lastName
     * @param  mixed $email
     * @param  mixed $date
     * @param  mixed $city
     * @return void
     */
    function editUserModel($firstName, $lastName, $email, $date, $city)
    {
        $db = $this->dbConnect();

        $req = $db->prepare("UPDATE users SET firstName=:firstName, lastName=:lastName,email=:email,birthDate=:birthDate,city=:city WHERE id =:id");
        $req->bindparam('firstName', $firstName, PDO::PARAM_STR);
        $req->bindparam('lastName', $lastName, PDO::PARAM_STR);
        $req->bindparam('email', $email, PDO::PARAM_STR);
        $req->bindparam('birthDate', $date, PDO::PARAM_STR);
        $req->bindparam('city', $city, PDO::PARAM_STR);
        $req->bindparam('id', $_SESSION['userId'], PDO::PARAM_STR);
        $req->execute();
        $req->closeCursor();
    }

    /**
     * editUserAvatarModel allow you to update the avatar of the user
     *
     * @param  mixed $avatar
     * @return void
     */
    function editUserAvatarModel($avatar)
    {
        $db = $this->dbConnect();

        if ($_FILES['file']['error'] > 0)  $error = 'Error during the upload';
        if ($_FILES['file']['size'] > 2000)  $error = 'Size of your file is too big';

        $validation_extensions = array('jpg', 'jpeg', 'png');
        $upload_extension = strtolower(substr(strrchr($_FILES['file']['name'], '.'), 1));

        $path = './public/images/profile/allUsersProfilePics/file/';
        mkdir($path . "/{$_SESSION['userId']}/", 0777, true);
        $path = "$path/{$_SESSION['userId']}/";
        $name = "{$_SESSION['userId']}.{$upload_extension}";

        $result = move_uploaded_file($_FILES['file']['tmp_name'], "$path/$name");
        $req = $db->prepare("UPDATE users SET avatar=:avatar WHERE id =:id");
        $req->bindparam('avatar', $name, PDO::PARAM_STR);
        $req->bindparam('id', $_SESSION['userId'], PDO::PARAM_STR);
        $req->execute();
        $req->closeCursor();
    }


    // Getting the last 7 days items from the events list - WHERE eventDate BETWEEN curdate() - INTERVAL DAYOFWEEK(curdate())+7 DAY AND curdate()

    function favoriteAdd($userId, $eventId) {
        $dataBase = $this->dbConnect();
        $rawRequest = $dataBase->prepare(
            "INSERT INTO wishlist(userId, eventId, heart) VALUES(:userID, :eventID, true)"
        );
        $rawRequest->execute(array(
            'userID' => $userId,
            'eventID' => $eventId
        ));
        $rawRequest->closeCursor();
    }

    function favoriteElimination($userId, $eventId) {
        $dataBase = $this->dbConnect();
        $rawRequest = $dataBase->query(
            "DELETE FROM wishlist WHERE userId = $userId AND eventId = $eventId"
        );
        // $rawRequest->execute(array(
        //     'userID' => $userId,
        //     'eventID' => $eventId
        // ));
        $rawRequest->closeCursor();
    }

}