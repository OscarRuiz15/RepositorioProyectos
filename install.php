<html>
<head>
<title>Instalador REPO</title>
<link rel="stylesheet" type="text/css" href="css/estilo.css">
<link rel="stylesheet" type="text/css" href="css/cuerpo_instalador.css">
<meta http-equiv='content-type' content='text/html; charset=UTF-8'/>
</head>
<body>
<header>
	<div id="cabecera">
		<a href="http://www.univalle.edu.co"><img id="Univalle" src="images/LogoUnivalle.png"></a>

			<nav>
				<ul class="menu">
					<center><li><a href="">.</a></li></center>
				</ul>	
			</nav>
	</div>
</header>
<br>

<div id="contenedor">
<h1>Archivo de Instalación</h1>
<?php 
if(isset($_POST['step1']) || isset($_POST['step2']) || isset($_POST['step3'])){ } else {
	
	echo '
	<form action="install.php" method="post" class="captura" name="captura">
			<strong><label>Nombre del servidor de BD:</label> </strong>
			<input type="text" name="servername" required><br>
			<strong><label>Nombre de la base de datos:</label> </strong>
			<input type="text" name="dbname" required><br> 
			<strong><label>Usuario BD:</label> </strong>
			<input type="text" name="username" required><br> 
			<strong><label>Contraseña:</label> </strong>
			<input type="text" name="password"><br> 
			<center><button type="submit" id="btnEntrar" name="step1">Crear archivo de configuración</button></center>
	</form>';
}
?>


<?php 
if(isset($_POST['step1'])){

	$file = fopen('config.php','w');
	fwrite($file,"<?php	\$con = mysql_connect('$_POST[servername]', '$_POST[username]', '$_POST[password]') or die ('error: no se pudo conectar a mysql'); \$database = '$_POST[dbname]'; ?>");
	fclose($file);
	
	$file = fopen('php/Conexion/Conexion.php','w');
	fwrite($file,
		"<?php
			class Conexion extends PDO {

		    public function __construct() {
		        try {
		            parent::__construct('mysql:host=$_POST[servername];dbname=$_POST[dbname]', '$_POST[username]','$_POST[password]', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
		            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        } catch (Exception \$e) {
		            echo \$e->getMessage();
		        }
		    	}	
			}
			\$c=new Conexion();
		 ?>");
	fclose($file);
	
	echo "<strong>El archivo de conexion y configuracion fue creado correctamente</strong>";
	
	echo '
	<div style="margin-top: 20px;">
		<form action="install.php" method="post" class="captura" name="captura">
		<center><button type="submit" id="btnEntrar" name="step2">Crear base de datos</button></center>
		</form>
	</div>
	';
	
}
?>


<?php 
if(isset($_POST['step2'])){
	include ("config.php");
	mysql_select_db("$database",$con);
	mysql_query("CREATE DATABASE $database CHARACTER SET utf8 COLLATE utf8_general_ci",$con);
	
	echo "<strong>La base de datos $database fue creada correctamente</strong>";

	echo '
	<div style="margin-top: 20px;">
		<form action="install.php" method="post" class="captura" name="captura">
		<center><button type="submit" id="btnEntrar" name="step3">Crear tablas y campos</button></center>
		</form>
	</div>
	';
}
?>


<?php 
if(isset($_POST['step3'])){
	include ("config.php");
	mysql_select_db("$database", $con);
	$texto = file_get_contents("bd.sql");
	$sentencia = explode(";", $texto);
	for($i = 0; $i < (count($sentencia)-1); $i++){
		$db_selected = mysql_query ("$sentencia[$i];") or die(mysql_error()); 
	}

	echo '
	<div style="margin-top: 20px;">
		<form action="install.php" method="post" class="captura" name="captura">
		<div><strong>Base de Datos creada correctamente</strong>
		</form>
	</div>
	';

	echo "<script language='javascript'>window.location.href='index.php';</script>";
}
?>

</div>

</body>
</html>
