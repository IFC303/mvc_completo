<?php

class AdminGrupos extends Controlador
{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->grupoModelo = $this->modelo('Grupo');
    }



    public function index(){
        $this->datos['grupo'] = $this->grupoModelo->obtenerGrupos();
        $this->vista('administradores/crudGrupos/inicio',$this->datos);
    }


    public function nuevo_grupo(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $grupoNuevo = [
                'id_grupo' => trim($_POST['id_grupo']),
                'nombre' => trim($_POST['nombre']),
                'fecha_inicio' => trim($_POST['fecha_inicio']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
            ];

            if($this->grupoModelo->agregarGrupo($grupoNuevo)){
                redireccionar('/adminGrupos');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            $this->datos['grupo'] = (object)[
                'id_grupo'=>'',
                'nombre'=>'',
                'fecha_inicio'=>'',
                'fecha_fin'=>'',
            ];
            $this->vista('administradores/crudGrupos/nuevo_grupo',$this->datos);
        }
    }


    public function borrar($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->grupoModelo->borrarGrupo($id)) {
                redireccionar('/adminGrupos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['grupo'] = $this->grupoModelo->obtenerGrupoId($id);
            $this->vista('administradores/crudGrupos/inicio', $this->datos);
        }


}

        public function participantes($id_grupo){
            $this->datos['participantes'] = $this->grupoModelo->obtenerEntrenador();
            $this->vista('administradores/crudGrupos/participantes',$this->datos);
        }












































}