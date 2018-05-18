<?php
	session_start(); 
    if(isset($_SESSION['user_id']) and $_SESSION['estado'] == 'Autenticado'){ 
      if($_SESSION['tipo_user'] == 1){
        print "<script>window.location='home_administrador.php';</script>";
      }
      if($_SESSION['tipo_user'] == 2){
      
      }
      if($_SESSION['tipo_user'] == 3){
        print "<script>window.location='home.php';</script>";
      }
    } 
    else {  
      print "<script>window.location='index.php';</script>";      
    }  

    include_once './php/Modelo/Proyectos.php';
    include_once './php/Conexion/ProyectosBD.php';
    include_once './php/Modelo/Eventos.php';
    include_once './php/Conexion/EventosBD.php';
	$pbd=new ProyectosBD();
	$listaproyectos=$pbd->consultarProyectos();
	$id_proyecto=  count($listaproyectos)+1; //Id del nuevo proyecto para crear la carpeta
	$ebd=new EventosBD();
	$listaeventos=$ebd->consultarEventos();
	$id_evento=  count($listaeventos)+1; //Id del nuevo evento para crear la subcarpeta y guardar los archivos
	
	$storeFolder = 'docs/Proyectos/';
	$idProyecto=$id_proyecto."/";
	$idEvento=$id_evento."/";
	$directorio=$storeFolder.$idProyecto.$idEvento;
	if (file_exists($directorio)) {
		$archivos = scandir($directorio); //hace una lista de archivos del directorio
		$num = count($archivos); //los cuenta
		//Los borramos
		for ($i=0; $i<$num; $i++) {
			if ($archivos[$i] != "." && $archivos[$i] != "..") {
	 			unlink ($directorio.$archivos[$i]); 
	 		}
		}
		//borramos el directorio
		rmdir ($directorio);
		$idProyecto=$id_proyecto;
		$directorio=$storeFolder.$idProyecto;
		rmdir ($directorio);
	}
	  
