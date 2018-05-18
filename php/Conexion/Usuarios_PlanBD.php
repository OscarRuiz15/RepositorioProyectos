<?php
require_once '/../modelo/Usuarios_Plan.php';
require_once 'Conexion.php'; 

class Usuarios_PlanBD 
{
	
	public function InsertarUsuarioPlan($usuasig){
		
		$conexion=new Conexion();
		$sql= "insert into usuarios_planes (Documento,Id_Plan) values(:Documento,:Id_Plan)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Documento',$usuasig->getDocumento());
                $statement->bindParam(':Id_Plan',$usuasig->getId_Planes());
                
                
                
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }   
                return $mensaje;

	}
        public function consultarUsuariosPlan() {
            $usuasig=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from Usuarios_Plan";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            while ($result =$statement->fetch()){
                $usuasig[]=$result;
            }
            return $usuasig;
	
        }
        
        public function consultarUsuariosPlanId($id){
            $usuasig=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from Usuarios_Plan where Documento=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            while ($result =$statement->fetch()){
                $usuasig[]=$result;
                break;
            }
            return $usuasig;
        }

}

?>