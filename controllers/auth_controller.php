<?php
require_once('../classes/user.class.php');
$user = new User();
$action = filter_input(0,"action",513);
@session_start();


switch($action){
    case 'loginUser':
       // $_SESSION['app_user'] = $user->login($_POST);

        $val = 0;
        $val = $user->login($_POST);
        echo $val;
        break;


    case 'register':
        echo $user->addUser($_POST);
        break;
}