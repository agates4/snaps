<?php

    include 'extension/encryption_handler.php';
    include 'extension/database_handler.php';

    class userRegisterHandler extends encryptionHandler
    {

        public function registerUser($username, $email, $password, $insurance)
        {
            $token = ["token" => "token verified"];
            $database = new databaseHandler();
            $findUser = "SELECT * FROM `users` 
                WHERE Username = \"" . $username . "\"";
            $foundUser = $database->query($findUser);
            if(!$database->isEmpty($foundUser))
                return false;
            $encryptedPassword = $this->encryptData($password);
            $sql = "INSERT INTO `users` (Username, Email, Password, Insurance)
                VALUES('" . $username . "', '" . $email . "', '" . $encryptedPassword . "', '" . $insurance . "');";
            $result = $database->multi_query($sql);
            $token["username"] = $username;
            $token["user_id"] = $database->insert_id();
            $token = json_encode($token);
            if($result === false)
                return false;
            return $token;
        }

    }

?>