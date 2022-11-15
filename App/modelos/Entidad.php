<?php

class Entidad{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }


//*********************************** VER ****************************************/

    public function obtener_entidades(){
        $this->db->query("SELECT * FROM v2entidad");
        return $this->db->registros();
    }


    public function obtener_entidad_id($id){
        $this->db->query("SELECT * FROM v2entidad WHERE id_entidad = :idEntidad");
        $this->db->bind(':idEntidad', $id);
        return $this->db->registro();
    }


    
//*********************************** NUEVO ****************************************/
    public function nuevo($nuevo){
        
        $this->db->query("INSERT INTO v2entidad (cif,nombre,direccion,telefono,email,observaciones) VALUES (:cif, :nombre, :direccion,:telefono,:email,:observaciones)");
        $this->db->bind(':cif',$nuevo['cif']);
        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':direccion',$nuevo['direccion']);
        $this->db->bind(':telefono',$nuevo['telefono']);
        $this->db->bind(':email',$nuevo['email']);
        $this->db->bind(':observaciones',$nuevo['observaciones']);

        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }

    }


//*********************************** EDITAR ****************************************/
public function editar($editar,$id){

    $this->db->query("UPDATE v2entidad SET cif=:cif, nombre=:nombre, direccion=:direccion,telefono=:telefono,email=:email,observaciones=:observaciones WHERE id_entidad = :id");
    
    $this->db->bind(':cif',$editar['cif']);
    $this->db->bind(':nombre', $editar['nombre']);
    $this->db->bind(':direccion',$editar['direccion']);
    $this->db->bind(':telefono',$editar['telefono']);
    $this->db->bind(':email',$editar['email']);
    $this->db->bind(':observaciones',$editar['observaciones']);

    $this->db->bind(':id',$id);
    
    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}


//*********************************** BORRAR ****************************************/
    public function borrar($id){

        $this->db->query("DELETE FROM v2entidad WHERE id_entidad =:id");
        $this->db->bind(':id',$id);

        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



 


}