<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_POST["username"]==""  || $_POST["mobile"]=="" || $_POST["address"]=="" || $_POST["pincode"]=="" || $_POST["provalue"]=="" || $_SESSION["seller_login"]==false )
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");
	
	$query_seller='select semail,sprofile from seller where sid="'.$_SESSION["seller_id"].'"';
	$result_seller=mysqli_query($con,$query_seller);
	$row_seller=mysqli_fetch_array($result_seller);	
	
	if($_POST["provalue"]=="1")
	{
		$photo_name=$_FILES['profile_seller']['name'];
		if($photo_name!=NULL)
		{
			$pos = strrpos($photo_name, '.');
			$file_extension=substr($photo_name,($pos+1));
			$file_extension=strtolower($file_extension);
			
			$photo_name=$_FILES['profile_seller']['tmp_name'];
			$name='profile_seller/'.$row_seller["semail"].'.'.$file_extension;
			if(!is_dir('profile_seller'))
			{
			mkdir('profile_seller');
			}
			move_uploaded_file($photo_name,$name);
		}
		else
		{
		 $file_extension="";
		}
	}
	else
	{
		$file_extension=$row_seller["sprofile"];
	}
	
	if($_POST["password"]=="")
	{
		$query = 'UPDATE seller SET sname="'.$_POST["username"].'", smobile="'.$_POST["mobile"].'", saddress="'.$_POST["address"].'", spincode="'.$_POST["pincode"].'", sprofile="'.$file_extension.'" where sid="'.$_SESSION['seller_id'].'"';
	}
	else
	{
		include('Enc.php');
		$pass=add_num($_POST["password"]);
		$query = 'UPDATE seller SET sname="'.$_POST["username"].'", smobile="'.$_POST["mobile"].'", spass="'.$pass.'", saddress="'.$_POST["address"].'", spincode="'.$_POST["pincode"].'", sprofile="'.$file_extension.'" where sid="'.$_SESSION['seller_id'].'"';

	}
		
	$result = mysqli_query($con, $query);
		
	header('Location:seller_profile.php?msg=success');
}
?>