<?php

class Equipacion{


    private $db;
    

    public function __construct(){
        $this->db = new Base; 
    }


    public function obtener_equipaciones(){
        $this->db->query("SELECT id_equipacion,tipo,imagen,descripcion,precio,temporada from v2equipacion");
        return $this->db->registros();
    }


    public function obtenerEquipacionId($id){
         $this->db->query("SELECT id_equipacion,tipo,imagen,descripcion,precio,temporada from v2equipacion where id_equipacion=:id");
         $this->db->bind(':id',$id);
         return $this->db->registros();
     }


     public function obtener_usuarios(){
        $this->db->query("SELECT * from v2usuario");
        return $this->db->registros();
     }


     
     public function obtener_tallas(){
        $this->db->query("SELECT * from v2talla");
        return $this->db->registros();
     }

     
     

    // ***************************************** GESTION EQUIPACIONES *********************************

    public function nuevaEquipacion($nuevo){     
        $this->db->query("INSERT INTO v2equipacion (tipo,descripcion,imagen,precio,temporada) VALUES (:tipo,:descripcion,:imagen,:precio,:temporada)");
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
        $this->db->query("UPDATE v2equipacion SET imagen=:foto where id_equipacion=:id_equipacion;");
        $this->db->bind(':foto', $foto);
        $this->db->bind(':id_equipacion', $id);
        if ($this->db->execute()){
             return true;
         }else{
                 return false;
         }
        }else{
            return true;
        }   
    }



    public function borrarEquipacion($id){
        $this->db->query("DELETE FROM v2equipacion WHERE id_equipacion =:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function editarEquipacion($equipacion_modificada,$id){
          $this->db->query("UPDATE v2equipacion SET tipo=:tipo, imagen=:imagen, descripcion=:descripcion, precio=:precio, temporada=:temporada WHERE id_equipacion=:id");          
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


    public function obtener_pedidos(){
        $this->db->query("SELECT v2soli_equipacion.id_soli_equi, v2usuario.id_usuario, v2usuario.nombre, apellidos, email, telefono, v2soli_equipacion.id_equipacion, 
        v2equipacion.imagen, v2soli_equipacion.fecha_peticion, v2soli_equipacion.id_soli_equi, v2soli_equipacion.estado, v2equipacion.id_equipacion, v2equipacion.tipo, 
        v2soli_equipacion.cantidad, v2talla.nombre as talla_nombre, v2talla.id_talla
        FROM v2soli_equipacion, v2usuario, v2equipacion , v2talla
        WHERE v2soli_equipacion.id_usuario = v2usuario.id_usuario and v2soli_equipacion.id_equipacion = v2equipacion.id_equipacion 
        and v2talla.id_talla = v2soli_equipacion.talla 
        ORDER BY id_usuario");
        return $this->db->registros();
    }



    public function borrarPedido($id){
        $this->db->query("DELETE FROM v2soli_equipacion WHERE id_soli_equi =:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    // public function editar_pedido($id,$equipacionModi){
    //     $this->db->query("UPDATE v2soli_equipacion SET talla=:talla, cantidad=:cantidad where id_soli_equi=:id");
    //     $this->db->bind(':id',$id);
    //     $this->db->bind(':cantidad',$equipacionModi['cantidad']);
    //     $this->db->bind(':talla',$equipacionModi['talla']);
    //     if ($this->db->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }



    public function cambiar_estado($id,$estado){
        if($estado==1){
            $this->db->query("UPDATE v2soli_equipacion SET estado=1 WHERE id_soli_equi =:id");
            $this->db->bind(':id',$id);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else if($estado==2){
            $this->db->query("UPDATE v2soli_equipacion SET estado=2 WHERE id_soli_equi =:id");
            $this->db->bind(':id',$id);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
         }else if($estado==3){
            $this->db->query("UPDATE v2soli_equipacion SET estado=3 WHERE id_soli_equi =:id");
            $this->db->bind(':id',$id);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
         }else if($estado==4){
            $this->db->query("UPDATE v2soli_equipacion SET estado=4 WHERE id_soli_equi =:id");
            $this->db->bind(':id',$id);
            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
         }
       
    }
  


    public function nuevo_pedido($pedidoNuevo){
        $this->db->query("INSERT INTO v2soli_equipacion (id_usuario,id_equipacion,fecha_peticion,talla,estado,cantidad) VALUES (:idUsu,:idEquipacion,CURDATE(),:talla,0,:cantidad)");
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