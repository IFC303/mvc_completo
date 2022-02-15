<?php

class Entrenador extends Controlador
{
    public function __construct()
    {
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [2];          // Definimos los roles que tendran acceso

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->testModelo = $this->modelo('Test');
    }


    public function index(){
        $this->vista('entrenadores/inicio', $this->datos);
    }


    public function grupos(){
        $this->vista('entrenadores/grupos', $this->datos);
    }


    public function test(){  
        $test = $this->testModelo->obtenerTest();
        $this->datos['usuarios'] = $test;
        $this->vista('entrenadores/test', $this->datos);
    }


    public function nuevo_test()
    {
        $this->datos['rolesPermitidos'] = [2];          // Definimos los roles que tendran acceso

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


   public function borrar($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->testModelo->borrarTest($id)) {
                redireccionar('/entrenador/test');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['usuarios'] = $this->testModelo->obtenerTestId($id);
            $this->vista('entrenadores/test', $this->datos);
        }
    }




    public function mensajeria(){
        $this->vista('entrenadores/mensajeria', $this->datos);
    }

}
