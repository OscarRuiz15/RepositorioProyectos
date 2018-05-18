<?php
	$storeFolder = 'docs/Proyectos/';
	$idProyecto=$_GET['proyecto']."/";
	$idEvento=$_GET['evento']."/";
	$url = $storeFolder.$idProyecto.$idEvento;
	echo "URL: ".$url;
	$url .= $_GET['nombre'];
	if (file_exists($url)) {
        unlink($url);
    }
?>