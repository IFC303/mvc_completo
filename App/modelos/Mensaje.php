<?php

class Mensaje
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerEmail(){
        $this->db->query("SELECT nombre,apellidos,email FROM USUARIO");
        return $this->db->registros();
    }


   


}