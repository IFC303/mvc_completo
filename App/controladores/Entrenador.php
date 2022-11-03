<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    require_once RUTA_APP.'/librerias/PHPMailer/Exception.php';
    require_once RUTA_APP.'/librerias/PHPMailer/PHPMailer.php';
    require_once RUTA_APP.'/librerias/PHPMailer/SMTP.php';


class Entrenador extends Controlador{


//**************************************** CONSTRUCTOR *******************************************  

            public function __construct(){
                Sesion::iniciarSesion($this->datos);
                $this->datos['rolesPermitidos'] = [2];         
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/');
                }

                $this->adminModelo = $this->modelo('AdminModelo');

                $this->testModelo = $this->modelo('Test');
                $this->pruebaModelo = $this->modelo('Prueba');
                $this->mensajeModelo = $this->modelo('Mensaje');
                $this->grupoModelo = $this->modelo('Grupo');
                $this->usuarioModelo = $this->modelo('Usuario');
            }


//**************************************** PANTALLA INICAL ENTRENADOR *******************************************  
            
            public function index(){
                $id=$this->datos['usuarioSesion']->id_usuario;
                $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);
                $this->vista('entrenadores/inicio', $this->datos);
            }

            
//**************************************** SUBMENU GRUPOS *******************************************  

            public function grupos(){
                    
               $id_entrenador=$this->datos['usuarioSesion']->id_usuario;
               //echo $id_entrenador;

                $this->datos['grupos'] = $this->grupoModelo->obtenerGrupos();
                $this->datos['todosSociosGrupos'] = $this->grupoModelo->todosSociosGrupos($id_entrenador);
                //var_dump($this->datos['todosSociosGrupos']);

                $this->datos['todosEntrenadoresGrupos'] = $this->grupoModelo->todosEntrenadoresGrupos($id_entrenador);
                //var_dump($this->datos['todosEntrenadoresGrupos']);


                if(isset($_POST['filtro']) && $_POST['filtro']!=0 ){
                    $this->datos['alumnosGrupo'] = $this->grupoModelo->obtenerAlumnosUno($_POST['filtro']);
                }else{
                    $this->datos['alumnosGrupo'] = $this->grupoModelo->todosSociosGrupos($id_entrenador);
                }
             

                $this->datos['testPruebas'] = $this->grupoModelo->obtenerTestPruebas();
                $this->datos['miga1']="GRUPOS";
                $this->vista('entrenadores/grupos', $this->datos);
                
            }


// ------------------------------- ANOTAR MARCAS ------------------------//
            
            public function marca($id){
                $this->datos['rolesPermitidos'] = [2];         
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/usuarios');
                };
             

                $testPrueba=explode(":",$_POST['idPrueba']);           

                 if($_SERVER['REQUEST_METHOD']=='POST'){
   
                      $nuevaMarca=[   
                        'id_usuario'=> $id,
                        'id_prueba'=> $testPrueba['1'],
                        'id_test'=> $testPrueba['0'],
                        'fecha'=> trim($_POST['fecha']),
                        'marca'=>($_POST['marca']),                                                
                        'observaciones'=>($_POST['observaciones'])   
                      ];  

                      if ($this->pruebaModelo->agregarMarca($nuevaMarca)) {
                            redireccionar('/entrenador/grupos');
                        }else{
                            die('Algo ha fallado!!!');
                        }  
                 }
            }

// ------------------------------- VER RESULTADOS DE UN ALUMNO ------------------------//

            public function gru_res($alumno){
                $id_entrenador=$this->datos['usuarioSesion']->id_usuario;

                $this->datos['un_alu'] = $this->pruebaModelo->obtenermarcasAlumno($alumno);
                $this->datos['aluInfo'] = $this->usuarioModelo->obtenerUsuarioId($alumno);
                $this->vista('entrenadores/gru_res', $this->datos);
            }

