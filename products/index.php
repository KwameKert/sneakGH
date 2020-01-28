<?php
@session_start();
$page = 'products';
require_once('../inc/client_header.php');
require_once('../classes/product.class.php');
$product =  new Product();


$curpage = '';
if(isset($_GET['curpage'])){
  $curpage = $_GET['curpage'];  
}


if($curpage){

    switch($curpage) {

        case 'list_products':
        require('files/listProducts.php');
        break;

       
        default:
        	require('files/listProducts.php');
        	break;


    }
}


require_once('../inc/client_footer.php');


