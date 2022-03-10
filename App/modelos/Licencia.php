<?php

class Licencia
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerLicencias(){
        $this->db->query("SELECT * FROM LICENCIA");
        return $this->db->registros();
    }

}