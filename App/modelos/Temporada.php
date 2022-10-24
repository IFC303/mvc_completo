<?php

class Temporada{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }



//*********************************** VER ****************************************/

public function obtener_temporadas(){
    $this->db->query("SELECT * FROM TEMPORADA ORDER BY fecha_inicio");
    return $this->db->registros();
}

public function obtener_temporada_id($id){
    $this->db->query("SELECT * FROM TEMPORADA WHERE id_TEMP = :id");
    $this->db->bind(':id', $id);
    return $this->db->registro();
}


//*********************************** NUEVO ****************************************/
    public function nuevo($nuevo){

        $this->db->query("INSERT INTO TEMPORADA (nombre,fecha_inicio,fecha_fin,observaciones) VALUES (:nombre, :fecha_ini, :fecha_fin, :observaciones)");
        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':fecha_ini',$nuevo['fecha_ini']);
        $this->db->bind(':fecha_fin',$nuevo['fecha_fin']);
        $this->db->bind(':observaciones',$nuevo['observaciones']);

        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }


//*********************************** EDITAR ****************************************/
public function editar($editar,$id){

    $this->db->query("UPDATE TEMPORADA SET nombre=:nombre, fecha_inicio=:fecha_ini, fecha_fin=:fecha_fin, observaciones=:observaciones WHERE id_temp = :id");
    $this->db->bind(':nombre', $editar['nombre']);
    $this->db->bind(':fecha_ini',$editar['fecha_ini']);
    $this->db->bind(':fecha_fin',$editar['fecha_fin']);
    $this->db->bind(':observaciones',$editar['observaciones']);
    $this->db->bind(':id', $id);

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}


//*********************************** BORRAR ****************************************/
public function borrar($id){
    
    $this->db->query("DELETE FROM TEMPORADA WHERE id_temp=:id");
    $this->db->bind(':id',$id);

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}



}

