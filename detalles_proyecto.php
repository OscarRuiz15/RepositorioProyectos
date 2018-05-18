<?php
  session_start(); 
    if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado'){ 
      if($_SESSION['tipo_user'] == 1){
        print "<script>window.location='home_administrador.php';</script>";
      }
      if($_SESSION['tipo_user'] == 2){
      
      }
      if($_SESSION['tipo_user'] == 3){
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
	<link rel="stylesheet" type="text/css" href="css/cuerpo_detalles_proyecto.css">
	<link rel="shortcut icon" href="images/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
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
	<?php
		include_once './php/Conexion/UsuariosBD.php';
	    include_once './php/Modelo/Usuarios.php';

	    include_once './php/Modelo/Proyectos.php';
	    include_once './php/Conexion/ProyectosBD.php';
	    $Documento = $_SESSION["user_id"];
	    $ubd = new UsuariosBD();

	    $user = $ubd->consultarUsuario($Documento);
	    $nombre=$user->getNombres();
	    $foto=$user->getFoto();

      	$grupo=  $_GET['grupo'];
      	$year= $_GET['year'];
      	$periodo= $_GET['periodo'];

      	$id=$_GET['id'];
      	$asi=$_GET['asi'];
      	$pbd=new ProyectosBD();
      	$proyecto=$pbd->consultarProyectoId($id);
	?>
		<div id="cabecera">
			<a href="http://www.univalle.edu.co"><img src="images/LogoUnivalle.png"></a>
			
			<div class="menu_bar">
		<a href="#" class="bt-menu">Menú</a>
	</div>
			<nav>
				<ul class="menu">
					<li><a href="home.php">Inicio</a></li>
					<?php
					$perfil=substr($foto, 6, strlen($foto));
          			echo '<li id="usuario" ><a href="#">'.$nombre.'<img id="perfil" src="'.$perfil.'"></a>';
					?>

						<ul>
							<li><a href="profile.php">Mi perfil</a></li>
							<li><a href="php/logout.php">Cerrar Sesión</a></li>
						</ul>
					</li>
				</ul>
			</nav>
		</div>

	</header>
	
	<div id="cuerpo">
		<div id="pan">
			<ul class="breadcrumb">
  				<li><a href="home.php">Area Personal</a></li>
  				<?php
  			echo 
  			'<li><a href="info_proyectos.php?id='.$asi.'&grupo='.$grupo.'&year='.$year.'&periodo='.$periodo.'">'.$asi.'-'.$grupo.'-'.$periodo.'-'.$year.'</a></li>';
  			echo 
  			'<li><a href="#">'.$proyecto->getNombre().'</a></li>';

  				?>
			</ul>
		</div>
		
		<section>
       	<?php
	      include_once './php/Modelo/Asignaturas.php';
	      include_once './php/Conexion/AsignaturasBD.php';
	      include_once './php/Modelo/Usuarios_Proyecto.php';
	      include_once './php/Conexion/Usuarios_ProyectoBD.php';
	      include_once './php/Modelo/Usuarios.php';
	      include_once './php/Conexion/UsuariosBD.php';
	      include_once './php/Modelo/Eventos.php';
	      include_once './php/Conexion/EventosBD.php';
	      include_once './php/Modelo/Archivos.php';
	      include_once './php/Conexion/ArchivosBD.php';

	      $docente=$_SESSION['user_id'];
	      
	      $abd=new AsignaturasBD();
	      $upbd=new UsuariosProyectoBD();
	      $ubd=new UsuariosBD();
	      $ebd=new EventosBD();
	      $archbd=new ArchivosBD();
	      $asignatura=$abd->consultarAsignaturaId($asi);
	                    
	      echo '<br><br><br><center><strong>'.$asignatura->getNombre().' - '.$grupo.'-'.$year.'-'.$periodo.'</strong></center>';
	      echo '<div id="proyecto">
				<div class="info_proyecto">';
	      $proyecto=$pbd->consultarProyectoId($id);
	      echo '<center><h1>'.$proyecto->getNombre().'</h1></center><hr></hr>';
	      echo '<p><b>'.$proyecto->getDescripcion().'</b></p><hr></hr>';
	      echo '<p><b>Fecha de Creacion:</b></p>';
	      echo '<p>'.$proyecto->getFecha_Creacion().'</p><hr></hr>';
	      echo '		<h3>Integrantes:</h3>';
	      $integrantes=$ubd->consultarIntegrantes($id);
	      for ($i = 0; $i < count($integrantes); $i++) {
	          echo '<li>'.$integrantes[$i]->getApellidos().' '.$integrantes[$i]->getNombres().'</li>';
	      }
	      echo 
	      '<center><button type="submit" class="btnNuevoEvento">
			<a href="crear_evento.php?id='.$id.'&asi='.$asi.'&grupo='.$grupo.'&year='.$year.'&periodo='.$periodo.'">Nuevo Evento</a></button></center>';
      	?>
				<hr></hr>
				<h1>Eventos:</h1>

				<?php
                    $eventos=$ebd->consultarEventosIdProyecto($id);
					for ($i=0; $i <  count($eventos); $i++) { 
						echo
						'<div class="eventos">
							<h3>'.$eventos[$i]->getNombre(). '</h3>
							<p>'.$eventos[$i]->getDescripcion(). '</p>';
                            $autor=$ubd->consultarUsuario($eventos[$i]->getId_Usuarios());
                            $archivos=$archbd->consultarArchivosEvento($eventos[$i]->getId_Eventos());
                            echo '<div class="archivos">';
                            for ($x=0; $x < count($archivos); $x++) { 
                            	$archivo=$archivos[$x]->getArchivo();
                            	$ruta=substr($archivo, 6, strlen($archivo));
                            	$extension = end( explode('.', $archivo) );
                            	$img;
                            	switch($extension){
						      case "xls":
						      $img= 'dist/img/excel20.png';
						      break;
						      case "xlsx":
						      $img= 'dist/img/excel20.png';
						      break;
						      case "pdf":
						      $img= 'dist/img/pdf22.png';
						      break;
						      case "doc":
						      $img= 'dist/img/doc20.png';
						      case "docx":
						      $img= 'dist/img/doc20.png';
						      break;
						      case "zip":
						      $img= 'dist/img/zip20.png';
						      break;
						      case "rar":
						      $img= 'dist/img/rar24.png';
						      break;
						      case "ppt":
						      $img= 'dist/img/ppt24.png';
						      break;
						      case "pptx":
						      $img= 'dist/img/ppt24.png';
						       break;
						      default:
						     $img= 'dist/img/nose20.png';
						      break;
		     } 
                            	echo 
                            	'<li><img src="'.$img.'"><a href="'.$ruta.'" download="'.$archivos[$x]->getNombre().'">'.$archivos[$x]->getNombre().'</a></li>';
                            }
                            echo '</div>';
							echo 
							'<h4>Autor: '.$autor->getApellidos().' '.$autor->getNombres().'</h4>
						</div>';
					}
				?>
				<!--<div class="eventos">
					<h3>Nombre del Evento</h3>
					Aca se supone que van los archivos, no se como se pondran :v
					<h4>Autor: El que lo hizo</h4>
				</div>-->
			</div>
		</div>
		</section>	
	</div>

	<div id="pie">
		<footer>
			<p>Apicaciones en la Web y Redes Inalámbricas - Tecnicas de Pruebas de Software &copy; 2016<br>
			<a href="home.php">Inicio</a></p>
		</footer>	
	</div>
	
</body>
</html>