<?php
@session_start();
$page = 'transactions';
require_once('../inc/client_header.php');
require_once('../classes/transaction.class.php');
$transaction =  new Transaction();

$transactionDetails = $transaction->transactionDetails();

$userDetails = [
    'full_name' => $_SESSION['app_user']['first_name']." ".$_SESSION['app_user']['first_name'],
    'email' => $_SESSION['app_user']['email'],
    'location' => $_SESSION['app_user']['location'],
    'country' => 'Ghana',
    'phone' => $_SESSION['app_user']['phone']
];

$curpage = '';
if(isset($_GET['curpage'])){
  $curpage = $_GET['curpage'];  
}


if($curpage){

    switch($curpage) {

        case 'make_deposit':
        require('files/makeDeposit.php');
        break;

        case 'my_transactions':
            require('files/myTransactions.php');
            break;


        case 'list_all_deposits':
            require('files/listAllDeposits.php');
            break;

        default:
            require('files/dashboard.php');
            break;




    }
}


require_once('../inc/client_footer.php');


