<!DOCTYPE html>
<html lang="en">

<head>
<?php
	if(session_id() == ''){session_start();}
	if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
	if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
	if($_SESSION['seller_login']==false && $_SESSION["user_login"]==false)
	{	header('Location:user_sign.php?err=login_first');	}

	include("database_connect.php");
	$query_shop='select * from seller NATURAL JOIN distance where sid='.$_GET["sid"].' and sapprove=1';
	$result_shop = mysqli_query($con,$query_shop);
	if(mysqli_num_rows($result_shop)==0)
	{
		header('Location:PNF.html');
	}
	?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>SHOPTOP- Shop</title>

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
<?php include("header.php"); ?>
<?php
$row_shop=mysqli_fetch_array($result_shop);
if($row_shop["sprofile"]=="")
	$img='images/default_profile.png';
else
	$img='profile_seller/'.$row_shop["semail"].'.'.$row_shop["sprofile"];


$rate=0;
$rate=$row_shop["srating"];
?>
	<div class="container">
<div class="col-lg-12">
            <div class="page-header">
                <h2><?php echo $row_shop["sname"]; ?></h2>
            </div>
		</div>

		

		<div class="col-md-5">
			<img class="img-responsive" src="<?php echo $img; ?>" style="width:450px; height:300px;" alt="">
		</div>


		<div class="col-md-6">
			<h4> Address: <?php echo $row_shop["saddress"]; ?></h4>
			<h4> Pin Code: <?php echo $row_shop["spincode"]; ?> </h4>
            <h4> Distance: <?php echo (int)$row_shop["dis"]; ?> KM</h4>
            <h4> E-Mail: <?php echo $row_shop["semail"]; ?></h4>
            <h4> Contact No: <?php echo $row_shop["smobile"]; ?> </h4>
			<h4> <span style="float:left;">Rating: </span> <span style="margin-top:-2px; float:left; width:120px; height:25px; background:url(images/rating_small.png) <?php echo (5-$rate)*(-25)+(4-$rate);?>px 0px;"></span> </h4>
		</div>



		<div class="col-md-3" style="margin-top:6%;float:left; clear:right;">
			<a class="btn btn-lg btn-default btn-block" href="view_seller_products.php?sid=<?php echo $row_shop["sid"];?>">View Products</a>
		</div>

<?php 
if($_SESSION["user_login"]==true)
{
	$query_approve='select rapprove from request where uid='.$_SESSION["user_id"].' and sid='.$row_shop["sid"].' and rapprove=1';
	$result_approve = mysqli_query($con,$query_approve);
	if(mysqli_num_rows($result_approve)!=0)
	{

	echo'
	<div style="float:left; clear:left; margin-top:40px; margin-left:20px;">
	<h4 style="float:left; margin-right:10px;">Rate This Shop :</h4>';
	
	$rate=0;
	$query_rate='select rate from rating where uid='.$_SESSION["user_id"].' and sid='.$row_shop["sid"].'';
	$result_rate = mysqli_query($con,$query_rate);
	if(mysqli_num_rows($result_rate)!=0)
	{
		$row_rate=mysqli_fetch_array($result_rate);
		$rate=$row_rate["rate"];
	}
	for($i=1;$i<6;$i++)
	{
		if($i<=$rate)
			$img='images/rating_YS.png';
		else
			$img='images/rating_NS.png';
		echo '<a href="rate_process.php?sid='.$row_shop["sid"].'&rate='.$i.'"><img style="float:left; margin-top:6px;" src="'.$img.'"></a>';
	}
	
	echo '</div>';
			
	}
}
?>


</div>


      <div style="margin-bottom:10%"></div>
  <?php include ("footer.php") ?>
      <script>active("shop");</script>
</body>
</html>
