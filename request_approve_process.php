<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false || $_SESSION["user_login"]==true)
{	header('Location:PNF.html');	}

if(!isset($_GET["rid"]))
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");
	
	$query_approve='UPDATE request SET rapprove=1 where rid='.$_GET["rid"].' and sid='.$_SESSION["seller_id"].'';
	$result_approve = mysqli_query($con,$query_approve);
	header('Location:view_requests.php');
}
?>