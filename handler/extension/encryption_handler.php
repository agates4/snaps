<?php

    class encryptionHandler
    {
        private $encryptedData;
        private $iv = "FnoULezGM7!4nL9f";
        private $key = 'M0CY7U6cc*Z!3nC*';
        private $method = 'aes-128-cbc';

        function __construct($data = NULL) 
        {
            if($data != NULL)
            {
                $encrypted = openssl_encrypt($data, $this->method, $this->key, true, $this->iv);
                $this->encryptedData = base64_encode($encrypted);
            }
        }
        function encryptData($data)
        {
            $encrypted = openssl_encrypt($data, $this->method, $this->key, true, $this->iv);
            $this->encryptedData = base64_encode($encrypted);
            return $this->encryptedData;
        }
        function decryptData($data)
        {
            $basedDecode = base64_decode($this->encryptedData);
            return openssl_decrypt($basedDecode, $this->method, $this->key, true, $this->iv);
        }
        function returnEncryption()
        {
            return $this->encryptedData;
        }
        function compareValues($encrypted, $unencrypted) // compares unencrypted against encrypted
        {
            $secondEncrypt = openssl_encrypt($unencrypted, $this->method, $this->key, true, $this->iv);
            $secondEncrypt = base64_encode($secondEncrypt);
            if($secondEncrypt == $encrypted)
                return true;
            return false;
        }

    }

?>