<?php
include_once 'Conexion.php'; 
include_once '/../modelo/Usuarios_Asignaturas.php';

class Usuarios_AsignaturasBD 
{
	
	public function InsertarUsuarioAsig($usuasig){
		
		$conexion=new Conexion(); 
		$sql= "insert into usuarios_asignaturas (Documento,Id_Asignatura,Ano,Periodo,Grupo) "
                        . "values(:Documento,:Id_Asignatura,:Year,:Periodo,:Grupo)";
		$statement =$conexion->prepare($sql);
		$statement->bindParam(':Documento',$usuasig->getDocumento());
                $statement->bindParam(':Id_Asignatura',$usuasig->getId_Asignaturas());
                $statement->bindParam(':Year',$usuasig->getYear());
                
                $statement->bindParam(':Periodo',$usuasig->getPeriodo());
                $statement->bindParam(':Grupo',$usuasig->getGrupo());
                
                
                $mensaje="";
                if (!$statement) {
                    $mensaje="Error creando relacion";
                }  else {
                    $statement->execute();
                    $mensaje="Usuario creado exitosamente";
                }
                return $mensaje;
                    

	}
        public function consultarUsuariosAsignaturas() {
            $usuasig=null;
            $modelo=new Conexion();
	    $conexion=$modelo->get_conexion();
            $sql= "select * from Usuarios_Asignaturas";
            $statement= $conexion->prepare($sql);
            $statement->execute();
            while ($result =$statement->fetch()){
                $usuasig[]=$result;
            }
            return $usuasig;
	
        }
        
        public function consultarUsuariosAsignaturasId($id){
            $usuasig=array();
            
	    $conexion=new Conexion();
            $sql= "select * from Usuarios_Asignaturas where Documento=:id order by Ano desc, Periodo desc";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id);
            $statement->execute();
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
            
                $id_asig=$result[$i]['Id_Asignatura'];
                $year=$result[$i]['Ano'];
                
               
                $periodo=$result[$i]['Periodo'];
                $grupo=$result[$i]['Grupo'];
                $usuario_asg=new Usuarios_Asignaturas($id, $id_asig, $year, $periodo, $grupo);
                array_push($usuasig, $usuario_asg);
              
                
                
            }
          
           
            
            return $usuasig;
        }
        
        public function consultarUsuariosAsignaturasIdAsig($id_asig){
            $usuasig=array();
            
	    $conexion=new Conexion();
            $sql= "select * from Usuarios_Asignaturas where Id_Asignatura=:id";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id_asig);
            $statement->execute();
            $result =$statement->fetchAll();
            for ($i = 0; $i < count($result); $i++) {
                
            
                $id=$result[$i]['Documento'];
                $year=$result[$i]['Ano'];
                
               
                $periodo=$result[$i]['Periodo'];
                $grupo=$result[$i]['Grupo'];
                $usuario_asg=new Usuarios_Asignaturas($id, $id_asig, $year, $periodo, $grupo);
                array_push($usuasig, $usuario_asg);
              
                
                
            }
          
           
            
            return $usuasig;
        }
        public function consultarUsuariosAsignaturasExistente($id_asig,$year,$grupo,$periodo,$documento){
            $usuasig=null;
            
	    $conexion=new Conexion();
            $sql= "select * from Usuarios_Asignaturas where Id_Asignatura=:id and Ano=:year and Grupo=:grupo"
                    . " and Periodo=:periodo and Documento=:documento";
            $statement= $conexion->prepare($sql);
            $statement-> bindParam(":id",$id_asig);
            $statement-> bindParam(":year",$year);
            $statement-> bindParam(":grupo",$grupo);
            $statement-> bindParam(":periodo",$periodo);
            $statement-> bindParam(":documento",$documento);
            
            $statement->execute();
            while($result =$statement->fetchAll())
            {
                
            
                $id=$result[0]['Documento'];
                $year=$result[0]['Ano'];
                
               
                $periodo=$result[0]['Periodo'];
                $grupo=$result[0]['Grupo'];
                $usuasig=new Usuarios_Asignaturas($documento, $id_asig, $year, $periodo, $grupo);
                break;
              
                
                
            }
          
           
            
            return $usuasig;
        }
        


}

?>

