<?php

class AdminTemporadas extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);

        $this->datos['rolesPermitidos'] = [1]; 
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/'); 
        }
        $this->adminModelo = $this->modelo('AdminModelo');
        $this->temporadaModelo = $this->modelo('Temporada');
    }


    //*********** NOTIFICACIONES EN EL MENU LATERAL *********************/
    public function notificaciones(){
        $notific[0] = $this->adminModelo->notSocio();
        $notific[1] = $this->adminModelo->notGrupo();
        $notific[2] = $this->adminModelo->notEventos();
        $notific[3] = $this->adminModelo->contar_pedidos();
        return $notific;
    }


    
    //*********** INDEX *********************/
    public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['temporada']=$this->temporadaModelo->obtener_temporadas();
        $this->vista('administradores/temporada',$this->datos);
    }



//*********************************** NUEVO ****************************************/
    public function nuevo(){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $nuevo = [
                'nombre' => trim($_POST['nombre']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin' => trim($_POST['fecha_fin']),
                'observaciones' => trim($_POST['observaciones'])
            ];

            if($this->temporadaModelo->nuevo($nuevo)){
                redireccionar('/adminTemporadas');
            }else{
                die('Añgo ha fallado!!');
            }
        }else{
            $this->datos['temporada'] = (object)[
                'nombre' => '',
                'fecha_ini' => '',
                'fecha_fin' => '',
                'observaciones' => ''
            ];

            $this->vista('administradores/temporada',$this->datos);
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
                'nombre' => trim($_POST['nombre']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin' => trim($_POST['fecha_fin']),
                'observaciones' => trim($_POST['observaciones'])
            ];

            if ($this->temporadaModelo->editar($editar,$id)){
                redireccionar('/adminTemporadas');
            } else {
                die('Algo ha fallado!!!');
            }
    
         } else {    
            $this->vista('administradores/temporada',$this->datos);
        }
    }
    

//*********************************** BORRAR ****************************************/

public function borrar($id){

    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->temporadaModelo->borrar($id)) {
            redireccionar('/adminTemporadas');
        }else{
            die('Algo ha fallado!!!');
        }
    }else{
        $this->vista('administradores/temporada', $this->datos);
    }
}


}