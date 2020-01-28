<?php

$action = filter_input(0,"action",513);
require_once('../classes/transaction.class.php');
$transaction  = new Transaction();

switch($action){

	case 'deposit_money':
		echo $transaction->depositMoney($_POST);
		break;


	case 'reverse_transaction':
		echo  $transaction->reverseTransaction($_POST);
		break;

case 'refund_transaction':
		echo  $transaction->refundTransaction($_POST);
		break;


case 'approve_transaction':
		echo  $transaction->approveTransaction($_POST);
		break;


		
}
