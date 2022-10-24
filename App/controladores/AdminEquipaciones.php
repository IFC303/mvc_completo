<?php


class AdminEquipaciones extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->equipacionModelo = $this->modelo('Equipacion');
        $this->adminModelo = $this->modelo('AdminModelo');
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
    //$this->vista('administradores/crudEquipacion',$this->datos);
}



//****************************************** GESTION EQUIPACIONES ************************************************/

public function gestion(){
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

    $this->datos['equipacion'] = $this->equipacionModelo->obtenerEquipaciones();
    $this->vista('administradores/equiG',$this->datos);
}


public function nuevaEquipacion(){
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }
 
    if($_SERVER['REQUEST_METHOD'] =='POST'){
        
        $nuevo = [
            'nombre' => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion']),
            'precio' => trim($_POST['precio']),
            'temporada' => trim($_POST['temporada']),
            'foto'=>$_FILES['subirFoto']['name']
        ];

        if ($this->equipacionModelo->nuevaEquipacion($nuevo)) {
            redireccionar('/adminEquipaciones/gestion');
        } else {
            die('Algo ha fallado!!!');
        }
                 
     }else{
         $this->datos['equipacion'] = (object)[
            'nombre' => '',
            'descripcion' => '',
            'precio' => '',
            'temporada' => '',
            'foto'=>''
         ];

         $this->vista('administradores/equiG',$this->datos);
    }
    
}


public function borrarEquipacion($id){
     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         if ($this->equipacionModelo->borrarEquipacion($id)) {
            //$directorio="/var/www/html/tragamillas/public/img/fotos_equipacion/";
             $directorio="C:/xampp/htdocs/tragamillas/public/img/fotos_equipacion/"; 
             unlink($directorio.$id.'.jpg');
             redireccionar('/adminEquipaciones/gestion');
         }else{
             die('Algo ha fallado!!!');
         }
     }else{
        $this->datos['equipacion'] = $this->equipacionModelo->obtenerEquipacionId($id);
        $this->vista('administradores/equiG',$this->datos);
     }
}



public function editarEquipacion($id){

    $this->datos['rolesPermitidos'] = [1];          
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $foto=$_FILES['editarFoto']['name'];
            $foto=$id.'.jpg';

             $equipacionModificada = [
                 'nombre' => (trim($_POST['nombre'])),
                 'foto'=>$foto,
                 'descripcion' => trim($_POST['descripcion']),
                 'precio' => trim($_POST['precio']),
                 'temporada' => trim($_POST['temporada'])                               
             ];

            if ($this->equipacionModelo->editarEquipacion($equipacionModificada,$id)){
                $directorio="C:/xampp/htdocs/tragamillas/public/img/fotos_equipacion/";       
                copy($_FILES['editarFoto']['tmp_name'], $directorio.$id.'.jpg');
                chmod($directorio.$id.'.jpg',0777);
                redireccionar('/adminEquipaciones/gestion');
            } else {
                die('Algo ha fallado!!!');
            }

     } else {
        $this->datos['equipacion'] = (object)[
            'nombre' => '',
            'foto'=>'',
            'descripcion' => '',
            'precio' => '',
            'temporada' => ''
         ];

        $this->vista('administradores/equiG',$this->datos);
    }
}




//****************************************** PEDIDOS EQUIPACIONES ************************************************/

    public function pedidos(){    
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        
        $this->datos['pedidos']=$this->equipacionModelo->obtenerPedidosUsuarios(); 
        $this->vista('administradores/equiP',$this->datos);
    }



    public function borrarPedido($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->equipacionModelo->borrarPedido($id)) {
                redireccionar('/adminEquipaciones/pedidos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['tienda'] = $this->equipacion->obtenerEquipacionId($id);
            $this->vista('adminEquipaciones/equiP', $this->datos);
        }
    }


    // ********* cambiar estado a entregado o no *******
    public function cambiar_estado($id){
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $estado=$_POST['estado'];
            if ($this->equipacionModelo->cambiarEstado($id,$estado)) {
                redireccionar('/adminEquipaciones/pedidos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->vista('adminEquipaciones/equiP', $this->datos);
        }
    }



            // ********* PEDIDOS --> EDITAR EQUIPACIONES *******
            // public function editar_equipacion($id_soli_equi){
            //     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            //         $equipacion_modificada = [
            //             'cantidad'=> trim($_POST['cantidad']),
            //             'talla' => trim($_POST['talla']),
            //         ];
            //         if ($this->equipacionModelo->editar_pedido($id_soli_equi,$equipacion_modificada)) {
            //             redireccionar('/adminEquipaciones/pedidos');
            //         }else{
            //             die('Algo ha fallado!!!');
            //         }
            //     } else {
            //         $this->vista('adminEquipaciones/equiP', $this->datos);
            //     }
            // }

        

            // ********* PEDIDOS --> NUEVA EQUIPACION *******
            // public function nueva_equipacion(){
            //     $this->datos['rolesPermitidos'] = [1];         
            //     if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            //         redireccionar('/usuarios');
            //     }

            //     if($_SERVER['REQUEST_METHOD'] =='POST'){
            //         $equipacionNueva = [
            //             'tipo'=>trim($_POST['tipo']),
            //             'talla'=>trim($_POST['talla']),
            //             'usu'=>trim($_POST['usu'])
            //         ];
            //         if($this->equipacion->agregarEquipacion($equipacionNueva)){
            //             redireccionar('/adminEquipaciones/pedidos');
            //         }else{
            //             die('Añgo ha fallado!!');
            //         }
            //     }else{
            //         $this->datos['tienda'] = (object)[
            //             'tipo'=>'',
            //             'talla'=>'',
            //             'usu'=>''
            //         ];
            //         $this->vista('adminEquipaciones/equiP',$this->datos);
            //     }
            // }


  

  
}