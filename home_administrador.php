<?php
  session_start(); 
    if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado'){ 
      if($_SESSION['tipo_user'] == 1){
      	
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
	<title>Repositorio de Proyectos</title>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/cuerpo_administrador.css">
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
		<br><br><br><br><br><br>
		<div id="izquierdo">
			<center><h1>REPOSITORIO DE PROYECTOS</h1></center>
			<center><h2>Universidad del Valle - Sede Buga</h2></center>
			<center><img src="images/logo.png"></center>
		</div>
		<div id="derecho">
		<?php
			include_once './php/Conexion/UsuariosBD.php';
			include_once './php/Conexion/AsignaturasBD.php';
			include_once './php/Conexion/PlanBD.php';
			$ubd = new UsuariosBD();
			$abd = new AsignaturasBD();
			$pbd = new PlanBD();
			$cantusers = $ubd->consultarCantidadUsuarios(1);
			echo '<p><strong>Número de Usuarios registrados: '.$cantusers.'</strong></p>';
			$cantusers = $ubd->consultarCantidadUsuarios(2);
			echo '<p><strong>Número de Docentes registrados: '.$cantusers.'</strong></p>';
			$cantusers = $ubd->consultarCantidadUsuarios(3);
			echo '<p><strong>Número de Estudiantes registrados: '.$cantusers.'</strong></p>';
			$cantasig = $abd->consultarCantidadAsignaturas();
			echo '<p><strong>Número de Asignaturas registradas: '.$cantasig.'</strong></p>';
			$cantplan = $pbd->consultarCantidadPlanes();
			echo '<p><strong>Número de Asignaturas registradas: '.$cantplan.'</strong></p>';
		?>
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
