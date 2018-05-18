<?php
  session_start(); 
    if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado'){ 
      if($_SESSION['tipo_user'] == 1){
      }
      if($_SESSION['tipo_user'] == 2){
        print "<script>window.location='home.php';</script>";
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
  <link rel="stylesheet" type="text/css" href="css/cuerpo_nuevo_plan.css">
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
    <?php include "php/cabecera_admin.php"; ?>
  </header>
  
  <div id="cuerpo">
    <section>
      <div id="formulario">
      <p class="titulo"><b>Registrar Plan:</b></p><hr></hr>
        <form class="captura" action="php/Controlador/CrearPlan.php" method="post" name="captura">
          <strong><label for="txtcodigo">Código:</label></strong>
            <input type="text" name="txtcodigo" placeholder="Código" required><br> 
          <strong><label for="txtnombre">Nombre:</label></strong>
            <input type="text" name="txtnombre" placeholder="Nombre" required><br> 
          <button type="submit" id="btnRegistrar">Registrar</button>
          <button type="reset" id="btnVaciar">Vaciar</button>
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


