<?php

class Prueba
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerPruebas(){
        $this->db->query("SELECT tipo,nombre FROM PRUEBA");
        return $this->db->registros();
    }


}