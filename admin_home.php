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
<title>SHOPTOP- ADMIN</title>
<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    
    

<script src="js/bootstrap.min.js"></script>

<style>


body
{
 color:#222;
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
	margin-left:20%;
	margin-top:50px;
	margin-right:10%;
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
<a href="Danger_Process.php" id="admin_out">Admin Out</a>
	
</body>
</html>