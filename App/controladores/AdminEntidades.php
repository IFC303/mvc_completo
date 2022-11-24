<?php

class AdminEntidades extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1]; 
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/'); 
        }
            $this->entidadModelo = $this->modelo('Entidad');
            $this->temporadaModelo = $this->modelo('Temporada');
            $this->adminModelo = $this->modelo('AdminModelo');
    }


    //*********** NOTIFICACIONES EN EL MENU LATERAL *********************/
    public function notificaciones(){
        $this->datos['temp_actual']=$this->temporadaModelo->obtener_actual();
        $notific[0] = $this->adminModelo->notSocio();
        $notific[1] = $this->adminModelo->notGrupo();
        $notific[2] = $this->adminModelo->notEventos();
        $notific[3] = $this->adminModelo->contar_pedidos($this->datos['temp_actual']);
        return $notific;
    }

    //*********** INDEX *********************/
    public function index(){
        $this->datos['notificaciones'] =  $this->notificaciones();
        $this->datos['entidad']=$this->entidadModelo->obtener_entidades();
        $this->vista('administradores/entidad',$this->datos);
    }


    //*********************************** NUEVO ****************************************/
    public function nuevo(){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $nuevo = [
                'cif' => trim($_POST['cif']),
                'nombre' => trim($_POST['nombre']),
                'direccion' => trim($_POST['direccion']),
                'telefono' => trim($_POST['telefono']),
                'email' => trim($_POST['email']),
                'observaciones' => trim($_POST['observaciones'])
            ];

            if($this->entidadModelo->nuevo($nuevo)){
                redireccionar('/adminEntidades');
            }else{
                die('Algo ha fallado!!');
            }
        }else{
            $this->datos['entidad'] = (object)[
                'id_entidad'=>'',
                'nombre'=>'',
                'direccion' => '',
                'telefono' => '',
                'email' => '',
                'observaciones' => ''
            ];

            $this->vista('administradores/entidad',$this->datos);
        }
    }


//*********************************** BORRAR ****************************************/

    public function borrar($id){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->entidadModelo->borrar($id)) {
                redireccionar('/adminEntidades');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['entidad'] = $this->entidadModelo->obtener_entidad_id($id);
            $this->vista('administradores/entidad', $this->datos);
        }
    }


//*********************************** EDITAR ****************************************/

    public function editar($id){

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $editar = [
                    'cif' => trim($_POST['cif']),
                    'nombre' => trim($_POST['nombre']), 
                    'direccion' => trim($_POST['direccion']),
                    'telefono' => trim($_POST['telefono']),
                    'email' => trim($_POST['email']),
                    'observaciones' => trim($_POST['observaciones'])
                ];
   
                if ($this->entidadModelo->editar($editar,$id)) {
                    redireccionar('/adminEntidades');
                }else{
                    die('Algo ha fallado!!!');
                }

         } else {
                $this->vista('administradores/entidad', $this->datos);
        }


}


































}