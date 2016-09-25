<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false || $_SESSION["user_login"]==true)
{	header('Location:PNF.html');	}

if(!isset($_GET["pid"]))
{	header('Location:PNF.html');	}

include("database_connect.php");

$query_pro='select * from product where pid="'.$_GET["pid"].'" and sid="'.$_SESSION["seller_id"].'"';
$result_pro = mysqli_query($con,$query_pro);
if(mysqli_num_rows($result_pro)==0)
{
	header('Location:PNF.html');
}
else
{
	$query_del='delete from product where pid="'.$_GET["pid"].'" and sid="'.$_SESSION["seller_id"].'"';
	$result_del = mysqli_query($con,$query_del);
	header('Location:view_products.php');
}

?>