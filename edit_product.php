<head>
<?php
if(session_id() == ''){session_start();}
if(!(isset($_SESSION['seller_login']))){$_SESSION["seller_login"]=false;}
if(!(isset($_SESSION['user_login']))){$_SESSION["user_login"]=false;}
if($_SESSION['seller_login']==false || $_SESSION["user_login"]==true)
{	header('Location:seller_sign.php?err=login_first');	}

include("database_connect.php");
$query_pro='select * from product where pid="'.$_GET["pid"].'" and sid="'.$_SESSION["seller_id"].'"';
$result_pro = mysqli_query($con,$query_pro);
if(mysqli_num_rows($result_pro)==0)
{
	header('Location:PNF.html');
}

?>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SHOPTOP- Edit Product</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link href="css/edit_profile_seller.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap-filestyle.min.js"></script>
      <script src="js/bootstrap-filestyle.js"></script>
      <script src="js/add_product.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Script to Activate the Carousel -->
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>

    <script src="js/common.js" ></script>
    <script src="js/category.js" ></script>

    <script>
    var Profile = function(event) {
        var output = document.getElementById('proimg');
        output.src = URL.createObjectURL(event.target.files[0]);
    document.getElementById("remove").style.display="block";
		document.getElementById("provalue").value="1";
      };
  function remove_profile()
  {
    document.getElementById("proimg").src="images/700x450.png";
    document.getElementById("proinput").value="";
    document.getElementById("remove").style.display="none";
		document.getElementById("provalue").value="1";
  }
    </script>


</head>
<body>
<?php include('header.php')?>

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


<?php

$row_pro=mysqli_fetch_array($result_pro);

if($row_pro["pimage"]=="")
{
	$img='images/700x450.png';
	$display="display:none";
}
else
{
	$img='product_images/'.$row_pro["pid"].'.'.$row_pro["pimage"];
	$display="display:block";
}

$query_findCat='select superid from category where cid="'.$row_pro["cid"].'"';
$result_findCat = mysqli_query($con,$query_findCat);
$row_findCat=mysqli_fetch_array($result_findCat);

if($row_findCat["superid"]!=0)
{
	$superID=$row_findCat["superid"];
	$subID=$row_pro["cid"];
}
else
{
	$superID=$row_pro["cid"];	
	$subID=0;
}

?>

<form id="add_product-form" action="edit_product_process.php?pid=<?php echo $_GET["pid"];?>&" onSubmit="return product()" style="width:100%;float:left; margin-top:100px;" method="post" role="form" enctype="multipart/form-data">

    <div style="float:left;">
          <div id="prodiv">
          <img id="proimg" src="<?php echo $img;?>" alt="Profile">
          <input type="file" name="pimage" id="proinput" onChange="Profile(event)" accept="image/*">
          </div>
          <p class="protext">Product Picture</p>
          <a class="protext" id="remove" style="color:#F00; font-size:16px; <?php echo $display;?>" onClick="remove_profile()">&times;Remove&times;</a>
    </div>

	<div style="float:left; margin-left:3%; width:40%;">
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
                    <input type="text" name="pname" id="pname" tabindex="1" class="form-control" placeholder="Product Name" value="<?php echo $row_pro["pname"];?>">
                    </div>

                      <div class="form-group">
                      <input type="text" name="pdesc" id="pdesc" tabindex="1" class="form-control" placeholder="Product Description" value="<?php echo $row_pro["pdesc"];?>">
                      </div>

                  <div class="form-group">
                  <input type="hidden" name="provalue" id="provalue" tabindex="1" class="form-control" value="0">
                  </div>

                      <div class="form-group">
                      <input type="text" name="pprice" id="pprice" tabindex="1" class="form-control" placeholder="Product Price" value="<?php echo $row_pro["pprice"];?>">
                      </div>

                      <div class="form-group">
                      <input type="text" name="pqty" id="pqty" tabindex="1" class="form-control" placeholder="Product Quantity" value="<?php echo $row_pro["pqty"];?>">
                      </div>

                      <div class="form-group">
                        <div class="row">
                          <div class="col-sm-6 col-sm-offset-3">
                          <input type="submit" name="add_product" id="add_product" tabindex="4" class="btn btn-primary" value="Save">
                          </div>
                        </div>
                      </div>
    </div>
</form>

<script>
	document.getElementById("pcat").value=<?php echo $superID;?>;
	changeSub();
	document.getElementById("psubcat").value=<?php echo $subID;?>;
	changeNewsub();
</script>
<div style="margin-top:530px ;clear:left;">
<?php include ("footer.php") ?></div>
<script>active("user");</script>
