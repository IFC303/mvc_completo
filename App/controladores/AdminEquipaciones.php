<?php

 use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
    require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
    require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
    require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';


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
            'precio' => trim($_POST['precio']),
            'temporada' => trim($_POST['temporada']),
            'foto'=>$_FILES['subirFoto']['name']
        ];
           if($indice=$this->equipacionModelo->nuevaEquipacion($equipacionNueva)){
                 $directorio="/var/www/html/tragamillas/public/img/fotos_equipacion/";
                 copy ( $_FILES['subirFoto']['tmp_name'],$directorio.$indice) ; 
                 $this->equipacionModelo->renombrar($indice);
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
    }
    
}


public function borrarEquipacion($id){
    $notific = $this->notificaciones();
    $this->datos['notificaciones'] = $notific;

    $this->datos['rolesPermitidos'] = [1];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }

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
        var_dump($_POST);
            $equipacionModificada = [
                'nombre' => trim($_POST['nombre']),
                'descripcion' => trim($_POST['descripcion']),
                'precio' => trim($_POST['precio']),
                'temporada' => trim($_POST['temporada']),
                'foto'=>$_FILES['editarFoto']['name'],
                'id'=>trim($_POST['idEquipacion'])
            ];

            //var_dump($equipacionModificada);

        //     if($indice=$this->equipacionModelo->editarEquipacion($equipacionModificada)){
        //         $directorio="/var/www/html/tragamillas/public/img/fotos_equipacion/";
        //         copy ($_FILES['subirFoto']['tmp_name'],$directorio.$indice) ; 
        //         $this->equipacionModelo->renombrar($indice);
        //         redireccionar('/adminEquipaciones/gestion');
        //   }else{
        //      die('Añgo ha fallado!!');
        //   }

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



// ********* PEDIDOS EQUIPACIONES *******


    public function pedidos(){    
        $notific = $this->notificaciones();
        $notific[3] ="PEDIDOS";
        $this->datos['notificaciones'] = $notific;
        $this->datos['pedidos']=$this->equipacionModelo->obtenerPedidosUsuarios(); 
        $this->vista('administradores/crudEquipacion/pedidos',$this->datos);
    }

            // ********* PEDIDOS --> borrar pedido *******
            public function borrarPedido($idPedido){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if ($this->equipacionModelo->borrarPedido($idPedido)) {
                        redireccionar('/adminEquipaciones/pedidos');
                    }else{
                        die('Algo ha fallado!!!');
                    }
                }else{
                    $this->datos['tienda'] = $this->equipacion->obtenerEquipacionId($idPedido);
                    $this->vista('adminEquipaciones/pedidos', $this->datos);
                }
            }

            // ********* PEDIDOS --> cambiar estado a entregado o no *******
            public function cambiar_estado($id){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $estado=$_POST['estado'];
                    if ($this->equipacionModelo->cambiarEstado($id,$estado)) {
                        redireccionar('/adminEquipaciones/pedidos');
                    }else{
                        die('Algo ha fallado!!!');
                    }
                }else{
                    $this->vista('adminEquipaciones/pedidos', $this->datos);
                }
            }

            // ********* PEDIDOS --> envio mail avisando de recogida *******
            public function enviar(){
                $notific = $this->notificaciones();
                $this->datos['notificaciones'] = $notific;
               
                if($_SERVER['REQUEST_METHOD']=='POST'){
        
                    $mail = new PHPMailer();      
        
                    //me llega un string y lo paso a array con explode
                    $destinatario = explode(",",($_POST['destinatario']));
                    //echo print_r($destinatario);          
                    $asunto = ($_POST['asunto']);
                    //echo $asunto;
                    $mensaje =($_POST['mensaje']);
                    //echo $mensaje;
            
                     try {
                    // //  Configuracion SMTP
                        // $mail->SMTPDebug =2;
                         $mail->isSMTP();                                       // Activar envio SMTP
                         $mail->Host  = 'smtp.gmail.com';                       // Servidor SMTP
                         $mail->SMTPAuth  = true;                               // Identificacion SMTP
                         $mail->Username  = 'sbr.design.reto@gmail.com';              // Usuario SMTP
                         $mail->Password  = 'sbrdesign1234';	                     // Contraseña SMTP
                         $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                         $mail->Port  = 587;
                        
                    // // CONFIGURACION CORREO
                         $mail->setFrom('sbr.design.reto@gmail.com');   // Remitente del correo
        
                         foreach($destinatario as $correo){
                            //echo $correo ."<br>";
                            $mail->addAddress($correo); // Email destinatario
                         }
                          
                         $mail->isHTML(true);
                         $mail->Subject = $asunto;
                         $mail->Body  = $mensaje;
                         $mail->send();
        
                         
                         echo '<script type="text/javascript">alert("Mensaje enviado correctamente");
                            window.location.assign("pedidos");
                            </script>'; 
         
                     } catch (Exception $e) {
                         echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
                     }
        
                }
        
                //redireccionar('/adminEquipaciones/pedidos');
                    
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