<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false && $_SESSION["user_login"]==false)
{	header('Location:PNF.html');	}

if(!isset($_GET["pid"]) || $_POST["comment"]=="")
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");
	
	$query_pro='select * from product where pid="'.$_GET["pid"].'"';
	$result_pro = mysqli_query($con,$query_pro);
	if(mysqli_num_rows($result_pro)==0)
	{
		header('Location:PNF.html');
	}
	else
	{
		if($_SESSION["seller_login"])
		{
			$uos=1;	//1 for seller
			$usid=$_SESSION["seller_id"];
		}
		else
		{
			$uos=0;	//0 for user		
			$usid=$_SESSION["user_id"];
		}
		
		$query_cmnt='insert into comment (pid,usid,cmnt,uos) values('.$_GET["pid"].','.$usid.',"'.$_POST["comment"].'",'.$uos.')';
		$result_cmnt = mysqli_query($con,$query_cmnt);
		header('Location:single_product.php?pid='.$_GET["pid"].'');
	}
}
?>