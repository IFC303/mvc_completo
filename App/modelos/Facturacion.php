<?php

class Facturacion
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerIngresos(){
        $this->db->query("SELECT * from INGRESOS");
        return $this->db->registros();
    }

      public function obtenerIngresosTipo($tipo){
          $this->db->query("SELECT * FROM INGRESOS WHERE tipo=:tipo");
          $this->db->bind(':tipo', $tipo);
          return $this->db->registros();
       }

    // public function obtenerIngresosOtros(){
    //     $this->db->query("SELECT * FROM I_OTROS");
    //     return $this->db->registros();
    // }

    // public function obtenerGastosPersonal(){
    //     $this->db->query("SELECT * FROM G_PERSONAL");
    //     return $this->db->registros();
    // }

    // public function obtenerGastosOtros(){
    //     $this->db->query("SELECT * FROM G_OTROS");
    //     return $this->db->registros();
    // }

}