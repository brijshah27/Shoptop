<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false && $_SESSION["user_login"]==false)
{	header('Location:PNF.html');	}

if(!(isset($_SESSION['distance']))){$_SESSION["distance"]=false;}
if($_SESSION["distance"]==false)
{
include("database_connect.php");
include("distance.php");

if($_SESSION["seller_login"])
{
	$query_pin='select spincode from seller where sid='.$_SESSION["seller_id"].'';
	$result_pin = mysqli_query($con,$query_pin);
	$row_pin=mysqli_fetch_array($result_pin);
	$pincode1=$row_pin["spincode"];
}
else
{
	$query_pin='select upincode from user where uid='.$_SESSION["user_id"].'';
	$result_pin = mysqli_query($con,$query_pin);
	$row_pin=mysqli_fetch_array($result_pin);
	$pincode1=$row_pin["upincode"];
}


$query_truncate='TRUNCATE TABLE distance';
$result_truncate = mysqli_query($con,$query_truncate);

$query_sellers='select sid,spincode from seller GROUP BY sid';
$result_sellers = mysqli_query($con,$query_sellers);
while($row_sellers=mysqli_fetch_array($result_sellers))
{
	$dis=distance($pincode1,$row_sellers["spincode"]);
//	echo "sid: ".$row_sellers["sid"]." dis:".$dis."<br />";
	$query_ins_dis='insert into distance (sid,dis) values('.$row_sellers["sid"].','.$dis.')';
	$result_ins_dis = mysqli_query($con,$query_ins_dis);
}
$_SESSION["distance"]=true;
}
?>