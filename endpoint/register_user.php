<?php

    include '../handler/user_register_handler.php';

    $post = json_decode(file_get_contents('php://input'), true);
    $userRegister = new userRegisterHandler();
    if(isset($post['First']) && isset($post['Last']) && isset($post['University']) && isset($post['Birthdate']) && isset($post['Username']) && isset($post['Password']) && isset($post['Email']))
        echo $userRegister->registerUser($post['First'], $post['Last'], $post['University'], $post['Birthdate'], $post['Username'], $post['Password'], $post['Email']);

?>