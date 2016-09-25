<!DOCTYPE html>
<html lang="en">

<head>
<?php
	if(session_id() == ''){session_start();}
	if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
	if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
	if($_SESSION['seller_login']==false && $_SESSION["user_login"]==false)
	{	header('Location:seller_sign.php?err=login_first');	}
	
	include("database_connect.php");
	
	if(isset($_GET["sid"]))
	{
		$query_check_id='select * from seller where sid='.$_GET["sid"].' and sapprove=1';
		$result_check_id = mysqli_query($con,$query_check_id);
		if(mysqli_num_rows($result_check_id)==0)
		{	header('Location:PNF.html');	}
	}
		
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- Seller Products</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/build.css">
    <link rel="stylesheet" href="css/view_seller_products.css">

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

<script src="js/common.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">

</head>
<body>
<?php include ('header.php')?>


<?php
include("database_connect.php");
$query_name='select * from seller where sid="'.$_GET["sid"].'"';
$result_name = mysqli_query($con,$query_name);
$row_name=mysqli_fetch_array($result_name);

  ?>  
    
    <!-- products display--->
    <div class="mar" >
    
<?php
include("database_connect.php");

if(!isset($_GET["page"]))	{	$page=0;	}
else
{
	$page=$_GET["page"];
}
$size=8;

$query_ps='select * from product NATURAL JOIN category where sid='.$_GET["sid"].' and capprove=1 LIMIT '.($page*$size).', '.$size.'';
$result_ps = mysqli_query($con,$query_ps);
if(mysqli_num_rows($result_ps)==0)
{
	echo'
<div class="container" style="margin-bottom:380px;">
<div class="col-lg-11">
	<div class="page-header">
	<h3>No Products</h3>
	</div>
</div>
</div>';

}
else
{
	echo'
<div class="container">
<div class="col-lg-11">
	<div class="page-header">
	<h3>'.$row_name["sname"].'\'s Products</h3>
	</div>
</div>
</div>';

while($row_ps=mysqli_fetch_array($result_ps))
{
	if($row_ps["pimage"]=="")
		$img='images/700x450.png';
	else
		$img='product_images/'.$row_ps["pid"].'.'.$row_ps["pimage"];
		
		$rate=0;
		$rate=$row_ps["prating"];

	echo'
	<a href="single_product.php?pid='.$row_ps["pid"].'">
	<div class="product">
		<img src="'.$img.'" class="proImg">
		<div class="proInfo">
			<p class="pname">'.$row_ps["pname"].'</p>
			<p class="pprice">&#8377 '.$row_ps["pprice"].'</p>
			<div class="prating"><span style="margin-top:-5px; float:left; width:120px; height:25px; background:url(images/rating_small.png) '.((5-$rate)*(-25)+(4-$rate)).'px 0px;"></span></div>
		</div>
		<div class="proEdit">
			<a href="single_product.php?pid='.$row_ps["pid"].'" class="btn btn-primary" id="delBtn">View</a>
		</div>
	</div>
	</a>';
}
}
?>
    </div>

<?php
$query_total='select count(pid) from product NATURAL JOIN category where sid='.$_GET["sid"].' and capprove=1';
$result_total = mysqli_query($con,$query_total);
$row_total= mysqli_fetch_array($result_total);
$last=floor($row_total["count(pid)"]/($size+1));
if($page!=0)
{
	echo '<a href="view_seller_products.php?sid='.$_GET["sid"].'&page='.($page-1).'"><div class="prev"> <u><b>&lt; Previous</b></u></div></a>';
	echo '<a href="view_seller_products.php?sid='.$_GET["sid"].'&page=0"><div class="home"> <u><b>&lt; HOME &gt;</b></u></div></a>';
}
if($page!=$last)
	echo '<a href="view_seller_products.php?sid='.$_GET["sid"].'&page='.($page+1).'"><div class="next"> <u><b>Next &gt;</b></u></div></a>';

?>
<!--- products Display ends -->
<div style="clear:both;"></div>
<?php include("footer.php");?>
<script>active("products");</script>
</body>
</html>