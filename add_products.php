<!DOCTYPE html>
<html lang="en">
<head>
	<?php
	if(session_id() == ''){session_start();}
	if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
	if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
	if($_SESSION['seller_login']==false || $_SESSION["user_login"]==true)
	{	header('Location:seller_sign.php?err=login_first');	}
	?>

 <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- Add Product</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">
    <link href="css/form_seller.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

	<script src="js/bootstrap-filestyle.min.js"></script>
    <script src="js/bootstrap-filestyle.js"></script>

	<script src="js/common.js"></script>
    <script src="js/category.js" ></script>
		<script src="js/add_product.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>

    <?php include("header.php");?>
		<?php
				if(isset($_GET["msg"]))
				{
				if($_GET["msg"]=='success')
				 {
					 echo '<div style="width:20%;margin-left:100px;"><h3>&nbsp Successfully Added!</h3></div>';
				 }
			 	}
				 ?>

		<?php
				if(isset($_GET["err"]))
				{
				if($_GET["err"]=='name')
				 {
					 echo '<div style="width:20%;margin-left:100px;"><h3>&nbsp Product already exists!</h3></div>';
				 }
			 	}
				 ?>

		
	<script>
    <?php
    $query_cat='select * from category';
    $result_cat = mysqli_query($con,$query_cat);
    while($row_cat=mysqli_fetch_array($result_cat))
    {
        echo 'add_cat('.$row_cat["cid"].',"'.$row_cat["cname"].'",'.$row_cat["superid"].');';
    }
	?>
	find_subCat(0);</script>

    <div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
    <form id="add_product-form" action="add_product_process.php" onSubmit="return product()" style="margin-left:25%; margin-top:100px; margin-bottom:90px;width:50%;" method="post" role="form" enctype="multipart/form-data">

              <div class="form-group">
                  <select name="pcat" class="form-control" onChange="changeSub();" id="pcat">
                  <option value="0">--Select Category--</option>

					<script>
					for(var ii=0;ii<spointer;ii++)
						document.write('<option value="'+sid[ii]+'">'+sname[ii]+'</option>');
                    </script>
                  </select>
              </div>

                <div class="form-group">
                <input type="text" name="pncat" id="pncat" tabindex="1" class="form-control" onChange="changeSub2()" placeholder="New Category">
                </div>

              <div class="form-group">
                  <select name="psubcat" class="form-control" id="psubcat" onChange="changeNewsub()" style="display:none;">
                  <option value="0">--Select Sub-Category--</option>
					<script>
					spointer=0;
					find_subCat();
					for(var ii=0;ii<spointer;ii++)
						document.write('<option value="'+sid[ii]+'">'+sname[ii]+'</option>');
                    </script>
                  </select>
              </div>

                <div class="form-group">
                <input type="text" name="pnsubcat" id="pnsubcat" tabindex="1" class="form-control" style="display:none;" placeholder="New Sub Category">
                </div>

            <div class="form-group">
            <input type="text" name="pname" id="pname" tabindex="1" class="form-control" placeholder="Product Name">
            </div>

              <div class="form-group">
							<input type="text" name="pdesc" id="pdesc" tabindex="1" class="form-control" placeholder="Product Description">
							</div>

              <div class="form-group">
							<input type="text" name="pprice" id="pprice" tabindex="1" class="form-control" placeholder="Product Price">
							</div>

              <div class="form-group">
							<input type="text" name="pqty" id="pqty" tabindex="1" class="form-control" placeholder="Product Quantity">
							</div>

              <div class="form-group">
              <input type="file" class="filestyle" id="pimage" name="pimage" data-classButton="btn btn-primary" data-input="false" data-buttonText="Choose product picture." accept="image/*">
              </div>

              <div class="form-group">
                <div class="row">
                  <div class="col-sm-6 col-sm-offset-3">
                  <input type="submit" name="add_product" id="add_product" tabindex="4" class="btn btn-primary" value="Add Product">
                  </div>
                </div>
              </div>
     </form>
</div>
</div>
</div>
    <?php include ("footer.php") ?>

	<script>active("user");</script>

</body>
