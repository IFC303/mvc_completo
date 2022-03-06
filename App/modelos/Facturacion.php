<?php

class Facturacion
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerIngresosCuotas(){
        $this->db->query("SELECT * FROM I_CUOTAS");
        return $this->db->registros();
    }

    public function obtenerIngresosOtros(){
        $this->db->query("SELECT * FROM I_OTROS");
        return $this->db->registros();
    }

    public function obtenerGastosPersonal(){
        $this->db->query("SELECT * FROM G_PERSONAL");
        return $this->db->registros();
    }

    public function obtenerGastosOtros(){
        $this->db->query("SELECT * FROM G_OTROS");
        return $this->db->registros();
    }

}