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
		setcookie("uemail",$_POST["email_log"],time()+60*60*24*30);
		include('Enc.php');
		include('database_connect.php');
	
		$query = 'select * from user where uemail="'.$_POST["email_log"].'"';
		$result = mysqli_query($con, $query);
		$row = mysqli_fetch_array($result);	
		if(mysqli_num_rows($result)==0) //For Wrong Mail ID
		{
			header('Location:user_sign.php?err=login_email');
		}
		else if(mysqli_num_rows($result)==1)
		{
			$pass=add_num($_POST["password_log"]);
			if($row["upass"]==$pass)  //For Both is Right
			{
				$_SESSION['user_login']=true;
				$_SESSION['user_id']=$row["uid"];
				include("make_distance_table.php");
				header('Location:user_profile.php?msg=success');
			}
			else //For Password is Wrong
			{
			header('Location:user_sign.php?err=login_pass');
			}
		}
	}
}//login process
else
{
	$_SESSION['user_login']=false;
	unset($_SESSION['user_id']);
	$_SESSION['distance']=false;
	header('Location:user_sign.php?msg=logout'); 
}//logout process
?>