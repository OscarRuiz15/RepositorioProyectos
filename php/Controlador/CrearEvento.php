<?php

    include_once '/../Modelo/Asignaturas.php';
    include_once '/../Conexion/AsignaturasBD.php';
    include_once '/../Modelo/Usuarios_Proyecto.php';
    include_once '/../Conexion/Usuarios_ProyectoBD.php';
    include_once '/../Modelo/Proyectos.php';
    include_once '/../Conexion/ProyectosBD.php';
    include_once '/../Modelo/Usuarios.php';
    include_once '/../Conexion/UsuariosBD.php';
    include_once '/../Modelo/Eventos.php';
    include_once '/../Conexion/EventosBD.php';
    include_once '../Modelo/Archivos.php';
    include_once '../Conexion/ArchivosBD.php';
    $id = $_GET['id'];
    $asi = $_GET['asi'];
    $grupo = $_GET['grupo'];
    $year = $_GET['year'];
    $periodo = $_GET['periodo'];

    $autor = $_GET['usuario'];
    $nombre=$_POST['txtnombre'];
    $Descripcion=$_POST['txtdescripcion'];

     $fechaactual = getdate();
    $date="$fechaactual[year]:$fechaactual[mon]:$fechaactual[mday] $fechaactual[hours]:$fechaactual[minutes]:$fechaactual[seconds]";

    $ebd=new EventosBD();
      $listaeventos=$ebd->consultarEventos();
      $id_evento=  count($listaeventos)+1;
      $evento=new Eventos($id_evento,$id,$autor,$nombre,$Descripcion,$date);
      $ebd->InsertarEvento($evento);

      $dir = "../../docs/Proyectos/".$id."/".$id_evento."/";
      if (file_exists($dir)) {
        $explorar = scandir($dir);  
        $total_archivos = count($explorar); 
        for($x=0;$x<$total_archivos;$x++){
          if ($explorar[$x] != "." && $explorar[$x] != "..") {
            $abd=new ArchivosBD();
            $archivos=new Archivos(0, $id_evento, $date, $dir.$explorar[$x], $explorar[$x], "un tamaño");
            $abd->InsertarArchivo($archivos);
          }
        }
      }

      $link='detalles_proyecto.php?id='.$id.'&asi='.$asi.'&grupo='.$grupo.'&year='.$year.'&periodo='.$periodo;
      print "<script>alert(\"El evento se ha registrado.\");window.location='../../$link';</script>";
