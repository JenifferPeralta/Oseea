<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="estilo.css" /> 
    <title>Oseea</title>
</head>
<body>
    <?php
        /*
         * File: index.php (Oseea)
         * Author: Samuel Morales Bender
         * 
         */
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
        if (!table_exists($tabla, $database)){
            echo "No se encontró tabla \"$tabla\" en la Base de Datos. Creando Tabla.<br />";
            $sql = "CREATE TABLE IF NOT EXISTS $tabla
                    (
                    ID int NOT NULL AUTO_INCREMENT,
                    PRIMARY KEY(ID),
                    NOMBRE varchar(20) NOT NULL,
                    PASSWORD varchar(20) NOT NULL,
                    CORREO varchar(20) NOT NULL
            ) DEFAULT CHARSET=latin1";
            $result = dbquery($sql);
            echo "Éxito [Tabla creada]<br />";
        }

        error_reporting(0);
        session_start();
        
        //USERPANEL
        if($_SESSION["autentificado"]=="SI")
        {		
            echo "<div id=\"userpanel\">";
            $usuario = $_SESSION['usuario'];
            echo "Hola $usuario";
            echo "| <a href=\"cerrar_sesion.php\">Cerrar_Sesion</a>";
            echo '</div>';
        } else {
            echo "<div id=\"userpanel\">";
            echo "<a href=\"login.php\">Login</a> | <a href=\"registro.php\">Registro</a>";
            echo '</div>';
        }
        

    ?>
    
    <div id="logo">
      <img src="./images/logo.png" />
    </div>
    <div id="main">
            <img id="beta" src="./images/beta.png" />
      <div id="top"></div>
            <div id="middle">

                    <h1>Subir Archivos</h1>

                    <form enctype="multipart/form-data" action="upload.php" method="post">

                            <div id="boxtop"></div><div id="boxmid">

                                    <div class="section">
                                            <span>Archivo:</span>
                                            <input type="file" name="archivo" />
                                    </div>

                            </div><div id="boxbot"></div>

                            <div class="text" style="float: left;"><p>Tamaño Max. 10 Mb</p><p>Archivos soportados: jpg, gif, png, pdf, rar, zip</p></div>
                            <div class="text" style="float: right;">

                            <input type="submit" value="Subir" name="upload" class="submit" />
                <input name="action" type="hidden" value="upload" /> 
                    </div>
                    <br style="clear:both; height: 0px;" />

                    </form>

            </div>
            <div id="bottom"></div>
    </div>
    <div id="pie"><a href=""
    onClick="window.open('terminos.html','Términos y Condiciones', 'width=640, height=480');
    return false">Términos y condiciones</a> | <a href="mailto:deozamox@gmail.com&subject=Oseea">Contacto</a></div>
</body>
</html>
