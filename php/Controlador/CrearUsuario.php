<?php

include_once '/../Conexion/UsuariosBD.php';
include_once '/../Conexion/Usuarios_PlanBD.php';
include_once '/../Modelo/Usuarios.php';
include_once '/../Modelo/Usuarios_Plan.php';
include_once '/../Modelo/Usuarios_Asignaturas.php';
include_once '/../Conexion/Usuarios_AsignaturasBD.php';

$Documento = $_POST['txtdocumento'];
$tipo = $_POST['cbtipo'];
$Nombre = $_POST['txtnombre'];
$apellido = $_POST['txtapellido'];
$correo = $_POST['txtcorreo'];
//$foto=$_FILE['imagen'];
$codigo;
$contrasena = $_POST['txtcontrasena'];
$confirmar = $_POST['txtconfirmar'];
$id_tipo;
if ($tipo == 'Estudiante') {
    $id_tipo = 3;
    $codigo = $_POST['txtcodigo'];
} else {
    $id_tipo = 2;
    $codigo = $_POST['txtdocumento'];
}
$ubd = new UsuariosBD();
$user = $ubd->consultarUsuario($Documento);
if ($confirmar == $contrasena) {
    if (!is_null($user)) {
        print "<script>alert(\"El documento ya existe.\");window.location='../../registrar_usuario.php';</script>";
    } else {
        $user = $ubd->consultarUsuarioEmail($correo);
        if (!is_null($user)) {
            print "<script>alert(\"El correo ya esta registrado.\");window.location='../../registrar_usuario.php';</script>";
        } else {
            $user = $ubd->consultarUsuarioCodigo($codigo);
            if (!is_null($user)) {
                print "<script>alert(\"El codigo ya esta registrado.\");window.location='../../registrar_usuario.php';</script>";
            } else {
                //FOTO
                $storeFolder = '../../docs/Usuarios/';
                $usuario = $Documento . "/";
                $direccion = $storeFolder . $usuario;

                if (!file_exists($direccion)) {
                    mkdir($direccion, 0777, true);
                }
                else{
                }

                //$ruta = "../../docs/".$Documento."/"; //ruta carpeta donde queremos copiar las imágenes 
                $uploadfile_temporal = $_FILES["imagen"]['tmp_name'];
                $uploadfile_nombre = $direccion . $_FILES["imagen"]['name'];

                if ($_FILES['imagen']['tmp_name'] != "") {
                    if (is_uploaded_file($uploadfile_temporal)) {
                        move_uploaded_file($uploadfile_temporal, $uploadfile_nombre);
                    } else {
                        copy("../../images/perfil.png", $direccion . "perfil.png");
                        $predeterminada = "../../images/perfil.png";
                    }
                } else {
                    $predeterminada = "../../images/perfil.png";
                    copy($predeterminada, $direccion . "perfil.png");
                }

                $directorio = opendir($direccion);
                while ($ficheros = readdir($directorio)) {
                    $url = $direccion . $ficheros;
                    //echo "<img src=" . $url . ">";
                }
                $user = new Usuarios($Documento, $id_tipo, $Nombre, $apellido, $correo, $codigo, $contrasena, 1, $url);
                $ubd = new UsuariosBD();
                $ubd->InsertarUsuario($user);
                $relacion = null;
                if ($id_tipo == 3) {
                    $upbd = new Usuarios_PlanBD();
                    $plan = $_POST['cbplan'];

                    $id_plan = substr($plan, 0, 4);
                    $relacion = new Usuarios_Plan($Documento, $id_plan);
                    $upbd->InsertarUsuarioPlan($relacion);
                } else {
                    $uabd = new Usuarios_AsignaturasBD();

                    $asi = $_POST['cbasignatura'];
                    $id_asi = substr($asi, 0, 7);
                    $time = time();
                    $year = date("Y", $time);
                    $mes = date("n", $time);
                    $periodo = 1;
                    if ($mes > 6) {
                        $periodo = 2;
                    }
                    $grupo = $_POST['cbgrupo'];
                    $relacion = new Usuarios_Asignaturas($Documento, $asi, $year, $periodo, $grupo);
                    $uabd->InsertarUsuarioAsig($relacion);
                    
                }
                print "<script>alert(\"Usuario registrado.\");window.location='../../home_administrador.php';</script>";
            }
        }
    }
} else {
    print "<script>alert(\"No coincide las contraseñas.\");window.location='../../registrar_usuario.php';</script>";
    
}
?>