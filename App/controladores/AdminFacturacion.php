<?php

class AdminFacturacion extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->facturacionModelo = $this->modelo('Facturacion');
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
    

      public function index(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        
         $this->vista('administradores/crudFacturacion',$this->datos);
     }



/*******************************************************/
/****************FUNCIONES INGRESOS ********************/
/*******************************************************/

    public function ingresos(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;
        // $notific = $this->notificaciones();
        // $notific[3] ="INGRESOS";
        // $this->datos['notificaciones'] = $notific;

            $ingresos = [];
            $ingresos = $this->facturacionModelo->obtenerIngresos();
            $this->datos['ingresos']=$ingresos;

            $this->datos['ingresosOtros']=$this->facturacionModelo->obtenerIngresosOtros();
            //var_dump($this->datos['ingresosOtros']);
            $this->datos['ingresosCuotas']=$this->facturacionModelo->obtenerIngresosCuotas();
            //todos ingresos participantes
            $this->datos['todosIngresosParticipantes']=$this->facturacionModelo->todosIngresosParticipantes();
            //var_dump($this->datos['todosIngresosParticipantes']);
            $this->datos['eventos']=$this->facturacionModelo->obtenerEventos();
            $this->datos['socios']=$this->facturacionModelo->obtenerSocios();
            $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();

            $this->datos['participantes']=$this->facturacionModelo->obtenerParticipante();
            $this->datos['ingresosActividadesSocios']=$this->facturacionModelo->ingresosActividadesSocios();
            $this->datos['ingresosActividadesExternos']=$this->facturacionModelo->ingresosActividadesExternos();
           
            $this->vista('administradores/crudFacturacion/ingresos', $this->datos);

    }


    public function nuevoIngreso(){
        $notific = $this->notificaciones();
        $notific[3] ="INGRESOS";
        $this->datos['notificaciones'] = $notific;

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        //para ingresar en CUOTAS
        $this->datos['socios']=$this->facturacionModelo->obtenerSocios();
        $this->datos['ingresosSocios']=$this->facturacionModelo->obtenerIngresosCuotas();
        //para ingresar en OTROS
        $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();
        $this->datos['ingresosOtros']=$this->facturacionModelo->obtenerIngresosOtros();
        //para ingresar en ACTIVIDADES
        $this->datos['participantes']=$this->facturacionModelo->obtenerParticipante();
        //var_dump($this->datos['participantes']);
        $this->datos['eventos']=$this->facturacionModelo->obtenerEventos();

        
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            //print_r($_POST);

            if($_POST['tipoSelect']=="otros"){
                    $ingresOtros = [
                    'fecha' => trim($_POST['fecha']),
                    'tipo' => trim($_POST['tipoSelect']),
                    'importe'=> trim($_POST['importe']),
                    'concepto'=>trim($_POST['concepto']),
                    'id_entidad'=>($_POST['browser3']),
                    ];
                    if($this->facturacionModelo->agregarIngresoOtros($ingresOtros)){
                        redireccionar('/adminFacturacion/ingresos');
                    }else{
                        die('Añgo ha fallado!!');
                    }

            }elseif ($_POST['tipoSelect']=="cuotas"){
                $ingresCuotas = [
                 'fecha' => trim($_POST['fecha']),
                 'tipo' => trim($_POST['tipoSelect']),
                 'importe'=> trim($_POST['importe']),
                 'concepto'=>trim($_POST['concepto']),
                 'id_usuario'=>($_POST['browser']),
                ];
                    if($this->facturacionModelo->agregarIngresoCuotas($ingresCuotas)){
                        redireccionar('/adminFacturacion/ingresos');
                    }else{
                    die('Añgo ha fallado!!');
                    }

            }elseif ($_POST['tipoSelect']=="actividades"){
                
                $cadena=($_POST['browser2']);  
                $separador = "-";
                $separada = explode($separador, $cadena);
                $id=$separada[0];

                if($separada[1]=="externo"){
                    $ingresActividadesExterno = [
                    'fecha' => trim($_POST['fecha']),
                    'tipo' => trim($_POST['tipoSelect']),
                    'importe'=> trim($_POST['importe']),
                    'concepto'=>trim($_POST['concepto']),
                    'id_evento'=>($_POST['idEventos']),
                    ];

                    //var_dump($ingresActividadesExterno);
                     if($this->facturacionModelo->agregarIngresoActividadesExterno($ingresActividadesExterno,$id)){
                         redireccionar('/adminFacturacion/ingresos');
                     }else{
                         die('Añgo ha fallado!!');
                     }

                }else{
 
                    $ingresActividadesSocio = [
                        'fecha' => trim($_POST['fecha']),
                        'tipo' => trim($_POST['tipoSelect']),
                        'importe'=> trim($_POST['importe']),
                        'concepto'=>trim($_POST['concepto']),
                        'id_evento'=>($_POST['idEventos']),
                        ];
                        //var_dump($ingresActividadesSocio);
                        // echo $id;
    
                           if($this->facturacionModelo->agregarIngresoActividadesSocio($ingresActividadesSocio,$id)){
                               redireccionar('/adminFacturacion/ingresos');
                           }else{
                             die('Añgo ha fallado!!');
                           }
                } 
            }
            }else{
            
            $this->datos['evento'] = (object)[
                'id_grupo'=>'',
                'id_usuario'=>'',
                'nombre'=>'',
                'tipo'=>'',
                'precio'=>'',
                'descuento'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>'',
            ];  
            $this->datos["nuevo"]="FACTURACION";
             $this->vista('administradores/crudFacturacion/nuevo_ingreso',$this->datos);
        }
        
    }



    public function borrarIngreso($id){
        $notific = $this->notificaciones();
        $notific[3] ="INGRESOS";
        $this->datos['notificaciones'] = $notific;       
        $tipo=$_POST['tipo'];

         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             if($tipo=="actividades"){
                 $this->facturacionModelo->borrarIngresoActividades($id);
                 redireccionar('/adminFacturacion/ingresos');
             }else if($tipo=="cuotas") {
                 $this->facturacionModelo->borrarIngresoCuotas($id);
                 redireccionar('/adminFacturacion/ingresos');
             }else if ($tipo=="otros"){
                 $this->facturacionModelo->borrarIngresoOtros($id);
                 redireccionar('/adminFacturacion/ingresos');
             }   
        }
    }


    public function editarIngreso($id){
            $notific = $this->notificaciones();
            $this->datos['notificaciones'] = $notific;

            $this->datos['rolesPermitidos'] = [1];          
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            //para ingresar en CUOTAS
            $this->datos['socios']=$this->facturacionModelo->obtenerSocios();
            $this->datos['ingresosSocios']=$this->facturacionModelo->obtenerIngresosCuotas();
            //para ingresar en OTROS
            $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();
            $this->datos['ingresosOtros']=$this->facturacionModelo->obtenerIngresosOtros();
            //para ingresar en ACTIVIDADES
            $this->datos['participantes']=$this->facturacionModelo->obtenerParticipante();
            //var_dump($this->datos['participantes']);
            $this->datos['eventos']=$this->facturacionModelo->obtenerEventos();


        if($_SERVER['REQUEST_METHOD'] =='POST'){
            //print_r($_POST);
            $id_viejo=$_POST['id_viejo'];
            $tipo_viejo=$_POST['tipo_viejo'];


             if($_POST['tipoSelect']=="otros"){
                        
                        $ingresOtros = [
                        'fecha' => trim($_POST['fecha']),
                        'tipo' => trim($_POST['tipoSelect']),
                        'importe'=> trim($_POST['importe']),
                        'concepto'=>trim($_POST['concepto']),
                        'id_entidad'=>($_POST['browser3']),
                        ];

                        if($tipo_viejo=="otros"){
                            $this->facturacionModelo->borrarIngresoOtros($id_viejo);
                        }elseif($tipo_viejo=="cuotas"){
                            $this->facturacionModelo->borrarIngresoCuotas($id_viejo);
                        }elseif($tipo_viejo=="actividades"){
                            $this->facturacionModelo->borrarIngresoActividades($id_viejo);
                        }
                        $this->facturacionModelo->agregarIngresoOtros($ingresOtros);
                        redireccionar('/adminFacturacion/ingresos');  

                }elseif ($_POST['tipoSelect']=="cuotas"){

                        $ingresCuotas = [
                        'fecha' => trim($_POST['fecha']),
                        'tipo' => trim($_POST['tipoSelect']),
                        'importe'=> trim($_POST['importe']),
                        'concepto'=>trim($_POST['concepto']),
                        'id_usuario'=>($_POST['browser']),
                        ];

                        if($tipo_viejo=="otros"){
                            $this->facturacionModelo->borrarIngresoOtros($id_viejo);
                         }elseif($tipo_viejo=="cuotas"){
                            $this->facturacionModelo->borrarIngresoCuotas($id_viejo);
                         }elseif($tipo_viejo=="actividades"){
                            $this->facturacionModelo->borrarIngresoActividades($id_viejo);
                         }
                        $this->facturacionModelo->agregarIngresoCuotas($ingresCuotas);
                        redireccionar('/adminFacturacion/ingresos');  
     
                }elseif ($_POST['tipoSelect']=="actividades"){
                       //var_dump($_POST);
                        $cadena=($_POST['browser2']);  
                        $separador = "-";
                        $separada = explode($separador, $cadena);
                        $id=$separada[0];

                        if($separada[1]=="externo"){
                            $ingresActividadesExterno = [
                            'fecha' => trim($_POST['fecha']),
                            'tipo' => trim($_POST['tipoSelect']),
                            'importe'=> trim($_POST['importe']),
                            'concepto'=>trim($_POST['concepto']),
                            'id_evento'=>($_POST['browser4']),
                            ];

                            if($tipo_viejo=="otros"){
                                $this->facturacionModelo->borrarIngresoOtros($id_viejo);
                             }elseif($tipo_viejo=="cuotas"){
                                $this->facturacionModelo->borrarIngresoCuotas($id_viejo);
                             }elseif($tipo_viejo=="actividades"){
                                $this->facturacionModelo->borrarIngresoActividades($id_viejo);
                             }
                             $this->facturacionModelo->agregarIngresoActividadesExterno($ingresActividadesExterno,$id);

                         }else{
                            $ingresActividadesSocio = [
                            'fecha' => trim($_POST['fecha']),
                            'tipo' => trim($_POST['tipoSelect']),
                            'importe'=> trim($_POST['importe']),
                            'concepto'=>trim($_POST['concepto']),
                            'id_evento'=>($_POST['browser4']),
                            ];    
                         //var_dump($ingresActividadesSocio);
                         // echo $id;
    
                            if($tipo_viejo=="otros"){
                                $this->facturacionModelo->borrarIngresoOtros($id_viejo);
                            }elseif($tipo_viejo=="cuotas"){
                                $this->facturacionModelo->borrarIngresoCuotas($id_viejo);
                            }elseif($tipo_viejo=="actividades"){
                                $this->facturacionModelo->borrarIngresoActividades($id_viejo);
                            }
                            $this->facturacionModelo->agregarIngresoActividadesSocio($ingresActividadesSocio,$id);
                         } 

                redireccionar('/adminFacturacion/ingresos');        

            }else{
            
                $this->datos['ingresos'] = (object)[
                    'id_grupo'=>'',
                    'id_usuario'=>'',
                    'nombre'=>'',
                    'tipo'=>'',
                    'precio'=>'',
                    'descuento'=>'',
                    'fecha_ini'=>'',
                    'fecha_fin'=>'',
                ];  
                $this->datos["nuevo"]="FACTURACION";
                $this->vista('administradores/crudFacturacion/ingresos',$this->datos);
            }
        }

    }




