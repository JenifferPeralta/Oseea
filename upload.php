<?php 
    /*
    * File: index.php (Oseea)
    * Author: Samuel Morales Bender
    * 
    */
    session_start();
    include("config.php");
    //Funciones
    //Existe Tabla
    function table_exists ($table, $db){ 
       $tables = mysql_list_tables ($db); 
       while (list ($temp) = mysql_fetch_array ($tables)){
           if ($temp == $table){
               return true;
           }
       }	
       return false;
    }
    //Conexion MySQL
    $connection = mysql_connect($server,$user,$pass);
    if (!$connection) {
       die('No se pudo conectar a la base de datos: ' . mysql_error());
    }
    //Conexion BD
    if(!mysql_select_db($database)){
       //die('No se puede usar la base de datos : ' . mysql_error());
       echo 'No se encontró base de datos. Se creó base de datos nueva.<br />';
       dbquery("CREATE DATABASE $database");
    }
    //Tabla
    //Crear tabla si no existe
    $tabla = "archivos";
    if (!table_exists($tabla, $database)){
       echo "No se encontró tabla \"$tabla\" en la Base de Datos. Creando Tabla.<br />";
       $sql = "CREATE TABLE IF NOT EXISTS $tabla
               (
               ID int NOT NULL AUTO_INCREMENT,
               PRIMARY KEY(ID),
               NOMBRE_ARCH varchar(100) NOT NULL,
               DIRECCION varchar(1000) NOT NULL,
               USER_ID int NULL
               ) DEFAULT CHARSET=latin1";

       $result = dbquery($sql);
       $result = dbquery("ALTER TABLE archivos ADD FOREIGN KEY (USER_ID) REFERENCES hosting.usuarios (ID) ON DELETE CASCADE ON UPDATE CASCADE");
       
       echo "Éxito [Tabla creada]<br />";
    }

    if ($_POST["action"] == "upload") {
        //datos del archivo
        $tamano = $_FILES["archivo"]['size'];
        $tipo = $_FILES["archivo"]['type'];
        $archivo = $_FILES["archivo"]['name'];
        $prefijo = substr(md5(uniqid(rand())),0,6);

        if ($archivo != "") {
            //Guarda en directorio "archivos"
            $directorio = 'archivos';
            if (!file_exists($directorio)) {
                mkdir($directorio);
            }
            $destino =  $directorio."/".$prefijo."_".$archivo;

            if (copy($_FILES['archivo']['tmp_name'],$destino)) {
                echo "Archivo subido: <b>".$archivo."</b><br />";
                echo "Enlace del archivo: ";
                echo "<a href='$destino'>$web_root$destino<a>";
                
                if(isset($_SESSION["usuario"])){
                    $resultado = dbquery("SELECT ID FROM usuarios WHERE NOMBRE = '".$_SESSION["usuario"]."'");
                    $row = @mysql_fetch_array($resultado);
                }
                if(isset($row["ID"])){
                    $query="INSERT INTO archivos (NOMBRE_ARCH,DIRECCION,USER_ID) VALUES ('$archivo','$destino','".$row["ID"]."')";
                    $resultado = dbquery($query) or die( mysql_error() );                  
                } else {
                    $query="INSERT INTO archivos (NOMBRE_ARCH,DIRECCION) VALUES ('$archivo','$destino')";
                    $resultado = dbquery($query) or die( mysql_error() );
                }
                
            } else {
                echo "Error al subir el archivo";	
            }
        } else {
            echo "Error al subir archivo";
        }
    }
?> 
