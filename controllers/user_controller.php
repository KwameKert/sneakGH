<?php

require_once("../classes/user.class.php");

$user = new User();
$c_id = filter_input(0,"category_id",257);

$action = filter_input(0,"action",513);
switch($action){

    case 'addUser':
        //var_dump($_POST);
        echo $user->addUser($_POST);
        break;

    case 'editUser':
        echo $user->editUser($_POST);
        break;

    case 'listUsers':
        echo $user->listUsers();
        break;

    case 'fetchLinks':
        echo $user->fetchCatPrivs($c_id);
        break;

    case 'saveLinks':
        echo $user->saveAssignedLinks($_POST);
        break;

    case 'addCat':
        echo $user->addCategory($_POST);
        break;

    case 'editCat':
        echo $user->editCategory($_POST);
        break;

    case 'listCategories':
        echo $user->listCategories();
        break;

}