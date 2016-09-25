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
	$query_pro='select * from product NATURAL JOIN category NATURAL JOIN distance where pid="'.$_GET["pid"].'" and papprove=1 and capprove=1';
	$result_pro = mysqli_query($con,$query_pro);
	if(mysqli_num_rows($result_pro)==0)
	{
		header('Location:PNF.html');
	}
	?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>SHOPTOP- Product</title>

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

	<script>
    function commentCheck()
	{
		var flag=true;
		var x= document.getElementById("comment");
		if(x.value=="")
		{	
			flag=false;
			x.style.border="2px solid #000";
		}
		else
		{
			x.style.border="1px solid #CCC";
		}
		return flag;
	}
    </script>
	
</head>

<body>

<?php include("header.php"); ?>

<?php
$row_pro=mysqli_fetch_array($result_pro);
if($row_pro["pimage"]=="")
	$img='images/700x450.png';
else
	$img='product_images/'.$row_pro["pid"].'.'.$row_pro["pimage"];

$query_seller='select sname from seller where sid="'.$row_pro["sid"].'"';
$result_seller = mysqli_query($con,$query_seller);
$row_seller=mysqli_fetch_array($result_seller);
$rate=0;
$rate=$row_pro["prating"];
?>
<div class="container">

		<div class="col-lg-12">
            <div class="page-header">
                <h2><?php echo $row_pro["pname"]; ?></h2>
                <a href="single_shop.php?sid=<?php echo $row_pro["sid"];?>"><h4> Seller: <?php echo $row_seller["sname"]; ?></h4></a>
            </div>
		</div>

		<div class="col-md-5">
			<img class="img-responsive" src="<?php echo $img; ?>" style="width:450px; height:300px;" alt="">
		</div>


		<div class="col-md-6">
			<h4> Product Description: <?php echo $row_pro["pdesc"]; ?></h4>
			<h4> Price: &#8377 <?php echo $row_pro["pprice"]; ?></h4>
			<h4> Quantity: <?php echo $row_pro["pqty"]; ?></h4>
            <h4> Distance: <?php echo (int)$row_pro["dis"]; ?> KM</h4>
			<h4> <span style="float:left;">Rating: </span> <span style="margin-top:-2px; float:left; width:120px; height:25px; background:url(images/rating_small.png) <?php echo (5-$rate)*(-25)+(4-$rate);?>px 0px;"></span></h4>
		</div>


<?php
	if($_SESSION["user_login"]==true)
	{
		$query_rqst='select * from request where uid='.$_SESSION["user_id"].' and pid='.$_GET["pid"].'';
		$result_rqst = mysqli_query($con,$query_rqst);
		if(mysqli_num_rows($result_rqst)==1)
		{
			$row_rqst=mysqli_fetch_array($result_rqst);
			$blink='del_request_process.php?rid='.$row_rqst["rid"];
			$bname='Requested';
		}
		else
		{
			$blink='add_request_process.php?pid='.$_GET["pid"];
			$bname='Request Delivery';
		}
		echo'
		<div class="col-md-3" style="margin-top:11%;float:left; clear:right;">
			<a class="btn btn-lg btn-default btn-block" href="'.$blink.'">'.$bname.'</a>
		</div>';
	}
	else if($_SESSION["seller_id"]==$row_pro["sid"])
	{
	echo '
	<div style="float:left;margin-top:10%;">
		<a href="edit_product.php?pid='.$row_pro["pid"].'" style="background-color:#F00; margin-left:10px; border:0px;" class="btn btn-primary" id="editBtn">Edit Product</a>
		<a href="del_product.php?pid='.$row_pro["pid"].'" style="background-color:#00F; margin-left:20px; border:0px;" class="btn btn-primary" id="delBtn">Delete Product</a>
	</div>';
	}
?>
<?php 
if($_SESSION["user_login"]==true)
{
	$query_approve='select rapprove from request where uid='.$_SESSION["user_id"].' and pid='.$row_pro["pid"].' and rapprove=1';
	$result_approve = mysqli_query($con,$query_approve);
	if(mysqli_num_rows($result_approve)!=0)
	{

	echo'
	<div style="float:left; clear:left; margin-top:40px; margin-left:20px;">
	<h4 style="float:left; margin-right:10px;">Rate This Product :</h4>';
	
	$rate=0;
	$query_rate='select rate from rating where uid='.$_SESSION["user_id"].' and pid='.$row_pro["pid"].'';
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
		echo '<a href="rate_process.php?pid='.$row_pro["pid"].'&rate='.$i.'"><img style="float:left; margin-top:6px;" src="'.$img.'"></a>';
	}
	
	echo '</div>';
			
	}
}
?>

</div>


<div class="container">

    <div class="col-lg-11">
        <div class="page-header">
        <h3>Comments:</h3>
        </div>
    </div>

    <div style="margin-left:6%; margin-right:5%;margin-top:10%;width:79.5%;">
        <div class="well">
            <h4>Leave a Comment:</h4>
            <form action="add_comment_process.php?pid=<?php echo $_GET["pid"];?>" method="post" onSubmit="return commentCheck()">
                <div class="form-group">
                <textarea class="form-control" rows="3" id="comment" name="comment" value=""></textarea>
                </div>
	            <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

</div>

<?php
$query_cmnt='select * from comment where pid='.$_GET["pid"].' ORDER BY cmid DESC';
$result_cmnt = mysqli_query($con,$query_cmnt);
while($row_cmnt=mysqli_fetch_array($result_cmnt))
{
	if($row_cmnt["uos"]==0)
	{
		$query_usid='select uemail,uname,uprofile from user where uid='.$row_cmnt["usid"].'';
		$result_usid = mysqli_query($con,$query_usid);
		$row_usid=mysqli_fetch_array($result_usid);

		$link='';
		$usname=$row_usid["uname"];
		if($row_usid["uprofile"]!="")
			$usprofile='profile_user/'.$row_usid["uemail"].'.'.$row_usid["uprofile"];
		else
			$usprofile="images/default_profile.png";
	}
	else
	{
		$query_usid='select semail,sname,sprofile from seller where sid='.$row_cmnt["usid"].'';
		$result_usid = mysqli_query($con,$query_usid);
		$row_usid=mysqli_fetch_array($result_usid);

		$link='href="single_shop.php?sid='.$row_cmnt["usid"].'"';
		$usname=$row_usid["sname"];
		if($row_usid["sprofile"]!="")
			$usprofile='profile_seller/'.$row_usid["semail"].'.'.$row_usid["sprofile"];
		else
			$usprofile="images/default_profile.png";
	}
	
	echo '
	<div class="container">
		<div style="margin-left:6%; margin-top:30px;width:79.5%; padding-bottom:11px; float:left; background-color:#f5f5f5;">
			<img style="height:50px;width:50px;margin-left:10px;margin-top:10px;float:left;" src="'.$usprofile.'">
	
			<div style="float:left;margin-left:1%;margin-top:10px;">
				<a '.$link.' style="color:#2e6da4; font-size:20px;">'.$usname.'</a>
				<p style="margin:4px 0px 0px 0px;">'.$row_cmnt["cmnt"].'</p>
			</div>				
		</div>
	</div>';
}
?>



<div style="margin-top:150px"></div>
<?php include ("footer.php"); ?>
<script>active("products");</script>
</body>
</html>
