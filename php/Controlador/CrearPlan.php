<?php

include_once '/../Conexion/PlanBD.php';
include_once '/../Modelo/Plan.php';

$id = $_POST['txtcodigo'];
$nombre = $_POST['txtnombre'];
$pbd = new PlanBD();
$plan = $pbd->consultarPlanId($id);
if (!is_null($plan)) {
    print "<script>alert(\"El plan ya existe.\");window.location='../../nuevo_plan.php';</script>";
} else {
    $plan = new Plan($id, $nombre);
    $pbd->InsertarPlan($plan);
    print "<script>alert(\"El plan ha sido registrado.\");window.location='../../nuevo_plan.php';</script>";
}


