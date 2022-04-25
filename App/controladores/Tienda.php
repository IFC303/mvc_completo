<?php

class Tienda extends Controlador{



    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [4];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }
        $this->tiendaModelo = $this->modelo('TiendaModelo');
    }


    public function index(){
        $this->datos['tienda']=$this->tiendaModelo->obtenerUsuarios();  
       // $this->datos['tienda'] = $this->Modelo->obtenerEventos();
        $this->vista('tiendas/inicio', $this->datos);     
    }


    public function nueva_equipacion(){
   
        $this->datos['rolesPermitidos'] = [4];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $equipacionNueva = [
                'tipo'=>trim($_POST['tipo']),
                'talla'=>trim($_POST['talla']),
                'usu'=>trim($_POST['usu'])
            ];

            if($this->tiendaModelo->agregarEquipacion($equipacionNueva)){
                redireccionar('/tienda');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            $this->datos['tienda'] = (object)[
                'tipo'=>'',
                'talla'=>'',
                'usu'=>''
            ];
            //$this->datos["nuevo"]="EVENTO";
            $this->vista('tiendas/inicio',$this->datos);
        }



    }




















    //  public function equipaciones()
    //  {
    //      $this->datos['equipaciones'] = $this->equipacionesModelo->getEquipacionesUsuario();
    //      $this->vista('tienda/equipaciones', $this->datos);
    //  }

    // public function editarEquipacion()
    // {
    //     $this->datos['rolesPermitidos'] = [4];
    //     if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
    //         redireccionar('/tienda');
    //     }

    //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //         if ($this->equipacionesModelo->updateUsuario(trim($_POST['id_usuario']), trim($_POST['entregado']))) {
    //             redireccionar('/tienda');
    //         } else {
    //             die('Algo ha fallado!!!');
    //         }
    //     }
    // }


}
