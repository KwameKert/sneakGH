<?php
@session_start();

require_once('../classes/transaction.class.php');

$app = new Transaction();

function json_response($code = 200, $message = null)
{
    // clear the old headers
    header_remove();
    // set the actual code
    http_response_code($code);
    // set the header to make sure cache is forced
    header("Cache-Control: no-transform,public,max-age=300,s-maxage=900");
    // treat this as json
    header('Content-Type: application/json');
    $status = array(
        200 => '200 OK',
        401 => '401 Unauthorized Access',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
        );
    // ok, validation error, or failure
    header('Status: '.$status[$code]);
    // return the encoded json
    return json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message
        ));
}


if($_SESSION['app_user']){
	$amount = filter_input(0,"amount",513);
	$product_id = filter_input(0,"product_id",257);
$invoice_id =$app->generateInvoiceId();
if($app->depositMoney($amount,$invoice_id,$product_id) ==1 ){
	echo json_response(200,"Transaction successfull");
}else{
	echo json_response(500,"Opps an error occured");
}
}else{
	echo json_reponse(401,"Unauthorized User");
}