?>
<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<title>Repositorio de Proyectos</title>
	<meta content="text/html; charset=utf-8" http-equiv="content-type">
	<link rel="stylesheet" type="text/css" href="css/estilo.css">
	<link rel="stylesheet" type="text/css" href="css/cuerpo_crear_proyecto.css">
	<link rel="shortcut icon" href="images/logo.png" />
	<link rel="stylesheet" type="text/css" href="css/breadcrumb.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="js/dropzone.js"></script>
	<link rel="stylesheet" href="css/dropzone.css">
	<script type="text/javascript">

		$(document).ready(function (){
			 
		        /* INICIA CONFIGURACIÓN DE DROPZONE */
		 Dropzone.options.myDropzone = {
		 dictDefaultMessage: "Arrastre aqui archivos para subir.",
		 addRemoveLinks: true,
		     init: function() {
		         thisDropzone = this;
		                /* ESTE CODIGO SIRVE PARA MOSTRAR LOS ARCHIVOS ACTUALES EN EL SERVIDOR*/
		         $.get("receptor.php", function(data) {
		 		
		             $.each(data, function(key,value){  
		                 var mockFile = { name: value.name, size: value.size}; 

		                 thisDropzone.options.addedfile.call(thisDropzone, mockFile);
		                 thisDropzone.options.thumbnail.call(thisDropzone, mockFile, "../docs/"+value.name);
		     thisDropzone.emit("complete", mockFile);
		     var ext = mockFile.name.split(".")[1];
		     switch(ext){
		      case "xls":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/excel.png');
		      break;
		      case "xlsx":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/excel.png');
		      break;
		      case "pdf":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/pdf.png');
		      break;
		      case "doc":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/doc.png');
		      case "docx":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/doc.png');
		      break;
		      case "zip":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/zip.png');
		      break;
		      case "rar":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/rar.png');
		      break;
		      case "ppt":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/ppt.png');
		      break;
		      case "pptx":
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/ppt.png');
		      break;
		      case "png":
		      break;
		      case "jpg":
		      break;
		      case "jpeg":
		      break;
		      default:
		      thisDropzone.createThumbnailFromUrl(mockFile, 'dist/img/nose.png');
		      break;
		     } 
		             });
		         });
		     },
		            /* EL EVENTO ACCEPT NOS PERMITE CAMBIAR LA IMAGEN DE VISTA PREVIA QUE SE MUESTRA */
		     accept: function(file, done) {
		     var thumbnail = $('.dropzone .dz-preview.dz-file-preview .dz-image:last');
		 
		     switch (file.type) {
		       case 'application/pdf':
		         thumbnail.css('background', 'url(dist/img/pdf.png');
		         break;
		       case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
		         thumbnail.css('background', 'url(dist/img/doc.png');
		         break;
		       case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
		         thumbnail.css('background', 'url(dist/img/excel.png');
		         break;
		        case 'application/vnd.ms-excel':
		        thumbnail.css('background', 'url(dist/img/excel.png');
		         break;
		        case 'application/zip, application/x-compressed-zip':
		        thumbnail.css('background', 'url(dist/img/zip.png');
		         break;
		        case 'application/vnd.ms-powerpointtd>':
		        thumbnail.css('background', 'url(dist/img/ppt.png');
		         break;
		        case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
		        thumbnail.css('background', 'url(dist/img/ppt.png');
		         break;
		        case 'image/jpeg':
		        break;
		        case 'image/png':
		        break;
		        default:
		        thumbnail.css('background', 'url(dist/img/nose.png');
		     }
		 
		     done();
		   },
		            /* ESTE EVENTO NOS PERMITE ELIMINAR REALMENTE EL ARCHIVO DEL SERVIDOR */
		     removedfile: function(file) {
		      $.get( <?php echo '"eliminarArchivo.php?proyecto='.$id_proyecto.'&evento='.$id_evento.'"' ?>, { 
		      nombre: file.name
		      }).done(function( data ) {
		     var _ref;
		      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		     });
		     }
		 };
		});
	</script>
	<script>
		$(document).ready(main);
 		var contador = 1;
 
		function main(){
		$('.menu_bar').click(function(){
			if(contador == 1){
				$('nav').animate({
					left: '0'
				});
				contador = 0;
			} else {
				contador = 1;
				$('nav').animate({
					left: '-100%'
				});
			}
		});
		};
	</script>
	
	<script type="text/javascript" src="js/tablas.js"></script>
	<script type="text/javascript" src="js/captura.js"></script>
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
</head>

