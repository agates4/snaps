<?php

    include 'extension/encryption_handler.php';
    include 'extension/database_handler.php';

    class userRegisterHandler extends encryptionHandler
    {

        public function registerUser($first, $last, $univ, $birth, $username, $password, $email)
        {

            $birth = strtotime($birth);
            $birth = date('Y/m/d', $birth);
            $token = ["token" => "token verified"];
            $database = new databaseHandler();
            $findUser = "SELECT * FROM `users` 
                WHERE Username = \"" . $username . "\"";
            $foundUser = $database->query($findUser);
            if(!$database->isEmpty($foundUser))
                return false;
            $findEmail = "SELECT * FROM `users` 
                WHERE Email = \"" . $email . "\"";
            $foundEmail = $database->query($findEmail);
            if(!$database->isEmpty($foundEmail))
                return false;
            $encryptedPassword = $this->encryptData($password);
            $sql = "INSERT INTO `users` (First, Last, University, Birthdate, Username, Password, Email, Date)
                VALUES('" . $first . "', '" . $last . "', '" . $univ . "', '" . $birth . "', '" . $username . "', '" . $encryptedPassword . "', '" . $email . "', '" . date("Y/m/d") . "');";
            $result = $database->multi_query($sql);
            $token["user_id"] = $database->insert_id();
            $token = json_encode($token);
            if($result === false)
                return false;
            return $token;
        }

    }

?>