function active(a)
{
  document.getElementById("home").className="inactive";

  document.getElementById("user").className="inactive";
  document.getElementById("seller").className="inactive";
  document.getElementById("about").className="inactive";
  document.getElementById("contact").className="inactive";
  document.getElementById("products").className="inactive"; 
  document.getElementById("shop").className="inactive";
  
  document.getElementById(a).className="active";
}