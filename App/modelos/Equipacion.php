<?php

class Equipacion{


    private $db;
    

    public function __construct(){
        $this->db = new Base; 
    }


    public function obtenerEquipaciones(){
        $this->db->query("SELECT id_equipacion,tipo,imagen,descripcion,precio,temporada from EQUIPACION");
        return $this->db->registros();
    }


    public function obtenerEquipacionId($id){
         $this->db->query("SELECT id_equipacion,tipo,imagen,descripcion,precio,temporada from EQUIPACION where id_equipacion=:id");
         $this->db->bind(':id',$id);
         return $this->db->registros();
     }


     public function obtener_usuarios(){
        $this->db->query("SELECT * from usuario");
        return $this->db->registros();
     }

     

    // ***************************************** GESTION EQUIPACIONES *********************************

    public function nuevaEquipacion($nuevo){     
        $this->db->query("INSERT INTO EQUIPACION (tipo,descripcion,imagen,precio,temporada) VALUES (:tipo,:descripcion,:imagen,:precio,:temporada)");
        $this->db->bind(':tipo', $nuevo['nombre']);
        $this->db->bind(':descripcion',$nuevo['descripcion']);     
        $this->db->bind(':precio',$nuevo['precio']);
        $this->db->bind(':temporada',$nuevo['temporada']);
        $this->db->bind(':imagen',$nuevo['foto']);

        $this->db->execute();

        $id = $this->db->ultimoIndice();
        if($nuevo['foto']!=''){
            //COPIO LA FOTO EN EL DIRECTORIO Y CAMBIO NOMBRE EN LA BBDD  
            //$directorio = "/var/www/html/tragamillas/public/img/fotos_equipacion/";
            $directorio="C:/xampp/htdocs/tragamillas/public/img/fotos_equipacion/";   
            copy($_FILES['subirFoto']['tmp_name'], $directorio.$id.'.jpg');
            chmod($directorio.$id.'.jpg',0777);

            $foto=$id.'.jpg';
            $this->db->query("UPDATE EQUIPACION SET imagen=:id where id_equipacion=:id;");
            $this->db->bind(':id', $foto);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        } else{
            return true;
        }   
    }



    public function borrarEquipacion($id){
        $this->db->query("DELETE FROM EQUIPACION WHERE id_equipacion =:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function editarEquipacion($equipacion_modificada,$id){
          $this->db->query("UPDATE EQUIPACION SET tipo=:tipo, imagen=:imagen, descripcion=:descripcion, precio=:precio, temporada=:temporada WHERE id_equipacion=:id");          
          $this->db->bind(':id',$id);
          $this->db->bind(':tipo',$equipacion_modificada['nombre']);
          $this->db->bind(':imagen',$equipacion_modificada['foto']);
          $this->db->bind(':descripcion',$equipacion_modificada['descripcion']);
          $this->db->bind(':precio',$equipacion_modificada['precio']);
          $this->db->bind(':temporada',$equipacion_modificada['temporada']);
               
          if ($this->db->execute()){
              return true;
          }else{
              return false;
          }
    }



    // ***************************************** PEDIDOS EQUIPACIONES *********************************


    public function obtenerPedidosUsuarios(){
        $this->db->query("SELECT SOLI_EQUIPACION.id_soli_equi,USUARIO.id_usuario,nombre, apellidos, email, telefono, SOLI_EQUIPACION.id_equipacion, SOLI_EQUIPACION.talla, EQUIPACION.imagen,
        SOLI_EQUIPACION.fecha_peticion, SOLI_EQUIPACION.id_soli_equi, SOLI_EQUIPACION.recogido, EQUIPACION.id_equipacion, EQUIPACION.tipo, SOLI_EQUIPACION.cantidad
        FROM SOLI_EQUIPACION, USUARIO, EQUIPACION 
        WHERE SOLI_EQUIPACION.id_usuario = USUARIO.id_usuario and SOLI_EQUIPACION.id_equipacion=EQUIPACION.id_equipacion 
        ORDER BY id_usuario");
        return $this->db->registros();
    }



    public function borrarPedido($id){
        $this->db->query("DELETE FROM SOLI_EQUIPACION WHERE id_soli_equi =:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function editar_pedido($id,$equipacionModi){
        $this->db->query("UPDATE SOLI_EQUIPACION SET talla=:talla, cantidad=:cantidad where id_soli_equi=:id");
        $this->db->bind(':id',$id);
        $this->db->bind(':cantidad',$equipacionModi['cantidad']);
        $this->db->bind(':talla',$equipacionModi['talla']);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function cambiarEstado($id,$estado){
        if($estado==0){
            $this->db->query("UPDATE SOLI_EQUIPACION SET recogido=1 WHERE id_soli_equi =:id");
            $this->db->bind(':id',$id);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $this->db->query("UPDATE SOLI_EQUIPACION SET recogido=0 WHERE id_soli_equi =:id");
            $this->db->bind(':id',$id);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }
    }
  


    public function pedidoEquipacion($pedidoNuevo){
        $this->db->query("INSERT INTO SOLI_EQUIPACION (id_usuario,id_equipacion,fecha_peticion,talla,recogido,cantidad) VALUES (:idUsu,:idEquipacion,CURDATE(),:talla,'0',:cantidad)");
        $this->db->bind(':idUsu', $pedidoNuevo['idUsuario']);
        $this->db->bind(':idEquipacion',$pedidoNuevo['idEquipacion']);     
        $this->db->bind(':talla',$pedidoNuevo['talla']);
        $this->db->bind(':cantidad',$pedidoNuevo['cantidad']);

        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }


 


  

}