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


    // public function index(){
    //     $this->datos['evento'] = $this->eventoModelo->obtenerEventos();
    //     $this->vista('administradores/crudEventos/inicio',$this->datos);
    // }


    public function ingresos(){
        $this->datos['ingresosCuotas'] = $this->facturacionModelo->obtenerIngresosCuotas();
        $this->datos['ingresosOtros'] = $this->facturacionModelo->obtenerIngresosOtros();
        $this->vista('administradores/crudFacturacion/ingresos', $this->datos);

    }

    public function gastos(){
        $this->datos['gastosPersonal'] = $this->facturacionModelo->obtenerGastosPersonal();
        $this->datos['gastosOtros'] = $this->facturacionModelo->obtenerGastosOtros();
        $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    }

  

}