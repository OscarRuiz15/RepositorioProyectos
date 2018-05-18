<?php
	session_start();
	include_once '/../Conexion/UsuariosBD.php';
	include_once '/../Modelo/Usuarios.php';
	$Documento=$_SESSION['user_id'];
	$Correo=$_POST['txtcorreo'];
	$ubd=new UsuariosBD();
	$user=$ubd->consultarUsuario($Documento);

	//FOTO
    $storeFolder = '../../docs/Usuarios/';
    $usuario = $Documento . "/";
    $direccion = $storeFolder . $usuario;

    if (!file_exists($direccion)) {
        mkdir($direccion, 0777, true);
    }

    //$ruta = "../../docs/".$Documento."/"; //ruta carpeta donde queremos copiar las imágenes 
    $uploadfile_temporal = $_FILES["imagen"]['tmp_name'];
    $uploadfile_nombre = $direccion . $_FILES["imagen"]['name'];
    if ($_FILES['imagen']['tmp_name'] != "") {
        if (is_uploaded_file($uploadfile_temporal)) {
            move_uploaded_file($uploadfile_temporal, $uploadfile_nombre);
            $user->setFoto($uploadfile_nombre);
        } else {
        	$user->setFoto($user->getFoto());
        }
    } else {
    	$user->setFoto($user->getFoto());
    }
	$user->setCorreo($Correo);
	$ubd->ModificarUsuario($user);

	print "<script>alert(\"Datos actualizados.\");window.location='../../home.php';</script>";

?>