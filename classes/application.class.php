<?php

require_once('mysql.class.php');


class Application extends MySQL
{
    public function __construct()
    {

        parent::__construct();
        @session_start();
    }


    public function addApplication($post){

        $values = Array();

        $values['name'] =  MySQL::SQLValue(filter_input(0,"name",513));
        $values['expiration_date'] =  MySQL::SQLValue(filter_input(0,"exp_date",513));
        $values['description'] =  MySQL::SQLValue(filter_input(0,"description",513));
        $values['status'] =  MySQL::SQLValue(filter_input(0,"status",257));
        $values['type'] =  MySQL::SQLValue(filter_input(0,"type",513));
        $values['created_by'] =  MySQL::SQLValue($_SESSION['app_user']['id']);
        $values['created_at'] =  "now()";

        $sql = MySQL::BuildSQLInsert("applications",$values);

        return $this->Query($sql)?  1: 0;


    }


    public function listApplications(){
        $this->Query("SELECT * FROM applications ");
        $i = 1;
        $output ="";

        while(!$this->EndOfSeek()){
            $row = $this->Row();

            $output .= "
            <tr>
            <td>$i</td>
            <td>$row->name</td>
            <td>$row->expiration_date</td>
            <td>$row->type</td>
            <td>$row->description</td>
            <td>$row->amount</td>
            <td>$row->status</td>
            <td>".date('M d Y',strtotime($row->created_at))."</td>
           
        </tr>
            ";
            $i++;
        }

        return $output;


    }

    public function allApplications(){
        $this->Query("SELECT * FROM applications WHERE status=1");
        $i = 1;
        $output ="";


        while(!$this->EndOfSeek()){
            $row = $this->Row();

            $status = $row->status == 1 ? 'Active':'Inactive';
            $output .= "   <div class=\"card-box m-b-10\">
            <div class=\"table-box opport-box\">


                <div class=\"table-detail\">
                    <div class=\"member-info\">
                        <h4 class=\"m-t-0\"><b><a href='?curpage=view_application&id=$row->id' >$row->name</a> </b></h4>
                        <p class=\"text-dark m-b-5\"><b>Expiration Date: </b> <span class=\"text-muted\">".date('M d Y',strtotime($row->expiration_date))."</span></p>
                        <p class=\"text-dark m-b-0\"><b>Status: </b> <span class=\"text-muted\">$status</span></p>
                    </div>
                </div>



                <div class=\"table-detail\">
                    <p class=\"text-dark m-b-5\"><b>Type:</b> <span class=\"text-muted\">$row->type</span></p>
                    <p class=\"text-dark m-b-0\"><b>Price:</b> <span class=\"text-muted\">¢ $row->amount</span></p>
                </div>


                <div class=\"table-detail table-actions-bar\">
                    <a href=\"#\" class=\"table-action-btn  \"><i class=\"md md-assignment-turned-in md-2x  \"></i></a>
                </div>
            </div>
        </div>";
            $i++;
        }

        return $output;


    }


