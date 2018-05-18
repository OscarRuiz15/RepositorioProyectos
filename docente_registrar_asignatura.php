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
	<link rel="stylesheet" type="text/css" href="css/cuerpo_docente_registrar_asignatura.css">
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
    <ul class="breadcrumb">
        <li><a href="home.php">Area Personal</a></li>
        <li><a href="#">Registrar Asignatura</a></li>
    </ul>
		<section>
    <br><br><br>
			<div id="contenedor">
				<p><b>Registrar Asignatura:</b></p><hr></hr>
				<center>

				<form class="captura" action="docente_registrar_asignatura.php" method="post" name="captura">
					<strong><label for="txtAsignatura">Asignatura:</label></strong>
            <input type="text" name="txtAsignatura" placeholder="Campo de Busqueda" required>
            <button type="submit" id="btnBuscar">Buscar</button>
          </form>
          </center>	

          <?php
          echo 
          '<form class="captura" action="php/Controlador/DocenteRegistrarAsignatura.php?documento='.$Documento.'" method="post" name="captura">';
          ?>
        
          <table border="2px">
           	<tr>
              	<th>Código</th>
              	<th id="columna2">Nombre</th>
              	<th></th>
          	</tr>
          	
            <?php
                if(isset($_POST['txtAsignatura'])){
                  include_once './php/Modelo/Asignaturas.php';
                  include_once './php/Conexion/AsignaturasBD.php';
                  $abd=new AsignaturasBD();
                  $parametro=$_POST['txtAsignatura'];
                  $asignatura=$abd->consultarAsignaturaLike($parametro);
                  for ($i=0; $i < count($asignatura); $i++) { 
                    echo '<tr>';
                    echo '<td>'.$asignatura[$i]->getId_Asignaturas().'</td>';
                    echo '<td>'.$asignatura[$i]->getNombre().'</td>';
                    echo '<td><input type="checkbox" name="check[]" id="check" value="'.$asignatura[$i]->getId_Asignaturas().'"></input></td>';
                    echo '</tr>';
                  }
                }
            ?>
        	</table>
          <br>
				  <center>
          <strong><label for="cbgrupo">Grupo:</label></strong>
            <select name="cbgrupo">
            	
            	<option value="50">50</option> 
            	<option value="51">51</option> 
            	<option value="52">52</option> 
            	<option value="53">53</option> 
            	<option value="54">54</option> 
            	<option value="55">55</option> 
            </select>
          </center>

        
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