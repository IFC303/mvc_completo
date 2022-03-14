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


    public function nuevo_ingreso(){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        $this->datos['usuarios']=$this->facturacionModelo->obtenerUsuarios();
        $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();
        $this->datos['externos']=$this->facturacionModelo->obtenerExternos();

        
        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $ingresoNuevo = [
                'id_evento' => trim($_POST['id_evento']),
                'id_usuario'=> trim($_POST['id_usuario']),
                'nombre' => trim($_POST['nombre']),
                'tipo'=>trim($_POST['tipo']),
                'precio'=>trim($_POST['precio']),
                'descuento'=>trim($_POST['descuento']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
            ];

            if($this->eventoModelo->agregarEvento($eventoNuevo)){
                redireccionar('/adminEventos');
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

    // public function gastos(){
    //     $this->datos['gastosPersonal'] = $this->facturacionModelo->obtenerGastosPersonal();
    //     $this->datos['gastosOtros'] = $this->facturacionModelo->obtenerGastosOtros();
    //     $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    // }

  

}