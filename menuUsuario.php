<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="estilo.css" />
        <title>Menú de Usuario</title>
    </head>
    <body>
        <?php
        error_reporting(0);
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
            die('No se puede usar la base de datos : ' . mysql_error());
        }
        //USERPANEL
        if($_SESSION["autentificado"]=="SI")
        {		
            echo "<div id=\"userpanel\">";
            $usuario = $_SESSION['usuario'];
            echo "<a href=\"menuUsuario.php\">Hola $usuario</a>";
            echo "| <a href=\"cerrar_sesion.php\">Cerrar_Sesion</a>";
            echo '</div>';
        } else {
            echo "<div id=\"userpanel\">";
            echo "<a href=\"login.php\">Login</a> | <a href=\"registro.php\">Registro</a>";
            echo '</div>';
        }
    ?>
    
    <div id="logo">
        <a href= "./index.php"><img src="./images/logo.png" alt="Da click para regresar al menú principal" /></a>
    </div>
    <div id="main">
            <img id="beta" src="./images/beta.png" />
      <div id="top"></div>
            <div id="middle">

                    <h1>Menú de Usuario</h1>
                            <div id="boxtop"></div><div id="boxmid">
                                    <div class="section">
                                            <span>Archivos: <br /></span></div>
                                            <?php
                                            if(isset($_SESSION["usuario"])){
                                                $resultado = dbquery("SELECT ID FROM usuarios WHERE NOMBRE = '".$_SESSION["usuario"]."'");
                                                $row = @mysql_fetch_array($resultado);
                                            }
                                            if(isset($row["ID"])){
                                                $query="SELECT NOMBRE_ARCH, DIRECCION FROM archivos WHERE USER_ID = '".$row["ID"]."'";
                                                $resultado= dbquery($query) or die( mysql_error() );
                                                                                                   
                                                while ($row = mysql_fetch_array($resultado, MYSQL_ASSOC)) {
                                                    printf("<div class=\"section\"><a href='%s'>%s<a> </div>", $row["DIRECCION"], $row["NOMBRE_ARCH"]);
                                                }
                                                
                                            } else {
                                                echo "Error al ingresar a la base de datos. Compruebe su sesión.";
                                            }
                                                                                        
                                            mysql_free_result($resultado);
                                            ?>
                                            
                                    
                            </div>
                            <div id="boxbot"></div>
                    <br style="clear:both; height: 0px;" />
            </div>
            <div id="bottom"></div>
    </div>
    <div id="pie"><a href=""
    onClick="window.open('terminos.html','Términos y Condiciones', 'width=640, height=480');
    return false">Términos y condiciones</a> | <a href="mailto:deozamox@gmail.com&subject=Oseea" />Contacto</a></div>
</body>
</html>
