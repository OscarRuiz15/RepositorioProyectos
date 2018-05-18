<?php
	include_once './php/Conexion/UsuariosBD.php';
    include_once './php/Modelo/Usuarios.php';
    $Documento = $_SESSION["user_id"];
    $ubd = new UsuariosBD();

    $user = $ubd->consultarUsuario($Documento);
    $nombre=$user->getNombres();
    $foto=$user->getFoto();
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
					<li><a href="docente_registrar_asignatura.php">Registrar Asignatura</a></li>
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

					<!--<div id="perfil"><img id="perfil" src="images/administrador.png"></div>-->
				</ul>
			</nav>
		</div>