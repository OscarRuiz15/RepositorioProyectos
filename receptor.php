<?php
$ds = DIRECTORY_SEPARATOR;

$storeFolder = 'docs/Proyectos/';
$idProyecto=$_GET['proyecto']."/";
$idEvento=$_GET['evento'];
$direccion=$storeFolder.$idProyecto.$idEvento;


if (!file_exists($direccion)) {
    mkdir($direccion, 0777, true);
}
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];             
      
    $targetPath = dirname( __FILE__ ) . $ds. $direccion . $ds;
     
    $targetFile =  $targetPath. $_FILES['file']['name']; 
 
    $upload_success = move_uploaded_file($tempFile,$targetFile); 

    /* TEST */

    $success_message = array( 
        'name' => $_FILES['file']['name'],
        'filesize' => $_FILES['file']['size']
    );

    if( $upload_success ) {
        return json_encode($success_message);
    } else {
        return Response::json('error', 400);
    }
     
} else {                                                          
    $result  = array();
 
    $files = scandir($direccion);                 
    if ( false!==$files ) {
        foreach ( $files as $file ) {
            if ( '.'!=$file && '..' !=$file && strpos($file, '.') !== false) {       
                $obj['name'] = $file;
                $obj['size'] = filesize($direccion.$ds.$file);
                $result[] = $obj;
            }
        }
    }
     
    header('Content-type: text/json');             
    header('Content-type: application/json');
    echo json_encode($result);
}
?>     