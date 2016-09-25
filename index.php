<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>SHOPTOP- Home</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
    <style>
	.product{
	  float:left;
	  padding:10px 40px;
	  margin-top:30px;
	  margin-left:10px;
	  border-radius: 5px;
			}
			
	.proimage:hover{
  box-shadow:0px 0px 5px #00F;
			}
			
	.proimage{
				 clear:both;
				 float:left;
				 width:300px;
				 height:250px;
 					}
			</style>




</head>

<body>

	<?php include("header.php"); ?>


    <!-- Header Carousel -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">
            <div class="item active">
                <div class="fill" style="background-image:url('images/1st.jpg');"></div>
                <div class="carousel-caption">
                    <!--<h2>Caption 1</h2>-->
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/2nd.jpg');"></div>
                <div class="carousel-caption">
                    <!--<h2>Caption 2</h2>-->
                </div>
            </div>
            <div class="item">
                <div class="fill" style="background-image:url('images/3rd2.png');"></div>
                <div class="carousel-caption">
                   <!-- <h2>Caption 3</h2>-->
                </div>
            </div>
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>
    </header>
     <!-- About -->
     <div class="container">
     	<div class="row">
            <div class="col-lg-12">

                <h2 class="page-header">Highlight About Us..</h2>
                <h3> <b>SHOPTOP- One stop for everything.</b></h3>
                <h4>&bull; Find products & shops near you.</h4>
                <h4>&bull; Expand your bussiness with local market.&rarr; <a href="seller_sign.php">Signup </a>Today! Its completly free!!!.</h4>
                <h4><a href="about.php">Learn more</a> </h4>

            </div>
         </div>
      </div>
     <!-- Tending Products -->

     <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Trending Products</h2>
            </div>
            <?php
							include("database_connect.php");
							

							$query_tpro='select * from product NATURAL JOIN category where papprove=1 and capprove=1 ORDER BY PRATING DESC LIMIT 0, 9';
							$result_tpro = mysqli_query($con,$query_tpro);
							
							if(mysqli_num_rows($result_tpro)==0)
							{	header('Location:PNF.html');	}
								
							while($row_tpro=mysqli_fetch_array($result_tpro))
							{
								if($row_tpro["pimage"]=="")
								$img='images/700x450.png';
							else
								$img='product_images/'.$row_tpro["pid"].'.'.$row_tpro["pimage"];
				echo' 
				<div class="product">
                	<a href="single_product.php?pid='.$row_tpro["pid"].'">
                    	<img class="proimage" src="'.$img.'" alt="">
					</a>
				</div>';
								
							}
						?>
            </div>
        </div>
        <!-- Tending shops -->

     <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="page-header">Trending Shops</h2>
            </div>
             <?php
							include("database_connect.php");
							$query_tshop='select * from seller where sapprove=1 ORDER BY SRATING DESC LIMIT 0, 9';
							$result_tshop = mysqli_query($con,$query_tshop);
							
							if(mysqli_num_rows($result_tshop)==0)
							{	header('Location:PNF.html');}
								
							while($row_tshop=mysqli_fetch_array($result_tshop))
							{
								if($row_tshop["sprofile"]=="")
								$img='images/700x450.png';
							else
								$img='profile_seller/'.$row_tshop["semail"].'.'.$row_tshop["sprofile"];
				echo' 
				<div class="product">
                	<a href="single_shop.php?sid='.$row_tshop["sid"].'">
                    	<img class="proimage" src="'.$img.'" alt="">
					</a>
				</div>';
								
							}
						?>
            
        </div>

        </div>
        <!-- /.row -->

<?php include ("footer.php") ?>
    <script>active("home");</script>

</body>
</html>
