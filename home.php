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
	<title>Repositorio de Proyectos</title>
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
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
		<?php include "php/cabecera_usuario.php"; ?>
	</header>
	
	<div id="cuerpo">
		<section>
			<div id="periodos">
				<center><p><b>PERIODOS ACADEMICOS</b></p></center><hr></hr>
				<ul id="periodos_academicos"> 

					<?php
            include_once './php/Conexion/Usuarios_AsignaturasBD.php';
            include_once './php/Modelo/Usuarios_Asignaturas.php';
            include_once './php/Conexion/AsignaturasBD.php';
            include_once './php/Modelo/Asignaturas.php';
            $Documento = $_SESSION["user_id"];
            $ubd = new Usuarios_AsignaturasBD();
            $abd=new AsignaturasBD();

            $usuasig = $ubd->consultarUsuariosAsignaturasId($Documento);
            $perido_year="";
            for ($i = 0; $i < count($usuasig); $i++) {
              if ($perido_year!=$usuasig[$i]->getYear().$usuasig[$i]->getPeriodo()) {
                if ($i!=0) {
                  echo '</ul> 
									</div>';
                }
                  
                $perido_year=$usuasig[$i]->getYear().$usuasig[$i]->getPeriodo();
                echo
                  '<input type="checkbox" id="spoiler' . $usuasig[$i]->getYear() . $usuasig[$i]->getPeriodo() . '"></input>';
                if ($usuasig[$i]->getPeriodo() == 1) {
                  echo
                    '<label for="spoiler' . $usuasig[$i]->getYear() . $usuasig[$i]->getPeriodo() . '"><b>Febrero-Junio ' . $usuasig[$i]->getYear() . '</b><hr></hr></label>';
                }
                if ($usuasig[$i]->getPeriodo() == 2) {
                  echo
                    '<label for="spoiler' . $usuasig[$i]->getYear() . $usuasig[$i]->getPeriodo() . '"><b>Agosto-Diciembre' . $usuasig[$i]->getYear() . '</b><hr></hr></label>';
                }
                echo
                  '<div class="spoiler">
									<ul>';
                            }
                $asignatura=$abd->consultarAsignaturaId($usuasig[$i]->getId_Asignaturas());
                /*echo
                  '<li><a href="info_proyectos.php?id=' . $asignatura->getId_Asignaturas() . $usuasig[$i]->getGrupo() .$perido_year. '">' . $asignatura->getNombre() . "-" . $usuasig[$i]->getGrupo() . '</a></li>';*/
                echo 
                '<li class="proy"><a href="info_proyectos.php?id='.$asignatura->getId_Asignaturas().'&grupo='.$usuasig[$i]->getGrupo().'&year='.$usuasig[$i]->getYear().'&periodo='.$usuasig[$i]->getPeriodo().'">'. $asignatura->getNombre() . "-" . $usuasig[$i]->getGrupo() . '</a></li>';
            }
          ?>
				</ul>
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