<?php

class Socio extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->marcasModelo = $this->modelo('Marcas');
        $this->datosModelo = $this->modelo('Datos');
      
    }

    public function index()
    {
        $this->vista('socios/inicio', $this->datos);
    }

    public function modificarDatos()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $datosUser = $this->datosModelo->obtenerDatosSocioId($idUsuarioSesion);
        $this->datos['usuarios']=$datosUser;

        

        $this->vista('socios/modificarDatos', $this->datos);
    }

    public function verMarcas()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $marcas = $this->marcasModelo->obtenerMarcasId($idUsuarioSesion);
        $this->datos['usuarios']=$marcas;

        $this->vista('socios/verMarcas', $this->datos);
    }

    


}
