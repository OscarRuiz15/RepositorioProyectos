<?php

	include_once '/../Conexion/UsuariosBD.php';
	include_once '/../Modelo/Usuarios.php';
	$Usuario=$_POST['tfUsuario'];
	$ubd = new UsuariosBD();
	$user = $ubd->consultarUsuario($Usuario);
	$paso=0;

	if(!is_null($user)){
		$paso=1;
	}
	else{
		$paso=0;
		$user = $ubd->consultarUsuarioCodigo($Usuario);
		if(!is_null($user)){
			$paso=1;
		}
		else{
			$paso=0	;
			$user = $ubd->consultarUsuarioEmail($Usuario);
			if(!is_null($user)){
				$paso=1;
			}
			else{
				$paso=0;
			}	
		}
	}
		

	if($paso==1){
		$email=$user->getCorreo();
		$nombre=$user->getNombres()." ".$user->getApellidos();
		$usuario=$user->getDocumento();
		$contra=$user->getContrasena();
		require_once('PHPMailerAutoload.php');

		//Creamos una instancia en lugar usar mail()
		$correo = new PHPMailer();

		//Le decimos al script que utilizaremos SMTP
		$correo->IsSMTP();

		//Activaremos la autentificación SMTP el cual se utiliza en la mayoría de casos
		$correo->SMTPAuth = true;

		//Especificamos la seguridad de la conexion, puede ser SSL, TLS o lo dejamos en blanco si
		$correo->SMTPSecure = 'ssl';

		//Especificamos el host del servidor SMTP
		$correo->Host = "smtp.gmail.com";

		//Especficiamos el puerto del servidor SMTP
		$correo->Port = 465;

		$correo->CharSet = "UTF-8";

		//El usuario del servidor SMTP
		$correo->Username   = "repositorioproyectosunivalle@gmail.com";

		//Contraseña del usuario
		$correo->Password   = "1234proyecto";

		//Usamos el SetFrom para decirle al script quien envia el correo
		$correo->SetFrom("repositorioproyectos@gmail.com", "Cuentas Repositorio");

		//Usamos el AddReplyTo para decirle al script a quien tiene que responder el correo
		$correo->AddReplyTo("repositorioproyectos@gmail.com","Repositorio de Proyectos");

		//Usamos el AddAddress para agregar un destinatario
		$correo->AddAddress($email, $nombre);

		//Ponemos el asunto del mensaje
		$correo->Subject = "Información sobre la cuenta";

		/*
		 * Si deseamos enviar un correo con formato HTML utilizaremos MsgHTML:
		 * $correo->MsgHTML("<strong>Mi Mensaje en HTML</strong>");
		 * Si deseamos enviarlo en texto plano, haremos lo siguiente:
		 * $correo->IsHTML(false);
		 * $correo->Body = "Mi mensaje en Texto Plano";
		 */
		$correo->IsHTML(false);
		$correo->Body = "Apreciado(a) usuario(a): ".$nombre."\n\nHemos recibido su solicitud de recuperar cuenta para ingresar a nuestro sistema, a continuacion le proporcionamos sus datos:\n\n\nUsuario: ".$usuario."\nContraseña: ".$contra."\n\n\nSaludos.";

		//Si deseamos agregar un archivo adjunto utilizamos AddAttachment
		//$correo->AddAttachment("examples/images/phpmailer.png");

		//Enviamos el correo
		if(!$correo->Send()) {
		  print "<script>alert(\"Por favor comprueba tu conexion a internet\");window.location='../../recuperar_password.php?op=1';</script>";
		} else {
		  print "<script>window.location='../../recuperar_password.php?op=2';</script>";
		}
	}
	else{
		print "<script>window.location='../../recuperar_password.php?op=3';</script>";
	}

	//1 -> Cuando lo encuentra pero no hay internet
	//2 -> Cuando lo encuentra y tiene internet para mandarlo
	//3 -> Si el correo o nombre de usuario no esta registrado en la BD
?>