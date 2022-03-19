<?php

class Test
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }



    public function obtenerTest()
    {
        $this->db->query("SELECT * FROM TEST");
        return $this->db->registros();
    }



    public function agregarTest($datos, $pruebasSelec)
    {

        $this->db->query("INSERT INTO TEST (id_test,nombreTest) VALUES (:idTest, :nombre)");
        $this->db->bind(':idTest', $datos['id_test']);
        $this->db->bind(':nombre', $datos['nombreTest']);

        if ($this->db->execute()) {
            foreach ($pruebasSelec as $selected) {
                $this->db->query("INSERT INTO TEST_PRUEBA (id_test,id_prueba) VALUES (:idTest, :idPrueba)");
                $this->db->bind(':idTest', $datos['id_test']);
                $this->db->bind(':idPrueba', $selected);
                if (!$this->db->execute()) {
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }



    public function obtenerTestId($id)
    {
        $this->db->query("SELECT * FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);
        return $this->db->registro();
    }



    public function obtenerTestPrueba($id)
    {
        $this->db->query("SELECT id_prueba FROM TEST_PRUEBA WHERE id_test = :id");
        $this->db->bind(':id', $id);
        return $this->db->registros();
    }




    public function borrarTest($id)
    {
        $this->db->query("DELETE FROM TEST WHERE id_test = :id");
        $this->db->bind(':id', $id);

        // $this->db->query("DELETE FROM TEST_PRUEBA WHERE id_prueba = :id_prueba AND id_test=:id" );
        // $this->db->bind(':id_prueba', $id_);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function modificarTest($id, $entregado)
    {
        $this->db->query("UPDATE USUARIO SET entregado=:entregado WHERE id_usuario = :id_usuario");
        $this->db->bind(':id_usuario', $id);
        $this->db->bind(':entregado', $entregado);
        $this->db->execute();
    }
}
