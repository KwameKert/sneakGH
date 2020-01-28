<?php

require_once('mysql.class.php');
require_once('../inc/functions.php');

class User extends MySQL{
    public function __construct()
    {

        parent::__construct();
        @session_start();
    }

    public function listUsers(){
        $this->Query("SELECT
users.id,
users.username,
users.full_name,
users.`password`,
users.user_cat,
users.email,
users.phone_number,
users.`status`,
users.created_on,
users.created_by,
user_cat.`name`
FROM
users
INNER JOIN user_cat ON users.user_cat = user_cat.cat_id  WHERE users.status ='Active'");
        $i = 1;
        $output =" <table class='table datatable-basic'>
        <thead>
        <tr>
            <th>#</th>
            <th>Full Name</th>
            <th>Category</th>
            <th>Email</th>
            <th>Created on</th>
            <th>Status</th>
            <th class=\"text-center\">Actions</th>
        </tr>
        </thead>
        <tbody >";
        while(!$this->EndOfSeek()){
            $row= $this->Row();
            if($row->status == 'Active'){
                $status = 'label-success';
            }else{
                $status = 'label-danger';
            }
            $output .= "
            <tr>
            <td>$i</td>
            <td>$row->full_name</td>
            <td>$row->name</td>
            <td>$row->email</td>
            <td>".date('M d Y',strtotime($row->created_on))."</td>
            
            <td><span class='label ".$status."'>$row->status</span></td>
            <td class=\"text-center\">
                <ul class=\"icons-list\">
                    <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                            <i class=\"icon-menu9\"></i>
                        </a>
                        <ul class=\"dropdown-menu dropdown-menu-right\">
                            <li><a   href='edit_user.php?&u_id=".base64_encode($row->id)."'><i class=\"icon-pencil5\"></i> Edit</a></li>
                            <li><a class='delete'  type='user' data-id='".base64_encode($row->id)."'><i class='icon-bin2 delete '></i> Delete</a></li>
                        </ul>
                    </li>
                </ul>
            </td>
        </tr>
            ";
            $i++;
        }
        $output .="  </tbody>
    </table>";

        return $output;
    }
    public function login($post){
        $email = MySQL::SQLValue(filter_input(0,"email",513));
        $password = MySQL::SQLValue(SHA1(filter_input(0,"password",513)));

        $sql = "SELECT * FROM users WHERE email=$email AND `password`=$password LIMIT 1";
        $this->Query($sql);
        if($this->RowCount() > 0){
            $row = $this->QuerySingleRowArray($sql,MYSQLI_ASSOC);
           // var_dump($row);
            $_SESSION['app_user'] =$row;
            return 1;
        }else{
            //echo "Not found";
            return 0;
        }
        }



        public function editUser($post)
        {
            if (sizeof($post) > 0) {
                $values = Array();
                $where = Array();
                $email = filter_input(0, "email", 513);
                $values['full_name'] = MySQL::SQLValue(filter_input(0, "fullName", 513));
                $values['email'] = MySQL::SQLValue($email);
                $values['phone_number'] = MySQL::SQLValue(filter_input(0, "phone_number", 513));
                $values['user_cat'] = MySQL::SQLValue(filter_input(0, "user_cat", 257));
                $where['id'] = MySQL::SQLValue(filter_input(0, "user_id", 257));

                $sql = MySQL::BuildSQLUpdate("users", $values, $where);
                $rs = $this->Query($sql);
                return $rs ? 1 : 0;
            } else {
                return -1;
            }
        }

    public function addUser($post)
    {
        $serial_id = uniqid();
        $password = SHA1('password');
        $email = filter_input(0, "email", 513);
        if (sizeof($post) > 1) {
            $values = Array();

            if($this->checkEmail($email)){
                return -2;
            }
            $values['first_name'] = MySQL::SQLValue(filter_input(0, "first_name", 513));
            $values['last_name'] = MySQL::SQLValue(filter_input(0, "last_name", 513));
            $values['dob'] = MySQL::SQLValue(filter_input(0, "dob",513));
            $values['email'] = MySQL::SQLValue($email);
            $values['location'] = MySQL::SQLValue(filter_input(0, "location", 513));
            $values['phone'] = MySQL::SQLValue(filter_input(0, "phone", 513));
            $values['user_cat'] = MySQL::SQLValue("2");
            $values['serial_id'] = MySQL::SQLValue($serial_id);
            $values['password'] = MySQL::SQLValue($password);
            $values['created_at'] = "now()";
            $values['created_by'] = MySQL::SQLValue($serial_id);

            $sql = MySQL::BuildSQLInsert("users", $values);
            $rs = $this->Query($sql);
            echo $this->Error();
           return $rs? 1:0;
        }else{
            return -1;
        }
    }

    public function checkEmail($email){
         return $this->HasRecords("SELECT email FROM users WHERE email='$email'");
    }

   public  function fetchCatPrivs($cid){

        $sql = sprintf("SELECT user_links.link_id, user_links.page_id,user_links.page_id_sub, user_links.link_url, user_links.link_name, user_links.link_target, user_links.link_image, user_links.link_parent FROM user_cat_links INNER JOIN user_links ON user_cat_links.link_id = user_links.link_id WHERE user_cat_links.cat_id = %s", MySQL::SQLValue($cid, MySQL::SQLVALUE_NUMBER));
        $links = $this->QueryArray($sql, MYSQLI_ASSOC);

        $child = array();

        if(!empty($links)){

            foreach($links as $row_links){

                if($row_links['link_parent'] > 0){

                    $child[] = $row_links;

                }
            }

        }

        $myprivssql = "SELECT link_id FROM user_cat_links WHERE cat_id = $cid";

        $this->Query($myprivssql);

        $mylinks = array();

        while(!$this->EndOfSeek()){

            $num = $this->Row();
            $mylinks[] = $num->link_id;

        }


        $psql = sprintf("SELECT * FROM user_links WHERE status = 'Active'");

        $all_links = $this->QueryArray($psql, MYSQLI_ASSOC);

        $main = array();
        $children = array();

        foreach($all_links as $r_links){

            if($r_links['link_parent']==0){
                $main[] = $r_links;
            }else{
                $children[] = $r_links;
            }
        }

        $privlist = "";

        $privlist .= "<table class='table table-responsive table-bordered'>";
        foreach($main as $mainlink){
            $privlist .= "<tr>
                <td colspan='2'><h5><strong>".$mainlink['link_name']."</strong></h5></td>
            </tr>";
            foreach($children as $subs){ if($mainlink['link_id']==$subs['link_parent']){

                $privlist .="<tr>
                    <td style=\"width: 60px;\"><input type=\"checkbox\" name=\"priv_check[]\" id=\"priv_check\" value=\"".$subs['link_id']."\" "; if(in_array($subs['link_id'],$mylinks)){ $privlist .="checked";}
                $privlist .="></td>
                    <td>". $subs['link_name']."</td>
                </tr>";
            }
            }
        }
        $privlist .="</table>";

        return $privlist;



    }


    public function listCategories(){
       $this->Query("SELECT * FROM user_cat WHERE status='Active'");
        $output =" <table class=\"table datatable-basic\">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Description</th>
            <th>Created on</th>
            <th>Status</th>
            <th class=\"text-center\">Actions</th>
        </tr>
        </thead>
        <tbody >";
        $i =1;
       while(!$this->EndOfSeek()){
           $row = $this->Row();
           if($row->status == 'Active'){
               $status = 'label-success';
           }else{
               $status = 'label-danger';
           }
           $output .= "
            <tr>
            <td>$i</td>
            <td>$row->name</td>
            <td>$row->description</td>
            <td>".date('M d Y',strtotime($row->created_on))."</td>
            
            <td><span class='label ".$status."'>$row->status</span></td>
            <td class=\"text-center\">
                <ul class=\"icons-list\">
                    <li class=\"dropdown\">
                        <a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">
                            <i class=\"icon-menu9\"></i>
                        </a>
                        <ul class=\"dropdown-menu dropdown-menu-right\">
                            <li><a   href='edit_category.php?&c_id=".base64_encode($row->cat_id)."'><i class=\"icon-pencil5\"></i> Edit</a></li>
                            <li><a class='delete'  type='category' data-id='".base64_encode($row->cat_id)."'><i class='icon-bin2 delete '></i> Delete</a></li>
                        </ul>
                    </li>
                </ul>
            </td>
        </tr>
            ";
           $i++;
       }
        $output .="  </tbody>
    </table>";

        return $output;
    }



    public function addCategory($post){
       if(sizeof($post)>0){
           $values = Array();
           $values['name'] = MySQL::SQLValue(filter_input(0,"cat_name",513));
           $values['description'] = MySQL::SQLValue(filter_input(0,"description",513));
           $values['status'] = MySQL::SQLValue(filter_input(0,"status",513));
           $values['created_on'] = "now()";
           $values['created_by'] = MySQL::SQLValue($_SESSION['app_user']['id']);

           $sql = MySQL::BuildSQLInsert("user_cat",$values);
           $rs = $this->Query($sql);
           return $rs? 1:0;
       }else{
           return -1;
       }
    }

    public function editCategory($post){
        if(sizeof($post)>0){
            $values = Array();
            $where = Array();
            $values['name'] = MySQL::SQLValue(filter_input(0,"cat_name",513));
            $where['cat_id'] = MySQL::SQLValue(filter_input(0,"id",513));
            $values['description'] = MySQL::SQLValue(filter_input(0,"description",513));
            $values['status'] = MySQL::SQLValue(filter_input(0,"status",513));
            $sql = MySQL::BuildSQLUpdate("user_cat",$values,$where);
            $rs = $this->Query($sql);
            return $rs? 1:0;
        }else{
            return -1;
        }


    }


    public function saveAssignedLinks($post){
        if(isset($_POST['priv_check'])){

            if(sizeof($_POST['priv_check'])!=0) {

                if(isset($_POST['user_cat']) && !empty($_POST['user_cat'])){

                    $usercategory = $_POST['user_cat'];

                    $del_result = $this->Query("DELETE FROM user_cat_links WHERE cat_id = $usercategory");

                    if($del_result){

                        $wucl ="";

                        for($r=0;$r<sizeof($_POST['priv_check']);$r++){

                            $link_id = $_POST['priv_check'][$r];

                            $valuesArray['link_id'] = MySQL::SQLValue($link_id);
                            $valuesArray['cat_id'] = MySQL::SQLValue($usercategory);

                            $sql = MySQL::BuildSQLInsert("user_cat_links", $valuesArray);

                            if($r==0){

                                $wucl = $sql;

                            }
                            else
                            {

                                $wucl .= ','.substr($sql,58);


                            }


                        }


                        $cresponse = $this->Query($wucl);



                        $this->Query("SELECT DISTINCT(user_links.link_parent) FROM user_links
                        JOIN user_cat_links ON user_links.link_id = user_cat_links.link_id
                        WHERE user_cat_links.cat_id = $usercategory");

                        $pwucl = "";
                        $pcnt=0;

                        while(!$this->EndOfSeek()){

                            $mprow = $this->Row();
                            $mpval = $mprow->link_parent;

                            $valuesArray['link_id'] = MySQL::SQLValue($mpval);
                            $valuesArray['cat_id'] = MySQL::SQLValue($usercategory);

                            $sql_parent = MySQL::BuildSQLInsert("user_cat_links", $valuesArray);


                            if($pcnt==0){

                                $pwucl = $sql_parent;
                                $pcnt++;

                            }else{

                                $pwucl .= ','.substr($sql_parent,58);
                                $pcnt++;


                            }

                        }
                        $presponse = $this->Query($pwucl);

                        if($presponse==true && $cresponse==true){

                            return "ok";

                        }else{

                            return "fail";

                        }



                    }else{

                        return "d_fail";

                    }


                }else{

                    return "unselected";
                }
            }else{

                return "unchecked";

            }

        }else{

            return "unchecked";

        }

    }









}