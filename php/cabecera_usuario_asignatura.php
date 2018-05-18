<?php
    include_once './php/Conexion/UsuariosBD.php';
    include_once './php/Modelo/Usuarios.php';
    $Documento = $_SESSION["user_id"];
    $ubd = new UsuariosBD();

    $user = $ubd->consultarUsuario($Documento);
    $nombre=$user->getNombres();
    $foto=$user->getFoto();
    $year= $_GET['year'];
    $periodo= $_GET['periodo'];
    $grupo=  $_GET['grupo'];
    $id=$_GET['id'];
    $id_asi=  substr($id, 0,7);
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
				'<li><a href="crear_proyecto.php?asignatura='.$id_asi.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'">Crear Proyecto</a></li>';
				echo 
				'<li><a href="listado_estudiantes.php?asignatura='.$id_asi.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'">Listado Estudiantes</a></li>';
                echo 
					'<li><a href="registrar_estudiante.php?asignatura='.$id_asi.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'&id=1">Registrar Estudiantes</a></li>';         
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
