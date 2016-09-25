<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['danger']))){$_SESSION["danger"]=false;}
if($_SESSION['danger']==false)
{	header('Location:PNF.html');	}

include("database_connect.php");

if(isset($_GET["super"]) && isset($_GET["sub"]) && isset($_GET["approve"]))
{
	if($_GET["approve"]=='y')
	{
		if($_POST["superName"]!="")
			$add=', cname="'.$_POST["superName"].'"';
		else
			$add='';
		$query_update='UPDATE category SET capprove=1 '.$add.' where cid='.$_GET["super"].'';
		$result_update = mysqli_query($con, $query_update);

		if($_GET["sub"]!=-1)
		{
			if($_POST["subName"]!="")
				$add=', cname="'.$_POST["subName"].'"';
			else
				$add='';

			$query_update='UPDATE category SET capprove=1 '.$add.' where cid='.$_GET["sub"].'';
			$result_update = mysqli_query($con, $query_update);
		}
		header('Location:admin_category.php');		
	}
	else if($_GET["approve"]=='n')
	{
		
		$query_check_del='select cid from category where cid='.$_GET["super"].' and capprove=0';
		$result_check_del = mysqli_query($con, $query_check_del);
		if(mysqli_num_rows($result_check_del)==1)
		{
			$query_del='DELETE from category where cid='.$_GET["super"].' or superid='.$_GET["super"].'';
			$result_del = mysqli_query($con, $query_del);
		}


		if($_GET["sub"]!=-1)
		{
			$query_del='DELETE from category where cid='.$_GET["sub"].' and capprove=0';
			$result_del = mysqli_query($con, $query_del);
		}
		header('Location:admin_category.php');
	}
	else
	{
		header('Location:PNF.html');
	}
}
else if(isset($_GET["allcat"]))
{
	if($_GET["allcat"]=='y')
	{
		$query_update='UPDATE category SET capprove=1';
		$result_update = mysqli_query($con, $query_update);
		header('Location:admin_category.php');		
	}
	else if($_GET["allcat"]=='n')
	{
		$query_del='DELETE from category where capprove=0';
		$result_del = mysqli_query($con, $query_del);
		header('Location:admin_category.php');		
	}
	else
	{
		header('Location:PNF.html');
	}
}
else if(isset($_GET["sid"]) && isset($_GET["approve"]))
{
	if($_GET["approve"]=='y')
	{
		$query_update='UPDATE seller SET sapprove=1 where sid='.$_GET["sid"].'';
		$result_update = mysqli_query($con, $query_update);
		
		$query_update='UPDATE product SET papprove=1 where sid='.$_GET["sid"].'';
		$result_update = mysqli_query($con, $query_update);
		
		header('Location:admin_seller.php');
	}
	else if($_GET["approve"]=='n')
	{
		$query_del='DELETE from seller where sid='.$_GET["sid"].'';
		$result_del = mysqli_query($con, $query_del);
		
		$query_del_pro='DELETE from product where sid='.$_GET["sid"].'';
		$result_del_pro = mysqli_query($con, $query_del_pro);

		header('Location:admin_seller.php');
	}
	else
	{
		header('Location:PNF.html');
	}
}
else if(isset($_GET["allseller"]))
{
	if($_GET["allseller"]=='y')
	{
		$query_update='UPDATE seller SET sapprove=1';
		$result_update = mysqli_query($con, $query_update);
		
		$query_update='UPDATE product SET papprove=1';
		$result_update = mysqli_query($con, $query_update);
		
		header('Location:admin_seller.php');
	}
	else if($_GET["allseller"]=='n')
	{
		$query_del='DELETE from seller where sapprove=0';
		$result_del = mysqli_query($con, $query_del);
		
		$query_del_pro='DELETE from product where papprove=0';
		$result_del_pro = mysqli_query($con, $query_del_pro);

		header('Location:admin_seller.php');
	}
	else
	{
		header('Location:PNF.html');
	}
}
else
{
	header('Location:PNF.html');
}
	

?>
