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

    <title>SHOPTOP- My Profile</title>

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

    <script src="js/jquery.js"></script>

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
		$profileImg='images/default_profile.png';
	else
		$profileImg='profile_seller/'.$row_seller["semail"].'.'.$row_seller["sprofile"];
?>
<div style="margin-left:10%;float:left;margin-top:5%">
<img src="<?php echo $profileImg;?>" width="200px" height="200px">
</div>
<div style="width:60%;float:left">
      <div style="margin-left:5%;margin-top:30px">
              <div class="row">
                  <div class="col-lg-12">
                      <h2 class="page-header"><?php echo $row_seller["sname"];?></h2>
                  </div>
      		</div>
      <h4>
      <div style="float:left;">Shop Addresss: <?php echo $row_seller["saddress"];?> </div>
      <br>
      <br>
      <div style="float:left;">Pin Code: <?php echo $row_seller["spincode"];?></div>
      <br><br>
      <div style="float:left;">E-mail Id: <?php echo $row_seller["semail"];?></div>

      <br><br>
      <div style="float:left;">Contact No: <?php echo $row_seller["smobile"];?></div>
      <br><br>
      <div style="float:left;">Status: <?php if($row_seller["sapprove"]==1) echo'Approved'; else echo 'Pending';
		  ?></div>
      <br><br>
      </h4>
      </div>

</div>

<div style="float:right;margin-right:80px;margin-top:130px;clear:right;">
<a href="add_products.php"><input type="submit" name="add_product" style="background:#00F;border:0px; " id="add_product" tabindex="4" class="btn btn-primary" value="Add Products"></a><br><br>
<a href="view_products.php"><input type="submit" name="view_product" style="background:#00F;border:0px;" id="view_product" tabindex="4" class="btn btn-primary" value="View Products"></a>
</div>
<a href="edit_seller_profile.php"><input type="submit" name="edit_profile" style="background:#E00; margin-left:27.5%;clear:left; border:0px;float:left" id="edit_profile" tabindex="4" class="btn btn-primary" value="Edit Profile"></a>

<a href="view_requests.php"><input type="submit" name="view_request" style="background:#E00;float:left; margin-left:2%; border:0px" id="view_request" tabindex="4" class="btn btn-primary" value="View Requests"></a>
<br>


<div style="margin-top:520px;clear:left">
<?php include ("footer.php") ?></div>
<script>active("user");</script>


</body>
