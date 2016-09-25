<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
?>

<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        <a href="index.php"><div style="width:50px;height:50px;float:left;margin-right:10px"><img src="images/logo_final_1.png"/></div></a>
        <a class="navbar-brand" href="index.php">SHOPTOP <sub><font size="-2"></a></font></sub>
                	 <div style="float:left;margin-left:35px;">
        
        <form action="search_products.php" method="get" id="sform" role="form" enctype="multipart/form-data" style="margin-bottom:0px;">
        		<input type="text" name="search" id="search" style="height:50px;border:5px solid #222;width:400px;" placeholder=" <?php
				if(isset($_GET["search"]))
				{
					echo $_GET["search"];
				}
				else
				{
					 echo ' What\'s your wish today?';
				}
                ?>
                ">
                
                <input type="submit" name="" id="sbutton" tabindex="4" class="btn btn-primary" value="Search">
		</form>
        
        </div>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li id="home" class="inactive">
                    <a href="index.php">Home</a>
                </li>

                <li id="products" class="inactive" >
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Products <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                        <?php
							include("database_connect.php");
							$query_trend='select * from product NATURAL JOIN category where papprove=1 and capprove=1 ORDER BY PRATING DESC LIMIT 0, 3';
							$result_trend = mysqli_query($con,$query_trend);
							if(mysqli_num_rows($result_trend)==0)
							{		}
								
							while($row_trend=mysqli_fetch_array($result_trend))
							{
									echo' <li>
                                <a href="single_product.php?pid='.$row_trend["pid"].'">'.$row_trend["pname"].'</a>
                            </li>';
								
							}
						?>
                           
                            <li id="products" class="inactive">
                                <a href="all_products.php">See All..</a>
                            </li>
                        </ul>

                    </li>
                 <li id="shop" class="inactive">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Shops <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <?php
							include("database_connect.php");
							$query_trend2='select * from seller where sapprove=1 ORDER BY SRATING DESC LIMIT 0, 3';
							$result_trend2 = mysqli_query($con,$query_trend2);
							if(mysqli_num_rows($result_trend2)==0)
							{		}
								
							while($row_trend=mysqli_fetch_array($result_trend2))
							{
									echo' <li>
                                <a href="single_shop.php?sid='.$row_trend["sid"].'">'.$row_trend["sname"].'</a>
                            </li>';
								
							}
						?>
                            <li>
                                <a href="all_shops.php">See All..</a>
                            </li>
                        </ul>
        </li>

				<?php
				if($_SESSION["seller_login"])
				{
					include("database_connect.php");

					$query_login='select sname from seller where sid="'.$_SESSION["seller_id"].'"';
					$result_login = mysqli_query($con,$query_login);
					$row_login=mysqli_fetch_array($result_login);

					$href1="seller_profile.php";
					if(strlen($row_login["sname"])>15)
						$menu1= substr($row_login["sname"],0,12)."...";
					else
						$menu1=$row_login["sname"];
					$href2="seller_signin_process.php";
					$menu2="Logout";
				}
				else if($_SESSION["user_login"])
				{
					include("database_connect.php");

					$query_login='select uname from user where uid="'.$_SESSION["user_id"].'"';
					$result_login = mysqli_query($con,$query_login);
					$row_login=mysqli_fetch_array($result_login);

					$href1="user_profile.php";
					$menu1=$row_login["uname"];
					$href2="user_signin_process.php";
					$menu2="Logout";
				}
				else
				{
					$href1="user_sign.php";
					$menu1="User";
					$href2="seller_sign.php";
					$menu2="Seller";

				}

				echo '
                <li id="user" class="inactive">
	                <a href="'.$href1.'">'.$menu1.'</a>
                </li>



                <li id="seller" class="inactive">
    	            <a href="'.$href2.'">'.$menu2.'</a>
                </li>';
				?>

        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container -->
</nav>
