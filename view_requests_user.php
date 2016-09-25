<head>
<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['user_login']==false || $_SESSION["seller_login"]==true)
{	header('Location:user_sign.php?err=login_first');	}
?>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- Your Requests</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="css/view_request_user.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->

    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

    <script src="js/common.js" ></script>

</head>
<body>
<?php include('header.php')?>

<?php
$query_rqst='select rid,uid,pid,sid,pname,pprice from request NATURAL JOIN product where uid='.$_SESSION["user_id"].'';
$result_rqst = mysqli_query($con,$query_rqst);
if(mysqli_num_rows($result_rqst)==0)
{
	echo'<div class="col-lg-11" style="margin-bottom:400px;">
        <div class="page-header">
        <h3>No Requests </h3>
        </div>
    </div>
    </div>';
}
else
{
	$query_user='select * from user where uid="'.$_SESSION["user_id"].'"';
	$result_user = mysqli_query($con,$query_user);
	$row_user=mysqli_fetch_array($result_user);
	echo'<div class="col-lg-11">
        <div class="page-header">
        <h3>'.$row_user["uname"].'\'s Requests</h3>
        </div>
    </div>
    </div>';
while($row_rqst=mysqli_fetch_array($result_rqst))
{
	$query_seller='select * from seller where sid='.$row_rqst["sid"];
	$result_seller = mysqli_query($con,$query_seller);
	if($row_seller=mysqli_fetch_array($result_seller))
	{
		echo '
		<div class="request">
			<div class="rInfo">
				<a href="single_product.php?pid='.$row_rqst["pid"].'" class="rname">'.$row_rqst["pname"].'</a>
				<p class="rdetial">Price: '.$row_rqst["pprice"].'</p>
                <p class="rdetial">Seller: '.$row_seller["sname"].'</p>
				<p class="rdetail">Address: '.$row_seller["saddress"].'</p>
				<p class="rdetail">Pin Code: '.$row_seller["spincode"].'</p>
				<p class="rdetail">E-mail: '.$row_seller["semail"].'</p>
				<p class="rdetail">Contact: '.$row_seller["smobile"].'</p>
			</div>
			<div class="rEdit">
				<a href="del_request_process.php?rid='.$row_rqst["rid"].'&link=req" class="btn btn-primary" id="delBtn">Delete Request</a>
			</div>
		</div>';

	}
}
}
?>




<div style="clear:both;margin-bottom:25px"></div>
<?php include ("footer.php") ?>
<script>active("user");</script>
