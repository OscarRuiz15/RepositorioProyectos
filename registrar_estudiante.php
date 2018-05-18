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
	<link rel="stylesheet" type="text/css" href="css/cuerpo_registrar_estudiante.css">
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
  			<li><a href="#">Registrar Estudiantes</a></li>
		</ul>

		<section>
		<br><br><br>
			<div id="contenedor">
				<p><b>Registrar Estudiante:</b></p><hr></hr>
				<center>
				<?php
				echo 
				'<form class="captura" action="registrar_estudiante.php?asignatura='.$id_asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'&id=2" method="post" name="captura">'
				?>
				
					<strong><label for="txtEstudiante">Estudiante:</label></strong>
            		<input type="text" name="txtEstudiante" placeholder="Campo de Busqueda" required></input>
            		<button type="submit" id="btnBuscar">Buscar</button>
          		</form>
          		</center>	

          		<?php 
				    echo '<form class="captura" action="php/Controlador/DocenteRegistrarEstudiante.php?asignatura='.$id_asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'" method="post" name="captura">';
          		?>
          		<table border="2px">
		           	<tr>
		              	<th>Código</th>
		              	<th id="columna2">Nombre</th>
		              	<th></th>
		          	</tr>
		          	<?php
		          		include_once './php/Conexion/UsuariosBD.php';
	                    include_once './php/Modelo/Usuarios.php';
	                    $ubd=new UsuariosBD();
		          		$id=$_GET['id'];
		          		if($id==1){
		          			
	                    	$d = array();
	                    	$d=$ubd->consultarEstudiantes($id_asignatura, $year, $periodo, $grupo);
	                 
	                    	for ($i = 0; $i < count($d);$i++) {
	                      		echo '<tr>';
		                        echo '<td>'.$d[$i]->getCodigo().'</td>';
		                        echo '<td>'.$d[$i]->getNombres().' '.$d[$i]->getApellidos().'</td>';
		                        echo '<td><input type="checkbox" name="check[]" id="check" value="'.$d[$i]->getDocumento().'"></td>';
		                        echo '</tr>';
	                    	}
		          		}
		          		else{
			                $parametro=$_POST['txtEstudiante'];
			                $usuario=$ubd->consultarEstudiantesLike($parametro, $id_asignatura, $year, $periodo, $grupo);
			                for ($i=0; $i < count($usuario); $i++) { 
			                	echo '<tr>';
			                    echo '<td>'.$usuario[$i]->getCodigo().'</td>';
			                    echo '<td>'.$usuario[$i]->getNombres().' '.$usuario[$i]->getApellidos().'</td>';
			                    echo '<td><input type="checkbox" name="check[]" id="check" value="'.$usuario[$i]->getDocumento().'"></input></td>';
			                    echo '</tr>';
			                }
		          		}
                    	
              		?>
		        </table>
          		<br>
        		<center>
          			<button type="submit" id="btnRegistrar">Registrar</button>
          			<button type="reset" id="btnVaciar">Vaciar</button>
        		</center>
   				</form>
        		<br>
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