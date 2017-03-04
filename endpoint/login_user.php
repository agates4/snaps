<?php

    include '../handler/user_login_handler.php';

    $post = json_decode(file_get_contents('php://input'), true);
    $userLogin = new userLoginHandler();
    if(isset($post['Username']) && isset($post['Password']))
        echo $userLogin->checkUser($post['Username'], $post['Password']);

?>