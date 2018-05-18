<?php
	session_start(); 
    if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado'){ 
      if($_SESSION['tipo_user'] == 1){
        print "<script>window.location='home_administrador.php';</script>";
      }
      if($_SESSION['tipo_user'] == 2){
      
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
	<link rel="stylesheet" type="text/css" href="css/cuerpo_listado_estudiantes.css">
	<link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
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
	<?php
		include_once './php/Conexion/UsuariosBD.php';
	    include_once './php/Modelo/Usuarios.php';
	    $Documento = $_SESSION["user_id"];
	    $ubd = new UsuariosBD();

	    $user = $ubd->consultarUsuario($Documento);
	    $nombre=$user->getNombres();
	    $foto=$user->getFoto();

        $id_asignatura=$_GET['asignatura'];
        $year=$_GET['year'];
        $periodo=$_GET['periodo'];
        $grupo=$_GET['grupo'];

	?>
		<div id="cabecera">
			<a href="http://www.univalle.edu.co"><img src="images/LogoUnivalle.png"></a>
			<div class="menu_bar">
		<a href="#" class="bt-menu">Menú</a>
	</div>
			<nav>
				<ul class="menu">
					<li><a href="home.php">Inicio</a></li>
					<?php if($_SESSION['tipo_user'] == 2):?>
				<?php
				echo 
				'<li><a href="crear_proyecto.php?asignatura='.$id_asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'">Crear Proyecto</a></li>';
				echo 
				'<li><a href="listado_estudiantes.php?asignatura='.$id_asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'">Listado Estudiantes</a></li>';
                echo 
					'<li><a href="registrar_estudiante.php?asignatura='.$id_asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'&id=1">Registrar Estudiantes</a></li>';         
				?>
				
				<?php endif; ?>	
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
		<ul class="breadcrumb">
  			<li><a href="home.php">Area Personal</a></li>
  			<?php
  			echo 
  			'<li><a href="info_proyectos.php?id='.$id_asignatura.'&grupo='.$grupo.'&year='.$year.'&periodo='.$periodo.'">'.$id_asignatura.'-'.$grupo.'-'.$periodo.'-'.$year.'</a></li>';
			?>
  			<li><a href="#">Listado Estudiantes</a></li>
		</ul>
		<section>
		<?php
			include_once './php/Modelo/Asignaturas.php';
	      	include_once './php/Conexion/AsignaturasBD.php';
	      	$abd=new AsignaturasBD();
			$asignatura=$abd->consultarAsignaturaId($id_asignatura);
			echo '<br><br><br><h2>'.$asignatura->getNombre().' '.$grupo.'-'.$year.'-'.$periodo.'</h2><hr></hr>';
		?>
			
		
			<table id="tabla">
				<tr>
          			<th class="columna1">Nombre</th>
          			<th class="columna2">Código</th>
          			<th class="columna3">Correo</th>
          			<th class="columna4">Imagen</th>         			
          		</tr>

          		<?php
          		$listadoestudiantes=$ubd->consultarEstudiantesAsignatura($id_asignatura,$year,$periodo,$grupo);
          		for ($i=0; $i <count($listadoestudiantes) ; $i++) { 
          			echo '<tr>';
          			echo '<td>'.($i+1).'. '.$listadoestudiantes[$i]->getNombres().' '.$listadoestudiantes[$i]->getApellidos().'</td>';
          			echo '<td>'.$listadoestudiantes[$i]->getCodigo().'</td>';
          			echo '<td>'.$listadoestudiantes[$i]->getCorreo().'</td>';
          			$perfil=substr($listadoestudiantes[$i]->getFoto(), 6, strlen($listadoestudiantes[$i]->getFoto()));
          			echo '<td><img class="imagen" src="'.$perfil.'"></td>';
          			echo '</tr>';
          		}
          		
          		?>
				
				
			</table>
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


