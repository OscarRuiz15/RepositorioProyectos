<?php
      include_once '../Modelo/Usuarios_Proyecto.php';
      include_once '../Conexion/Usuarios_ProyectoBD.php';
      include_once '../Modelo/Proyectos.php';
      include_once '../Conexion/ProyectosBD.php';
      include_once '../Modelo/Usuarios.php';
      include_once '../Conexion/UsuariosBD.php';
      include_once '../Modelo/Eventos.php';
      include_once '../Conexion/EventosBD.php';
      include_once '../Modelo/Archivos.php';
      include_once '../Conexion/ArchivosBD.php';
      $Titulo=$_REQUEST['titulo'];
      $Descripcion=$_REQUEST['descripcion'];
      $Integrantes=$_REQUEST['integrantes'];
      $asignatura=$_REQUEST['asignatura'];
      $grupo=$_REQUEST['grupo'];
      $year=$_REQUEST['year'];
      $periodo=$_REQUEST['periodo'];

      $CodigoIntegrantes=explode(',',$Integrantes);

      $fechaactual = getdate();
      $date="$fechaactual[year]:$fechaactual[mon]:$fechaactual[mday] $fechaactual[hours]:$fechaactual[minutes]:$fechaactual[seconds]";
      /*$time=  time();
      $date= date("d-m-Y H:i:s", $time);*/

      $pbd=new ProyectosBD();
      $listaproyectos=$pbd->consultarProyectos();
      $id_proyecto=  count($listaproyectos)+1;
      $proyecto=new Proyectos($id_proyecto, $Titulo, $date, $Descripcion, 1);
      $pbd->InsertarProyecto($proyecto);
      $ubd=new UsuariosBD();
      $upbd=new UsuariosProyectoBD();
      for ($i = 0; $i < count($CodigoIntegrantes); $i++) {
          $usuario=$ubd->consultarUsuarioCodigo($CodigoIntegrantes[$i]);
          $usuarioproyecto=new Usuarios_Proyecto($usuario->getDocumento(), $id_proyecto, $asignatura, $year, $periodo, $grupo);
          $upbd->InsertarUsuarioProyecto($usuarioproyecto);
      }

      $ebd=new EventosBD();
      $listaeventos=$ebd->consultarEventos();
      $id_evento=  count($listaeventos)+1;
      $evento=new Eventos($id_evento,$id_proyecto,$CodigoIntegrantes[count($CodigoIntegrantes)-1],"Creacion de Proyecto","Docente ".$CodigoIntegrantes[count($CodigoIntegrantes)-1]." creó el proyecto ".$Titulo."",$date);
      $ebd->InsertarEvento($evento);

      $dir = "../../docs/Proyectos/".$id_proyecto."/".$id_evento."/";
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
      
      $link='info_proyectos.php?id='.$asignatura.'&grupo='.$grupo.'&year='.$year.'&periodo='.$periodo;
      print "<script>alert(\"Proyecto Creado.\");window.location='../../$link';</script>";
  ?>