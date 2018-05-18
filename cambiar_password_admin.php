<?php
  session_start(); 

  if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado'){ 
    if($_SESSION['tipo_user'] == 1){
      // Lo dejas entrar a la pagina 
    }
    if($_SESSION['tipo_user'] == 2){
		print "<script>window.location='home.php';</script>";
    }
    if($_SESSION['tipo_user'] == 3){
    	print "<script>window.location='home.php';</script>";
    }
  } 
  else {  
  	print "<script>window.location='index.php';</script>";	    
  }  
?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Repositorio de Proyectos</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/cuerpo_cambiar_password_admin.css">
	<link rel="shortcut icon" href="images/logo.png" />
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script>
		$(document).ready(main);
 		var contador = 1;
 
		function main(){
		$('.menu_bar').click(function(){
			if(contador == 1){
				$('nav').animate({
					left: '0'
				});
				contador = 0;
			} else {
				contador = 1;
				$('nav').animate({
					left: '-100%'
				});
			}
		});
		};
	</script>
</head>

<body>

	<header>
		<?php include "php/cabecera_admin.php"; ?>
	</header>
	
	<div id="cuerpo">
		<section>
		<div id="datos">
		<p><b>Cambiar Contraseña</b></p><hr></hr>
		<center>
                    <form class="captura" method="post" action="php/Controlador/CambiarPassword.php">
		        <br><br><label><strong>Contraseña Antigua: </strong></label><br><input type="password" name="contra" id="contra" required><br><br>
		        <label><strong>Nueva Contraseña: </strong></label><br><input type="password" name="c1" id="c1" required><br><br>
		        <label><strong>Repita Nueva Contraseña: </strong></label><br><input type="password" name="c2" id="c2" required><br><br>
		        <button type="submit" id="btnCambiar">Cambiar Contraseña</button><br><br>
	        </form>
	    </center>
		</div>
		</section>	
	</div>

	<div id="pie">
		<footer>
			<p>Apicaciones en la Web y Redes Inalámbricas - Tecnicas de Pruebas de Software &copy; 2016<br>
			<a href="home_administrador.php">Inicio</a></p>
		</footer>	
	</div>
	
</body>
</html>
