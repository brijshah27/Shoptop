<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	if(session_id() == ''){session_start();}
	if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
	if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
	

	include("database_connect.php");

	if(isset($_GET["cid"]))
	{
		$query_check_cat='select * from category where cid='.$_GET["cid"].' and superid=0 and capprove=1';
		$result_check_cat = mysqli_query($con,$query_check_cat);
		if(mysqli_num_rows($result_check_cat)==0)
		{	header('Location:PNF.html');	}
		else
		{
			$sub=-1;
			$cid=$_GET["cid"];
		}
	}
	else if(isset($_GET["sub"]))	
	{
		$query_check_sub='select * from category where cid='.$_GET["sub"].' and superid!=0 and capprove=1';
		$result_check_sub = mysqli_query($con,$query_check_sub);
		if(mysqli_num_rows($result_check_sub)==0)
		{	header('Location:PNF.html');	}
		else
		{
			$row_check_sub=mysqli_fetch_array($result_check_sub);
			$sub=$_GET["sub"];
			$cid=$row_check_sub["superid"];
		}
	}
	else
	{
		$sub=-1;
		$cid=-1;
	}
	?>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- All Products</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/build.css">
    <link rel="stylesheet" href="css/all_products_page.css">

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
<!-- Content Row -->
        <!--<div class="row">-->
            <!-- Sidebar Column -->
<div class="sidebar">
	<div class="col-md-2">
    	<div class="list-group">
     	
        <div class="list-group-item">
        	<h4>Choose Category</h4>
        </div>

<?php
$query_cat='select * from category where superid=0 and capprove=1';
$result_cat = mysqli_query($con,$query_cat);
while($row_cat=mysqli_fetch_array($result_cat))
{
	if($cid==-1)
	{
		$cid=$row_cat["cid"];
		$catClass='scat';
	}
	else if($cid==$row_cat["cid"])
		$catClass='scat';
	else
		$catClass='cat';
	echo '
	<div class="'.$catClass.'">
		<a href="all_products.php?cid='.$row_cat["cid"].'">'.$row_cat["cname"].'</a>
	</div>';
}
?>
		</div>
	</div>
</div> 

 		<!-- sub category Display--->
<div style=" margin-left:1%; margin-top:1%;background-color:#e5e5e5; padding:0px 20px 10px; width:80%; float:left;">

<?php 
$query_sub='select * from category where superid='.$cid.' and capprove=1';
$result_sub = mysqli_query($con,$query_sub);
while($row_sub=mysqli_fetch_array($result_sub))
{
	if($sub==-1)
	{
		$sub=$row_sub["cid"];
		$subClass='ssub';
	}
	else if($sub==$row_sub["cid"])
		$subClass='ssub';
	else
		$subClass='sub';
	echo'
		<div class="'.$subClass.'">
			<a href="all_products.php?sub='.$row_sub["cid"].'"> <button class="btn btn-primary" id="Btn">'.$row_sub["cname"].'</button></a>
		</div>';
}
?>
          
</div>

<!-- sub category ends --->

<!-- products Display -->
<div class="mar" >
<?php


if(!isset($_GET["page"]))	{	$page=0;	}
else
{
	$page=$_GET["page"];
}
$size=9;

$query_pro='select * from product NATURAL JOIN distance where cid='.$sub.' and papprove=1 ORDER BY dis LIMIT '.($page*$size).', '.$size.'';
$result_pro = mysqli_query($con,$query_pro);
if(mysqli_num_rows($result_pro)==0)
{	echo '<div style="margin-left:20px;margin-bottom:350px;"><h3><b>Products not available</b></h3></div>';	}
	
while($row_pro=mysqli_fetch_array($result_pro))
{
if($row_pro["pimage"]=="")
	$img='images/700x450.png';
else
	$img='product_images/'.$row_pro["pid"].'.'.$row_pro["pimage"];

$rate=0;
$rate=$row_pro["prating"];

$query_sname='select sname from seller where sid='.$row_pro["sid"].'';
$result_sname = mysqli_query($con,$query_sname);
$row_sname =mysqli_fetch_array($result_sname);

echo '
	<a href="single_product.php?pid='.$row_pro["pid"].'">
		<div class="product">
			<img src="'.$img.'" class="proImg" />
			<div class="proInfo">
				<p class="pname">'.$row_pro["pname"].'</p>
				<p class="pprice">&#8377 '.$row_pro["pprice"].'</p>
				<div class="prating"><span style="margin-top:-5px; float:left; width:120px; height:25px; background:url(images/rating_small.png) '.((5-$rate)*(-25)+(4-$rate)).'px 0px;"></span></div>';
				if($_SESSION["seller_login"]==false && $_SESSION["user_login"]==false)
			{echo'<p class="pdis">Distance: NA</p>';}
			else
			{	echo'<p class="pdis">Distance: '.(int)$row_pro["dis"].' KM</p>'; }
			
				echo'<p class="psname">'.$row_sname["sname"].'</p>
				
			</div>
			<div class="proEdit">
				<a href="single_product.php?pid='.$row_pro["pid"].'" class="btn btn-primary" id="delBtn">View</a>
			</div>
		</div>
	</a>';
}

echo '</div>';

$query_total='select count(pid) from product where cid='.$sub.' and papprove=1';
$result_total = mysqli_query($con,$query_total);
$row_total= mysqli_fetch_array($result_total);
$last=floor($row_total["count(pid)"]/($size+1));
if($page!=0)
{
	echo '<a href="all_products.php?sub='.$sub.'&page='.($page-1).'"><div class="prev"> <u><b>&lt; Previous</b></u></div></a>';
	echo '<a href="all_products.php?sub='.$sub.'&page=0"><div class="home"> <u><b>&lt; HOME &gt;</b></u></div></a>';
}
if($page!=$last)
	echo '<a href="all_products.php?sub='.$sub.'&page='.($page+1).'"><div class="next"> <u><b>Next &gt;</b></u></div></a>';

?>

<!--- products Display ends -->
<div style="clear:both;"></div>
<?php include("footer.php");?>
<script>active("products");</script>
</body>
</html>
