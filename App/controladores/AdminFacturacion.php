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
        $ingresos = $this->facturacionModelo->obtenerIngresosCuotas();
        $i=$this->facturacionModelo->obtenerIngresosOtros();
        foreach($i as $info){
          $ingresos[]=$info; 
        }
        
        $this->datos['ingresos']=$ingresos;
        $this->vista('administradores/crudFacturacion/ingresos', $this->datos);

    }

    public function gastos(){
        $this->datos['gastosPersonal'] = $this->facturacionModelo->obtenerGastosPersonal();
        $this->datos['gastosOtros'] = $this->facturacionModelo->obtenerGastosOtros();
        $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    }

  

}