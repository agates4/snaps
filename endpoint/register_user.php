<?php

    include '../handler/user_register_handler.php';

    $post = json_decode(file_get_contents('php://input'), true);
    $userRegister = new userRegisterHandler();
    if(isset($post['Username']) && isset($post['Email']) && isset($post['Password']) && isset($post['Insurance']))
        echo $userRegister->registerUser($post['Username'], $post['Email'], $post['Password'], $post['Insurance']);

?>