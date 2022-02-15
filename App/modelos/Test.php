<?php

class Test
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }



    public function obtenerTest(){
        $this->db->query("SELECT * FROM TEST");
        return $this->db->registros();
    }



    public function agregarTest($datos){
        $this->db->query("INSERT INTO TEST (id_test,nombre) VALUES (:id_test, :nombre)");

        $this->db->bind(':id_test',$datos['id_test']);
        $this->db->bind(':nombre', $datos['nombre']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerTestId($id){
        $this->db->query("SELECT * FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);
        return $this->db->registro();
    }


    public function borrarTest($id){
        $this->db->query("DELETE FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


}