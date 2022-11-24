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
                $this->socioModelo = $this->modelo('SocioModelo');
                $this->equipacionModelo = $this->modelo('Equipacion');    
                $this->eventoModelo = $this->modelo('Evento');    
                $this->temporadaModelo = $this->modelo('Temporada');
                $this->testModelo = $this->modelo('Test');
                $this->pruebaModelo = $this->modelo('Prueba');
                $this->mensajeModelo = $this->modelo('Mensaje');
                $this->grupoModelo = $this->modelo('Grupo');
                $this->usuarioModelo = $this->modelo('Usuario');
            }


//******************************** PANTALLA INICAL ENTRENADOR ************************************  
            
            public function index(){
                $id=$this->datos['usuarioSesion']->id_usuario;
                $this->datos['datos_user'] = $this->adminModelo->obtenerDatosId($id);
                $this->vista('entrenadores/inicio', $this->datos);
            }



//**************************************** EVENTOS *******************************************  

public function eventos(){ 
    $id_usuario=$this->datos['usuarioSesion']->id_usuario;
    $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
    $this->datos['eventos'] = $this->eventoModelo->obtener_eventos();
    $this->datos['resul_eventos'] = $this->eventoModelo->obtener_resul_eventos();
    $this->vista('entrenadores/eventos', $this->datos);
}


public function anotar_eventos(){
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $tam=sizeof($_POST['parti']);
        $nuevo = array();
        for($i=0;$i<$tam;$i++){
            $obj =[
                'parti'=> $_POST['parti'][$i],
                'marca'=>$_POST['marca'][$i],
                'dorsal'=>$_POST['dorsal'][$i]
            ];
            array_push($nuevo,$obj);
        };

        if ($this->eventoModelo->anotar_marca($nuevo,$_POST['evento'],)) {
            redireccionar('/entrenador/eventos');
        }else{
            die('Algo ha fallado!!!');
        }
     }else{
         $this->vista('entrenador/eventos', $this->datos);
    }       
}



//**************************************** EQUIPACION *******************************************  

public function equipacion(){   
    $id_usuario=$this->datos['usuarioSesion']->id_usuario;
    $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);

    $this->datos['temp_actual']=$this->temporadaModelo->obtener_actual();
    $id_temporada=$this->datos['temp_actual']->id_temp;
    $this->datos['equipacion'] = $this->equipacionModelo->obtener_equipaciones($id_temporada);
 
    $this->datos['talla'] = $this->equipacionModelo->obtener_tallas();
    $this->datos['equi'] = $this->socioModelo->obtener_pedidos($id_usuario);
    $this->vista('entrenadores/equipacion', $this->datos);
}



public function pedir_equipacion(){
    $id_usuario=$this->datos['usuarioSesion']->id_usuario;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $pedidoEquipacion = [
            'cantidad' => trim($_POST["cantidad"]),
            'talla' => trim($_POST["talla"]),
            'idUsuario' => $id_usuario,
            'idEquipacion' => trim($_POST['idEquipacion'])
        ];
            if ($this->equipacionModelo->nuevo_pedido($pedidoEquipacion) ){
                redireccionar('/entrenador/equipacion');
            } else {
            die('Algo ha fallado!!!');
            }
    } else {
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
        $this->vista('entrenadores/equipacion', $this->datos);
    }
}



public function borrar_pedido($id){
    $this->datos['rolesPermitidos'] = [3];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }
    $id_usuario=$this->datos['usuarioSesion']->id_usuario;

    if ($this->socioModelo->borrar_pedido($id,$id_usuario)) {
        redireccionar('/entrenador/equipacion');
        }else{
            die('Algo ha fallado!!!');
        }
    $this->vista('entrenadores/equipacion', $this->datos); 
}

    

            
//**************************************** GRUPOS *******************************************  

    public function grupos(){           
        $id_entrenador=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['grupos_entrenador'] = $this->grupoModelo->grupos_por_entrenador($id_entrenador);   
        $this->datos['info_grupos'] = $this->grupoModelo->info_grupos($id_entrenador);
        $this->datos['horarios_grupos'] = $this->grupoModelo->horarios_grupos();
        $this->vista('entrenadores/grupos', $this->datos);       
    }



    public function alumnos($id_grupo){
        $id_entrenador=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['alumnos']=$this->grupoModelo->ver_alus_grupo($id_entrenador,$id_grupo);
        $this->datos['grupo_info']=$this->grupoModelo->grupo_concreto($id_entrenador,$id_grupo);
        $this->datos['testPruebas'] = $this->grupoModelo->obtenerTestPruebas();
        $this->datos['ver_marcas'] = $this->pruebaModelo->ver_marcas_alus($id_grupo);
        $this->vista('entrenadores/alumnos', $this->datos);
    }


            
    public function marca_alu($id){
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
            if ($this->pruebaModelo->agregar_marca_alumno($nuevaMarca)) {
                redireccionar('/entrenador/grupos');
            }else{
                die('Algo ha fallado!!!');
            }  
        }
    }



    public function borrar_marca($id){     
        $this->datos['rolesPermitidos'] = [2];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        };
            if($_SERVER['REQUEST_METHOD']=='POST'){                       
                $id_grupo=(trim($_POST['grupo']));
                $this->pruebaModelo->borrar_marca_alu($id);
                redireccionar('/entrenador/grupos');
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