<body>

	<header>
	<?php
		include_once './php/Conexion/UsuariosBD.php';
	    include_once './php/Modelo/Usuarios.php';
	    $Documento = $_SESSION["user_id"];
	    $ubd = new UsuariosBD();

	    $user = $ubd->consultarUsuario($Documento);
	    $nombre=$user->getNombres();
	    $foto=$user->getFoto();

	    $asignatura=$_GET['asignatura'];
	    $year= $_GET['year'];
	    $periodo= $_GET['periodo'];
    	$grupo=  $_GET['grupo'];
      	
	?>
		<div id="cabecera">
			<a href="http://www.univalle.edu.co"><img src="images/LogoUnivalle.png"></a>
			<div class="menu_bar">
		<a href="#" class="bt-menu">Menú</a>
	</div>
			<nav>
				<ul class="menu">
					<li><a href="home.php">Inicio</a></li>
					<?php if($_SESSION['tipo_user'] == 2):?>
				<?php
				echo 
				'<li><a href="crear_proyecto.php?asignatura='.$asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'">Crear Proyecto</a></li>';
				echo 
				'<li><a href="listado_estudiantes.php?asignatura='.$asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'">Listado Estudiantes</a></li>';
                echo 
					'<li><a href="registrar_estudiante.php?asignatura='.$asignatura.'&year='.$year.'&periodo='.$periodo.'&grupo='.$grupo.'&id=1">Registrar Estudiantes</a></li>';         
				?>
				
				<?php endif; ?>	
					<?php
					$perfil=substr($foto, 6, strlen($foto));
          			echo '<li id="usuario" ><a href="#">'.$nombre.'<img id="perfil" src="'.$perfil.'"></a>';
					?>
					
						<ul>
							<li><a href="profile.php">Mi perfil</a></li>
							<li><a href="php/logout.php">Cerrar Sesión</a></li>
						</ul>
					</li>

				</ul>
			</nav>
		</div>
	</header>
	
	<div id="cuerpo">
		<ul class="breadcrumb">
  			<li><a href="home.php">Area Personal</a></li>
  			<?php
  			echo 
  			'<li><a href="info_proyectos.php?id='.$asignatura.'&grupo='.$grupo.'&year='.$year.'&periodo='.$periodo.'">'.$asignatura.'-'.$grupo.'-'.$periodo.'-'.$year.'</a></li>';
			?>
  			<li><a href="#">Crear Proyecto</a></li>
		</ul>

		<section>
		<br><br><br>
		<div id="proyecto">
			<form class="captura" name="captura" method="post">
				<strong><label for="txtnombre">Nombre del Proyecto:</label></strong>
	            <input type="text" name="txtnombre" id="txtnombre" placeholder="Nombre del Proyecto" required>	 
	            <br><br>

	            <strong><label for="txtdescripcion">Descripción:</label><br></strong>
	            <textarea name="txtdescripcion" rows="10" cols="50" required></textarea><br><br>

	            <strong><label for="integrantes">Integrantes del Proyecto:</label><br></strong>

	            
      			<br>
      			<div id="todo">
      			<div id="izquierdo">
	            <table id="tabla1" border="2px" class="tablaBBDD"> 
        			<tr class="fila">
          				<th id="columna1">Código</th>
          				<th id="columna2">Nombre</th>
        			</tr>
        			<?php
        				include_once './php/Conexion/UsuariosBD.php';
                    	include_once './php/Modelo/Usuarios.php';
                    	$ubd=new UsuariosBD();
                    	$d = array();
                    	$d=$ubd->consultarEstudiantesAsignatura($asignatura,$year,$periodo,$grupo);

                    	
                 
                    	for ($i = 0; $i < count($d);$i++) {
                      		echo '<tr class="fila">';
	                        echo '<td>'.$d[$i]->getCodigo().'</td>';
	                        echo '<td>'.$d[$i]->getNombres().' '.$d[$i]->getApellidos().'</td>';
	                        echo '</tr>';
                    	}
        			?>
			  	</table>
			  	</div>
			  	<div id="medio">
			  		<label id="pasar"><img src="images/right.png"></label>
			  		<label id="regresar"><img src="images/left.png"></label>
	      		</div>
	      		<div id="derecho">
			    <table id="tabla2" border="2px" class="tablaBBDD">
			        <tr class="fila">
			            <th id="columna1">Código</th>
			            <th id="columna2">Nombre</th>
			        </tr>
			    </table>
			    </div>
				</div>
				
				<div id="resto">
				<br><strong><label for="archivos">Archivos:</label><br></strong>
				<?php
				echo '<div id="my-dropzone" class="dropzone" action="receptor.php?proyecto='.$id_proyecto.'&evento='.$id_evento.'">';
				?>
				</div>
				
        		<center><!--<button type="submit" id="btnCrear">Crear Proyecto</button>-->
        		<?php
        		echo '<input type="button" id="btnCrear" value="Crear Proyecto" onclick="cogerRes(this.form,'."'".$asignatura."',"."'".$year."',"."'".$periodo."',"."'".$grupo."',"."'".$Documento."'".')" />';
        		?>
        			<!--<input type="button" id="btnCrear" value="Crear Proyecto" onclick="cogerRes(this.form)" />-->
        		</center>
        		</div>

        	</form>
        </div>
		</section>	
	</div>

	<div id="pie">
		<footer>
			<p>Apicaciones en la Web y Redes Inalámbricas - Tecnicas de Pruebas de Software &copy; 2016<br>
			<a href="home.php">Inicio</a></p>
		</footer>	
	</div>
	
</body>
</html>