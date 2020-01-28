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
    <h4>Create Category</h4>
    <hr>

    <form action="" id="addCategory" style="padding:0 40px;">


        <div class="row">
            <div class="col-md-12">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="cat_name" placeholder="Category name">
                    <div class="form-control-feedback">
                        <i class="icon-users4 text-muted"></i>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-12">
                <textarea rows="2" name="description" cols="5" class="form-control" placeholder="Enter Description"></textarea>
            </div>
        </div>
        <br><br>

        <div class="row">
            <label for="" class="col-md-2" style="padding-top:10px">Status</label>
            <div class="form-group">
                <div class="col-md-8">
                    <select class="single-select" name="status">
                        <option value="">--Select --</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>
            </div>

        </div>
        <br>
        <input type="submit" value="Create" class="btn btn-primary pull-right">
        <input type="hidden" name="action" value="addCat">
        <br><br>

    </form>
</div>

<div class="white-box" id="list">


    <?php
    $obj = new User();
    echo $obj->listCategories();
    ?>



</div>


<?php

require_once('../inc/footer.php');

?>

<script>
//    $(document).ready(function() {
//        $('.single-select').select2();
//    });


    $(document).on("submit","#addCategory",function(ev){
        ev.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url:"../controllers/user_controller.php",
            type:"POST",
            data:data,
            success:function(text){
                if(text == 1){
                    makeToast("User Added","green","success");
                    $('#addCategory')[0].reset();
                    $("#list").load("../controllers/user_controller.php", {"action": "listCategories"})
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
