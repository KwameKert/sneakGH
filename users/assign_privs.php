<?php
session_start();
if(!isset($_SESSION['app_user'])){
    header("Location: ../index.php");
}
require_once('../classes/mysql.class.php');

$page = "user";
$sub1 = "apriv";

$alluserlinks = new MySQL();

$psql = sprintf("SELECT * FROM user_links WHERE status = 'Active'");

$all_links = $alluserlinks->QueryArray($psql, MYSQLI_ASSOC);

$main = array();
$children = array();

foreach($all_links as $r_links){
    if($r_links['link_parent']==0){
        $main[] = $r_links;
    }else{
        $children[] = $r_links;
    }
}
require_once('../classes/user.class.php');
require_once('../inc/header.php');
//header("Location: ../index.php");

?>

<div class="panel panel-flat">
    <div class="panel-heading">
        <h5 class="panel-title"> User Management - <small>Assign Privileges</small></h5>
        <div class="heading-elements">
            <ul class="icons-list">
                <li><a data-action="collapse"></a></li>
                <li><a data-action="reload"></a></li>
                <li><a data-action="close"></a></li>
            </ul>
        </div>
    </div>


    <!-- Main content -->
    <div class="panel-body">


        <!-- /.box-header -->
        <div>
            <p align="center" style="display: none; color: limegreen;" id="wait"><img src="../dist/img/spinner-grey.gif" > saving privileges. Please wait....</p>
            <p align="center" style="display: none; color: limegreen;" id="wait_fetch"><img src="../dist/img/spinner-grey.gif" > Fetching privileges for selected category. Please wait....</p>
        </div>

    </div>

    <div class="container-fluid">
    <form method="POST" class="new_user_form" action="" id="laform">
        <table class="table table-responsive table-email table-bordered" align="center">
            <tr>
                <td colspan="4"><p id="confirmation" style="text-align:center"></p></td>
            </tr>


            <tr>
                <td><label>Category:</label></td>
                <td><select name="user_cat" id="user_cat" style=" height:30px" class="single-select">
                        <option  value="">--SELECT CATEGORY--</option>
                        <?php $cat = new MySQL; $cat->Query("SELECT * FROM user_cat ORDER BY name ASC");
                        while(!$cat->EndOfSeek()){$crow = $cat->Row(); ?>
                            <option value="<?php echo $crow->cat_id; ?>">
                                <?php echo $crow->name; ?>
                            </option>
                        <?php }?>
                    </select>
                </td>
                <td><div><input type="submit" id="assign" class="btn btn-primary rounded-4" value="Assign Privileges"></div></td>
            </tr>
        </table>
           <input type="hidden" name="action" value="saveLinks">
    </form>
    </div>
    <br/><br/>
        <div class="container-fluid">
        <div id="listarea">
            <table class="table table-responsive table-bordered">
                <?php foreach($main as $mainlink){ ?>
                    <tr>
                        <td colspan="2"><h5><strong><?php echo $mainlink['link_name']; ?></strong></h5></td>
                    </tr>
                    <?php foreach($children as $subs){ if($mainlink['link_id']==$subs['link_parent']){ ?>
                        <tr>
                            <td style="width: 60px;"><input type="checkbox" name="priv_check[]" id="priv_check" value="<?php echo $subs['link_id'];?>"></td>
                            <td><?php echo $subs['link_name'];?></td>
                        </tr>
                    <?php }} ?>
                <?php } ?>
            </table>
            
        </div>
        </div>
        <br/> <br/>
     


</div>


<?php

require_once('../inc/footer.php');

?>
<script>
//    $(document).ready(function() {
//        $('.single-select').select2();
//    });
    $(document).on("change","#user_cat",function(){
        var dropvalue = $("#user_cat").val();
        var action = "fetchLinks";

        $("#wait_fetch").html('<i class="icon-spinner2 spinner"></i><p> Fetching privileges for selected category. Please wait....</p>');

        $.ajax({
            type: "POST",
            url: "../controllers/user_controller.php",
            data: {action: action ,category_id : dropvalue
            },
            success:function(data) {
                $('#listarea').html(data);
                $("#assign").removeAttr('disabled');
                $("#wait_fetch").html(" ");


            }

        });
    });



    $("document").ready(function(){

        $("#assign").attr("disabled", true)

    });

    $(function () {

        var $btns = $("#assign");
        $btns.click(function (e) {
            e.preventDefault();

            $("#wait").html('<i class="icon-spinner2 spinner"></i><p> saving privileges. Please wait....</p>');
            $("#assign").attr("disabled", "disabled");

            $.ajax({
                type: "POST",
                url: "../controllers/user_controller.php",
                data: $('#laform').serialize(),
                success: function(e) {
                    if(e=="d_fail"){
                        $("#wait").html(" ");
                        $("#assign").removeAttr('disabled');

                        $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> User privilege assignment failed</span></div>");
                        $("#confirmation").hide().fadeIn(2000).fadeOut(4000);

                    }else if(e=="ok"){

                        $("#wait").css("display","none");
                        $("#assign").removeAttr('disabled');


                        $('#confirmation').html("<div align='center'><span class='alert alert-success'><i class='icon icon-ok-sign'></i> User privileges were assigned successfully</span></div>");
                        $("#confirmation").hide().fadeIn(2000).fadeOut(4000);

                    }else if(e=="unchecked"){

                        $("#wait").css("display","none");
                        $("#assign").removeAttr('disabled');


                        $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i> Privilege assignment failed. No option was checked before assigning privileges</span></div>");
                        $("#confirmation").hide().fadeIn(2000);

                    }else if(e=="unselected"){

                        $("#wait").css("display","none");
                        $("#assign").removeAttr('disabled');


                        $('#confirmation').html("<div align='center'><span class='alert alert-danger'><i class='icon icon-remove-sign'></i>Privilege assignment failed. No user category was selected</span></div>");
                        $("#confirmation").hide().fadeIn(2000);

                    }


                }
            });
            return false;

        });

    });
</script>