    public function generateInvoiceId() {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil(25/strlen($x)) )),1,25);
    }


    public function submitApplication($id,$invoice_id){

        $values = Array();
        $values['application_id'] = MySQL::SQLValue($id);
        $values['user_id'] = MySQL::SQLValue($_SESSION['app_user']['id']);
        $values['status']  = MySQL::SQLValue(0);
        $values['created_at'] = "now()";
        $values['created_by'] = MySQL::SQLValue($_SESSION['app_user']['id']);
        $sql = MySQL::BuildSQLInsert("user_application",$values);
        if($this->Query($sql)){
            //echo "submitted successfully";
           return $this->insertTransaction($id,$invoice_id) ? 1: 0;
        }else{
            echo "error";
            echo $this->Error();
            return -1;
        }
       // return $this->Query($sql) ?  1: 0;

    }



    public function insertTransaction($app_id,$invoice_id){
        $response = file_get_contents("https://community.ipaygh.com/v1/gateway/json_status_chk?invoice_id=123459tssioivffjhvbnmkjhyuik&merchant_key=9a5a1c9c-7730-11e5-80ef-f23c9170642f");
        // $response = json_decode($response);
        $response = json_decode($response, true);

        $status = $response["123459tssioivffjhvbnmkjhyuik"]['status'];
        $client_ip = $response["123459tssioivffjhvbnmkjhyuik"]['client_ip'];
        $client_location = $response["123459tssioivffjhvbnmkjhyuik"]['client_ip_location'];
        $amount = $response["123459tssioivffjhvbnmkjhyuik"]['amount'];
        $values = Array();
        $values['application_id'] = MySQL::SQLValue($app_id);
        $values['invoice_id'] = MySQL::SQLValue($invoice_id);
        $values['status'] = MySQL::SQLValue($status);
        $values['client_location'] = MySQL::SQLValue($client_location);
        $values['client_ip'] = MySQL::SQLValue($client_ip);
        $values['amount'] = MySQL::SQLValue($amount);
        $values['user_id'] = MySQL::SQLValue($_SESSION['app_user']['id']);
        $values['created_at'] = "now()";

        $sql = MySQL::BuildSQLInsert("transactions",$values);
        return $this->Query($sql)? 1: 0;

    }





    public function myApplications(){
        $user_id = $_SESSION['app_user']['id'];

        $this->Query("SELECT
        applications.id,
        applications.`name`,
        applications.expiration_date,
        user_application.`status`,
        applications.type,
        applications.created_at,
        user_application.user_id,
        user_application.id as app_id
        FROM
        user_application
        INNER JOIN applications ON 
        user_application.application_id = applications.id 
        WHERE user_application.user_id=$user_id");
        $i = 1;
        $output ="";



        while(!$this->EndOfSeek()){
            $row = $this->Row();
            //$status = $row->status == 1 ? 'Pending':'Approved';
            if($row->status == 0){
                $status = "<a href='javascript:void(0)' class='retract' data-id='$row->app_id'><span class='label label-table label-info' class='retract'>Pending</span></a>";
            }else if($row->status == -1){
                $status = "<span class='label label-table label-danger'>Retracted</span>";
            }else if($row->status == -2){
                $status = "<span class='label label-table label-warning'>Approved</span>";
            }else{
                $status = "<span class='label label-table label-success'>Approved</span>";
            }
            $output .= "
            <tr>
            <td>$i</td>
            <td>$row->name</td>
            <td>$row->expiration_date</td>
            <td>$row->type</td>
            <td>$status </td>
            <td>".date('M d Y',strtotime($row->created_at))."</td>
           
        </tr> 
            ";
            $i++;
        }

        return $output;


    }


    public function retractApplication($id){

        $sql = "UPDATE user_application SET status='-1' where id=$id";
        return $this->Query($sql) ? 1: 0;
    }

    public function refundApplication($post){

        $user_id = filter_input(0,"user",257);
        $app_id = filter_input(0,"app",257);
        $sql = "UPDATE user_application SET status='-2' where user_id=$user_id and application_id=$app_id";
        return $this->Query($sql) ? 1: 0;
    }

    public function appliedApplications(){
        $sql = "SELECT
users.first_name,
users.last_name,
transactions.invoice_id,
transactions.id,
transactions.user_id,
transactions.client_location,
transactions.amount,
applications.`name`,
applications.`id` as app_id,
applications.`status`,
applications.`type`
FROM
transactions
INNER JOIN users ON users.id = transactions.user_id
INNER JOIN applications ON transactions.application_id = applications.id
";


        $this->Query($sql);
        $output = "";

    $i=1;
        while(!$this->EndOfSeek()){
            $row = $this->Row();
            $status = $row->status ;
//            if($row->status == 0){
//                $status = "<span class='label label-table label-secondary'>Pending</span>";
//            }else if($row->status == -1){
//                $status = "<a href='javascript:void(0)' class='approve'><span class='label label-table label-danger'>Retracted</span></a>";
//            }else{
//                $status = "<span class='label label-table label-success'>Approved</span>";
//            }
            $output .= "
            <tr>
            <td>$i</td>
            <td>$row->first_name $row->last_name</td>
            <td>$row->name</td>
            <td>$row->invoice_id</td>
            <td>$row->amount</td>
            <td>$row->type</td>
            <td>$status</td>
            <td><button class='btn btn-xs btn-danger refund' data-user='$row->user_id' data-app='$row->app_id'>Refund</button></td>
           
        </tr>
            ";
            $i++;
        }

        return $output;
    }
}