<?php

class TiendaModelo
{
    private $db;
    //private $paginator;

    public function __construct(){
        $this->db = new Base;
    }

    public function obtenerUsuarios(){
        $this->db->query("SELECT id_usuario, nombre, apellidos, email, telefono, talla, entregado FROM USUARIO");
        return $this->db->registros();
    }

    public function obtenerEquipacion(){
        $this->db->query("SELECT * FROM EQUIPACION");
        return $this->db->registros();
    }


    public function agregarEquipacion($nuevaEquipacion){
        
        $this->db->query("INSERT INTO EQUIPACION (talla,fecha_peticion,id_usuario,tipo) 
                            VALUES (:talla,CURDATE(),:id_usuario,:tipo)");
        $this->db->bind(':talla', $nuevaEquipacion['talla']);
        $this->db->bind(':id_usuario',$nuevaEquipacion['usu']);
        $this->db->bind(':tipo',$nuevaEquipacion['tipo']);
          
        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
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
