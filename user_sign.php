<!DOCTYPE html>
<html lang="en">

<head>
<?php
	if(session_id() == ''){session_start();}
	if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
	if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
	if($_SESSION['seller_login']==true || $_SESSION["user_login"]==true)
	{	header('Location:PNF.html');	}
?>
<?php
if(isset($_GET["err"]))
if($_GET["err"]=='login_first')
{
echo '
<h4 style="margin-left:8%;margin-top:10px;">Please, Login to access this feature.<br><br>
Sellers <a href="seller_sign.php">click here</a> </h4>
<script>
	document.getElementById("login-form-link").className="active";
	document.getElementById("register-form-link").className="inactive";
	document.getElementById("login-form").style.display="block";
	document.getElementById("register-form").style.display="none";
</script>';
}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- User</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/form_seller.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	<script src="js/bootstrap-filestyle.min.js"></script>

	<script src="js/common.js"></script>
    <script src="js/signup_login.js" ></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

<?php include("header.php");?>
<div class="container" style="padding:60px 0px;">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">

					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="user_signin_process.php" onSubmit="return login()" method="post" role="form" style="display:block;">
									<div class="form-group">
										<input type="text" name="email_log" id="email_log" tabindex="1" class="form-control" placeholder="Email">
									</div>
									<div class="form-group">
										<input type="password" name="password_log" id="password_log" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group text-center">
										<input type="checkbox" tabindex="3" class="" name="remember" id="remember">
										<label for="remember"> Remember Me</label>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="btn btn-primary" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<a href="" tabindex="5" class="forgot-password">Forgot Password?</a>
												</div>
											</div>
										</div>
									</div>

								</form>



								<form id="register-form" action="user_signup_process.php" onSubmit="return signup()" method="post" role="form" style="display: none;" enctype="multipart/form-data">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Full Name" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
                                    <div class="form-group">
										<input type="text" name="mobile" id="mobile" tabindex="2" class="form-control" placeholder="Mobile Number">
									</div>
                                    <div class="form-group">
										<input type="text" name="address" id="address" tabindex="2" class="form-control" placeholder="Full Address">
									</div>
                                    <div class="form-group">
										<input type="text" name="pincode" id="pincode" tabindex="2" class="form-control" placeholder="Pincode">
									</div>
                                    <div class="form-group">
										<input type="file" class="filestyle" id="profile_user" name="profile_user" data-classButton="btn btn-primary" data-input="false" data-buttonText="Choose profile picture." accept="image/*">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="btn btn-primary" value="Sign Up">
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div><!--pannel body-->

				</div>
			</div>
		</div>
</div>
<?php include('footer.php');?>
<script>active("user");</script>
<?php
if(isset($_GET["err"]))
if($_GET["err"]=='signup_email')
{
echo '<script>
	document.getElementById("login-form-link").className="inactive";
	document.getElementById("register-form-link").className="active";
	document.getElementById("login-form").style.display="none";
	document.getElementById("register-form").style.display="block";
	document.getElementById("email").style.border="2px solid #000";
	alert("email already exist");
</script> ';
}
?>
<?php
if(isset($_GET["err"]))
if($_GET["err"]=='login_email')
{
echo '<script>
	document.getElementById("login-form-link").className="inactive";
	document.getElementById("register-form-link").className="active";
	document.getElementById("login-form").style.display="block";
	document.getElementById("register-form").style.display="none";
	document.getElementById("email_log").style.border="2px solid #000";
</script> ';
}
?>
<?php
if(isset($_GET["err"]))
if($_GET["err"]=='login_pass')
{
echo '<script>
	document.getElementById("login-form-link").className="inactive";
	document.getElementById("register-form-link").className="active";
	document.getElementById("login-form").style.display="block";
	document.getElementById("register-form").style.display="none";
	document.getElementById("password_log").style.border="2px solid #000";
</script> ';
}
?>


</body>

</html>
