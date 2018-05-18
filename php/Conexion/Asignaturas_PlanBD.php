<?php
require_once '../modelo/Asignaturas_Plan.php';
require_once 'Conexion.php'; 
/**
* 
*/
class Asignaturas_PlanBD 
{
	
	public function InsertarAsignaturaPlan($AsignaturaPlan){
		
		$conexion=new Conexion();
		$sql= "insert into asignaturas_planes (Id_Asignatura,Id_Plan) values(:Id_Asignatura,:Id_Plan)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Id_Asignatura',$AsignaturaPlan->getId_Asignaturas());
                $statement->bindParam(':Id_Plan',$AsignaturaPlan->getId_Planes());
               
                
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                    

	}
        public function consultarAsignaturasPlanes() {
            $listaasigplan=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from asignaturas_planes";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            while ($result =$statement->fetch()){
                $listaasigplan[]=$result;
            }
            return $listaasigplan;
	
        }
        
        public function consultarAsignaturasPlanesId($id){
            $archivo=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from asignaturas_planes where Id_Asignatura=:id";
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

