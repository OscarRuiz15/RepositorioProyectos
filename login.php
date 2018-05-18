<?php
	session_start(); 
    if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado'){ 
      if($_SESSION['tipo_user'] == 1){
        print "<script>window.location='home_administrador.php';</script>";
      }
      if($_SESSION['tipo_user'] == 2){
      	print "<script>window.location='home.php';</script>";
      }
      if($_SESSION['tipo_user'] == 3){
        print "<script>window.location='home.php';</script>";
      }
    } 
    else {     
    }   
?>
<!DOCTYPE html>
<html>

<head>
	<title>Repositorio de Proyectos</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/cuerpo_login.css">
	<link rel="shortcut icon" href="images/logo.png" />
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
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
		<?php include "php/cabecera_pp.php"; ?>
	</header>
	
	<div id="cuerpo">
		<section>
			<div id="formulario">
				<b><center><p id="Ingreso">Ingreso</p></center></b>
				
				<form class="captura" action="php/logeo.php" method="post" name="captura">
				
         			<strong><label for="lblUsuario">Usuario:</label></strong>
         			<center><input type="text" name="tfUsuario" required><br></center>
        				
          			<strong><label for="lblContrasena">Contraseña:</label></strong>
          			<center><input type="password" name="tfContrasena" required><br></center>
        			
          			<button type="submit" id="btnEntrar">Entrar</button>
          			<button type="reset" id="btnVaciar">Vaciar</button>
        		
          		</form>

          		<strong><center><a href="recuperar_password.php?op=1"><p>¿Olvidó su contraseña?</p></a><br></center></strong>
			<div>
		</section>	
	</div>

	<div id="pie">
		<footer>
			<p>Apicaciones en la Web y Redes Inalámbricas - Tecnicas de Pruebas de Software &copy; 2016<br>
			<a href="index.php">Inicio</a></p>
		</footer>	
	</div>
	
</body>
</html>