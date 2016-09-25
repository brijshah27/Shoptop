<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==true || $_SESSION["user_login"]==false)
{	header('Location:PNF.html');	}

if(!isset($_GET["rate"]) && $_GET["rate"]>0 && $_GET["rate"]<6)
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");
	
	if(isset($_GET["sid"]))
	{
		$query_del='DELETE from rating where uid='.$_SESSION["user_id"].' and sid='.$_GET["sid"].'';
		$result_del = mysqli_query($con,$query_del);

		$query_rate='insert into rating (uid,sid,rate) values ('.$_SESSION["user_id"].','.$_GET["sid"].','.$_GET["rate"].')';
		$result_rate = mysqli_query($con,$query_rate);
		
		$query_rating='select AVG(rate) from rating where sid='.$_GET["sid"].'';
		$result_rating = mysqli_query($con,$query_rating);
		$row_rating=mysqli_fetch_array($result_rating);

		$query_trate='UPDATE seller SET srating='.(int)$row_rating["AVG(rate)"].' where sid='.$_GET["sid"].'';
		$result_trate = mysqli_query($con,$query_trate);
		
		header('Location:single_shop.php?sid='.$_GET["sid"].'');
	}
	else if(isset($_GET["pid"]))
	{
		$query_del='DELETE from rating where uid='.$_SESSION["user_id"].' and pid='.$_GET["pid"].'';
		$result_del = mysqli_query($con,$query_del);

		$query_rate='insert into rating (uid,pid,rate) values ('.$_SESSION["user_id"].','.$_GET["pid"].','.$_GET["rate"].')';
		$result_rate = mysqli_query($con,$query_rate);

		$query_rating='select AVG(rate) from rating where pid='.$_GET["pid"].'';
		$result_rating = mysqli_query($con,$query_rating);
		$row_rating=mysqli_fetch_array($result_rating);
		
		$query_trate='UPDATE product SET prating='.(int)$row_rating["AVG(rate)"].' where pid='.$_GET["pid"].'';
		$result_trate = mysqli_query($con,$query_trate);

		header('Location:single_product.php?pid='.$_GET["pid"].'');
	}
	else
	{	header('Location:PNF.html');	}
	

}
?>