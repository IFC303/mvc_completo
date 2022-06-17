<?php

class Equipacion
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerEquipacion(){
        $this->db->query("SELECT id_equipacion,tipo,imagen,descripcion,precio,temporada from EQUIPACION");
        return $this->db->registros();
    }

    // public function obtenerEquipacionId($id){
    //     $this->db->query("SELECT id_equipacion,tipo,imagen,descripcion,precio,temporada from EQUIPACION where id_equipacion=");
    //     $this->db->bind(':id',)
    //     return $this->db->registros();
    // }


    // *********** GESTION EQUIPACIONES: AÑADIR NUEVA ***********
    public function nuevaEquipacion($nuevaEquipacion){     
        $this->db->query("INSERT INTO EQUIPACION (tipo,descripcion,imagen,precio,temporada) VALUES (:tipo,:descripcion,:imagen,:precio,:temporada)");
        $this->db->bind(':tipo', $nuevaEquipacion['nombre']);
        $this->db->bind(':descripcion',$nuevaEquipacion['descripcion']);     
        $this->db->bind(':precio',$nuevaEquipacion['precio']);
        $this->db->bind(':temporada',$nuevaEquipacion['temporada']);
        $this->db->bind(':imagen',$nuevaEquipacion['foto']);
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }

    // public function renombrar($indice,$nombre){     
    //     $this->db->query("UPDATE EQUIPACION SET imagen=:nombre where id_equipacion=$indice");  
    //     $this->db->bind(':indice', $indice);
    //     $this->db->bind(':nombre',$nombre);
    //     if ($this->db->execute()){
    //         return true;
    //     }else{
    //         return false;
    //     }
    // }

    // *********** GESTION EQUIPACIONES: BORRAR ***********
    public function borrarEquipacion($id_equipacion){
        $this->db->query("DELETE FROM EQUIPACION WHERE id_equipacion =:id_equipacion");
        $this->db->bind(':id_equipacion',$id_equipacion);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // *********** GESTION EQUIPACIONES: EDITAR ***********
    public function editarEquipacion($equipacion_modificada){
          $this->db->query("UPDATE EQUIPACION SET tipo=:tipo, imagen=:imagen, descripcion=:descripcion, precio=:precio, temporada=:temporada WHERE id_equipacion=:id");          
          $this->db->bind(':id',$equipacion_modificada['id']);
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


    // *********** PEDIDO EQUIPACIONES DEL SOCIO ***********
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


    // *********** PEDIDOS EQUIPACIONES: visualizar todos los pedidos ***********
    public function obtenerPedidosUsuarios(){
        $this->db->query("SELECT USUARIO.id_usuario,nombre, apellidos, email, telefono, SOLI_EQUIPACION.id_equipacion, SOLI_EQUIPACION.talla, 
                          SOLI_EQUIPACION.fecha_peticion, SOLI_EQUIPACION.id_soli_equi, SOLI_EQUIPACION.recogido, EQUIPACION.id_equipacion, EQUIPACION.tipo, EQUIPACION.descripcion
                          FROM SOLI_EQUIPACION, USUARIO, EQUIPACION 
                          WHERE SOLI_EQUIPACION.id_usuario = USUARIO.id_usuario and SOLI_EQUIPACION.id_equipacion=EQUIPACION.id_equipacion 
                          ORDER BY id_usuario");
        return $this->db->registros();
    }

    // *********** PEDIDOS EQUIPACIONES: borrar pedido ***********
    public function borrarPedido($id_pedido){
        $this->db->query("DELETE FROM SOLI_EQUIPACION WHERE id_soli_equi =:id_pedido");
        $this->db->bind(':id_pedido',$id_pedido);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    // *********** PEDIDOS EQUIPACIONES: cambiar estado del pedido a entregado o no ***********
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
    

    public function agregarEquipacion($nuevaEquipacion){     
        $this->db->query("INSERT INTO EQUIPACION (talla,fecha_peticion,id_usuario,tipo,recogido) 
                          VALUES (:talla,CURDATE(),:id_usuario,:tipo,0)");
        $this->db->bind(':talla', $nuevaEquipacion['talla']);
        $this->db->bind(':id_usuario',$nuevaEquipacion['usu']);
        $this->db->bind(':tipo',$nuevaEquipacion['tipo']);
           
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }



  

}