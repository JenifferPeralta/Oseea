<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Validacion</title>
</head>

<?php
error_reporting(0);
include("conex.phtml");
$link=Conectarse();
$Usuario=$_POST["usuario"];
$consulta="SELECT NOMBRE,PASSWORD FROM usuarios WHERE NOMBRE='".$Usuario."'";
$resultado = mysql_query( $consulta, $link );
while ($row = @mysql_fetch_array($resultado)){
if($_POST['password']==$row["PASSWORD"]){
	
	session_start();
	session_name("autentificado");
	$_SESSION["autentificado"]="SI";
	$_SESSION["usuario"]=$row["NOMBRE"];
    }
}

if(isset($_SESSION["usuario"]))
header("Location: index.php");

else
header("Location: login.php");
?>
<body>
</body>
</html>