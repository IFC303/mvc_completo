<?php

class Marca
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerMarcas()
    {
        $this->db->query("SELECT * FROM PRUEBA");

        return $this->db->registros();
    }
}