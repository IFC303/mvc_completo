<?php

class Admin extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->AdminModelo = $this->modelo('AdminModelo');
    }

    public function index()
    {
        $this->vista('administradores/inicio', $this->datos);
    }


    public function crud_admin()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(1);
        $this->datos['usuAdmin'] = $verUsu;
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_entrenadores()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(2);
        $this->datos['usuAdmin'] = $verUsu;
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_socios()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(3);
        $this->datos['usuAdmin'] = $verUsu;
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function crud_tiendas()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(4);
        $this->datos['usuAdmin'] = $verUsu;
        $this->vista('administradores/cruds/crudAdmin', $this->datos);
    }

    public function borrarUsuario($idUsu)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->borrarUsuario($idUsu)) {
                redireccionar('/admin/crud_admin');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function editarUsuario($idEdit)
    {
        
        
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $ediUsu = [
                'idEdit' => trim($idEdit),
                'dniEdit' => trim($_POST["editDni"]),
                'nomEdit' => trim($_POST["editNombre"]),
                'apelEdit' => trim($_POST["editApellidos"]),
                'fecEdit' => trim($_POST["editFecha"]),
                'telEdit' => trim($_POST["editTlf"]),
                'emaEdit' => trim($_POST["editEmail"]),
                'passEdit' => trim($_POST["editPas"]),
                'CCCEdit' => trim($_POST["editCCC"]),
                'TallaEdit' => trim($_POST["editTalla"]),
                'FotoEdit' => trim($_POST["editFoto"]),
                'ActEdit' => trim($_POST["editAct"]),
                'RolEdit' => trim($_POST["editRol"]),
            ];

            if ($this->AdminModelo->editarUsuario($ediUsu)) {
                $verUsu = $this->AdminModelo->obtenerUsuarios(1);
                $this->datos['usuAdmin'] = $verUsu;
                $this->vista('administradores/cruds/crudAdmin', $this->datos);
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->vista('administradores/cruds/nuevoUsuario', $this->datos);
        }
    }

    public function nuevoUsuario()
    {
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $anaUsu = [
                'dniUsuAna' => trim($_POST["dni"]),
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
            $this->vista('administradores/cruds/nuevoUsuario', $this->datos);
        }
    }

}
