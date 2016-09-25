<!DOCTYPE html>
<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['danger']))){$_SESSION["danger"]=false;}
if($_SESSION['danger']==false)
{	header('Location:PNF.html');	}
?>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<title>ADMIN- Seller Requests</title>
<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    
    

<script src="js/bootstrap.min.js"></script>

<style>
.apporve
{
 text-decoration:none;
 padding:2px 10px;
 
}
.apporve:hover
{
 background-color:#008000;
 color:#FFF;
 cursor:pointer;
}
.del
{
 text-decoration:none;
 padding:2px 10px;
}
.del:hover
{
 background-color:#F00;
 color:#FFF;
 cursor:pointer;
}
.del_all
{
 text-decoration:none;
 color:#FFF;
}
.del_all:hover
{
 color:#000;
}
input ,select
{
 padding:5px 5px;
 font-size:14px;
 font-family:"Comic Sans MS", cursive;
 color:#06F;
 border:1px solid #AAA;
}
body
{
 color:#222;
}
span
{
 color:#333;
}
.button:hover
{
cursor:pointer;
border:1px solid #000;
color:#000;
}
table tr th
{
	text-align:center;
 font-size:20px;
 font-family:"Comic Sans MS", cursive;
 font-weight:normal;
 padding:5px 10px;
 background-color:#222;
 color:#FFF;
}
table tr td
{
	text-align:center;
}
#approve_all
{
	margin-left:40%;
	margin-top:25px;
	width:10%;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	color:#FFF;
	background-color:#008000;
}


#delete_all
{
	margin-right:20%;
	margin-top:25px;
	width:10%;
	font-family:Gotham, "Helvetica Neue", Helvetica, Arial, sans-serif;
	color:#FFF;
	background-color:#F00;
}
#admin_out
{
 text-decoration:none;
 cursor:pointer;
 background-color:#06F;
 color:#FFF;
 padding:3px 10px;
 font-family:"Comic Sans MS", cursive;
 position:absolute;
 top:10px;
 right:30px;
}
#admin_out:hover
{
 background-color:#FFF;
 color:#06F;
}
.category
{
	text-decoration:none;
	 cursor:pointer;
	 padding:3px 10px;
	 background-color:#06F;
	 color:#FFF;
	 font-family:"Comic Sans MS", cursive;
	float:left;
	margin-left:19%;
	margin-top:50px;
	margin-right:30%;
}

.seller
{
	text-decoration:none;
	 cursor:pointer;
	 padding:3px 10px 3px;
	 background-color:#06F;
	 color:#FFF;
	 font-family:"Comic Sans MS", cursive;
	float:left;
	margin-top:50px;
}
.category:hover
{
	background-color:#FFF;
 color:#06F;
}
.seller:hover
{
	background-color:#FFF;
 color:#06F;
}
</style>
</head>
<body>
<a href="admin_category.php"><h3 class="category">Category Requests</h3></a>
<a href="admin_seller.php"><h3 class="seller">Seller Requests</h3></a>
<a href="approve_process.php?allseller=y" id="approve_all" class="btn btn-primary">Approve All</a>
<a href="approve_process.php?allseller=n" id="delete_all" class="btn btn-primary">Delete All</a>
<a href="Danger_Process.php" id="admin_out">Admin Out</a>
	<table style="margin-top:50px;" border="2px solid black;" align="center">
            <tr>
                <th width="250px;">Name</th>
                <th width="250px;">Address</th>
                <th width="250px;">E-mail</th>
                <th width="250px;">Contact No:</th>
                <th width="100px;">Approve/Delete</th>
             </tr>
             
            <?php
			include("database_connect.php");
		
			$query_seller='select * from seller where sapprove=0';
			$result_seller = mysqli_query($con, $query_seller);
			while($row_seller=mysqli_fetch_array($result_seller))
			{
			echo'
			<tr>
                <td width="300px;">'.$row_seller["sname"].'</td>
                <td width="300px;">'.$row_seller["saddress"].'</td>
                <td width="300px;">'.$row_seller["semail"].'</td>
                <td width="300px;">'.$row_seller["smobile"].'</td>
                <td width="100px;">
				<a href="approve_process.php?approve=n&sid='.$row_seller["sid"].'" class="del">&#x2716;</a>&nbsp;
				<a href="approve_process.php?approve=y&sid='.$row_seller["sid"].'" class="apporve">&#10004;</a>
				</td>
            </tr>';
			}
			?>
    </table>
</body>
</html>