<?php

require_once('../classes/application.class.php');

$application = new Application();
$action = filter_input(0,"action",513);


switch($action) {
    case 'addApplication':
        echo $application->addApplication($_POST);
        break;

//    case 'getTransaction':
//        echo $application->insertTransaction();
//        break;

    case 'retractApplication':
        $id = filter_input(0,"id",257);
        //response 1 or 0
        echo $application->reTractApplication($id);
        break;

    case 'refundApplication':
        $id = filter_input(0,"id",257);
        echo $application->refundApplication($id);
        break;


        approve_retraction


}