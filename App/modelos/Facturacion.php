<?php

class Facturacion
{
    private $db;
    private $paginator;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getPaginator()
    {
        return $this->paginator;
    }

    public function getCuotasUsuario($limit, $page)
    {
        $query = "SELECT id_ingreso_cuota, CONCAT(apellidos, ', ', nombre) AS 'apellidos_nombre', CCC, importe, dni, concepto, concepto, tipo, fecha, concat(apellidos, ', ', nombre) as 'apellidos_nombre', direccion, direccion as 'cod_postal', direccion as 'poblacion', direccion as 'provincia' FROM I_CUOTAS NATURAL JOIN USUARIO";
        $this->paginator = new Paginator($this->db, $query);

        $results    = $this->paginator->getData($limit, $page);
        return $results->data;
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