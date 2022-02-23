<?php

class Prueba
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerPruebas(){
        $this->db->query("SELECT * FROM PRUEBA");
        return $this->db->registros();
    }


     public function obtenerPruebasTest($idTest){
         $this->db->query("SELECT TEST_PRUEBA.id_test,PRUEBA.nombrePrueba,PRUEBA.id_prueba FROM PRUEBA INNER JOIN TEST_PRUEBA 
                            ON TEST_PRUEBA.id_prueba=PRUEBA.id_prueba and TEST_PRUEBA.id_test=:idTest");
         $this->db->bind(':idTest', $idTest);
         return $this->db->registros();
     }


}