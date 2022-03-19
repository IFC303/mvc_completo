<?php

class AdminFacturacion extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->facturacionModelo = $this->modelo('Facturacion');
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
         $this->vista('administradores/crudFacturacion',$this->datos);
     }


    public function ingresos(){
        $notific = $this->notificaciones();
        $notific[3] ="INGRESOS";
        $this->datos['notificaciones'] = $notific;

            $ingresos = [];
            $ingresos = $this->facturacionModelo->obtenerIngresos();
            $this->datos['ingresos']=$ingresos;

            $this->datos['ingresosOtros']=$this->facturacionModelo->obtenerIngresosOtros();
            //var_dump($this->datos['ingresosOtros']);
            $this->datos['ingresosCuotas']=$this->facturacionModelo->obtenerIngresosCuotas();
            //todos ingresos participantes
            $this->datos['todosIngresosParticipantes']=$this->facturacionModelo->todosIngresosParticipantes();
            //var_dump($this->datos['todosIngresosParticipantes']);

            $this->datos['participantes']=$this->facturacionModelo->obtenerParticipante();
            $this->datos['ingresosActividadesSocios']=$this->facturacionModelo->ingresosActividadesSocios();
            $this->datos['ingresosActividadesExternos']=$this->facturacionModelo->ingresosActividadesExternos();

            //   if(isset($_POST['tipo'])){
            //       $tipo=$_POST['tipo'];
            //       $this->datos['tipoIngreso'] = $tipo;
            //   }
           
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
            print_r($_POST);

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

            if($_POST['tipoSelect']=="otros"){
                    $ingresOtros = [
                    'fecha' => trim($_POST['fecha']),
                    'tipo' => trim($_POST['tipoSelect']),
                    'importe'=> trim($_POST['importe']),
                    'concepto'=>trim($_POST['concepto']),
                    'id_entidad'=>($_POST['browser3']),
                    ];
                    if($this->facturacionModelo->editarIngresoOtros($ingresOtros,$id)){
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
                    if($this->facturacionModelo->editarIngresoCuotas($ingresCuotas,$id)){
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
                    'id_evento'=>($_POST['browser4']),
                    ];

                    //var_dump($ingresActividadesExterno);
                     if($this->facturacionModelo->editarIngresoActividadesExterno($ingresActividadesExterno,$id)){
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
                        'id_evento'=>($_POST['browser4']),
                        ];
                        //var_dump($ingresActividadesSocio);
                        // echo $id;
    
                            if($this->facturacionModelo->editarIngresoActividadesSocio($ingresActividadesSocio,$id)){
                                redireccionar('/adminFacturacion/ingresos');
                            }else{
                              die('Añgo ha fallado!!');
                            }
                }
             
            }

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












//**************************************************************************************** */
//********************* FUNCIONES GASTOS ******************************/


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

        // $this->datos['usuarios']=$this->facturacionModelo->obtenerUsuarios();
        // $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();
        // $this->datos['externos']=$this->facturacionModelo->obtenerExternos();

        
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $ingreso = [
                'fecha' => trim($_POST['fecha']),
                'tipo' => trim($_POST['tipoSelect']),
                'importe'=> trim($_POST['importe']),
                'usuario'=>trim($_POST['browser']),
                'concepto'=>trim($_POST['concepto']),
                'evento'=>trim($_POST['evento']),
        
            ];
        
            //var_dump($ingreso);

              if($this->facturacionModelo->agregarIngreso($ingreso)){
                  redireccionar('/adminFacturacion');
              }else{
                 die('Añgo ha fallado!!');
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




//******************************************************* */

 


   

    // public function gastos(){
        // $notific = $this->notificaciones();
        //$notific[3] ="GASTOS";
        // $this->datos['notificaciones'] = $notific;

    //     $this->datos['gastosPersonal'] = $this->facturacionModelo->obtenerGastosPersonal();
    //     $this->datos['gastosOtros'] = $this->facturacionModelo->obtenerGastosOtros();
    //     $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    // }

  

}