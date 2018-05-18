<?php
			class Conexion extends PDO {

		    public function __construct() {
		        try {
		            parent::__construct('mysql:host=localhost;dbname=repo', 'root','', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
		            parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		        } catch (Exception $e) {
		            echo $e->getMessage();
		        }
		    	}	
			}
			$c=new Conexion();
		 ?>