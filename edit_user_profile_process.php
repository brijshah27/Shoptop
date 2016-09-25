<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_POST["username"]==""  || $_POST["mobile"]=="" || $_POST["address"]=="" || $_POST["pincode"]=="" || $_POST["provalue"]=="" || $_SESSION["user_login"]==false )
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");

	$query_seller='select uemail,uprofile from user where uid="'.$_SESSION["user_id"].'"';
	$result_seller=mysqli_query($con,$query_seller);
	$row_seller=mysqli_fetch_array($result_seller);

	if($_POST["provalue"]=="1")
	{
		$photo_name=$_FILES['profile_user']['name'];
		if($photo_name!=NULL)
		{
			$pos = strrpos($photo_name, '.');
			$file_extension=substr($photo_name,($pos+1));
			$file_extension=strtolower($file_extension);

			$photo_name=$_FILES['profile_user']['tmp_name'];
			$name='profile_user/'.$row_seller["uemail"].'.'.$file_extension;
			if(!is_dir('profile_user'))
			{
			mkdir('profile_user');
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
		$file_extension=$row_seller["uprofile"];
	}

	if($_POST["password"]=="")
	{
		$query = 'UPDATE seller SET uname="'.$_POST["username"].'", umobile="'.$_POST["mobile"].'", uaddress="'.$_POST["address"].'", upincode="'.$_POST["pincode"].'", uprofile="'.$file_extension.'" where uid="'.$_SESSION['user_id'].'"';
	}
	else
	{
		include('Enc.php');
		$pass=add_num($_POST["password"]);
		$query = 'UPDATE seller SET uname="'.$_POST["username"].'", umobile="'.$_POST["mobile"].'", upass="'.$pass.'", uaddress="'.$_POST["address"].'", upincode="'.$_POST["pincode"].'", uprofile="'.$file_extension.'" where uid="'.$_SESSION['user_id'].'"';

	}

	$result = mysqli_query($con, $query);

	header('Location:user_profile.php?msg=success');
}
?>
