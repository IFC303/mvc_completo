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
        $notific[3] = $this->AdminModelo->notPedidos();
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
                 $directorio = "/var/www/html/tragamillas/public/img/fotos_equipacion/";
                
                 copy ( $_FILES['subirFoto']['tmp_name'],$directorio.$indice.'.jpg') ; 
                 //damos permisos al archivo para poder eliminarlo
                 chmod($directorio.$indice.'.jpg',0777);
      
                //  $this->equipacionModelo->renombrar($indice,$nom);
                 
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
            $directorio="/var/www/html/tragamillas/public/img/fotos_equipacion/";
             unlink($directorio.$id.'.jpg');
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
                 'id'=>trim($_POST['idEquipacion']),
                 'nombre' => (trim($_POST['nombre'])),
                 'foto'=>$_FILES['editarFoto']['name'],
                 'descripcion' => trim($_POST['descripcion']),
                 'precio' => trim($_POST['precio']),
                 'temporada' => trim($_POST['temporada'])                               
             ];

             $equipacionModificada['foto']=$equipacionModificada['id'].'.jpg';
                      
             if($this->equipacionModelo->editarEquipacion($equipacionModificada)){
                  $directorio="/var/www/html/tragamillas/public/img/fotos_equipacion/";
                  copy ($_FILES['editarFoto']['tmp_name'],$directorio.$equipacionModificada['id'].'.jpg') ; 
                  chmod($directorio.$equipacionModificada['id'].'.jpg',0777);
                  //$this->equipacionModelo->renombrar($equipacionModificada['id']);                           
                  redireccionar('/adminEquipaciones/gestion');
            }else{
               die('Añgo ha fallado!!');
            }

     } else {
            $this->vista('administradores/crudEventos/inicio', $this->datos);
    }
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

            // // ********* PEDIDOS --> envio mail avisando de recogida *******
            // public function enviar(){
            //     $notific = $this->notificaciones();
            //     $this->datos['notificaciones'] = $notific;
               
            //     if($_SERVER['REQUEST_METHOD']=='POST'){
        
            //         $mail = new PHPMailer();      
        
            //         //me llega un string y lo paso a array con explode
            //         $destinatario = explode(",",($_POST['destinatario']));
            //         //echo print_r($destinatario);          
            //         $asunto = ($_POST['asunto']);
            //         //echo $asunto;
            //         $mensaje =($_POST['mensaje']);
            //         //echo $mensaje;
            
            //          try {
            //         // //  Configuracion SMTP
            //             // $mail->SMTPDebug =2;
            //              $mail->isSMTP();                                       // Activar envio SMTP
            //              $mail->Host  = 'smtp.gmail.com';                       // Servidor SMTP
            //              $mail->SMTPAuth  = true;                               // Identificacion SMTP
            //              $mail->Username  = 'sbr.design.reto@gmail.com';              // Usuario SMTP
            //              $mail->Password  = 'sbrdesign1234';	                     // Contraseña SMTP
            //              $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            //              $mail->Port  = 587;
                        
            //         // // CONFIGURACION CORREO
            //              $mail->setFrom('sbr.design.reto@gmail.com');   // Remitente del correo
        
            //              foreach($destinatario as $correo){
            //                 //echo $correo ."<br>";
            //                 $mail->addAddress($correo); // Email destinatario
            //              }
                          
            //              $mail->isHTML(true);
            //              $mail->Subject = $asunto;
            //              $mail->Body  = $mensaje;
            //              $mail->send();
        
                         
            //              echo '<script type="text/javascript">alert("Mensaje enviado correctamente");
            //                 window.location.assign("pedidos");
            //                 </script>'; 
         
            //          } catch (Exception $e) {
            //              echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
            //          }
        
            //     }
        
            //     //redireccionar('/adminEquipaciones/pedidos');
                    
            // }
            


            // ********* PEDIDOS --> EDITAR EQUIPACIONES *******
            public function editar_equipacion($id_soli_equi){
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $equipacion_modificada = [
                        'cantidad'=> trim($_POST['cantidad']),
                        'talla' => trim($_POST['talla']),
                    ];
                    if ($this->equipacionModelo->editar_pedido($id_soli_equi,$equipacion_modificada)) {
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