<html>
<head>
	<?php
    if(session_id() == ''){session_start();}
    if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
    if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
    if($_SESSION['seller_login']==false || $_SESSION["user_login"]==true)
    {	header('Location:seller_sign.php?err=login_first');	}
	?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- Edit Profile</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
   

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <link href="css/edit_profile_seller.css" rel="stylesheet" type="text/css">
    <script src="js/jquery.js"></script>

    <script src="js/bootstrap-filestyle.min.js"></script>
      <script src="js/bootstrap-filestyle.js"></script>
	<script src="js/signup_login.js"></script>
      <script>
      var Profile = function(event) {
          var output = document.getElementById('proimg');
          output.src = URL.createObjectURL(event.target.files[0]);
  		document.getElementById("remove").style.display="block";
		document.getElementById("provalue").value="1";
        };
  	function remove_profile()
  	{
  		document.getElementById("proimg").src="images/default_profile.png";
  		document.getElementById("proinput").value="";
  		document.getElementById("remove").style.display="none";
		document.getElementById("provalue").value="1";
  	}
      </script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

    <script src="js/common.js" ></script>

</head>
<body>
<?php include('header.php')?>

<?php

	$query_seller='select * from seller where sid="'.$_SESSION["seller_id"].'"';
	$result_seller = mysqli_query($con,$query_seller);
	$row_seller=mysqli_fetch_array($result_seller);

	if($row_seller["sprofile"]=="")
	{
		$profileImg='images/default_profile.png';
		$display="display:none;";
	}
	else
	{
		$profileImg='profile_seller/'.$row_seller["semail"].'.'.$row_seller["sprofile"];
		$display="display:block;";
	}
?>

    <form id="seller_profile_edit-form" action="edit_seller_profile_process.php" method="post" role="form" onSubmit="return editPro()" style="float:left; width:100%; margin-top:100px;" enctype="multipart/form-data">

    <div style="float:left;">
    <div id="prodiv">
    <img id="proimg" src="<?php echo $profileImg;?>" alt="Profile">
    <input type="file" name="profile_seller" id="proinput" onChange="Profile(event)" accept="image/*">
    </div>
    <p class="protext">Profile Photo</p>
    <a class="protext" id="remove" style="color:#F00; font-size:16px; display:none; <?php echo $display;?>" onClick="remove_profile()">&times;Remove&times;</a>
    </div>

    <div style="float:left; margin-left:3%; width:40%;">
      <div class="form-group">
      <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Shop Name" value="<?php echo $row_seller["sname"];?>">
      </div>
                        <div class="form-group">
        <input type="text" name="mobile" id="mobile" tabindex="1" class="form-control" placeholder="Mobile" value="<?php echo $row_seller["smobile"];?>">
      </div>

      <div class="form-group">
        <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password" value="">
      </div>
      <div class="form-group">
        <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
      </div>
      <div class="form-group">
      <input type="text" name="address" id="address" tabindex="1" class="form-control" placeholder="Shop Address" value="<?php echo $row_seller["saddress"];?>">
      </div>
      <div class="form-group">
      <input type="text" name="pincode" id="pincode" tabindex="1" class="form-control" placeholder="pincode" value="<?php echo $row_seller["spincode"];?>">
      </div>
      <div class="form-group">
      <input type="hidden" name="provalue" id="provalue" tabindex="1" class="form-control" value="0">
      </div>
      <div class="form-group">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3">
            <input type="submit" name="sedit" id="sedit" tabindex="4" class="btn btn-primary" value="Save">
          </div>
        </div>
      </div>
      
      </div>
    </form>
<div style="margin-top:38%"><?php include ("footer.php") ?></div>
<script>active("user");</script>
</body>
</html>
