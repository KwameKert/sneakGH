<?php
session_start();
if(!isset($_SESSION['app_user'])){
    header("Location: ../index.php");
}

$page = "user";
require_once('../classes/user.class.php');
require_once('../inc/header.php');
//header("Location: ../index.php");

$u_id = base64_decode($_GET['u_id']);
$eObj = new MySQL();
$eObj->Query("SELECT * FROM users WHERE id= $u_id LIMIT 1");
$row = $eObj->Row();
$user_cat = $row->user_cat;


?>

<div class="card white-box " style="width:70%;margin-left:110px;">
    <h4>Edit User</h4>
    <hr>

    <form action="" id="editUser" style="padding:0 40px;">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" value="<?php echo $row->full_name?>" name="fullName" placeholder="Full name">
                    <div class="form-control-feedback">
                        <i class="icon-user-check text-muted"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <input type="email" name="email" value="<?php echo $row->email ?>" class="form-control" placeholder="Email">
                    <div class="form-control-feedback">
                        <i class="icon-envelope5 text-muted"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <input type="tel" class="form-control" value="<?php echo $row->phone_number ;?>"  name="phone_number" placeholder="Phone number">
                    <div class="form-control-feedback">
                        <i class="icon-phone-plus2 text-muted"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <select class="js-example-basic-single" name="user_cat">
                        <option value="Active" <?php echo $row->status == 'Active'? 'seelcted':''?>>Active</option>
                        <option value="Inactive" <?php echo $row->status == 'Inactive'? 'seelcted':''?>>Inactive</option>
                    </select>

                </div>
            </div>
                <div class="col-md-6">
                    <div class="form-group">

                    <select class="single-select" name="user_cat">
                        <?php
                        $obj = new MySQL();
                        $obj->Query("SELECT `name`,`cat_id`,`status`  FROM  user_cat WHERE `status`='Active'");
                        while(!$obj->EndOfSeek()){
                            $row = $obj->Row();
                            if($row->user_cat == $user_cat ){
                                echo "<option value='$row->cat_id' selected>$row->name</option>";

                            }else{
                                echo "<option value='$row->cat_id'>$row->name</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>
        <br>
        <input type="submit" value="Create" class="btn btn-primary pull-right">
        <input type="hidden" name="action" value="editUser">
        <input type="hidden" name="user_id" value="<?php echo $u_id?>">
        <br><br>

    </form>
</div>

<div class="white-box" id="list">
        <?php
        $obj = new User();
        echo $obj->listUsers();
        ?>
</div>


<?php

require_once('../inc/footer.php');

?>

<script>
//    $(document).ready(function() {
//        $('.js-example-basic-single').select2();
//    });


    $(document).on("submit","#editUser",function(ev){
        ev.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url:"../controllers/user_controller.php",
            type:"POST",
            data:data,
            success:function(text){
                if(text == 1){
                    makeToast("User Updated","green","success");
                    $("#list").load("../controllers/user_controller.php", {"action": "listUsers"})

                }else if(text == -2){
                    makeToast("A user with the same email exists","info","info");
                }else{
                    makeToast("An error occured","red","error");
                }
            }
        })
    })
    //
    //    $(document).ready(function(){
    //        alert("Hello wolrd");
    //        console.log("Hello wolrd");
    //    });
</script>
