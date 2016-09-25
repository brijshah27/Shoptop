
<!DOCTYPE html>
<html lang="en">

<head>
<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}


include("database_connect.php");

if(!isset($_GET["search"]))
{
	header('Location:PNF.html');	
}

if(!isset($_GET["redirect"])){$_GET["redirect"]='yes';}
if($_GET["redirect"]!='no')
{
	$a=0;
	$str="%";
	while($a<strlen($_GET["search"]))
	{
	$str.= $_GET["search"][$a]."%";
	$a++;
	}
	$query_sp='select * from product NATURAL JOIN category where papprove=1 and capprove=1 and (pname like "'.$str.'" OR pdesc like "'.$str.'")';
	$result_sp = mysqli_query($con,$query_sp);
	if(mysqli_num_rows($result_sp)==0)
	{
		header('location:search_shops.php?search='.$_GET["search"].'&redirect=yes');
	}
}; 
?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- Product Search</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/build.css">
    <link rel="stylesheet" href="css/search.css">

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
<?php include ('header.php');?>

<?php

echo'
<div style="width:100%;margin-left:5px;position:fixed;"><h3>Search result for "'.$_GET['search'].'"</h3></div>
';
?>
<!-- Content Row -->
        <!--<div class="row">-->
            <!-- Sidebar Column -->
          <div class="sidebar">
            <div class="col-md-2" style="position:fixed;margin-top:5%">
                <div class="list-group">
                 <div class="list-group-item" style="text-align:center;"><h4>Choose Filter</h4></div>
                <!-- Individual Category -->
                    
                    <div class="scat">
                     <a href="search_products.php?search=<?php echo $_GET["search"]; ?>" >Products</a>
                     </div>
            
                     
                    <div class="cat">
                     <a href="search_shops.php?search=<?php echo $_GET["search"]; ?>" >Shops</a>
			         </div>
					 
			
            
</div>
</div>
</div> 

 	
<!-- products Display -->

<div class="mar">
<?php
	include("database_connect.php");
	if(!isset($_GET["page"]))	{	$page=0;	}
	else
	{
		$page=$_GET["page"];
	}
	$size=9;

	$a=0;
	$str="%";
	while($a<strlen($_GET["search"]))
	{
	$str.= $_GET["search"][$a]."%";
	$a++;
	}
	$query_sp='select * from product NATURAL JOIN category where papprove=1 and capprove=1 and (pname like "'.$str.'" OR pdesc like "'.$str.'") ORDER BY prating DESC LIMIT '.($page*$size).', '.$size.'';
	$result_sp = mysqli_query($con,$query_sp);
	if(mysqli_num_rows($result_sp)==0)
	{
		echo'<h2 style="margin-top:65px;margin-left:40%;margin-bottom:380px;"><b>No Results</b></h2>';
	}
	else
	{
	while($row_sp=mysqli_fetch_array($result_sp))
	{
		
		if($row_sp["pimage"]=="")
			$img='images/700x450.png';
		else
			$img='product_images/'.$row_sp["pid"].'.'.$row_sp["pimage"];
			
			$rate=0;
			$rate=$row_sp["prating"];
			
		$query_seller ='select * from seller NATURAL JOIN distance where sid='.$row_sp["sid"].'';
		$result_seller = mysqli_query($con,$query_seller);
		$row_seller=mysqli_fetch_array($result_seller);
	
		echo'
		<a href="single_product.php?pid='.$row_sp["pid"].'">
		<div class="product">
			<img src="'.$img.'" class="proImg">
			<div class="proInfo">
				<p class="pname">'.$row_sp["pname"].'</p>
				<p class="pprice">&#8377 '.$row_sp["pprice"].'</p>
				<div class="prating"><span style="margin-top:-5px; float:left; width:120px; height:25px; background:url(images/rating_small.png) '.((5-$rate)*(-25)+(4-$rate)).'px 0px;"></span>
				</div>';
				if($_SESSION["seller_login"]==false && $_SESSION["user_login"]==false)
	{	echo'<p class="pdis">Distance: NA</p>';	}
				else
	{ echo'<p class="pdis">Distance: '.(int)$row_seller["dis"].' KM</p>';}
				echo'<p class="psname">'.$row_seller["sname"].'</p>
			</div>
			<div class="proEdit">				
				<a href="single_product.php?pid='.$row_sp["pid"].'" class="btn btn-primary" id="delBtn">View</a>
			</div>
		</div>
        </a>';
	}
	}
	?>
</div>

<?php
$query_total='select count(pid) from product NATURAL JOIN category where papprove=1 and capprove=1 and (pname like "'.$str.'" OR pdesc like "'.$str.'")';
$result_total = mysqli_query($con,$query_total);
$row_total= mysqli_fetch_array($result_total);
$last=floor($row_total["count(pid)"]/($size+1));
	

if($page!=0)
{
	echo '<a href="search_products.php?search='.$_GET["search"].'&page='.($page-1).'"><div class="prev"> <u><b>&lt; Previous</b></u></div></a>';
	echo '<a href="search_products.php?search='.$_GET["search"].'&page=0"><div class="home"> <u><b>&lt; HOME &gt;</b></u></div></a>';
}
if($page!=$last)
	echo '<a href="search_products.php?search='.$_GET["search"].'&page='.($page+1).'"><div class="next"> <u><b>Next &gt;</b></u></div></a>';

?>
<!--- products Display ends -->
<div style="clear:both;"></div>
<?php include("footer.php");?>
<script>active("products");</script>
</body>
</html>