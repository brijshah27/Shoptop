<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false || $_SESSION["user_login"]==true)
{	header('Location:PNF.html');	}

if($_POST["pname"]=="" || $_POST["pprice"]=="" || $_POST["pqty"]=="" || $_POST["pcat"]=="" || $_POST["psubcat"]=="" || $_GET["pid"]=="" )
{	header('Location:PNF.html');	}
else
{

include("database_connect.php");

$query_pid='select pid,pimage from product where pid='.$_GET["pid"].' and sid='.$_SESSION["seller_id"].'';
$result_pid = mysqli_query($con, $query_pid);
if(mysqli_num_rows($result_pid)==0)
{	header('Location:PNF.html');	}
else
{	
	$query_check = 'select pname from product where pname="'.$_POST["pname"].'" and sid='.$_SESSION["seller_id"].' and pid!='.$_GET["pid"].'';
	$result_check = mysqli_query($con, $query_check);
	if(mysqli_num_rows($result_check)!=0)
	{
		header('Location:edit_product.php?pid='.$_GET["pid"].'&err=name');
	}
	else
	{
		$row_pid=mysqli_fetch_array($result_pid);
		if($_POST["provalue"]=="1")
		{
			$photo_name=$_FILES['pimage']['name'];
			if($photo_name!=NULL)
			{
				$pos = strrpos($photo_name, '.');
				$file_extension=substr($photo_name,($pos+1));
				$file_extension=strtolower($file_extension);
		
				$photo_name=$_FILES['pimage']['tmp_name'];
				$name='product_images/'.$row_pid['pid'].'.'.$file_extension;
				if(!is_dir('product_images'))
				{
				mkdir('product_images');
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
			$file_extension=$row_pid["pimage"];
		}
		
		if($_POST["pcat"]==0)
		{
			if($_POST["pncat"]!="")
			{
				$query_ncat='insert into category (cname,superid,capprove) values ("'.$_POST["pncat"].'",0,0)';
				$result_ncat = mysqli_query($con, $query_ncat);
		
				$query_cid='select cid from category where cname="'.$_POST["pncat"].'"';
				$result_cid = mysqli_query($con,$query_cid);
				if($row_cid=mysqli_fetch_array($result_cid))
				{
					$cid=$row_cid["cid"];
					if($_POST["pnsubcat"]!="")
					{
						$query_nscat='insert into category (cname,superid,capprove) values ("'.$_POST["pnsubcat"].'",'.$row_cid["cid"].',0)';
						$result_nscat = mysqli_query($con, $query_nscat);
						
						$query_scid='select cid from category where cname="'.$_POST["pnsubcat"].'"';
						$result_scid = mysqli_query($con,$query_scid);
						if($row_scid=mysqli_fetch_array($result_scid))
							$cid=$row_scid["cid"];
					}
				}
			}
		}//if pcat==0
		else
		{
			$cid=$_POST["pcat"];
	
			if($_POST["psubcat"]!=0)
				$cid=$_POST["psubcat"];
			else
			{
				if($_POST["pnsubcat"]!="")
				{
					$query_nscat='insert into category (cname,superid,capprove) values ("'.$_POST["pnsubcat"].'",'.$_POST["pcat"].',0)';
					$result_nscat = mysqli_query($con, $query_nscat);
					
					$query_scid='select cid from category where cname="'.$_POST["pnsubcat"].'"';
					$result_scid = mysqli_query($con,$query_scid);
					if($row_scid=mysqli_fetch_array($result_scid))
						$cid=$row_scid["cid"];
				}
			}
		}//else pcat!=0
		
		
		$query = 'UPDATE product SET cid='.$cid.', pname="'.$_POST["pname"].'", pdesc="'.$_POST["pdesc"].'", pprice='.$_POST["pprice"].', pqty='.$_POST["pqty"].', pimage="'.$file_extension.'" where pid='.$_GET['pid'].'';
		$result = mysqli_query($con, $query);
			
		header('Location:single_product.php?pid='.$_GET["pid"].'');		
	}//else not error in pname
}//else right $_GET["pid"]
}//else every data is got
?>
