<?php

    include 'extension/encryption_handler.php';
    include 'extension/database_handler.php';

    class userLoginHandler extends encryptionHandler
    {

        public function checkUser($username, $password)
        {
            $token = ["token" => "token verified"];
            $database = new databaseHandler();
            $encryptedPassword = $this->encryptData($password);
            $sql = "SELECT Password FROM `users` 
                WHERE Username = \"" . $username . "\"";
            $databasePass = $database->query($sql);
            $databasePass = $database->fetch_assoc($databasePass)["Password"];
            $getUserID = "SELECT ID FROM `users` 
                WHERE Username = \"" . $username . "\"";
            $ID = $database->fetch_assoc($database->query($getUserID))["ID"];
            $token["username"] = $username;
            $token["user_id"] = $ID;
            $token = json_encode($token);
            if($this->compareValues($databasePass, $password))
                return $token;
            return false;
        }

    }

?>