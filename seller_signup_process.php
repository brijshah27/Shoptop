<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_POST["username"]=="" || $_POST["email"]=="" || $_POST["mobile"]=="" || $_POST["password"]=="" || $_POST["address"]=="" || $_POST["pincode"]=="" || $_SESSION["seller_login"] || $_SESSION["user_login"])
{	header('Location:PNF.html');	}
else
{
	include("database_connect.php");

	$mail_query='select * from seller where semail="'.$_POST["email"].'"';
	$mail_result=mysqli_query($con,$mail_query);

	if(mysqli_num_rows($mail_result)==0)
	{

		$photo_name=$_FILES['profile_seller']['name'];
		if($photo_name!=NULL)
		{
			$pos = strrpos($photo_name, '.');
			$file_extension=substr($photo_name,($pos+1));
			$file_extension=strtolower($file_extension);

			$photo_name=$_FILES['profile_seller']['tmp_name'];
			$name='profile_seller/'.$_POST['email'].'.'.$file_extension;
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

		include('Enc.php');
		$pass=add_num($_POST["password"]);

		$query = 'insert into seller (sname,semail,smobile,spass,saddress,spincode,sprofile) values("'.$_POST["username"].'","'.$_POST["email"].'",'.$_POST["mobile"].',"'.$pass.'","'.$_POST["address"].'","'.$_POST["pincode"].'","'.$file_extension.'")';
		$result = mysqli_query($con, $query);

		$query_login='select sid from seller where semail="'.$_POST["email"].'"';
		$result_login = mysqli_query($con,$query_login);
		$row_login=mysqli_fetch_array($result_login);


		$_SESSION['seller_login']=true;
		$_SESSION['seller_id']=$row_login["sid"];

		header('Location:seller_profile.php?msg=success');
	}
	else
	{
		header('Location:seller_sign.php?err=signup_email');

	}
}
?>
