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
<title>ADMIN- Category Requests</title>
<!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    
    

<script src="js/bootstrap.min.js"></script>

<style>
.apporve
{
 padding:2px 10px;
 color:#337ab7;
 background-color:#FFF;
 border:0px;
}
.apporve:hover
{
 text-decoration:underline;
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
<a href="approve_process.php?allcat=y" id="approve_all" class="btn btn-primary">Approve All</a>
<a href="approve_process.php?allcat=n" id="delete_all" class="btn btn-primary">Delete All</a>
<a href="Danger_Process.php" id="admin_out">Admin Out</a>
	<table style="margin-top:50px;" border="2px solid black;" align="center">
            <tr>
                <th width="250px;">Category Request</th>
                <th width="250px;">Edit Category</th>
                <th width="250px;">Subcategory Request</th>
                <th width="250px;">Edit Subcategory</th>
                <th width="100px;">Approve/Delete</th>
             </tr>
             
            <?php
			include("database_connect.php");
		
			$query_cat='select * from category where capprove=0';
			$result_cat = mysqli_query($con, $query_cat);
			while($row_cat=mysqli_fetch_array($result_cat))
			{
			if($row_cat["superid"]!=0)
			{
				$query_sup='select cname,capprove from category where cid='.$row_cat["superid"].'';
				$result_sup = mysqli_query($con, $query_sup);
				$row_sup=mysqli_fetch_array($result_sup);
				if($row_sup["capprove"]==0)
					$super=$row_sup["cname"].'<span style="color:red;"> [Not Approved]</span>';
				else
					$super=$row_sup["cname"];
				$superId=$row_cat["superid"];

				if($row_cat["capprove"]==0)
					$sub=$row_cat["cname"].'<span style="color:red;"> [Not Approved]</span>';
				else
					$sub=$row_cat["cname"];
				$subId=$row_cat["cid"];
			}
			else
			{
				if($row_cat["capprove"]==0)
					$super=$row_cat["cname"].'<span style="color:red;"> [Not Approved]</span>';
				else
					$super=$row_cat["cname"];
				$superId=$row_cat["cid"];
				$sub='-';
				$subId='-1';
			}
			echo '
			<tr>
				<form action="approve_process.php?approve=y&super='.$superId.'&sub='.$subId.'" method="post">
                <td width="300px;">'.$super.'</td>
                <td width="300px;"><input type="text" name="superName"></td>
                <td width="300px;">'.$sub.'</td>
                <td width="300px;"><input type="text" name="subName"></td>
                <td width="100px;">
					<a href="approve_process.php?approve=n&super='.$superId.'&sub='.$subId.'" class="del">&#x2716;</a>&nbsp;
					<input type="submit" class="apporve" value="&#10004;"/>
				</td>
				</form>
            </tr>';
			}
			?>
    </table>
</body>
</html>