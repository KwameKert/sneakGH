<?php
require_once("../classes/mysql.class.php");

if(isset($_POST['type']) && isset($_POST['id']) && $_POST['id'] !=""){

    $id=MYSQL::SQLValue(base64_decode(filter_input(0, 'id',513)),"int");
    $table="";
    $query="";
    switch($_POST['type']){


        case 'user':
            $table = "users";
            $query = MySQL::BuildSQLUpdate($table,array("status"=>"'INACTIVE'"),array("id"=>$id));
            break;


        case 'drug':
            $table = "drugs";
            $query = MySQL::BuildSQLUpdate($table,array("status"=>"'INACTIVE'"),array("id"=>$id));
            break;


        case 'stock':
            $table = "stockings";
            $query = MySQL::BuildSQLUpdate($table,array("status"=>"'INACTIVE'"),array("id"=>$id));
            break;


        case 'category':
            $table = "user_cat";
            $query = MySQL::BuildSQLUpdate($table,array("status"=>"'INACTIVE'"),array("cat_id"=>$id));
            break;
    }


    $sql=new MySQL();
    $rs=$sql->Query($query);
    echo $sql->Error();
    echo $query;
    if($rs){
        echo 1;
    }else{
        echo 0;
    }
}
?>