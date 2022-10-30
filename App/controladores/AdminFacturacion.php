<?php

class AdminFacturacion extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1];          // Definimos los roles que tendran acceso
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->facturacionModelo = $this->modelo('Facturacion');
        $this->entidadModelo = $this->modelo('Entidad');
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
    

       
    //*********** INDEX *********************/
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

        $this->datos['ingresos'] = $this->facturacionModelo->obtenerIngresos();

        $this->datos['eventos']=$this->facturacionModelo->obtenerEventos();
        $this->datos['socios']=$this->facturacionModelo->obtenerUsuarios();
        $this->datos['entidades']=$this->facturacionModelo->obtenerEntidades();
        $this->datos['participantes']=$this->facturacionModelo->obtenerParticipantes();
        $this->datos['parti_even']=$this->facturacionModelo->parti_even();
           
        $this->vista('administradores/crudFacturacion/ingresos', $this->datos);

    }


    public function nuevo_ingreso(){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if($_SERVER['REQUEST_METHOD'] =='POST'){

            $nuevo = [
                'fecha' => trim($_POST['fecha']),
                'importe'=> trim($_POST['importe']),
                'tipo' => trim($_POST['tipo']),
                'usuario'=>trim($_POST['socio']),
                'entidad'=>trim($_POST['entidad']),
                'evento'=>trim($_POST['evento']),
                'participante'=>trim($_POST['participante']),
                'observaciones'=>trim($_POST['observaciones'])
            ];
     
            if($this->facturacionModelo->nuevo_ingreso($nuevo)){
                redireccionar('/adminFacturacion/ingresos');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            
            $this->datos['ingreso'] = (object)[
                'fecha'=>'',
                'importe'=>'',
                'tipo'=>'',
                'usuario'=>'',
                'entidad'=>'',
                'evento'=>'',
                'participante'=>'',
                'observaciones'=>''
            ];

            $this->vista('administradores/crudFacturacion/ingresos',$this->datos);
        }
        
    }



    public function borrar_ingreso($id){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->facturacionModelo->borrar_ingreso($id)) {
                redireccionar('/adminFacturacion/ingresos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->vista('administradores/crudFacturacion/ingresos', $this->datos);
        }


    }


    public function editar_ingreso($id){

            $this->datos['rolesPermitidos'] = [1];          
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }


        if($_SERVER['REQUEST_METHOD'] =='POST'){
           

                $editar = [
                    'fecha' => trim($_POST['fecha']),
                    'importe'=> trim($_POST['importe']),
                    'tipo' => trim($_POST['tipo']),
                    'usuario'=>trim($_POST['socio']),
                    'entidad'=>trim($_POST['entidad']),
                    'participante'=>trim($_POST['participante']),
                    'concepto'=>trim($_POST['concepto'])
                ];

                if($this->facturacionModelo->editar_ingreso($editar,$id)){
                    redireccionar('/adminFacturacion/ingresos');
                }else{
                    die('Añgo ha fallado!!');
                }   

            }else{
            
                $this->vista('administradores/crudFacturacion/ingresos',$this->datos);
            }
        }

 

//**********************************************************************/
//********************* FUNCIONES GASTOS ******************************/
//********************************************************************/


    public function gastos(){
        $notific = $this->notificaciones();
        $this->datos['notificaciones'] = $notific;

        $this->datos['gastos']=$this->facturacionModelo->obtener_gastos();
        $this->datos['entidades']=$this->entidadModelo->obtener_entidades();
        $this->datos['usuarios']=$this->adminModelo->obtenerUsuarios();

        $this->vista('administradores/crudFacturacion/gastos', $this->datos);
    }



    public function borrar_gasto($id){
        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->facturacionModelo->borrar_gasto($id)) {
                redireccionar('/adminFacturacion/gastos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->vista('administradores/crudFacturacion/gastos', $this->datos);
        }
    }



    public function nuevo_gasto(){
            $this->datos['rolesPermitidos'] = [1];         
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }


        $letra = substr($_POST['imputar'],0,1);

        if($_SERVER['REQUEST_METHOD'] =='POST'){

            if($_POST['imputar']==""){
                $entidad=null;
                $usuario=null;
            }else{
                if ($letra=='u'){
                    $usuario=substr($_POST['imputar'],1);
                    $entidad=null;
                }else{
                    $entidad=substr($_POST['imputar'],1);
                    $usuario=null;
                }
            }

            $nuevo = [
                'fecha' => trim($_POST['fecha']),
                'importe'=> trim($_POST['importe']),
                'tipo' => trim($_POST['tipo']),
                'usuario'=>$usuario,
                'entidad'=>$entidad,
                'observaciones'=>trim($_POST['observaciones'])
            ];
     
            if($this->facturacionModelo->nuevo_gasto($nuevo)){
                redireccionar('/adminFacturacion/gastos');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{
            
            $this->datos['gasto'] = (object)[
                'fecha'=>'',
                'importe'=>'',
                'tipo'=>'',
                'usuario'=>'',
                'entidad'=>'',
                'observaciones'=>''
            ];

            $this->vista('administradores/crudFacturacion/gastos',$this->datos);
        }
    }



    public function editar_gasto($id){
            $this->datos['rolesPermitidos'] = [1];          
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            $letra = substr($_POST['imputar'],0,1);

            if($_SERVER['REQUEST_METHOD'] =='POST'){
    
                if($_POST['imputar']==""){
                    $entidad=null;
                    $usuario=null;
                }else{
                    if ($letra=='u'){
                        $usuario=substr($_POST['imputar'],1);
                        $entidad=null;
                    }else{
                        $entidad=substr($_POST['imputar'],1);
                        $usuario=null;
                    }
                }
    
                    $editar = [
                        'fecha' => trim($_POST['fecha']),
                        'importe'=> trim($_POST['importe']),
                        'tipo' => trim($_POST['tipo']),
                        'usuario'=>$usuario,
                        'entidad'=>$entidad,
                        'observaciones'=>trim($_POST['observaciones'])
                    ];
               
                    if($this->facturacionModelo->editar_gasto($editar,$id)){
                        redireccionar('/adminFacturacion/gastos');
                    }else{
                        die('Añgo ha fallado!!');
                    }
    
            }else{

                $this->vista('administradores/crudFacturacion/gastos',$this->datos);
            }

        }





      public function cuotas($page = 1) {
         $this->limit = 4;
         $this->page = is_numeric($page) && $page > 0 ? $page : 1;
          $this->links = 7;

         $this->datos['cuotas'] = $this->facturacionModelo->getCuotasUsuario($this->limit, $this->page);
         // $this->datos['paginator'] = $this->facturacionModelo->getPaginator();

          $this->vista('administradores/cuotas/index',$this->datos);     }

    //  public function exportData(){
    //      $this->datos['cuotas'] = $this->facturacionModelo->getAllCuotasUsuario();
    //      $this->vista('administradores/cuotas/exportData',$this->datos);
    //  }



}