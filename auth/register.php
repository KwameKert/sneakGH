<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <link rel="shortcut icon" href="../assets/images/favicon_1.ico">

    <title>My Wallet</title>

    <?php include('../inc/auth_styles.php')  ?>

</head>
<body>

<div class="account-pages"></div>
<div class="clearfix"></div>

<div class="row mt-5">
    <div class="col-2"></div>
    <div class="col-8 offset-3">

        <div class="card">
            <div class="card-box">
                <div class="panel-heading">
                    <h4 class="text-center"> Sign Up to <strong class=" cov_color">SneakGH</strong></h4>
                </div>

                <div id="loading" align="center" style="display:none"><img src="../assets/images/loader.gif" width="60px" height="60px" alt=""></div>
                <div class="p-20">
                    <form class="form-horizontal m-t-20"  id="registerForm">


                        <div class="form-group row">
                            <div class="col-6">
                                <div class="form-label">First Name</div>
                                <input type="text" name="first_name" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <div class="form-label">Last Name</div>
                                <input type="text" name="last_name" class="form-control" required>
                            </div>
                        </div>


                        <div class="form-group row">
                           <div class="col-6">
                                <div class="form-label">Location</div>
                                <input type="text" name="location" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <div class="form-label">Date Of Birth</div>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-6">
                                <div class="form-label">Email</div>
                                <input class="form-control" type="email" name="email" required >
                            </div>

                            <div class="col-6">
                                <div class="form-label">Phone </div>
                                <input class="form-control" placeholder="0242920202" type="text" name="phone" required >
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-6">
                                <div class="form-label">Password</div>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="col-6">
                                <div class="form-label">Confirm Password</div>
                                <input type="password" name="password" id="confirm_password" class="form-control" required>
                            </div>

                            <div id="error" style="color:red;margin-left:10px;display:none"> Passwords dont match</div>
                        </div>
                        <div class="form-group text-center m-t-40">
                            <div class="col-12">
                                <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit" id="submit" disabled>
                                    Log In
                                </button>
                            </div>
                        </div>
                        <input type="hidden" name="action" value="register">
                    </form>

                </div>

                <div class="row">
                    <div class="col-12 text-center">
                        <p>
                            Do you have an account? <a href="login.php" class="text-primary m-l-5"><b>Sign In</b></a>
                        </p>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

<?php include('../inc/auth_scripts.php')  ?>


<script>



    $("#confirm_password").keyup(function(){
        if($("#confirm_password").val() != $("#password").val()){
            $("#error").css("display","block");
            $('#submit').prop("disabled", true);
        }else{
            $("#error").css("display","none");
            $('#submit').prop("disabled", false);
        }
    });


$(document).on("submit","#registerForm", function(ev){

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
            if(text == 1){
                makeToast("Registration Successful","green","success")
                $("form")[0].reset();
                location="../auth/login.php";

            }else if( text == -2){

                makeToast("Registration Successful","blue","info")


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