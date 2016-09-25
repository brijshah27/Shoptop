<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false && $_SESSION["user_login"]==false)
{	header('Location:PNF.html');	}

if(!isset($_GET["rid"]))
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");
	
	$query_check='select pid from request where rid='.$_GET["rid"].'';
	$result_check = mysqli_query($con,$query_check);
	if(mysqli_num_rows($result_check)==0)
	{
		header('Location:PNF.html');
	}
	else
	{
		$row_check=mysqli_fetch_array($result_check);
		
		if($_SESSION["user_login"])
		{
			$check='uid='.$_SESSION["user_id"];
			if(isset($_GET["link"]) && $_GET["link"]=="req")
				$header='view_requests_user.php';
			else
				$header='single_product.php?pid='.$row_check["pid"];
		}
		else
		{
			$check='sid='.$_SESSION["seller_id"];
			$header='view_requests.php';
		}
		$query_rqst='delete from request where '.$check.' and rid='.$_GET["rid"].'';
		$result_rqst = mysqli_query($con,$query_rqst);
		header('Location:'.$header);
	}
}
?>