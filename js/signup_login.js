function signup()
{
	var flag=true;
	var x=document.getElementById("username");
	if(x.value=="")
	{	
	 	flag=false;
		x.style.border="2px solid #000";
	}
	else
	{
		x.style.border="1px solid #CCC";
	}
	
	x=document.getElementById("email");
	if(x.value.lastIndexOf('@')<x.value.lastIndexOf('.'))
	{
		x.style.border="1px solid #CCC";
	}
	
	else
	{
		flag=false;
		x.style.border="2px solid #000";
	}
	
	x=document.getElementById("mobile");
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
	else if(x.value.length<10)
	{
		flag=false;
		x.style.border="2px solid #000";
	}
	else
	{
		x.style.border="1px solid #CCC";
	}
	
	x=document.getElementById("password");
	if(x.value.length<8||x.value.length>25)
	{
		flag=false;
		x.style.border="2px solid #000";
	}
	else
	{
		x.style.border="1px solid #CCC";
	}
	
	var y=document.getElementById("confirm-password");
	if(x.value!=y.value)
	{
		flag=false;
		y.style.border="2px solid #000";
	}
	else
	{
		y.style.border="1px solid #CCC";
	}
	
	var x=document.getElementById("address");
	if(x.value=="")
	{	
	 	flag=false;
		x.style.border="2px solid #000";
	}
	else
	{
		x.style.border="1px solid #CCC";
	}
	var x=document.getElementById("pincode");
	if(x.value=="")
	{	
	 	flag=false;
		x.style.border="2px solid #000";
	}
	else if(x.value.length<6)
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
	return flag;
}

function editPro()
{
	var flag=true;
	var x=document.getElementById("username");
	if(x.value=="")
	{	
	 	flag=false;
		x.style.border="2px solid #000";
	}
	else
	{
		x.style.border="1px solid #CCC";
	}
	
	x=document.getElementById("mobile");
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
	else if(x.value.length<10)
	{
		flag=false;
		x.style.border="2px solid #000";
	}
	else
	{
		x.style.border="1px solid #CCC";
	}
	
	x=document.getElementById("password");
	if((x.value.length>8&&x.value.length<25) || x.value.length==0)
	{
		x.style.border="1px solid #CCC";
	}
	else
	{
		flag=false;
		x.style.border="2px solid #000";
	}
	
	var y=document.getElementById("confirm-password");
	if(x.value!=y.value)
	{
		flag=false;
		y.style.border="2px solid #000";
	}
	else
	{
		y.style.border="1px solid #CCC";
	}
	
	x=document.getElementById("address");
	if(x.value=="")
	{	
	 	flag=false;
		x.style.border="2px solid #000";
	}
	else
	{
		x.style.border="1px solid #CCC";
	}
	
	x=document.getElementById("pincode");
	if(x.value=="")
	{	
	 	flag=false;
		x.style.border="2px solid #000";
	}
	else if(x.value.length<6)
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

function login()
{
	var flag=true;	
	var x=document.getElementById("email_log");
	if(x.value.lastIndexOf('@')<x.value.lastIndexOf('.'))
	{
		x.style.border="1px solid #CCC";
	}
	else
	{
		flag=false;
		x.style.border="2px solid #000";
	}

	x=document.getElementById("password_log");
	if(x.value.length<8||x.value.length>25)
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

$(function() {

    $('#login-form-link').click(function(e) {
		$("#login-form").delay(100).fadeIn(100);
 		$("#register-form").fadeOut(100);
		$('#register-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});
	$('#register-form-link').click(function(e) {
		$("#register-form").delay(100).fadeIn(100);
 		$("#login-form").fadeOut(100);
		$('#login-form-link').removeClass('active');
		$(this).addClass('active');
		e.preventDefault();
	});

});