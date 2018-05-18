<?php
require_once '/../modelo/Proyectos.php';
require_once 'Conexion.php'; 
/**
* 
*/
class ProyectosBD 
{
	
	public function InsertarProyecto($Proyecto){
		
		$conexion=new Conexion();
		$sql= "insert into proyecto (Id_Proyecto,Nombre,Fecha_Creacion,Descripcion,Publico) "
                        . "values(:Id_Proyecto,:Nombre,:Fecha_Creacion,:Descripcion,:Publico)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Id_Proyecto',$Proyecto->getId_Proyectos());
                $statement->bindParam(':Nombre',$Proyecto->getNombre());
                $statement->bindParam(':Fecha_Creacion',$Proyecto->getFecha_Creacion());
                $statement->bindParam(':Descripcion',$Proyecto->getDescripcion());
                $statement->bindParam(':Publico',$Proyecto->getActivo());
                
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                    

	}
        public function consultarProyectos() {
            $listaproyectos=  array();
            
	    $conexion=new Conexion();
            $sql= "select * from proyecto";
            $statement= $conexion->prepare($sql);
            $statement->execute();
                        
            
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
            
                $id=$result[$i]['Id_Proyecto'];
                $nombre=$result[$i]['Nombre'];
                $fecha=$result[$i]['Fecha_Creacion'];
                $descripcion=$result[$i]['Descripcion'];
                $activo=$result[$i]['Publico'];
                

                $proyecto=new Proyectos($id, $nombre, $fecha, $descripcion, $activo);
              
                array_push($listaproyectos, $proyecto);
                
            }
            //echo count($listaasplan);
           
            
            return $listaproyectos;
            
	
        }
        
        public function consultarProyectoId($id){
            $proyecto=null;
            $conexion=new Conexion();
	       $sql= "select * from proyecto where Id_Proyecto=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            
            while ($result =$statement->fetchAll()){
                
                $nombre= $result[0]['Nombre'];
                $fecha= $result[0]['Fecha_Creacion'];
                $descripcion= $result[0]['Descripcion'];
                $publico=$result[0]['Publico'];
                
                $proyecto=new Proyectos($id, $nombre, $fecha, $descripcion, $publico) ;
                break;
            }
            
            return $proyecto;
        }

}

?>
