<?php

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\Exception;
        use PHPMailer\PHPMailer\SMTP;

        require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
        require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
        require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';


class Entrenador extends Controlador{


        // *********** CONSTRUCTOR ***********  

            public function __construct(){
                Sesion::iniciarSesion($this->datos);
                $this->datos['rolesPermitidos'] = [2];          // Definimos los roles que tendran acceso
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/');
                }
                $this->testModelo = $this->modelo('Test');
                $this->pruebaModelo = $this->modelo('Prueba');
                $this->mensajeModelo = $this->modelo('Mensaje');
                $this->grupoModelo = $this->modelo('Grupo');
            }


        // *********** PAGINA PRINCIPAL ENTRENADOR ***********  

            public function index(){
                $this->vista('entrenadores/inicio', $this->datos);
            }

        // *********** SUBMENU: GRUPOS (funciones) ***********  

            public function grupos(){
                $this->datos['grupos'] = $this->grupoModelo->obtenerGrupos();
              
                $id_grupo=$_POST['filtro'];
                //echo $id_grupo;
                $this->datos['alumnosGrupo'] = $this->grupoModelo->obtenerAlumnos($id_grupo);
                //var_dump($this->datos['alumnosGrupo']);
                $this->datos['testPruebas'] = $this->grupoModelo->obtenerTestPruebas();
                //var_dump($this->datos['testPruebas']);
                $this->datos['marcas'] = $this->pruebaModelo->obtenerMarcas();
                //var_dump($this->datos['marcas']);
                $this->vista('entrenadores/grupos', $this->datos);
                
            }


            public function marca($id){
                $this->datos['rolesPermitidos'] = [2];         
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/usuarios');
                };


                 if($_SERVER['REQUEST_METHOD']=='POST'){
   
                      $nuevaMarca=[
                         'id_prueba'=> $_POST['idPrueba'],
                         'id_usuario'=> $id,
                         'fecha'=> trim($_POST['fecha']),
                         'marca'=>($_POST['marca'])
                         
                      ];  
                      //var_dump($nuevaMarca);
                      if ($this->pruebaModelo->agregarMarca($nuevaMarca)) {
                            redireccionar('/entrenador/grupos');
                        }else{
                            die('Algo ha fallado!!!');
                        }  
                 }


            }


        // *********** SUBMENU: TEST/PRUEBAS (funciones) ***********  

            public function test(){  
                    $this->datos['test'] = $this->testModelo->obtenerTest();
                    $this->datos['pruebas']=$this->pruebaModelo->obtenerPruebas();
                    for($i = 0 ;$i<count($this->datos['test']); $i++){
                        $this->datos['test'][$i]->pruebas = $this->pruebaModelo->obtenerPruebasTest($this->datos['test'][$i]->id_test);
                    }
                    $this->vista('entrenadores/test', $this->datos);
            }


            public function nuevo_test(){
                    $this->datos['rolesPermitidos'] = [2];         
                    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                        redireccionar('/usuarios');
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $testNuevo = [
                            'id_test' => trim($_POST['id_test']),
                            'nombreTest' => trim($_POST['nombreTest']),
                        ];
                        //var_dump($_POST['id_prueba']);

                            if(isset($_POST['id_prueba'])){
                                if ($this->testModelo->agregarTest($testNuevo,$_POST['id_prueba'])) {
                                    redireccionar('/entrenador/test');
                                }else{
                                    die('Algo ha fallado!!!');
                                }
                            }else{
                                if ($this->testModelo->agregarSoloTest($testNuevo)) {
                                    redireccionar('/entrenador/test');
                                }else{
                                    die('Algo ha fallado!!!');
                                }
                            }


                            
                     } else{
                         $this->datos['test'] = (object) [
                             'id_test' => '',
                             'nombreTest' => '',
                         ];
                         //obtenemos los test
                         $this->datos['listaTest'] = $this->testModelo->obtenerTest();
                         //obtenemos las pruebas y lo guardamos en datos['pruebas']
                         $prueba = $this->pruebaModelo->obtenerPruebas();
                         $this->datos['pruebas'] = $prueba;
                         $this->vista('entrenadores/nuevo_test', $this->datos);
                    }
            }


            public function borrar($id){
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        if ($this->testModelo->borrarTest($id)) {
                            redireccionar('/entrenador/test');
                        }else{
                            die('Algo ha fallado!!!');
                        }
                    }else{
                        $this->datos['test'] = $this->testModelo->obtenerTestId($id);
                        $this->vista('entrenadores/test', $this->datos);
                    }
            }


            public function editarTest($id){

                $this->datos['rolesPermitidos'] = [2];          
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/usuarios');
                }

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                        //recogemos los datos modificados y guardamos en $testModificado
                        $testModificado = [
                            'id_test' => trim($_POST['id_test']),
                            'nombreTest' => trim($_POST['nombreTest']),
                            'id_prueba' => isset($_POST['id_prueba']) ? $_POST['id_prueba'] : ''
                        ];

                        $bd = [];
                        //recogemos los datos de la BBDD (array de objetos) y guardamos en $bd 
                        $bbdd = $this->testModelo->obtenerTestPrueba($id);
                        foreach ($bbdd as $objeto){
                            $bd[]=$objeto->id_prueba;
                            
                        }
                
                        $eliminar=[];
                        $insertar=[];

                        
                        foreach($bd as $idPrueba){  
                            if($testModificado['id_prueba']!=null){
                                //comparacion BBDD con MODIFICADO
                                if (!in_array($idPrueba,$testModificado['id_prueba'])){
                                $eliminar[]=$idPrueba;
                            }
                            }  
                          }

                        if($testModificado['id_prueba']!=null){
                            foreach($testModificado['id_prueba'] as $idPruebaM){  
                            //comparacion MODIFICADO con BBDD
                            if (!in_array($idPruebaM,$bd)){
                                $insertar[]=$idPruebaM;
                            }
                        }
                        }
                        
            
                        if ($this->testModelo->modificarTest($eliminar,$insertar,$testModificado)) {
                            redireccionar('/entrenador/test');
                        }else{
                            die('Algo ha fallado!!!');
                        }
            }


    }

    
        // *********** SUBMENU: MENSAJERIA (funciones) ***********  

            public function mensajeria(){
                //var_dump($this->datos['usuarioSesion']);
                $idUsu=$this->datos['usuarioSesion']->id_usuario;
               
                $this->datos['mensaje']=$this->mensajeModelo->obtenerEmailGrupo();
                //var_dump($this->datos['mensaje']);
                $this->datos['entrenadorGrupo']=$this->mensajeModelo->entrenadorGrupo($idUsu);
                //var_dump($this->datos['entrenadorGrupo']);

                 if($_SERVER['REQUEST_METHOD']=='POST'){
                     $this->datos['emailsEnvio']= $_POST['seleccionados'];
                 } 
                $this->vista('entrenadores/mensajeria', $this->datos);
            }


            public function enviar(){


                if($_SERVER['REQUEST_METHOD']=='POST'){

                    $mail = new PHPMailer();


                    //me llega un string y lo paso a array con explode
                    $destinatario = explode(",",($_POST['destinatario']));
                    //echo print_r($destinatario);   

                    $asunto = ($_POST['asunto']);
                    $mensaje =($_POST['mensaje']);
            
                    try {
                    //  Configuracion SMTP
                        $mail->SMTPDebug =2;
                        $mail->isSMTP();                                       // Activar envio SMTP
                        $mail->Host  = 'smtp.gmail.com';                       // Servidor SMTP
                        $mail->SMTPAuth  = true;                               // Identificacion SMTP
                        $mail->Username  = 'sbr.design.reto@gmail.com';              // Usuario SMTP
                        $mail->Password  = 'sbrdesign1234';	                     // Contraseña SMTP
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port  = 587;
                        
                    // CONFIGURACION CORREO
                        $mail->setFrom('sbr.design.reto@gmail.com');   // Remitente del correo

                        foreach($destinatario as $correo){
                            echo $correo ."<br>";
                             $mail->addAddress($correo); // Email destinatario
                        }
                          
                        $mail->isHTML(true);
                        $mail->Subject = $asunto;
                        $mail->Body  = $mensaje;
                        $mail->send();

                        
                        redireccionar('/entrenador/mensajeria');
                        echo 'El mensaje se ha enviado';
                    } catch (Exception $e) {
                        echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
                    }

                }
                    
            }




}
