<?php
$con = mysqli_connect("localhost","root","");
mysqli_select_db($con, "shoptop");
$query_delete='DELETE from `comment` where pid=15||10';
$result_delete = mysqli_query($con,$query_delete);
echo'sucess';
?>