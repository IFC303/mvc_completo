<?php

class AdminFacturacion extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->facturacionModelo = $this->modelo('Facturacion');
    }


      public function index(){
         $this->vista('administradores/crudFacturacion',$this->datos);
     }


    public function ingresos(){
            $ingresos = [];
            $ingresos = $this->facturacionModelo->obtenerIngresos();
            $this->datos['ingresos']=$ingresos;

            $this->datos['ingresosOtros']=$this->facturacionModelo->ingresosOtros();
            $this->datos['ingresosCuotas']=$this->facturacionModelo->ingresosCuotas();

            $this->datos['ingresosActividadesSocios']=$this->facturacionModelo->ingresosActividadesSocios();
            $this->datos['ingresosActividadesExternos']=$this->facturacionModelo->ingresosActividadesExternos();

              if(isset($_POST['tipo'])){
                  $tipo=$_POST['tipo'];
                  $this->datos['tipoIngreso'] = $tipo;
              }
           
              $this->vista('administradores/crudFacturacion/ingresos', $this->datos);

    }


    public function nuevoIngreso(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        $this->datos['usuarios']=$this->facturacionModelo->obtenerUsuarios();
        $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();
        $this->datos['externos']=$this->facturacionModelo->obtenerExternos();

        
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $ingreso = [
                'fecha' => trim($_POST['fecha']),
                'tipo' => trim($_POST['tipoSelect']),
                'importe'=> trim($_POST['importe']),
                'usuario'=>trim($_POST['browser']),
                'concepto'=>trim($_POST['concepto']),
                'evento'=>trim($_POST['evento']),
                'id_participante'=>($_POST['id_participante']),
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
            $this->vista('administradores/crudFacturacion/nuevo_ingreso',$this->datos);
        }
    }


//**************************************************************************************** */
//********************* FUNCIONES GASTOS ******************************/


    public function gastos(){
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
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        $this->datos['usuarios']=$this->facturacionModelo->obtenerUsuarios();
        $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();
        $this->datos['externos']=$this->facturacionModelo->obtenerExternos();

        
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
            $this->vista('administradores/crudFacturacion/nuevo_ingreso',$this->datos);
        }
    }




//******************************************************* */

    public function borrar($id){
            
        $tipo=$_POST['tipo'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            if($tipo=="actividades"){
                $this->facturacionModelo->borrarIngresoActividades($id);
                redireccionar('/adminFacturacion');
            }else if($tipo=="cuotas") {
                $this->facturacionModelo->borrarIngresoCuotas($id);
                redireccionar('/adminFacturacion');
            }else if ($tipo=="otros"){
                $this->facturacionModelo->borrarIngresoOtros($id);
                redireccionar('/adminFacturacion');
            }   
        }else{
            //$this->datos['ingresos'] = $this->eventoModelo->obtenerEventoId($id);
           //$this->vista('administradores/crudFacturacion/ingresos', $this->datos);
        // // }
     }
    }


   

    // public function gastos(){
    //     $this->datos['gastosPersonal'] = $this->facturacionModelo->obtenerGastosPersonal();
    //     $this->datos['gastosOtros'] = $this->facturacionModelo->obtenerGastosOtros();
    //     $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    // }

  

}