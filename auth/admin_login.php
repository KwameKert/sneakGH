<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="../assets/images/favicon_1.ico">

    <title>SneakGH</title>


    <?php
    include('../inc/auth_styles.php')  ?>



</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>

<div class="wrapper-page">
    <div class="card-box">
        <div class="panel-heading">
            <h4 class="text-center"> Sign In to <strong class=" cov_color">Sneak GH</strong></h4>
        </div>

        <div class="p-20">
            <form class="form-horizontal m-t-20"  id="loginForm">
                <div id="loading" align="center" style="display:none"><img src="../assets/images/loader.gif" width="60px" height="60px" alt=""></div>

                <div class="form-group ">
                    <div class="col-12">
                        <input class="form-control" type="text" required="" placeholder="email" name="email">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-12">
                        <input class="form-control" type="password" required="" placeholder="Password" name="password">
                    </div>
                </div>
                <div class="form-group text-center m-t-40">
                    <div class="col-12">
                        <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit">
                            Login
                        </button>
                    </div>
                </div>
                <input type="hidden" name="action" value="loginUser">
            </form>

        </div>

        <div class="row">
            <div class="col-12 text-center">
                <p>
                    Don't have an account? <a href="register.php" class="text-primary m-l-5"><b>Sign Up</b></a>
                </p>
            </div>
        </div>
    </div>

</div>


<?php include('../inc/auth_scripts.php')  ?>

<script>
    $(document).on("submit","#loginForm", function(ev){

        $("#loading").css("display","block");
        ev.preventDefault();
        var data = $(this).serialize();
        console.log(data);
        $.ajax({
            url: "../controllers/auth_controller.php",
            type: "POST",
            data:data,
            success: function(text){

                $("#loading").css("display","none");
                if(text == 1) {
                    makeToast("Login Successful", "green", "success")
                    $("form")[0].reset();
                    location = "../transactions?curpage=list_all_deposits";
                }else{
                    makeToast("An error occured !!!","red","danger")
                }

                console.log(text);
            }
        })

    })

</script>
</body>

</html>