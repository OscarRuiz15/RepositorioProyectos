<?php
include_once 'Conexion.php';
include_once '/../Modelo/Asignaturas.php';
 
/**
* 
*/
class AsignaturasBD 
{
	
	public function InsertarAsignatura($Asignatura){
		
		$conexion=new Conexion();
		$sql= "insert into asignaturas (Id_Asignatura,Nombre) values(:id,:nombre)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':id',$Asignatura->getId_Asignaturas());
                $statement->bindParam(':nombre',$Asignatura->getNombre());
//                $statement->bindParam(':plan',$Asignatura->getPlan());
//                $statement->bindParam(':periodo',$Asignatura->getPeriodo());
//                $statement->bindParam(':grupo',$Asignatura->getGrupo());
                
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                    

	}
        public function consultarAsignatura() {
            $listaasignatura=array();
            
	    $conexion=new Conexion();
            $sql= "select * from asignaturas";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
            
                $id=$result[$i]['Id_Asignatura'];
                $nombre=$result[$i]['Nombre'];
                
//                $plan=$result[$i]['plan'];
//                $periodo=$result[$i]['periodo'];
//                $grupo=$result[$i]['grupo'];
                $asignatura=new Asignaturas($id, $nombre, 0, "" , 0);
              
                array_push($listaasignatura, $asignatura);
                
            }
          
           
            return $listaasignatura;
	
        }
        
        public function consultarAsignaturaId($id){
            
            $asignatura=null;
	    $conexion=new Conexion();
            $sql= "select * from asignaturas where Id_Asignatura=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
             
            
            while ($result =$statement->fetchAll()){
                
                
                $nombre= $result[0]['Nombre'];
                     
                
                $asignatura=new Asignaturas($id, $nombre);
                break;
            }
            return $asignatura;
            
        }

        public function consultarAsignaturaLike($parametro){
            $listaasignaturas = array();
            $asignatura=null;
            $conexion=new Conexion();
            //$sql = "select * from asignaturas where Nombre like :argumento";
            $params = array(':argumento' => "'".$parametro.'%'."'");
            $sql= "select * from asignaturas where Nombre like "."'".$parametro.'%'."'";
            $stmt = $conexion->prepare($sql);
            $stmt->execute($params);
            $result =$stmt->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
                $nombre= $result[$i]['Nombre'];
                $id=$result[$i]['Id_Asignatura'];
                
                $asignatura=new Asignaturas($id, $nombre);
                array_push($listaasignaturas, $asignatura);
            }
            return $listaasignaturas;
            
        }

        public function consultarCantidadAsignaturas(){
            $cantusuarios=array();
            
            $conexion=new Conexion();
            
            $sql= "select count(*) from asignaturas";
            
            $statement= $conexion->prepare($sql);
            $statement->execute();
            return $statement->fetchColumn();
        }

}


?>