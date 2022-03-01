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

        $marcas = $this->datosModelo->obtenerMarcasId($idUsuarioSesion);
        $this->datos['usuarios']=$marcas;

        $this->vista('socios/verMarcas', $this->datos);
    }

    public function licencias(){

        $idUsuarioSesion = $this->datos['usuarioSesion']->id_usuario;

        $licencias = $this->datosModelo->obtenerLicenciasId($idUsuarioSesion);
        $this->datos['usuarios']=$licencias;

        $this->vista('socios/licencias', $this->datos);
    }

    public function agregarLicencia()
    {
        /*$this->datos['rolesPermitidos'] = [3];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $anaUsu = [
                'd niUsuAna' => trim($_POST["dni"]),
                'nomUsuAna' => trim($_POST["nombre"]),
                'apelUsuAna' => trim($_POST["apellidos"]),
                'fecUsuAna' => trim($_POST["fecha"]),
                'telUsuAna' => trim($_POST["telf"]),
                'emaUsuAna' => trim($_POST["email"]),
                'passUsuAna' => trim($_POST["pass"]),
            ];

            if ($this->AdminModelo->anadirUsuario($anaUsu)) {
                $verUsu = $this->AdminModelo->obtenerUsuarios(1);
                $this->datos['usuAdmin'] = $verUsu;
                $this->vista('administradores/cruds/crudAdmin', $this->datos);
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('socios/agregarLicencia', $this->datos);
        }*/
        $this->vista('socios/agregarLicencia', $this->datos);
    }
    


}
