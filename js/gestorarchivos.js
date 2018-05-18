$(document).ready(function (){
		 
		        /* INICIA CONFIGURACIÓN DE DROPZONE */
		 Dropzone.options.myDropzone = {
		 dictDefaultMessage: "Arrastre aqui archivos para subir.",
		 addRemoveLinks: true,
                 maxFilesize: 20,
                 maxFiles:2,
		     init: function() {
		         thisDropzone = this;
		                /* ESTE CODIGO SIRVE PARA MOSTRAR LOS ARCHIVOS ACTUALES EN EL SERVIDOR*/
		         $.get('../receptor.php', function(data) {
		 
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
		      $.get( "eliminarArchivo.php", { 
		      nombre: file.name
		      }).done(function( data ) {
		     var _ref;
		      return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
		     });
		     }
		 };
		 
		});