<?php
	include_once '/../Conexion/UsuariosBD.php';
	include_once '/../Modelo/Usuarios.php';
	$pass_actual=$_POST['contra'];
	$pass_nuevo=$_POST['c1'];
	$pass_confirmar=$_POST['c2'];

	$ubd=new UsuariosBD();
	$id=1234;
	$user=$ubd->consultarUsuario($id);
	$pass=$user->getContrasena();
	if($pass_confirmar!=$pass_nuevo){
	    print "<script>alert(\"Las contraseñas no coinciden.\");window.location='../../cambiar_password_admin.php';<script>";
	}else if($pass_actual==$pass){
	    $user->setContrasena($pass_nuevo);
	    $ubd->ModificarUsuario($user);
	    print "<script>alert(\"La contraseña ha sido cambiada exitosamente.\");window.location='../../home_admnistrador.php';<script>";
	}else{
	    print "<script>alert(\"La contraseña nueva no coincide con la actual.\");window.location='../../cambiar_password_admin.php';<script>";
	}

?>
