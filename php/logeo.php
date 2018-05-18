
<?php
$Usuario = $_POST['tfUsuario'];
$Contrasena = $_POST['tfContrasena'];

include_once 'Conexion/Conexion.php';
include_once 'Modelo/Usuarios.php';
include_once 'Conexion/UsuariosBD.php';



$ubd = new UsuariosBD();
$usuario=$ubd->consultarUsuarioLog($Usuario, $Contrasena);



if (is_null($usuario)) {
    print "<script>alert(\"Acceso denegado.\");window.location='../login.php';</script>";
} else {
    session_start();
    $_SESSION["user_id"] = $Usuario;

    if ($usuario->getId_Tipo() == 1) {
        $_SESSION["tipo_user"]=$usuario->getId_Tipo();
        $_SESSION["estado"]="Autenticado";
        print "<script>window.location='../home_administrador.php';</script>";
    }
    if ($usuario->getId_Tipo() == 2 || $usuario->getId_Tipo() == 3) {
        $_SESSION["tipo_user"]=$usuario->getId_Tipo();
        $_SESSION["estado"]="Autenticado";
        print "<script>window.location='../home.php';</script>";
    }
}

?>