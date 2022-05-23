<?php

class AdminEquipaciones extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->equipacionModelo = $this->modelo('Equipacion');
        $this->AdminModelo = $this->modelo('AdminModelo');
    }


   //NOTIFICACIONES
   public function notificaciones()
   {
       $notific[0] = $this->AdminModelo->notSocio();
       $notific[1] = $this->AdminModelo->notGrupo();
       $notific[2] = $this->AdminModelo->notEventos();
       
       return $notific;
   }

  
    public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        $this->vista('administradores/crudEquipacion',$this->datos);
     }




public function gestion(){
        $notific = $this->notificaciones();
        $notific[3] ="GESTION";
        $this->datos['notificaciones'] = $notific;
        $this->datos['equipacion'] = $this->equipacionModelo->obtenerEquipacion();
        $this->vista('administradores/crudEquipacion/gestion',$this->datos);
}


public function nuevaEquipacion(){

    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }


    if($_SERVER['REQUEST_METHOD'] =='POST'){
        $equipacionNueva = [
            'nombre' => trim($_POST['nombre']),
            'descripcion' => trim($_POST['descripcion']),
        ];

        if($this->equipacionModelo->nuevaEquipacion($equipacionNueva)){
            redireccionar('/adminEquipaciones/gestion');
        }else{
            die('Añgo ha fallado!!');
        }
    }else{
        $this->datos['equipacion'] = (object)[
            'id_entidad'=>'',
            'nombre'=>'',
            'tipo'=>'',
        ];
        $this->datos["nuevo"]="ENTIDADES";
        $this->vista('administradores/crudEntidades/nueva_entidad',$this->datos);
    }
    
}


public function borrarEquipacion($id){
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
         if ($this->equipacionModelo->borrarEquipacion($id)) {
             redireccionar('/adminEquipaciones/gestion');
         }else{
             die('Algo ha fallado!!!');
         }
     }else{
        $this->datos['equipacion'] = $this->equipacionModelo->obtenerEventoId($id);
        $this->vista('administradores/crudEventos/inicio', $this->datos);
     }
}


public function editarEquipacion(){
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

    $this->datos['rolesPermitidos'] = [1];          
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $equipacionModificada = [
                'id_equipacion' => $_POST['id_equipacion'],
                'tipo' => trim($_POST['nombre']),
                'descripcion'=> trim($_POST['descripcion'])           
            ];

             if ($this->equipacionModelo->editarEquipacion($equipacionModificada)) {
                 redireccionar('/adminEquipaciones/gestion');
             }else{
                 die('Algo ha fallado!!!');
             }

     } else {
            $this->vista('administradores/crudEventos/inicio', $this->datos);
    }
}




public function subirFotos(){

    $archivo = $_FILES['foto']['name'];
      $directorio="/var/www/html/tragamillas/public/img/fotosPerfil/";
    
  //Si se quiere subir una imagen
// if (isset($_POST['subir'])) {
//     //Recogemos el archivo enviado por el formulario
//     
//     //Si el archivo contiene algo y es diferente de vacio
//     if (isset($archivo) && $archivo != "") {
//        //Obtenemos algunos datos necesarios sobre el archivo
//        $tipo = $_FILES['foto']['type'];
//        $tamano = $_FILES['foto']['size'];
//        $temp = $_FILES['foto']['tmp_name'];

//        //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
//     //   if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
//     //      echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
//     //      - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
//     //   }

if (is_uploaded_file($_FILES['foto']['tmp_name'])) {
    echo "ok";
    copy($_FILES['foto']['tmp_name'], $directorio."prueba3".".png");
    } else {
    echo "error";
    }


// if (move_uploaded_file($archivo, $directorio.$archivo)) {
//              //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
//              //chmod($directorio.$archivo, 0777);
//              //Mostramos el mensaje de que se ha subido co éxito
//              echo 'ok';
//              //Mostramos la imagen subida
//              //echo '<p><img src="images/'.$archivo.'"></p>';
//          }
//          else {
//             //Si no se ha podido subir la imagen, mostramos un mensaje de error
//             echo 'error';
//          }



    //   else {
    //      //Si la imagen es correcta en tamaño y tipo
    //      //Se intenta subir al servidor
         
    //    }
    //}
 
    
    

}






    public function pedidos(){    
        $notific = $this->notificaciones();
        $notific[3] ="PEDIDOS";
        $this->datos['notificaciones'] = $notific;
        $this->datos['tienda']=$this->equipacion->obtenerEquipacionUsuarios(); 
        $this->vista('administradores/crudEquipacion/pedidos',$this->datos);
    }

            // ********* PEDIDOS --> BORRADO EQUIPACIONES *******
            public function borrar_equipacion($id_equipacion){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($this->equipacion->borrarEquipacion($id_equipacion)) {
                        redireccionar('/adminEquipaciones/pedidos');
                    }else{
                        die('Algo ha fallado!!!');
                    }
                }else{
                    $this->datos['tienda'] = $this->equipacion->obtenerEquipacionId($id_equipacion);
                    $this->vista('adminEquipaciones/pedidos', $this->datos);
                }
            }

            // ********* PEDIDOS --> EDITAR EQUIPACIONES *******
            public function editar_equipacion($id_equipacion){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $equipacion_modificada = [
                        'tipo'=> trim($_POST['tipo']),
                        'talla' => trim($_POST['talla']),
                    ];
                    if ($this->equipacion->editarEquipacion($id_equipacion,$equipacion_modificada)) {
                        redireccionar('/adminEquipaciones/pedidos');
                    }else{
                        die('Algo ha fallado!!!');
                    }
                } else {
                    $this->vista('adminEquipaciones/pedidos', $this->datos);
                }
            }

            // ********* PEDIDOS --> CAMBIAR ESTADO *******
            public function cambiar_estado($id){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $estado=$_POST['estado'];
                    if ($this->equipacion->cambiarEstado($id,$estado)) {
                        redireccionar('/adminEquipaciones/pedidos');
                    }else{
                        die('Algo ha fallado!!!');
                    }
                } else {
                    $this->vista('adminEquipaciones/pedidos', $this->datos);
                }
            }

            // ********* PEDIDOS --> NUEVA EQUIPACION *******
            public function nueva_equipacion(){
                $this->datos['rolesPermitidos'] = [1];         
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/usuarios');
                }

                if($_SERVER['REQUEST_METHOD'] =='POST'){
                    $equipacionNueva = [
                        'tipo'=>trim($_POST['tipo']),
                        'talla'=>trim($_POST['talla']),
                        'usu'=>trim($_POST['usu'])
                    ];
                    if($this->equipacion->agregarEquipacion($equipacionNueva)){
                        redireccionar('/adminEquipaciones/pedidos');
                    }else{
                        die('Añgo ha fallado!!');
                    }
                }else{
                    $this->datos['tienda'] = (object)[
                        'tipo'=>'',
                        'talla'=>'',
                        'usu'=>''
                    ];
                    $this->vista('adminEquipaciones/pedidos',$this->datos);
                }
            }


  

  
}