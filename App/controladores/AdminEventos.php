<?php

class AdminEventos extends Controlador{


    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [1]; 
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }

        $this->temporadaModelo = $this->modelo('Temporada');
        $this->eventoModelo = $this->modelo('Evento');
        $this->adminModelo = $this->modelo('AdminModelo');
    }

    
 //*********** NOTIFICACIONES EN EL MENU LATERAL *********************/
 public function notificaciones(){
    $this->datos['temp_actual']=$this->temporadaModelo->obtener_actual();
    $notific[0] = $this->adminModelo->notSocio();
    $notific[1] = $this->adminModelo->notGrupo();
    $notific[2] = $this->adminModelo->notEventos();
    $notific[3] = $this->adminModelo->contar_pedidos($this->datos['temp_actual']);
    return $notific;
}


//*********** INDEX *********************/
public function index(){
    $this->datos['temp_actual']=$this->temporadaModelo->obtener_actual();
    $this->datos['notificaciones'] = $this->notificaciones();
   
    $this->datos['evento'] = $this->eventoModelo->obtener_eventos($this->datos['temp_actual']);
    $this->vista('administradores/crudEventos/inicio',$this->datos);
}


//*********************************** NUEVO ****************************************/
    public function nuevo(){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if($_SERVER['REQUEST_METHOD'] =='POST'){
            $nuevo = [
                'nombre' => trim($_POST['nombre']),
                'tipo'=>trim($_POST['tipo']),
                'fecha_ini' => trim($_POST['fecha_ini']),
                'fecha_fin'=> trim($_POST['fecha_fin']),
                'precio'=>trim($_POST['precio']),
                'descripcion'=>trim($_POST['descripcion']), 
                'fecha_ini_inscrip' => trim($_POST['fecha_ini_inscrip']),
                'fecha_fin_inscrip'=> trim($_POST['fecha_fin_inscrip'])
            ];

            if($this->eventoModelo->nuevo($nuevo)){
                redireccionar('/adminEventos');
            }else{
                die('Añgo ha fallado!!');
            }

        }else{

            $this->datos['evento'] = (object)[
                'nombre'=>'',
                'tipo'=>'',
                'fecha_ini'=>'',
                'fecha_fin'=>'',
                'precio'=>'',
                'descripcion'=>'',
                'fecha_ini_inscrip'=>'',
                'fecha_fin_inscrip'=>''
            ];
       
            $this->vista('administradores/crudEventos/nuevo_evento',$this->datos);
        }
    }



//*********************************** EDITAR ****************************************/

    public function editar($id){

        $this->datos['rolesPermitidos'] = [1];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $editar= [
                    'nombre' => trim($_POST['nombre']),
                    'tipo'=> trim($_POST['tipo']),
                    'fecha_ini' => trim($_POST['fecha_ini']),
                    'fecha_fin' => trim($_POST['fecha_fin']), 
                    'precio' => trim($_POST['precio']),
                    'descripcion'=>trim($_POST['descripcion']),
                    'fecha_ini_inscrip' => trim($_POST['fecha_ini_inscrip']),
                    'fecha_fin_inscrip' => trim($_POST['fecha_fin_inscrip'])
                ];
   
                 if ($this->eventoModelo->editar($editar,$id)) {
                     redireccionar('/adminEventos');
                 }else{
                     die('Algo ha fallado!!!');
                 }

        }else{
                $this->vista('administradores/crudEventos/inicio', $this->datos);
        }
    }



//*********************************** BORRAR ****************************************/
    public function borrar($id){

        $this->datos['rolesPermitidos'] = [1];         
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->eventoModelo->borrar($id)) {
                redireccionar('/adminEventos');
            }else{
                die('Algo ha fallado!!!');
            }
        }else{
            $this->datos['evento'] = $this->eventoModelo->obtenerEventoId($id);
            $this->vista('administradores/crudEventos/inicio', $this->datos);
        }
    }




