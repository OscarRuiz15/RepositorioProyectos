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
  <link rel="stylesheet" type="text/css" href="css/cuerpo_profile.css">
  <link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
  <script type="text/javascript" src="js/input.js"></script>
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

          <!--<div id="perfil"><img id="perfil" src="images/administrador.png"></div>-->
        </ul>
      </nav>
    </div>
  </header>
  
  <div id="cuerpo">
    <ul class="breadcrumb">
        <li><a href="home.php">Area Personal</a></li>
        <li><a href="#">Perfil</a></li>
    </ul>
    <section>
    <br><br><br>
      <div id="datos">
      <p class="titulo"><b>General:</b></p><hr></hr>
        <form class="captura" action="php/Controlador/ActualizarDatos.php" method="post" name="captura" enctype="multipart/form-data">
          <strong><label id="Tipo">Tipo:</label></strong>
          <?php if($_SESSION['tipo_user'] == 2):?>
          <?php
          echo'<input type="text" name="txttipo" disabled value="Docente"><br>';
          ?>
          <?php else:?>
          <?php
          echo'<input type="text" name="txttipo" disabled value="Estudiante"><br>';
          ?>
          <?php endif; ?> 

          <strong><label for="txtdocumento">Documento</label></strong>
          <?php
          echo'<input type="text" name="txtdocumento" disabled value="'.$user->getDocumento().'"><br>';
          ?>

          <strong><label for="txtnombre">Nombre:</label></strong>
          <?php
          echo '<input type="text" name="txtnombre" disabled value="'.$user->getNombres().'"><br>';
          ?>

          <strong><label for="txtapellido">Apellido(s):</label></strong>
          <?php
          echo '<input type="text" name="txtapellido" disabled value="'.$user->getApellidos().'"><br>';
          ?>

          <strong><label for="txtcorreo">Correo Electronico:</label></strong>
          <?php
          echo '<input type="text" name="txtcorreo" required value="'.$user->getCorreo().'"><br>';
          ?>
          
          <?php if($_SESSION['tipo_user'] == 3):?>
          <strong><label for="txtcodigo">Código:</label></strong>
            <?php
            echo '<input type="text" name="txtcodigo" disabled value="'.$user->getCodigo().'"><br>';
            ?>
          <?php endif; ?>         
          
          <strong><label for="imagen">Fotografia o Imagen:</label></strong>
              <input type="file" name="imagen" onBlur='LimitAttach(this,1);'><br>

          <center><button type="submit" id="btnActualizar">Actualizar Datos</button></center>

        </form>
        <br><br>
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

