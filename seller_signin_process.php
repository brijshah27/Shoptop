<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false && $_SESSION["user_login"]==false)
{
	if(!isset($_POST["email_log"]) || !isset($_POST["password_log"]))
	{	header('Location:PNF.html');	}
	else
	{
		setcookie("semail",$_POST["email_log"],time()+60*60*24*30);
		include('Enc.php');
		include('database_connect.php');
	
		$query = 'select * from seller where semail="'.$_POST["email_log"].'"';
		$result = mysqli_query($con, $query);
		if(mysqli_num_rows($result)==0) //For Wrong Mail ID
		{
			header('Location:seller_sign.php?err=login_email');
		}
		else if(mysqli_num_rows($result)==1)
		{
		$row = mysqli_fetch_array($result);
		echo $query;	

			$pass=add_num($_POST["password_log"]);
			if($row["spass"]==$pass)  //For Both is Right
			{
				$_SESSION['seller_login']=true;
				$_SESSION['seller_id']=$row["sid"];
				include("make_distance_table.php");
				header('Location:seller_profile.php?msg=success');
			}
			else //For Password is Wrong
			{
			header('Location:seller_sign.php?err=login_pass');
			}
		}
	}
}//login process
else
{
	$_SESSION['seller_login']=false;
	unset($_SESSION['seller_id']);
	$_SESSION['distance']=false;
	header('Location:seller_sign.php?msg=logout'); 
}//logout process
?>