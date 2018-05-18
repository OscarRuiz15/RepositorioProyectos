<?php
	include_once '../Modelo/Usuarios_Asignaturas.php';
	include_once '../Conexion/Usuarios_AsignaturasBD.php';

	$Documento=$_GET['documento'];
	$Grupo= $_POST['cbgrupo'];
	$Asignatura=$_POST['check'];
    $count = count($Asignatura);
    $time = time();
    $year = date("Y", $time);
    $mes = date("n", $time);
    $periodo = 1;
    if ($mes > 6) {
    	$periodo = 2;
    }
    
    for ($i = 0; $i < $count; $i++) {
    	$uabd = new Usuarios_AsignaturasBD();
        $relacion=$uabd->consultarUsuariosAsignaturasExistente($Asignatura[$i], $year, $Grupo, $periodo, $Documento);
        if (!is_null($relacion)) {
            print "<script>alert(\"La asignatura ".$Asignatura[$i]."-".$Grupo ." ya la tiene registrada .\");window.location='../../docente_registrar_asignatura.php';</script>";
        }  else {
            $relacion = new Usuarios_Asignaturas($Documento, $Asignatura[$i], $year, $periodo, $Grupo);
        $uabd->InsertarUsuarioAsig($relacion);
        print "<script>alert(\"Asignatura(s) registrada(s).\");window.location='../../home.php';</script>";
        }
    	
    }

    

	
?>