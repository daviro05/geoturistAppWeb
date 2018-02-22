/*function confirmar()
{
	if(confirm("Seguro?"))
	{
		return true;
	}
	else
	{
		return false;
	}
}*/

function redirigir()
{
	setTimeout ("redirection()", 300);
}

function redirection(){

	window.location = "./index.php";
}

function validacion(){
	var usuario = document.getElementsByName("usuario")[0].value;
	var password = document.getElementsByName('password')[0].value;
	var t1 = document.getElementById("error");
	t1.innerHTML="";
	document.getElementsByName("usuario")[0].style.border = "none";
	document.getElementsByName("password")[0].style.border = "none";
	var flag=true;

	if(usuario == "" || usuario.length < 3){
		document.getElementsByName("usuario")[0].style.border = "2px solid red";
		t1.innerHTML="<p class='error_2'><img src='./img/error.png' style='width:20px'> Los campos no son correctos o no cumples los requisitos</p>";
		flag = false;
	}
	if(password == "" || password.length > 20){
		document.getElementsByName("password")[0].style.border = "2px solid red";
		t1.innerHTML="<p class='error_2'><img src='./img/error.png' style='width:20px'> Los campos no son correctos o no cumples los requisitos</p>";
		flag = false;
	}

	return flag;	
} 



