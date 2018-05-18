<?php
include_once '/../Modelo/Asignaturas.php';
include_once '/../Conexion/AsignaturasBD.php';
include_once '/../Modelo/Asignaturas_Plan.php';
include_once '/../Conexion/Asignaturas_PlanBD.php';

$codigo = $_POST['txtcodigo'];
$nombre = $_POST['txtnombre'];
$plan=$_POST['cbplan'];
$id_plan=  substr($plan, 0,4);
$abd=new AsignaturasBD();
$asignatura=$abd->consultarAsignaturaId($codigo);
if (!is_null($asignatura)){
    print "<script>alert(\"La asignatura ya existe.\");window.location='../../registrar_asignatura.php';</script>";
}else{
$asignatura=new Asignaturas($codigo, $nombre);
$abd->InsertarAsignatura($asignatura);
$asi_plan=new Asignaturas_Plan($codigo, $id_plan);
$apbd=new Asignaturas_PlanBD();
$apbd->InsertarAsignaturaPlan($asi_plan);
print "<script>alert(\"La asignatura ha sido registrada.\");window.location='../../registrar_asignatura.php';</script>";
}