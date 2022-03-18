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

            if(isset($_POST['tipo'])){
                $tipo=$_POST['tipo'];
                $this->datos['tipoIngreso'] = $tipo;
                
                //$tipoIngreso=$this->facturacionModelo->obtenerIngresosTipo($tipo);
                //var_dump($tipoIngreso);
            }
           
            $this->vista('administradores/crudFacturacion/ingresos', $this->datos);

            
          
         


            // if(isset($_POST['tipo'])){
            //     $tipo=$_POST['tipo'];
                
            //     if($tipo=="cuotas"){
            //         $cuotas = [];
            //         $cuotas = $this->facturacionModelo->obtenerCuotas();
            //         $this->datos['cuotas']=$cuotas;
            //         //var_dump($this->datos['cuotas']);
            //         $this->vista('administradores/crudFacturacion/ingresos', $this->datos);
            //     }else{
            //         echo "actividades";
            //     }
            // }
         
          
  
        
        
     
        

    }

    // public function gastos(){
    //     $this->datos['gastosPersonal'] = $this->facturacionModelo->obtenerGastosPersonal();
    //     $this->datos['gastosOtros'] = $this->facturacionModelo->obtenerGastosOtros();
    //     $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    // }

  

    public function cuotas($page = 1) {
        $this->limit = 4;
        $this->page = is_numeric($page) && $page > 0 ? $page : 1;
        $this->links = 7;

        $this->datos['cuotas'] = $this->facturacionModelo->getCuotasUsuario($this->limit, $this->page);
        $this->datos['paginator'] = $this->facturacionModelo->getPaginator();

        $this->vista('administradores/cuotas/index',$this->datos);
    }

    public function exportData(){
        $this->vista('administradores/cuotas/exportData',$this->datos);
    }
}