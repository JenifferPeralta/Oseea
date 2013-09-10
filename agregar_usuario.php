<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="estilo.css">
<title>OSSEA: Validar</title>
</head>

<?php
    include ("config.php");
    error_reporting(0);
    $Nombre = $_POST['usuario'];
    $Password = $_POST['password'];
    $Password2 = $_POST['password2'];
    $Email = $_POST['email'];

    if($Password != $Password2){
        header("location: registro.php?errorusuario=1");
    }
    else {
        session_start( ); 

        if( md5( $_POST[ 'code' ] ) != $_SESSION[ 'key' ] ) {
            session_destroy();
            header("location: registro.php?errorusuario=2");
        } 
        else {
            $Nombre = $_POST['usuario'];
            $Password = $_POST['password'];
            $Email = $_POST['email'];
            
            $connection = mysql_connect($server,$user,$pass);
            if (!$connection) {
                die('No se pudo conectar a la base de datos: ' . mysql_error());
            }
            //Conexion BD
            if(!mysql_select_db($database)){
                die('No se puede usar la base de datos : ' . mysql_error());
            }

            $query="INSERT INTO USUARIOS(NOMBRE,PASSWORD,CORREO) VALUES ('$Nombre','$Password','$Email')";
            $resultado = dbquery($query) or die( mysql_error() );
            
            session_name("autentificado");
            $_SESSION["autentificado"]="SI";
            $_SESSION["usuario"]=$_POST["usuario"];
            header ("Location: index.php");
        }
    }
?>
<body>
</body>
</html>
