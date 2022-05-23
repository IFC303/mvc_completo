<?php

class Equipacion
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerEquipacion(){
        $this->db->query("SELECT id_equipacion,tipo,imagen,descripcion from EQUIPACION");
        return $this->db->registros();
    }


    // *********** GESTION EQUIPACIONES: AÑADIR NUEVA ***********
    public function nuevaEquipacion($nuevaEquipacion){     
        $this->db->query("INSERT INTO EQUIPACION (tipo,descripcion) VALUES (:tipo,:descripcion)");
        $this->db->bind(':tipo', $nuevaEquipacion['nombre']);
        $this->db->bind(':descripcion',$nuevaEquipacion['descripcion']);         
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }

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
          $this->db->query("UPDATE EQUIPACION SET tipo=:tipo, descripcion=:descripcion WHERE id_equipacion=:id");
          $this->db->bind(':id',$equipacion_modificada['id_equipacion']);
          $this->db->bind(':tipo',$equipacion_modificada['tipo']);
          $this->db->bind(':descripcion',$equipacion_modificada['descripcion']);
          if ($this->db->execute()){
              return true;
          }else{
              return false;
          }

    }



    public function obtenerEquipacionUsuarios(){
        $this->db->query("SELECT USUARIO.id_usuario,nombre, apellidos, email, telefono, EQUIPACION.id_equipacion, EQUIPACION.talla, EQUIPACION.tipo, EQUIPACION.recogido 
                          FROM EQUIPACION, USUARIO WHERE EQUIPACION.id_usuario = USUARIO.id_usuario ORDER BY id_usuario");
        return $this->db->registros();
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



  


    public function cambiarEstado($id,$estado){

        if($estado==0){
            $this->db->query("UPDATE EQUIPACION SET recogido=1 WHERE id_equipacion =:id_equipacion");
            $this->db->bind(':id_equipacion',$id);

            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }else{
            $this->db->query("UPDATE EQUIPACION SET recogido=0 WHERE id_equipacion =:id_equipacion");
            $this->db->bind(':id_equipacion',$id);

            if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

    }

}