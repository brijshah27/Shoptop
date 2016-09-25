<?php
if(!isset($con))
{
	$con = mysqli_connect("localhost","root","");
	mysqli_select_db($con, "shoptop");
}
?>