// ------------------------------- BORRAR RESULTADO ------------------------//

            public function borrarMarca($id){
              
                $this->datos['rolesPermitidos'] = [2];         
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/usuarios');
                };


                  if($_SERVER['REQUEST_METHOD']=='POST'){                     
                       if ($this->pruebaModelo->borrarMarcaUsuario($id)) {
                             redireccionar('/entrenador/gru_res/'.$_POST['idUsu']);
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
                    $this->datos['miga1']="TEST";
                    $this->vista('entrenadores/test', $this->datos);
            }


            public function nuevo_test(){
                    $this->datos['rolesPermitidos'] = [2];         
                    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                        redireccionar('/usuarios');
                    }

                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                        $testNuevo = [
                            'nombreTest' => trim($_POST['nombreTest']),
                            'descripcion' => trim($_POST['descripcion'])
                        ];

                        if(isset($_POST['id_prueba'])){
                                $ultimoIndice = $this->testModelo->agregarSoloTest($testNuevo);
                                //echo $ultimoIndice;
                                if ($this->testModelo->agregarTodo($ultimoIndice,$_POST['id_prueba'])) {
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
                          

                        redireccionar('/entrenador/test');

                            
                     } else{
                         $this->datos['test'] = (object) [
                             'nombreTest' => '',
                             'descripcion' => '',
                         ];
                         //obtenemos los test
                         $this->datos['listaTest'] = $this->testModelo->obtenerTest();
                         //obtenemos las pruebas y lo guardamos en datos['pruebas']
                         $prueba = $this->pruebaModelo->obtenerPruebas();
                        
                         $this->datos['nuevoMiga'] = "TEST";
                         $this->datos['pruebas'] = $prueba;
                         $this->vista('entrenadores/new_t', $this->datos);
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
                    //var_dump($_POST);

                        //recogemos los datos modificados y guardamos en $testModificado
                        $testModificado = [
                            'id_test' => trim($_POST['id_test']),
                            'nombreTest' => trim($_POST['nombreTest']),
                            'fecha_alta' => trim($_POST['fecha']),
                            'descripcion' => trim($_POST['descripcion']),
                            'id_prueba' => isset($_POST['id_prueba']) ? $_POST['id_prueba'] : ''
                        ];//var_dump($testModificado);

                        $pruebas=$testModificado['id_prueba'];
                        //var_dump($pruebas);
   

                        //recogemos los datos de la BBDD (array de objetos) y guardamos en $bd
                          $bd = [];    
                          $bbdd = $this->testModelo->obtenerTestPrueba($id);
                          foreach ($bbdd as $objeto){
                                   $bd[]=$objeto->id_prueba;    
                          }//var_dump($bd);
                

                        //creamos 2 arrays para comparar lo que nos llega nuevo con lo que habia en la bbdd
                          $eliminar=[];
                          $insertar=[];

                        //comparacion BBDD con MODIFICADO
                           if(empty($pruebas)){
                                foreach($bd as $idPrueba){  
                                    //echo $idPrueba;
                                    $eliminar[]=$idPrueba;
                                }         
                            } else{
                                foreach($bd as $idPrueba){ 
                                    if (!in_array($idPrueba,$pruebas)){ 
                                    //echo $idPrueba;
                                    $eliminar[]=$idPrueba;
                                    }
                                }
                            } //echo "array eliminar",
                            //var_dump($eliminar);


                        //comparacion MODIFICADO con BBDD
                          if($testModificado['id_prueba']!=null){
                              foreach($testModificado['id_prueba'] as $idPruebaM){  
                               //si el valor de $idPruebaM no esta en el array $bd - in_array(valor a buscar, array donde buscamos)
                               if (!in_array($idPruebaM,$bd)){
                                  $insertar[]=$idPruebaM;
                                }
                             }
                          }//echo "array insertar";
                          //var_dump($insertar);
                        
            
                          if ($this->testModelo->modificarTest($eliminar,$insertar,$testModificado)) {
                              redireccionar('/entrenador/test');
                          }else{
                              die('Algo ha fallado!!!');
                          }
            }


    }


   // *********** SUBMENU: EVENTOS (funciones) ***********  

   public function eventos(){
    $idUsu=$this->datos['usuarioSesion']->id_usuario;
   
    // $this->datos['emails']=$this->mensajeModelo->obtener_email_grupo();
    // $this->datos['emails']=$this->mensajeModelo->grupos_x_entrenador($idUsu);
    // $this->datos['grupos']=$this->mensajeModelo->entrenador_grupo($idUsu);

  

    $this->vista('entrenadores/eventos', $this->datos);
}

    
        // *********** SUBMENU: MENSAJERIA (funciones) ***********  

            public function mensajeria(){
                $idUsu=$this->datos['usuarioSesion']->id_usuario;
               
                // $this->datos['emails']=$this->mensajeModelo->obtener_email_grupo();
                $this->datos['emails']=$this->mensajeModelo->grupos_x_entrenador($idUsu);
                $this->datos['grupos']=$this->mensajeModelo->entrenador_grupo($idUsu);

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
                        //$mail->SMTPDebug =2;
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
                            //  $mail->addAddress($correo); //Email destinatario
                             $mail->addBCC($correo);  
                        }
                          
                        $mail->isHTML(true);
                        $mail->Subject = $asunto;
                        $mail->Body  = $mensaje;
                        $mail->send();

                        echo '<script type="text/javascript">alert("Mensaje enviado correctamente");
                        window.location.assign("entrenador/mensajeria");
                        </script>'; 

                        
                       
                    } catch (Exception $e) {
                        echo "El mensaje no se ha enviado. Mailer Error: {$mail->ErrorInfo}";
                    }

                }
                  redireccionar('/entrenador/mensajeria');
            }




}
