<?php

class Marcas
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerMarcas()
    {
        $this->db->query("SELECT * FROM PRUEBA P, PRUEBA_SOCIO PS , TEST T , TEST_PRUEBA TP where P.id_prueba = PS.id_prueba AND P.id_prueba = TP.id_prueba AND TP.id_test = T.id_test ORDER BY P.id_prueba");

        return $this->db->registros();
    }

}