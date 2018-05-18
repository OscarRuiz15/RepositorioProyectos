<?php
	include_once '/../Modelo/Usuarios_Asignaturas.php';
	include_once '/../Conexion/Usuarios_AsignaturasBD.php';

	$Estudiante=$_POST['check'];
    $count = count($Estudiante);
    $id_asignatura=$_GET['asignatura'];
    $year=$_GET['year'];
    $periodo=$_GET['periodo'];
    $grupo=$_GET['grupo'];
    for ($i = 0; $i < $count; $i++) {
    	$uabd = new Usuarios_AsignaturasBD();
    	$relacion = new Usuarios_Asignaturas($Estudiante[$i], $id_asignatura, $year, $periodo, $grupo);
        $uabd->InsertarUsuarioAsig($relacion);
    }

    $link='info_proyectos.php?id='.$id_asignatura.'&grupo='.$grupo.'&year='.$year.'&periodo='.$periodo;
    print "<script>alert(\"Estudiante(s) registrado(s).\");window.location='../../$link';</script>";

	
?>