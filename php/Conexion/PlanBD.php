<?php
include_once 'Conexion.php'; 
include_once '/../Modelo/Plan.php';
/**
* 
*/
class PlanBD 
{
	
	public function InsertarPlan($Plan){
		
		$conexion=new Conexion();
		$sql= "insert into planes (Id_Plan,Nombre) values(:Id_Plan,:Nombre)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Id_Plan',$Plan->getId_Planes());
                $statement->bindParam(':Nombre',$Plan->getNombre());
                
                
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                    

	}
        public function consultarPlanes() {
            $listaasplan=array();
            
	    $conexion=new Conexion();
            $sql= "select * from planes";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
            
                $id=$result[$i]['Id_Plan'];
                $nombre=$result[$i]['Nombre'];
                

                $plan=new Plan($id, $nombre);
              
                array_push($listaasplan, $plan);
                
            }
            //echo count($listaasplan);
           
            return $listaasplan;
        }
        public function consultarPlanId($id){
            $plan=null;
            
	    $conexion=new Conexion();
            $sql= "select * from planes where Id_Plan=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
           
            
            while ($result =$statement->fetchAll()){
                $idP= $result[0]['Id_Plan'];
                $Nombre = $result[0]['Nombre'];
                $plan =new Plan($idP,$Nombre);
                break;
            }
            
            return $plan;
        }

        public function consultarCantidadPlanes(){
            $cantusuarios=array();
            
            $conexion=new Conexion();
            
            $sql= "select count(*) from planes";
            
            $statement= $conexion->prepare($sql);
            $statement->execute();
            return $statement->fetchColumn();
        }

}

?>
