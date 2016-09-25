function product()
{
  var flag=true;
  var x=document.getElementById("pcat");
  if(x.value=="0")
  {
	var y=document.getElementById("pncat");
	if(y.value=="")
	{
    flag=false;
  	y.style.border="2px solid #000";
	x.style.border="2px solid #000";
	}
	else
	{
  	y.style.border="1px solid #CCC";
  	x.style.border="1px solid #CCC";		
	}
  }
  else
  {
  	x.style.border="1px solid #CCC";		
  }
    
  var x=document.getElementById("pname");
  if(x.value=="")
  {
    flag=false;
    x.style.border="2px solid #000";
  }
  else
  {
    x.style.border="1px solid #CCC";
  }
  var x=document.getElementById("pprice");
  if(x.value=="")
  {
    flag=false;
    x.style.border="2px solid #000";
  }
  else if(!parseInt(x.value))
	{
		flag=false;
		x.style.border="2px solid #000";
	}
  else
  {
    x.style.border="1px solid #CCC";
  }
  var x=document.getElementById("pqty");
  if(x.value=="")
  {
    flag=false;
    x.style.border="2px solid #000";
  }
  else if(!parseInt(x.value))
	{
		flag=false;
		x.style.border="2px solid #000";
	}
  else
  {
    x.style.border="1px solid #CCC";
  }
  var x=document.getElementById("pdesc");
  if(x.value=="")
  {
    flag=false;
    x.style.border="2px solid #000";
  }
  else
  {
    x.style.border="1px solid #CCC";
  }
return flag;
}
