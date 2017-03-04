<?php

    include 'extension/encryption_handler.php';
    include 'extension/database_handler.php';

    class userLoginHandler extends encryptionHandler
    {

        public function checkUser($initUserEmail, $password)
        {
            $user;
            if (strpos($initUserEmail, '@') == false)
                $user = true;
            else
                $user = false;
            $user ? $user = "Username" : $user = "Email";
            $token = ["token" => "token verified"];
            $database = new databaseHandler();
            $encryptedPassword = $this->encryptData($password);
            $sql = "SELECT Password FROM `users` 
                WHERE " . $user . "  = \"" . $initUserEmail . "\"";
            $databasePass = $database->query($sql);
            $databasePass = $database->fetch_assoc($databasePass)["Password"];
            $getUserID = "SELECT ID FROM `users` 
                WHERE " . $user . "  = \"" . $initUserEmail . "\"";
            $ID = $database->fetch_assoc($database->query($getUserID))["ID"];
            $token["user_id"] = $ID;
            $token = json_encode($token);
            if($this->compareValues($databasePass, $password))
                return $token;
            return false;
        }

    }

?>