<?php

require_once('mysql.class.php');


class Product extends MySQL
{
    public function __construct()
    {

        parent::__construct();
        @session_start();
    }


public function listProducts(){
	$sql = "SELECT * FROM products";
	$this->Query($sql);

	$output = "";

	while(!$this->EndOfSeek()){
		$row = $this->Row();
		$output .= " <div class='col-sm-6 col-lg-3 col-md-4 other'>
                        <div class='product-list-box thumb'>
                            <a href='javascript:void(0)' class='image-popup '  title='Screenshot-1'>
                                <img src='../$row->image'   data-product_id='$row->id'  data-amount='$row->amount'   class='thumb-img buy' alt='work-thumbnail'>
                            </a>
                            <div class='price-tag'>
                              $ $row->amount
                            </div>
                            <div class='detail'>
                                <h4 class='m-t-0 font-18'><a href='#'' class='text-dark'>$row->name </a> </h4>
                                <div class='rating'>
                                    <ul class='list-inline'>
                                        <li class='list-inline-item'><a class='fa fa-star' href='#'></a></li>
                                        <li class='list-inline-item'><a class='fa fa-star' href='#'></a></li>
                                        <li class='list-inline-item'><a class='fa fa-star' href='#'></a></li>
                                        <li class='list-inline-item'><a class='fa fa-star' href='#'></a></li>
                                        <li class='list-inline-item'><a class='fa fa-star-o' href='#'></a></li>
                                    </ul>
                                </div>
                                <h5 class='m-0'> <span class='text-muted'> Stock : 98pcs.</span></h5>
                            </div>
                        </div>
                    </div>";

	}

	return $output;
}



}