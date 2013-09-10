<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Validacion</title>
</head>

<?php
    error_reporting(0);
    include("config.php");
    //Conexion MySQL
    $connection = mysql_connect($server,$user,$pass);
    if (!$connection) {
        die('No se pudo conectar a la base de datos: ' . mysql_error());
    }
    //Conexion BD
    if(!mysql_select_db($database)){
        die('No se puede usar la base de datos : ' . mysql_error());
    }

    $usuario=$_POST["usuario"];
    $query="SELECT NOMBRE,PASSWORD FROM usuarios WHERE NOMBRE='".$usuario."'";
    $resultado = dbquery($query);

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