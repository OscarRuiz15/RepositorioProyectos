<?php
  session_start(); 

  if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado') 
  { 
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
		<div id="contenido">
		<section>
			<b><p><center>Base de Conocimiento de Proyectos del programa Tecnología en Sistemas de Información.</center></p></b>
			<p>Proposito: Contar con una base de conocimiento que permita registrar y gestionar todo lo concerniente a los proyectos del software que se desarrollan en cada una de las cátedras del programa por parte de los estudiantes.</p><br>
			<p>Dirigido a: Docentes y Estudiantes de la Universidad del Valle – Sede Buga.</p>
			<br><b><p>Documentos:</p></b>
			<li class="documento"><a href="docs/Manual de Usuario.pdf" dowload="Manual de Usuario">Manual de Usuario</a></li>
			<li class="documento"><a href="docs/formatoPlanGuia PROYECTO.docx" dowload="formatoPlanGuia PROYECTO">Formato Plan Guia</a></li>
			<center><img src="images/logo.png"></center>
		</section>	
	</div>
	</div>

	<div id="pie">
		<footer>
			<p>Apicaciones en la Web y Redes Inalámbricas - Tecnicas de Pruebas de Software &copy; 2016<br>
			<a href="index.php">Inicio</a></p>
		</footer>	
	</div>
	
</body>
</html>