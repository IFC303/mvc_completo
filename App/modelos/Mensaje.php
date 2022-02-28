<?php

class Mensaje
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerEmail(){
        $this->db->query("SELECT nombre,apellidos,email FROM usuario");
        return $this->db->registros();
    }


   


}