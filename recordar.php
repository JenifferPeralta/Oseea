<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="estilo.css" />
<title>Oseea : Recordar Contraseña</title>
</head>
<body>
<div id="userpanel">
	<a href="login.html">Login</a> | <a href="registro.html">Registro</a>
</div>
<div id="logo">
		<a href= "./index.html"><img src="./images/logo.png" alt="Da click para regresar al menú principal" /></a>
	</div>
<div id="main">
	<img id="beta" src="./images/beta.png" />
    <div id="top"></div>
	<div id="middle">
		<h1>Recordar Contraseña</h1>
        <form action="./recordar_password.php" method="post" name="validar">
        <div id="boxtop"></div><div id="boxmid">
			<div id="user" class="section">
      				<span>Correo Electrónico:</span><input type="text" name="usuario" required />
            </div>
        </div>
        <div id="boxbot"></div>
        <div class="text" style="float: left;">
                	<p><a href="./recordar.html">¿Olvidaste tu contraseña?</a></p>
        </div>
        <div class="text" style="float: right;">
                	<input type="submit" value="Enviar" name="ok" class="submit">
        </div>
        <br />
        </form>
   	</div>
    <div id="bottom"></div>
</div>
<div id="pie"><a href="terminos.html" target="">Términos y condiciones</a> | <a href="mailto:deozamox@gmail.com&subject=Oseea">Contacto</a></div>
</body>
</html>