//*********************************** FUNCIONES PARTICIPANTES ****************************************/


        public function participantes($id_evento){
            $notific = $this->notificaciones();
            $this->datos['notificaciones'] = $notific;
            
            $this->datos['id_evento'] = $id_evento;
            $this->datos['datos_evento'] = $this->eventoModelo->obtenerEventoId($id_evento);

            $this->datos['participantesEventos'] = $this->eventoModelo->obtenerParticipantesEventos($id_evento);
            $this->vista('administradores/crudEventos/participantes', $this->datos);
        }



        public function nuevo_participante(){
            $this->datos['rolesPermitidos'] = [1];          
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if ($_FILES['subirFoto']['name']!=''){
                    $foto=$_FILES['subirFoto']['name'];
                }else{
                    $foto="";
                }

                $id=trim($_POST['id_evento']);

                $nuevo = [
                    'id_evento' => trim($_POST['id_evento']),
                    'nombre' => trim($_POST['nombre']),
                    'apellidos'=> trim($_POST['apellidos']),
                    'fecha_naci' => trim($_POST['fecha_naci']),
                    'dni'=> trim($_POST['dni']),
                    'direccion' => trim($_POST['direccion']),
                    'telefono'=> trim($_POST['telefono']),
                    'email' => trim($_POST['email']),
                    'foto'=>$foto
                ];

                if ($this->eventoModelo->nuevo_participante($nuevo)) {
                    redireccionar('/adminEventos/participantes/'.$id);
                }else{
                    die('Algo ha fallado!!!');
                }
             }else{
                $this->datos['participante'] = (object)[
                    'id_evento'=>'',
                    'nombre'=>'',
                    'apellidos'=>'',
                    'fecha_naci'=>'',
                    'dni'=>'',
                    'direccion'=>'',
                    'telefono'=>'',
                    'email'=>'',
                    'foto'=>''
                ];
                 $this->vista('administradores/crudEventos/participantes'.$id, $this->datos);
            }       
        }




        public function borrar_participante($id){
            $this->datos['rolesPermitidos'] = [1];         
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }
       
            $id_evento=trim($_POST['id_evento']);
    
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if ($this->eventoModelo->borrar_participante($id)) {
                    //$directorio="/var/www/html/tragamillas/public/img/fotosPerfil/";
                    $directorio="C:/xampp/htdocs/tragamillas/public/img/eventos/"; 
                    unlink($directorio.$id.'.jpg');

                    $id_evento=$_POST['id_evento'];
                    redireccionar('/adminEventos/participantes/'.$id_evento);
                }else{
                    die('Algo ha fallado!!!');
                }
            }else{
                $this->datos['evento'] = $this->eventoModelo->obtenerEventoId($id);
                $this->vista('administradores/crudEventos/participantes/'.$id_evento, $this->datos);
            }
        }




        public function editar_participante($id){
            $this->datos['rolesPermitidos'] = [1];          
            if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
                redireccionar('/usuarios');
            }

            $id_evento=(trim($_POST['id_evento']));


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                if (($_FILES['editar_foto']['name'])==''){
                    $foto=$_POST['foto_anterior'];
                }else{
                    $foto=$_FILES['editar_foto']['name'];
                    $foto=$id.'.jpg';
                }

                $nuevo = [
                    'nombre' => trim($_POST['nombre']),
                    'apellidos'=> trim($_POST['apellidos']),
                    'fecha_naci' => trim($_POST['fecha_naci']),
                    'dni'=> trim($_POST['dni']),
                    'direccion' => trim($_POST['direccion']),
                    'telefono'=> trim($_POST['telefono']),
                    'email' => trim($_POST['email']),
                    'foto'=>$foto
                ];

                if ($this->eventoModelo->editar_participante($nuevo,$id)) {
                    //$directorio="/var/www/html/tragamillas/public/img/licencias/";
                    $directorio="C:/xampp/htdocs/tragamillas/public/img/eventos/";       
                    copy($_FILES['editar_foto']['tmp_name'], $directorio.$foto);
                    chmod($directorio.$foto.'.jpg',0777);

                    redireccionar('/adminEventos/participantes/'.$id_evento);
                }else{
                    die('Algo ha fallado!!!');
                }
             }else{
                 $this->vista('administradores/crudEventos/participantes/'.$id_evento, $this->datos);
            }
                
        }




}





