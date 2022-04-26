<?php

class TiendaModelo
{
    private $db;
    //private $paginator;

    public function __construct(){
        $this->db = new Base;
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

    public function editarEquipacion($id_equipacion,$equipacion_modificada){
        var_dump($equipacion_modificada);

         $this->db->query("UPDATE EQUIPACION SET talla=:talla, tipo=:tipo WHERE id_equipacion=:id_equipacion");
         $this->db->bind(':id_equipacion',$id_equipacion);
         $this->db->bind(':talla',$equipacion_modificada['talla']);
         $this->db->bind(':tipo',$equipacion_modificada['tipo']);

         if ($this->db->execute()){
             return true;
         }else{
             return false;
         }

    }

    public function borrarEquipacion($id_equipacion){

        $this->db->query("DELETE FROM EQUIPACION WHERE id_equipacion =:id_equipacion");
        $this->db->bind(':id_equipacion',$id_equipacion);

        if ($this->db->execute()){
            return true;
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




    // public function getPaginator()
    // {
    //     return $this->paginator;
    // }

    // public function getEquipacionesUsuario()
    // {
    //     $this->db->query("SELECT * FROM EQUIPACION JOIN USUARIO ON EQUIPACION.id_usuario = USUARIO.id_usuario");
    //     return $this->db->registros();
    // }

    // public function updateUsuario($id, $entregado)
    // {
    //     $this->db->query("UPDATE USUARIO SET entregado=:entregado WHERE id_usuario = :id_usuario");
    //     $this->db->bind(':id_usuario', $id);
    //     $this->db->bind(':entregado', $entregado);
    //     $this->db->execute();
    //     return true;
    // }
}
