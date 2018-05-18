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
  <link rel="stylesheet" type="text/css" href="css/cuerpo_registrar_usuario.css">
  <script type="text/javascript" src="js/registrar_usuario.js"></script>
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
    <?php include "php/cabecera_admin.php"; ?>
  </header>
  
  <div id="cuerpo">
    <section>
      <div id="formulario">
        <p class="titulo"><b>Registrar Usuario:</b></p><hr></hr>
        
        <form class="captura" action="php/Controlador/CrearUsuario.php" method="post" name="captura" enctype="multipart/form-data">        
        <table class="table table-bordered">
          <tr>
            <td>
              <strong>Tipo</strong><br>
              <select name="cbtipo" id="cbtipo" class="boton" onChange="comprobarOption()">
                <option>Estudiante</option>
                <option>Docente</option>
              </select><br><br>

              <strong>Documento</strong><br>
              <input type="number" name="txtdocumento" placeholder="Documento" required> <br><br>

              <strong>Nombres</strong><br>
              <input type="text" name="txtnombre" placeholder="Nombres" required><br><br>

              <strong>Apellidos</strong><br>
              <input type="text" name="txtapellido" placeholder="Apellidos" required><br><br>

              <strong>Correo Electronico</strong><br>
              <input type="text" name="txtcorreo" placeholder="Correo Electrónico" required><br><br>

              <strong>Fotografia o Imagen</strong><br>
              <input type="file" name="imagen" id="imagen" onBlur='LimitAttach(this,1);'><br>
            </td>

            <td>
              <strong>Código</strong><br>
              <input type="number" name="txtcodigo" placeholder="Código" required><br><br>

              <strong>Contraseña</strong><br>
              <input type="password" name="txtcontrasena" placeholder="Contraseña" required><br><br>

              <strong>Repita la Contraseña</strong><br>
              <input type="password" name="txtconfirmar" placeholder="Repita la Contraseña" required><br><br>

              <strong>Plan</strong><br>
              <select name="cbplan">
              <?php  
                include_once '/php/Conexion/PlanBD.php';
                include_once '/php/Modelo/Plan.php';
                $pbd = new PlanBD();
                $d = array();
                $d = $pbd->consultarPlanes();
                for ($i = 0; $i < count($d); $i++) {
                  echo '<option value="'.$d[$i]->getId_Planes().'" select>'.$d[$i]->getId_Planes()." - ".$d[$i]->getNombre().'</option>';
                }
              ?>
              </select><br><br>

              <strong>Asignatura</strong><br>
              <select name="cbasignatura" disabled>
                <?php
                  include_once './php/Conexion/AsignaturasBD.php';
                  include_once './php/Modelo/Asignaturas.php';
                  $abd=new AsignaturasBD();
                  $d = array();
                  $d=$abd->consultarAsignatura();
                  for ($i = 0; $i < count($d);$i++) {
                        echo '<option value="'.$d[$i]->getId_Asignaturas().'" select>'.$d[$i]->getId_Asignaturas()." - ".$d[$i]->getNombre().'</option>';
                  }
                ?>
              </select><br><br>

              <strong>Grupo</strong><br>
              <select name="cbgrupo" disabled>
                <option value="0">0</option> 
                <option value="50">50</option> 
                <option value="51">51</option> 
                <option value="52">52</option> 
                <option value="53">53</option> 
                <option value="54">54</option> 
                <option value="55">55</option>
              </select><br><br>

              <button type="submit" id="btnRegistrar">Registrar</button>
              <button id="btnCancelar"><a href="home_administrador.php">Cancelar</a></button>
            </td>
          </tr>
        </table>
        </form>
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

