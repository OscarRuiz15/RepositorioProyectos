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
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Repositorio de Proyectos</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/cuerpo_recuperar_password.css">
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
		<?php include "php/cabecera_pp.php"; ?>
	</header>
	
	<div id="cuerpo">
		<section>
			<div id="formulario">
				<b><p class="titulo">Recupera tu cuenta:</p><hr></hr></b>
				
				<?php
					if(isset($_GET['op'])){
						$op=$_GET['op'];
						if($op==1){
							echo 
							'<form class="captura" action="php/Controlador/EnviarCorreo.php" method="post" name="captura">

			         			<center><strong><label for="lblUsuario">Ingresa tu Usuario o Correo Electronico:</label></strong>
			         			<input type="text" name="tfUsuario" required><br> </center>

			          			<button type="submit" id="btnBuscar">Buscar</button>
			          			<button type="reset" id="btnCancelar" onclick= "self.location.href=';
			          			echo "'login.php'";
			          			echo '"/>Cancelar</button>
			          		</form>';
						}
						if($op==2){
							echo 
							'<form class="captura" action="php/Controlador/EnviarCorreo.php" method="post" name="captura">

			         			<center><strong><label for="lblUsuario">Se ha enviado un correo electronico con la información de tu cuenta para que puedas acceder al sistema.</label></strong>

			          			<button type="reset" id="btnRegresar" onclick= "self.location.href=';
			          			echo "'login.php'";
			          			echo '"/>Regresar</button>
			          		</form>';
						}
						if($op==3){
							echo 
							'<form class="captura" action="php/Controlador/EnviarCorreo.php" method="post" name="captura">

			         			<center><strong><label for="lblUsuario">No hay resultados de busqueda.</label></strong>
			         			<strong><label for="lblUsuario">Tu busqueda no arrojo ningun resultado.</label></strong>
			         			<strong><label for="lblUsuario">Vuelve a intentarlo con otra información.</label></strong>
			          			<button type="reset" id="btnRegresar" onclick= "self.location.href=';
			          			echo "'login.php'";
			          			echo '"/>Regresar</button>
			          		</form>';
						}
					}
					else{
						echo 
							'<form class="captura" action="php/Controlador/EnviarCorreo.php" method="post" name="captura">

			         			<center><strong><label for="lblUsuario">Ingresa tu Usuario o Correo Electronico:</label></strong>
			         			<input type="text" name="tfUsuario" required><br> </center>

			          			<button type="submit" id="btnBuscar">Buscar</button>
			          			<button type="reset" id="btnCancelar" onclick= "self.location.href=';
			          			echo "'login.php'";
			          			echo '"/>Cancelar</button>
			          		</form>';
					}
					
					
				?>
				
          		<p></p><br><p></p>
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