<?php
require_once '../modelo/Tipo_Usuario.php';
require_once '"Conexion.php"'; 
/**
* 
*/
class Consultas 
{
	
	public function InsertarTipo($tipo){
		$modelo=new Conexion();
		$conexion=$modelo->get_conexion();
		$sql= "insert into tipo_usuario (Id_Tipo,Descripcion) values(:Id_Tipo,:Descripcion)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Id_Tipo',$tipo->getId_Tipo());
                $statement->bindParam(':Id_Evento',$tipo->getDescripcion());
                
                
                return $statement;
                    

	}
        public function consultarTipos() {
            $listatipo=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from tipo_usuario";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            while ($result =$statement->fetch()){
                $listatipo[]=$result;
            }
            return $listatipo;
	
        }
        
        public function consultarTipoId($id){
            $archivo=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from tipo_usuario where Id_Tipo=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            while ($result =$statement->fetch()){
                $archivo[]=$result;
                break;
            }
            return $archivo;
        }

}

?>

