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
        $this->pruebaModelo = $this->modelo('Prueba');
    }



    // MENU INICIO
    public function index(){
        $this->vista('entrenadores/inicio', $this->datos);
    }




    // FUNCIONES MENU GRUPOS
    public function grupos(){
        $this->vista('entrenadores/grupos', $this->datos);
    }



    // FUNCIONES MENU TEST -> PRUEBAS
    public function test(){  
 
            $this->datos['test'] = $this->testModelo->obtenerTest();

            $this->datos['pruebas']=$this->pruebaModelo->obtenerPruebas();

            for($i = 0 ;$i<count($this->datos['test']); $i++){
                $this->datos['test'][$i]->pruebas = $this->pruebaModelo->obtenerPruebasTest($this->datos['test'][$i]->id_test);
            }

            $this->vista('entrenadores/test', $this->datos);
    }

   

    public function nuevo_test()
    {
        $this->datos['rolesPermitidos'] = [2];         

        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $testNuevo = [
                'id_test' => trim($_POST['id_test']),
                'nombreTest' => trim($_POST['nombreTest']),
            ];
            if ($this->testModelo->agregarTest($testNuevo,$_POST['id_prueba'])) {
                redireccionar('/entrenador/test');
            } else {
                die('Algo ha fallado!!!');
            }
        } else {
            $this->datos['test'] = (object) [
                'id_test' => '',
                'nombreTest' => '',
            ];
            //obtenemos los test
            $this->datos['listaTest'] = $this->testModelo->obtenerTest();
            //obtenemos las pruebas y lo guardamos en datos['pruebas']
            $prueba = $this->pruebaModelo->obtenerPruebas();
            $this->datos['pruebas'] = $prueba;

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
            $this->datos['test'] = $this->testModelo->obtenerTestId($id);
            $this->vista('entrenadores/test', $this->datos);
        }
    }


    public function editarTest($id)
    {
        $this->datos['rolesPermitidos'] = [2];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $testModificado = [
                    'id_test' => trim($_POST['id_test']),
                    'nombreTest' => trim($_POST['nombreTest']),
                    'id_prueba' => isset($_POST['id_prueba']) ? $_POST['id_prueba'] : ''
                ];
           
                $datos['test_prueba'] = $this->testModelo->obtenerTestPrueba($id);
  

                if ($this->testModelo->modificarTest()) {
                    redireccionar('/entrenador/test');
                } else {
                    echo "ARRAY BBDD ";
                    var_dump($datos['test_prueba']);
                    echo '<br>';
                    echo "ARRAY MODIFICADO ";
                    var_dump($testModificado['id_prueba']);

                   
                     foreach($datos['test_prueba'] as $idPrueba){  
                        echo '<br>';
                        echo "variable";
                        var_dump($idPrueba->id_prueba);
                      
                        if (in_array($idPrueba->id_prueba,$testModificado['id_prueba'])){
                            $eliminar[] = [$idPrueba]; 
                        }

                    // }
        
                    //die('Algo ha fallado!!!');    
                    }
                    echo '<br>';
                    echo "ARRAY ELIMINAR";
                    var_dump($eliminar);

        }


    }

    }

    // FUNCIONES MENU MENSAJERIA
    public function mensajeria(){
        $this->vista('entrenadores/mensajeria', $this->datos);
    }

}
