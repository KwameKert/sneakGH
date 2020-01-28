<?php
session_start();
if(!isset($_SESSION['app_user'])){
    header("Location: ../index.php");
}

$page = "user";
require_once('../classes/user.class.php');
require_once('../inc/header.php');
//header("Location: ../index.php");



?>

<div class="card white-box " style="width:70%;margin-left:110px;">
<h4>Create User</h4>
    <hr>

    <form action="" id="addUser" style="padding:0 40px;">

        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="fullName" placeholder="Full name">
                    <div class="form-control-feedback">
                        <i class="icon-user-check text-muted"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email">
                    <div class="form-control-feedback">
                        <i class="icon-envelope5 text-muted"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group has-feedback">
                    <input type="tel" class="form-control" name="phone_number" placeholder="Phone number">
                    <div class="form-control-feedback">
                        <i class="icon-phone-plus2 text-muted"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <label for="" class="col-md-2" style="padding-top:10px">Category</label>
            <div class="form-group">
                <div class="col-md-8">
                    <select class="single-select" name="user_cat">
                        <?php
                        $obj = new MySQL();
                        $obj->Query("SELECT `name`,`cat_id`,`status`  FROM  user_cat WHERE `status`='Active'");
                        while(!$obj->EndOfSeek()){
                            $row = $obj->Row();
                            echo "<option value='$row->cat_id'>$row->name</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

        </div>
        <br>
        <input type="submit" value="Create" class="btn btn-primary pull-right">
        <input type="hidden" name="action" value="addUser">
        <br><br>

    </form>
</div>

<div class="white-box" id="list">


<?php
$obj = new User();
echo $obj->listUsers();
?>
        </tbody>
    </table>


</div>


<?php

require_once('../inc/footer.php');

?>

<script>

    $(document).on("submit","#addUser",function(ev){
        ev.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url:"../controllers/user_controller.php",
            type:"POST",
            data:data,
            success:function(text){
                   if(text == 1){
                   makeToast("User Added","green","success");
                   $('#addUser')[0].reset();
                       $("#list").load("../controllers/user_controller.php", {"action": "listUsers"})
                   }else if(text == -2){
                   makeToast("A user with the same email exists","info","info");
                   }else{
                        makeToast("An error occured","red","error");
                    }
                }
        })
    })

</script>
