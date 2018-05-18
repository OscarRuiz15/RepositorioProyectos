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
	<link rel="stylesheet" type="text/css" href="css/cuerpo_info_proyectos.css">
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
  <?php
    include_once './php/Modelo/Asignaturas.php';
    include_once './php/Conexion/AsignaturasBD.php';
    include_once './php/Modelo/Usuarios_Proyecto.php';
    include_once './php/Conexion/Usuarios_ProyectoBD.php';
    include_once './php/Modelo/Proyectos.php';
    include_once './php/Conexion/ProyectosBD.php';
    include_once './php/Modelo/Usuarios.php';
    include_once './php/Conexion/UsuariosBD.php';
    $id=$_GET['id'];
    $docente=$_SESSION['user_id'];
    $id_asi=  substr($id, 0,7);
    $grupo=  $_GET['grupo'];
    $year= $_GET['year'];
    $periodo= $_GET['periodo'];
    $abd=new AsignaturasBD();
    $pbd=new ProyectosBD();
    $upbd=new UsuariosProyectoBD();
    $ubd=new UsuariosBD();
    $usupro=$upbd->consultarProyectosId($docente, $id_asi, $year, $grupo, $periodo);
    $asignatura=$abd->consultarAsignaturaId($id_asi);
  ?>
	<header>
		<?php include "php/cabecera_usuario_asignatura.php"; ?>
	</header>
	
	<div id="cuerpo">
		<ul class="breadcrumb">
  			<li><a href="home.php">Area Personal</a></li>
  			<?php 
        echo '<li><a href="#">'.$id.'-'.$grupo.'-'.$periodo.'-'.$year.'</a></li>';
        ?>
		</ul>
		
		<section>
		<?php
      
                    
      echo '<br><br><br><center><strong>'.$asignatura->getNombre().' - '.$grupo.'-'.$year.'-'.$periodo.'</strong></center>';
      echo '<div id="proyectos">';
      for ($i=0; $i < count($usupro); $i++) { 
        $proyecto=$pbd->consultarProyectoId($usupro[$i]->getId_Proyectos()); 
			 	echo 
				'<div class="proyecto">
					<a href="detalles_proyecto.php?id='.$usupro[$i]->getId_Proyectos().'&asi='.$id_asi
                                        .'&grupo='.$grupo.'&year='.$year
                                        .'&periodo='.$periodo.'">' .$proyecto->getNombre().'</a>';
          $integrantes=$ubd->consultarIntegrantes($usupro[$i]->getId_Proyectos());
          echo '<strong><br>';
          for ($j = 0; $j < count($integrantes); $j++) {
            echo '<li>'.$integrantes[$j]->getApellidos().' '.$integrantes[$j]->getNombres(). '</li>';
          }
				  echo ' </strong></div>';
			}
      echo '</div>';
    ?>
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