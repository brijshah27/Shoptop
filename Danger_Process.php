<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['danger']))){$_SESSION["danger"]=false;}

if($_SESSION['danger']==false && isset($_POST["admin"]))
{
	include('Enc.php');
	include("database_connect.php");

	$query = 'select * from admin';
	$result = mysqli_query($con, $query);
	$row = mysqli_fetch_array($result);	
	
	$pass=add_num($_POST["admin"]);
	if(file_exists($pass.".txt")==1)
	{
		$_SESSION['danger']=true;
		header('Location:admin_home.php');
	}
	else
	{
		header('Location:admin.php');
	}
}
else
{
	$_SESSION['danger']=false;
	header('Location:index.php'); 
}
?>