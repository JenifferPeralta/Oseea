<?php
    /*
     * Config File
     */
    //Configuración
    $user = "root";
    $pass = "";
    $database = "hosting";
    $server = "localhost";
    $tabla = "usuarios";
    
    //Ruta de la página
    $web_root = "http://localhost/Oseea/";
    
    //Funciones
    //Query
    function dbquery ($query){
        $resultado = mysql_query($query);
        if(!$resultado){
            die('<br />Error en Query: ' . mysql_error());
        }
        return $resultado;
    }
?>
