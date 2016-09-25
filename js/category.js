var cid=[];
var cname=[];
var csuper=[];
var pointer=0;

var sid=[];
var sname=[];
var spointer=0;

function add_cat(id,name,superId)
{
  cid[pointer]=id;
  cname[pointer]=name;
  csuper[pointer]=superId;
  pointer++;
}

function find_subCat(id)
{
  for(var i=0;i<pointer;i++)
  {
    if(csuper[i]==id)
    {
		sid[spointer]=cid[i];
		sname[spointer]=cname[i];
		spointer++;
    }
  }
}

function changeSub()
{
	var id=document.getElementById("pcat").value;
	if(id==0)
	{
		document.getElementById("pncat").style.display="block";
		document.getElementById("psubcat").value="0";
		document.getElementById("psubcat").style.display="none";
		document.getElementById("pnsubcat").value="";
		document.getElementById("pnsubcat").style.display="none";
	}
	else
	{
		document.getElementById("pncat").value="";
		document.getElementById("pncat").style.display="none";
		document.getElementById("psubcat").style.display="block";
		document.getElementById("pnsubcat").style.display="block";
	}
	
	
	spointer=0;
	if(id!=0)
		find_subCat(id);
	var str;
	str='<option value="0">--Select Sub-Category--</option>';
	for(var ii=0;ii<spointer;ii++)
		str+=' <option value="'+sid[ii]+'">'+sname[ii]+'</option>';
	document.getElementById("psubcat").innerHTML=""+str;
}

function changeSub2()
{
	var id=document.getElementById("pncat").value;
	if(id=="")
	{
		document.getElementById("pnsubcat").value="";
		document.getElementById("pnsubcat").style.display="none";
	}
	else
	{
		document.getElementById("pnsubcat").style.display="block";
	}
	
}

function changeNewsub()
{
	var id=document.getElementById("psubcat").value;
	if(id==0)
		document.getElementById("pnsubcat").style.display="block";
	else
	{
		document.getElementById("pnsubcat").value="";
		document.getElementById("pnsubcat").style.display="none";			
	}
	
}