<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==true || $_SESSION["user_login"]==false)
{	header('Location:PNF.html');	}

if(!isset($_GET["pid"]))
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");
	
	$query_pro='select sid from product where pid='.$_GET["pid"].'';
	$result_pro = mysqli_query($con,$query_pro);
	if(mysqli_num_rows($result_pro)==0)
	{
		header('Location:PNF.html');
	}
	else
	{
		$row_pro=mysqli_fetch_array($result_pro);
		$query_rqst='insert into request (uid,pid,sid) values('.$_SESSION["user_id"].','.$_GET["pid"].','.$row_pro["sid"].')';
		$result_rqst = mysqli_query($con,$query_rqst);
		header('Location:single_product.php?pid='.$_GET["pid"].'');
	}
}
?>