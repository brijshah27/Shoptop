// JavaScript Document
function admin()
{
  var flag=true;
  var x=document.getElementById("username");
  if(x.value=="admin")
  {
	flag=true;
	
  }
  else
  {
	flag=false;
	x.style.border="2px solid black";  
  }
  
   var x=document.getElementById("password");
  if(x.value=="password")
  {
	flag=true;
	
  }
  else
  {
	flag=false;
	x.style.border="2px solid black";  
  }
  return flag;
  
}