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

        $this->SocioModelo = $this->modelo('SocioModelo');
      
    }

    public function index()
    {
        $this->vista('socios/inicio', $this->datos);
    }

    public function modificarDatos()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $datosUser = $this->SocioModelo->obtenerDatosSocioId($idUsuarioSesion);
        $this->datos['usuarios']=$datosUser;

        

        $this->vista('socios/modificarDatos', $this->datos);
    }

    public function verMarcas()
    {
        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $marcas = $this->SocioModelo->obtenerMarcasId($idUsuarioSesion);
        $this->datos['usuarios']=$marcas;

        $this->vista('socios/verMarcas', $this->datos);
    }

    public function licencias(){

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $licencias = $this->SocioModelo->obtenerLicenciasId($idUsuarioSesion);
        $this->datos['usuarios']=$licencias;

        $this->vista('socios/licencias', $this->datos);
    }

    public function nuevaLicencia()
    {
        $this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $agreLic = [
                'numLicencia' => trim($_POST['NumLicencia']),
                'tipoLicencia' => trim($_POST['tipoLicencia']),
                'federativas' => trim($_POST['federativas']),
                'dorsal' => trim($_POST['Dorsal']),
                'fechaCaducidad' => trim($_POST['FechaCaducidad']),
                'imagenLicencia' => trim($_POST['ImagenLicencia']),
            ];

            if ($this->SocioModelo->agregarLicencia($agreLic)) {
                $this->vista('socios/licencias', $this->datos);
            } else {
                die('Algo ha fallado!!!');
            }

        } else {
            $this->vista('socios/agregarLicencia', $this->datos);
        }
        
    }
    


}
