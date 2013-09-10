<?php 
    include("config.php");
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
                echo "<a href='$destino.'>$web_root/$destino<a>";
            } else {
                echo "Error al subir el archivo";	
            }
        } 

            else {
            echo "Error al subir archivo";
        }
    }
?> 
