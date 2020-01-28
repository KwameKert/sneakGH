<?php

require_once('mysql.class.php');


class Transaction extends MySQL
{
    public function __construct()
    {

        parent::__construct();
        @session_start();
    }


    public function depositMoney($amount,$invoice_id,$product_id){

        $values = [];

        $values['amount'] = MySQL::SQLValue($amount);
        $values['invoice_id'] = MySQL::SQLValue($invoice_id);
        $values['product_id'] = MySQL::SQLValue($product_id);
        $values['status'] = MySQL::SQLValue("1");
        $values['created_by'] = MySQL::SQLValue($_SESSION['app_user']['id']);
        $values['created_at'] = "now()";

        $sql = MySQL::BuildSQLInsert("transactions", $values);

        return $this->Query($sql) ? 1: 0;
    }

 public function generateInvoiceId() {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(25/strlen($x)) )),1,25);
    }



    public function myTransactions(){
        $id = $_SESSION['app_user']['id'];
       $sql = "SELECT
            transactions.invoice_id,
            transactions.id as tran_id,
            transactions.created_at,
            transactions.amount,
            transactions.`status`,
            products.`name`
            FROM
            products
            INNER JOIN transactions ON products.id = transactions.product_id
            WHERE created_by =$id ORDER BY transactions.id DESC";
        $this->Query($sql);
        $output = "";
        $i = 1;
        while(!$this->EndOfSeek()){

            $row = $this->Row();
            $status_btn = '';
            if($row->status == -1 ){
            $status_btn =  'disabled';
                
            }
             if($row->status == 1){
                $status = 'Successful';
                $status_label = 'success';
            }else{
                $status = 'Retracted';
                $status_label = 'danger';
            }
             $output .= "
            <tr>
            <td align='center'>$i</td>
            <td align='center'>$row->name</td>
            <td align='center'>$row->invoice_id</td>
            <td align='center'>$row->amount</td>
            <td align='center'><span class='label label-".$status_label."'>$status</span></td>
            <td align='center'>".date('M d Y',strtotime($row->created_at))."</td>
            
            <td align='center'><button class='btn btn-sm btn-primary sa-warning' $status_btn  data-id='".$row->tran_id."'>Retract</button></td>
           
        </tr>
            ";
            $i++;
        }


        return $output;
    }


    public function reverseTransaction($post){
           
        $id = filter_input(0,"id",257);
        $sql = "UPDATE transactions SET status=-1 where id=$id";
        return $this->Query($sql)? 1:0;
    }


    public function listAllDeposits(){
           $id = $_SESSION['app_user']['id'];
            $sql = "SELECT
            products.`name`,
            transactions.amount,
            transactions.invoice_id,
            transactions.created_at,
            transactions.`status`,
            users.first_name,
            users.last_name
            FROM
            users
            INNER JOIN transactions ON users.id = transactions.created_by
            INNER JOIN products ON transactions.product_id = products.id
   ORDER BY transactions.id DESC";
        $this->Query($sql);

  $output = "";
        $i = 1;
        while(!$this->EndOfSeek()){

            $row = $this->Row();
            $status_btn = '';
            if($row->status == 1 || $row->status == 2){
            $status_btn =  'disabled';
                
            }
             if($row->status == 1){
                $status = 'Successful';
                $status_label = 'success';
            }else{
                $status = 'Retracted';
                $status_label = 'danger';
            }
             $output .= "
            <tr>
            <td align='center'>$i</td>
            <td align='center'>$row->first_name $row->last_name</td>
            <td align='center'>$row->name</td>
            <td align='center'>$row->invoice_id</td>
            <td align='center'>$row->amount</td>
            <td align='center'><span class='label label-".$status_label."'>$status</span></td>
            <td align='center'>".date('M d Y',strtotime($row->created_at))."</td>
            
        </tr>
            ";
            $i++;
        }


        return $output;

    }



public function refundTransaction($post){
    $id = filter_input(0,"id",257);
    $sql = "UPDATE transactions SET status=-1 WHERE id=$id";
    return $this->Query($sql) ? 1: 0;
}


public function approveTransaction($post){
    $id = filter_input(0,"id",257);
    $sql = "UPDATE transactions SET status=2 WHERE id=$id";
    return $this->Query($sql) ? 1: 0;
}



public function transactionDetails(){

    $user_cat = $_SESSION['app_user']['user_cat'];

    if($user_cat == 1){
        $id = 1;
    }else{
        $id = $_SESSION['app_user']['id'];
    }
    $transactions = [
            'completed' => $this->completedTransactions($id),
            'total' => $this->countTransactions($id),
            'retracted' => $this->retractedTransactions($id),
            'percentage' =>$this->successPercentage($id)
        ];

        return $transactions;
    

}
public function completedTransactions($id){
    if($id == 1){
         $this->Query("SELECT SUM(amount) AS amount FROM transactions where status=1 ORDER BY id DESC");
     }else{
         $this->Query("SELECT SUM(amount) AS amount FROM transactions where created_by=$id and status=1");
     }
   
   
    if($row = $this->Row()){
        return $row->amount;
    } else{
        return 0;
    }
}


public function pendingTransactions($id){
    if($id == 1){
         $this->Query("SELECT SUM(amount) AS amount FROM transactions where status=1");
     }else{
         $this->Query("SELECT SUM(amount) AS amount FROM transactions where created_by=$id and status=1");
     }
   
   
    if($row = $this->Row()){
        return $row->amount;
    } else{
        return 0;
    }
}



public function retractedTransactions($id){
    if($id == 1){
         $this->Query("SELECT SUM(amount) AS amount FROM transactions where status=-1");
     }else{
         $this->Query("SELECT SUM(amount) AS amount FROM transactions where created_by=$id and status=-1");
     }
   
    
    if($row = $this->Row()){

        return $row->amount;
    } else{
        return 0;
    }
}



public function countTransactions($id){
    if($id == 1){
         $this->Query("SELECT id FROM transactions ");
     }else{
         $this->Query("SELECT id   FROM transactions where created_by=$id ");
     }
   
    $row = $this->RowCount();
    return $row;
}


public function successPercentage($id){
    if($id == 1){
         $this->Query("SELECT SUM(amount) AS amount FROM transactions  ");
     }else{
         $this->Query("SELECT SUM(amount) AS amount FROM transactions where created_by=$id ");
     }

     if($row = $this->Row()){

        $total =  $row->amount;
         $success_amount = $this->completedTransactions($id);
        return round(($success_amount/$total)*100);
    } else{
        return 0;
    }
   
}

}



