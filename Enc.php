<?php
$arr=array('p','L','M','0','O','k','N','9','I','j','b','8','u','H','7','y','g','V','6','t','F','c','5','r','D','x','4','e','s','Z','3','w','a','2','Q','1','P','l','m',' ','o','K','n','~','i','J','B','_','U','h','&','Y','G','v','-','T','f','C','%','R','d','X','$','E','S','z','#','W','A','@','q','!','.',',',':',';','?','/','+','=');

function value($a)
{
  global $arr;
  return array_search($a,$arr);
}

function char($a)
{
  global $arr;
  if($a>=0 && $a<=80)
	return $arr[$a];
}

function convert($str)
{
  $ans="";
  $key=strlen($str);
  for($i=0;$i<strlen($str);$i++)
  {
	$ans=$ans.value($str[$i]);
  }	  
  $cnt=0;
  for($i=0;$i<strlen($ans);$i++)
  {
	$key+=$ans[$i];
	if(($i+1)%5==0)
	{
	  $sub[$cnt]=substr($ans,$i,5);
	  $cnt++;
	}
  }	  
  $ans="";
  for($i=0;$i<$cnt;$i++)
  {
	$sub[$i]=$sub[$i]*$key*($i+6);
	$ans.=$sub[$i];
  }	  
  return $ans;
}
	

function add_num($pass)
{
  $ans=convert($pass);
  $i=0;
  $cnt=strlen($ans);	
  $str="";
  $ans.="";
  for($i=0;$i<strlen($ans);$i++)
  {
	if($ans[$i]>=8 || ($i+1)==strlen($ans) || $ans[$i]==0)
	{
		$str.=char($ans[$i]);
	}
	else
	{
		$str.=char($ans[$i].$ans[$i+1]);
		$i++;
	}
  }
  return $str;
}
