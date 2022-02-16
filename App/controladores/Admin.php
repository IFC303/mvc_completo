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

    public function borrarUsuario($idUsu){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->AdminModelo->borrarUsuario($idUsu)) {
                redireccionar('/admin/crud_admin');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }

    public function nuevoUsuario()
    {
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $testNuevo = [
                'id_test' => trim($_POST['id_test']),
                'nombre' => trim($_POST['nombre'])
            ];

            if ($this->testModelo->agregarTest($testNuevo)) {
                redireccionar('/entrenador');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['test'] = (object) [
                'id_test' => '',
                'nombre' => '',
            ];
            $this->datos['listaTest'] = $this->testModelo->obtenerTest();
            $this->vista('entrenadores/nuevo_test', $this->datos);
        }
    }

    public function crud_entrenadores()
    {
        $verUsu = $this->AdminModelo->obtenerUsuarios(2);
        $this->datos['usuAdmin'] = $verUsu;
        $this->vista('administradores/cruds/crudEntrenador', $this->datos);
    }

    public function crud_socios()
    {
        $this->vista('administradores/cruds/crudSocios', $this->datos);
    }

    public function crud_tiendas()
    {
        $this->vista('administradores/cruds/crudTiendas', $this->datos);
    }
}