//**********************************************************************/
//********************* FUNCIONES GASTOS ******************************/
//********************************************************************/


    public function gastos(){
        $notific = $this->notificaciones();
        $notific[3] ="GASTOS";
        $this->datos['notificaciones'] = $notific;

        $gastos= [];
        $gastos = $this->facturacionModelo->obtenerGastos();
        $this->datos['gastos']=$gastos;
        $this->datos['gastosPersonal']=$this->facturacionModelo->gastosPersonal();
        $this->datos['gastosOtrosUsuario']=$this->facturacionModelo->gastosOtrosUsuario();
        $this->datos['gastosOtrosEntidad']=$this->facturacionModelo->gastosOtrosEntidad();

        $this->datos['entrenadores']=$this->facturacionModelo->obEntrenadores();
        $this->datos['entidades']=$this->facturacionModelo->obEntidades();
        $this->datos['socios']=$this->facturacionModelo->obSocios();  


          if(isset($_POST['tipo'])){
              $tipo=$_POST['tipo'];
              $this->datos['tipoGasto'] = $tipo;
          }
       
          $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    }




    public function nuevoGasto(){
            $notific = $this->notificaciones();
            $notific[3] ="GASTOS";
            $this->datos['notificaciones'] = $notific;

            $this->datos['rolesPermitidos'] = [1];         
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            $this->datos['entrenadores']=$this->facturacionModelo->obEntrenadores();
            $this->datos['entidades']=$this->facturacionModelo->obEntidades();
            $this->datos['socios']=$this->facturacionModelo->obSocios();  


        
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            //var_dump($_POST);

            if($_POST['tipoSelect']=="personal"){
                
                    $gastoPersonal = [
                        'fecha' => trim($_POST['fecha']),
                        'tipo' => trim($_POST['tipoSelect']),
                        'importe'=> trim($_POST['importe']),
                        'id_entrenador'=>trim($_POST['browser1']),
                        'concepto'=>trim($_POST['concepto']),
                    ];
                
                    if($this->facturacionModelo->agregarGastosPersonal($gastoPersonal)){
                        redireccionar('/adminFacturacion/gastos');
                    }else{
                        die('Añgo ha fallado!!');
                    }

                }elseif ($_POST['tipoSelect']=="otros"){

                        $gastosOtros = [
                        'fecha' => trim($_POST['fecha']),
                        'concepto'=>trim($_POST['concepto']),
                        'importe'=> trim($_POST['importe']),
                        'tipo' => trim($_POST['tipoSelect']),
                        'id_usuario'=>($_POST['browser2']),    
                        'id_entidad'=>($_POST['browser3']),                  
                        ];
    
                        //var_dump($gastoOtros);

                          if($this->facturacionModelo->agregarGastosOtros($gastosOtros)){
                              redireccionar('/adminFacturacion/gastos');
                          }else{
                              die('Añgo ha fallado!!');
                          }

                } 
                

            }else{
            
            $this->datos['evento'] = (object)[
                'id_grupo'=>'',
                'id_usuario'=>'',
                'nombre'=>'',
                'tipo'=>'',
                'precio'=>'',
                'descuento'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>'',
            ];
            $this->datos["nuevo"]="FACTURACION2";
           $this->vista('administradores/crudFacturacion/nuevo_gasto',$this->datos);
        }
    }


    public function borrarGasto($id){
        $notific = $this->notificaciones();
        $notific[3] ="INGRESOS";
        $this->datos['notificaciones'] = $notific; 

        $tipo=$_POST['tipo'];
        var_dump($tipo);

          if ($_SERVER['REQUEST_METHOD'] == 'POST') {
              if($tipo=="personal"){
                  $this->facturacionModelo->borrarGastosPersonal($id);
                  redireccionar('/adminFacturacion/gastos');
              }else if($tipo=="otros") {
                  $this->facturacionModelo->borrarGastosOtros($id);
                  redireccionar('/adminFacturacion/gastos'); 
             }
         }

        }


        public function editarGasto($id){
            $notific = $this->notificaciones();
            $this->datos['notificaciones'] = $notific;

            $this->datos['rolesPermitidos'] = [1];          
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            $this->datos['gastosPersonal']=$this->facturacionModelo->gastosPersonal();
            $this->datos['gastosOtrosUsuario']=$this->facturacionModelo->gastosOtrosUsuario();
            $this->datos['gastosOtrosEntidad']=$this->facturacionModelo->gastosOtrosEntidad();

            $this->datos['entrenadores']=$this->facturacionModelo->obEntrenadores();
            $this->datos['entidades']=$this->facturacionModelo->obEntidades();
            $this->datos['socios']=$this->facturacionModelo->obSocios();  


            //print_r($_POST);
            $id_viejo=$_POST['id_viejo'];
            $tipo_viejo=$_POST['tipo_viejo'];


            if($_SERVER['REQUEST_METHOD'] =='POST'){
      
                if($_POST['tipoSelect']=="otros"){
                    $gastosOtros = [
                    'fecha' => trim($_POST['fecha']),
                    'tipo' => trim($_POST['tipoSelect']),
                    'importe'=> trim($_POST['importe']),
                    'concepto'=>trim($_POST['concepto']),
                    'id_usuario'=>($_POST['browser']),
                    'id_entidad'=>($_POST['browser3']),
                    ];

                    if($tipo_viejo=="otros"){
                        $this->facturacionModelo->borrarGastosOtros($id_viejo);
                    }elseif($tipo_viejo=="personal"){
                        $this->facturacionModelo->borrarGastosPersonal($id_viejo);
                    }

                    $this->facturacionModelo->agregarGastosOtros($gastosOtros);

                }elseif($_POST['tipoSelect']=="personal"){

                    $gastosPersonal = [
                    'fecha' => trim($_POST['fecha']),
                    'tipo' => trim($_POST['tipoSelect']),
                    'importe'=> trim($_POST['importe']),
                    'concepto'=>trim($_POST['concepto']),
                    'id_usuario'=>($_POST['browser2']),
                    ];

                    if($tipo_viejo=="otros"){
                        $this->facturacionModelo->borrarGastosOtros($id_viejo);
                    }elseif($tipo_viejo=="personal"){
                        $this->facturacionModelo->borrarGastosPersonal($id_viejo);
                    }

                    $this->facturacionModelo->agregarGastosPersonal($gastosPersonal);
                }

                redireccionar('/adminFacturacion/gastos');  

            }else{
            
                $this->datos['gastos'] = (object)[
                    'id_grupo'=>'',
                    'id_usuario'=>'',
                    'nombre'=>'',
                    'tipo'=>'',
                    'precio'=>'',
                    'descuento'=>'',
                    'fecha_ini'=>'',
                    'fecha_fin'=>'',
                ];  
                $this->datos["nuevo"]="FACTURACION";
                $this->vista('administradores/crudFacturacion/gastos',$this->datos);
            }


        }





    public function cuotas($page = 1) {
        $this->limit = 4;
        $this->page = is_numeric($page) && $page > 0 ? $page : 1;
        $this->links = 7;

        $this->datos['cuotas'] = $this->facturacionModelo->getCuotasUsuario($this->limit, $this->page);
        $this->datos['paginator'] = $this->facturacionModelo->getPaginator();

        $this->vista('administradores/cuotas/index',$this->datos);
    }

    public function exportData(){
        $this->datos['cuotas'] = $this->facturacionModelo->getAllCuotasUsuario();
        $this->vista('administradores/cuotas/exportData',$this->datos);
    }
}