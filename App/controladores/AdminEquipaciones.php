<?php


class AdminEquipaciones extends Controlador{



    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1]; 
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
}



//****************************************** GESTION EQUIPACIONES ************************************************/

public function gestion(){
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

    $this->datos['equipacion'] = $this->equipacionModelo->obtener_equipaciones();
 
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
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

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

            if (($_FILES['editarFoto']['name'])==''){
                if($_POST['foto_ant']!=''){
                    $foto=$_POST['foto_ant'];
                }else{
                  $foto='';  
                }
            }else{
                $foto=$_FILES['editarFoto']['name'];
                $foto=$id.'.jpg';
            }

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
        $this->vista('administradores/equiG',$this->datos);
    }
}




//****************************************** PEDIDOS EQUIPACIONES ************************************************/


public function pedidos(){    
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;   

    $this->datos['usus']=$this->equipacionModelo->obtener_usuarios();
    $this->datos['equip']=$this->equipacionModelo->obtener_equipaciones();
    $this->datos['pedidos']=$this->equipacionModelo->obtener_pedidos(); 
    $this->datos['talla'] = $this->equipacionModelo->obtener_tallas();
    $this->vista('administradores/equiP',$this->datos);
}



public function nuevo_pedido(){
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

    if($_SERVER['REQUEST_METHOD'] =='POST'){
        $nuevo = [
            'idEquipacion'=>trim($_POST['equi']),
            'idUsuario'=>trim($_POST['usu']),
            'cantidad'=>trim($_POST['cantidad']),
            'talla'=>trim($_POST['talla'])
        ];
        if($this->equipacionModelo->nuevo_pedido($nuevo)){
            redireccionar('/adminEquipaciones/pedidos');
        }else{
            die('Añgo ha fallado!!');
        }
    }else{
        $this->datos['pedido'] = (object)[
            'equi'=>'',
            'usu'=>'',
            'cantidad'=>'',
            'talla'=>''
        ];
        $this->vista('adminEquipaciones/equiP',$this->datos);
    }
}



// public function editar_pedido($id_soli_equi){
//     $this->datos['rolesPermitidos'] = [1];         
//     if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
//         redireccionar('/usuarios');
//     }

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



public function borrarPedido($id){
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

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



public function cambiar_estado($id){
    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $estado=$_POST['estado'];
        if ($this->equipacionModelo->cambiar_estado($id,$estado)) {
            redireccionar('/adminEquipaciones/pedidos');
        }else{
            die('Algo ha fallado!!!');
        }
    }else{
        $this->vista('adminEquipaciones/equiP', $this->datos);
    }
}




  

  
}