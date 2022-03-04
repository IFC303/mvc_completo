<?php

class AdminEventos extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->eventoModelo = $this->modelo('Evento');
    }


    public function index(){
        $this->datos['evento'] = $this->eventoModelo->obtenerEventos();
        $this->vista('administradores/crudEventos/inicio',$this->datos);
    }



    public function nuevo_evento(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $eventoNuevo = [
                'id_evento' => trim($_POST['id_evento']),
                'id_usuario'=> trim($_POST['id_usuario']),
                'nombre' => trim($_POST['nombre']),
                'tipo'=>trim($_POST['tipo']),
                'precio'=>trim($_POST['precio']),
                'descuento'=>trim($_POST['descuento']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
            ];

            if($this->eventoModelo->agregarEvento($eventoNuevo)){
                redireccionar('/adminEventos');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            $this->datos['evento'] = (object)[
                'id_grupo'=>'',
                'id_usuario'=>'',
                'nombre'=>'',
                'tipo'=>'',
                'precio'=>'',
                'descuento'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>'',
            ];
            $this->vista('administradores/crudEventos/nuevo_evento',$this->datos);
        }
    }


    public function borrar($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->eventoModelo->borrarEvento($id)) {
                redireccionar('/adminEventos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['evento'] = $this->eventoModelo->obtenerEventoId($id);
            $this->vista('administradores/crudEventos/inicio', $this->datos);
        }


    }


    public function editarEvento($id){

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $evento_modificado = [
                    'id_evento' => trim($_POST['id_evento']),
                    'id_usuario' => trim($_POST['id_usuario']),
                    'nombre' => trim($_POST['nombre']),
                    'tipo'=> trim($_POST['tipo']),
                    'precio' => trim($_POST['precio']),
                    'descuento'=>trim($_POST['descuento']),
                    'fecha_ini' => trim($_POST['fecha_ini']),
                    'fecha_fin' => trim($_POST['fecha_fin']),   
                ];
   
                $this->eventoModelo->editarEvento($evento_modificado);
                 if ($this->eventoModelo->editarEvento($evento_modificado)) {
                     redireccionar('/adminEventos');
                 }else{
                     die('Algo ha fallado!!!');
                 }
    }


}






























}





