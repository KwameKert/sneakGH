<?php
session_start();

if(!$_SESSION['app_user']->id){
    header('Location: auth/login.php');
}

    require_once('inc/header.php');    


    $url = $_GET['curpage'];
    switch($url){


        default:
            include_once('inc/dashboard.php');
    }





require_once('inc/footer.php');
