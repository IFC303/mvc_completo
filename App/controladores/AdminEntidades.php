<?php

class AdminEntidades extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/'); 
        }
            $this->entidadModelo = $this->modelo('Entidad');
    }


    public function index(){
        $this->datos['entidad']=$this->entidadModelo->obtenerEntidades();
        $this->vista('administradores/crudEntidades/inicio',$this->datos);
    }

    
    public function nuevaEntidad(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $entidadNueva = [
                'id_entidad' => trim($_POST['id_entidad']),
                'nombre' => trim($_POST['nombre']),
                'direccion' => trim($_POST['direccion']),
                'telefono' => trim($_POST['telefono']),
                'email' => trim($_POST['email']),
                'observaciones' => trim($_POST['observaciones']),
            ];

            if($this->entidadModelo->agregarEntidad($entidadNueva)){
                redireccionar('/adminEntidades');
            }else{
                die('Añgo ha fallado!!');
            }
        }else{
            $this->datos['entidad'] = (object)[
                'id_entidad'=>'',
                'nombre'=>'',
                'tipo'=>'',
            ];
            $this->vista('administradores/crudEntidades/nueva_entidad',$this->datos);
        }
    }


    public function borrar($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->entidadModelo->borrarEntidad($id)) {
                redireccionar('/adminEntidades');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['entidad'] = $this->entidadModelo->obtenerEntidadId($id);
            $this->vista('administradores/crudEntidades/inicio', $this->datos);
        }
    }



    public function editarEntidad($id){

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                //recogemos los datos modificados y guardamos en $grupo_modificado
                $entidad_modificada = [
                    'id_entidad' => trim($_POST['id_entidad']),
                    'nombre' => trim($_POST['nombre']), 
                    'direccion' => trim($_POST['direccion']),
                    'telefono' => trim($_POST['telefono']),
                    'email' => trim($_POST['email']),
                    'observaciones' => trim($_POST['observaciones']),
                ];
   
                if ($this->entidadModelo->editarEntidad($entidad_modificada)) {
                    redireccionar('/adminEntidades');
                }else{
                    die('Algo ha fallado!!!');
                }

         } else {
                $this->vista('administradores/crudEntidades/inicio', $this->datos);
        }


}


































}