<?php

    include '../handler/user_login_handler.php';

    $post = json_decode(file_get_contents('php://input'), true);
    $userLogin = new userLoginHandler();
    $user;
    if(isset($post['Username']))
        $user = true;
    elseif(isset($post['Email']))
        $user = false;
    if((isset($user)) && isset($post['Password']))
        echo $userLogin->checkUser( $user ? $post['Username'] : $post['Email'], $post['Password'] );

?>