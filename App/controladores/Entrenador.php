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
            
                
                
               $id_entrenador=$this->datos['usuarioSesion']->id_usuario;
               //echo $id_entrenador;

                $this->datos['grupos'] = $this->grupoModelo->obtenerGrupos();
                $this->datos['todosSociosGrupos'] = $this->grupoModelo->todosSociosGrupos($id_entrenador);
                //var_dump($this->datos['todosSociosGrupos']);

                $this->datos['todosEntrenadoresGrupos'] = $this->grupoModelo->todosEntrenadoresGrupos($id_entrenador);
                //var_dump($this->datos['todosEntrenadoresGrupos']);


                if(isset($_POST['filtro']) && $_POST['filtro']!=0 ){
                        $this->datos['alumnosGrupo'] = $this->grupoModelo->obtenerAlumnos($_POST['filtro']);
                }else{
                    $this->datos['alumnosGrupo'] = $this->grupoModelo->todosSociosGrupos($id_entrenador);
                }
             


                $this->datos['testPruebas'] = $this->grupoModelo->obtenerTestPruebas();
                //var_dump($this->datos['testPruebas']);
                $this->datos['marcas'] = $this->pruebaModelo->obtenerMarcas();
                //var_dump($this->datos['marcas']);
                $this->datos['miga1']="GRUPOS";
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


            public function borrarMarca($id){
                $this->datos['rolesPermitidos'] = [2];         
                if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                    redireccionar('/usuarios');
                };


                 if($_SERVER['REQUEST_METHOD']=='POST'){
   
                      $borrarMarca=[
                         'id_prueba'=> $_POST['mBorrar'],
                         'id_usuario'=> trim($_POST['idUsu']),                 
                      ];  
                      
                      if ($this->pruebaModelo->borrarMarcaUsuario($borrarMarca)) {
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
                         ];
                         //obtenemos los test
                         $this->datos['listaTest'] = $this->testModelo->obtenerTest();
                         //obtenemos las pruebas y lo guardamos en datos['pruebas']
                         $prueba = $this->pruebaModelo->obtenerPruebas();
                        
                         $this->datos['nuevoMiga'] = "TEST";
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
                    //var_dump($_POST);

                        //recogemos los datos modificados y guardamos en $testModificado
                        $testModificado = [
                            'id_test' => trim($_POST['id_test']),
                            'nombreTest' => trim($_POST['nombreTest']),
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
                 $this->datos['miga1']="MENSAJERIA";
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
                            echo $correo ."<br>";
                             $mail->addAddress($correo); // Email destinatario
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
                    //redireccionar('/entrenador/mensajeria');
            }




}
