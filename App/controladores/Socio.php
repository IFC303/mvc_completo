<?php


require_once RUTA_APP.'/vistas/socios/jpgraph/src/jpgraph.php';
require_once RUTA_APP.'/vistas/socios/jpgraph/src/jpgraph_line.php';



class Socio extends Controlador{



    public function __construct(){
        Sesion::iniciarSesion($this->datos);
        $this->datos['rolesPermitidos'] = [3];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/');
        }
        $this->socioModelo = $this->modelo('SocioModelo');
        $this->equipacionModelo = $this->modelo('Equipacion');     
        $this->eventoModelo = $this->modelo('Evento');   
        $this->grupoModelo = $this->modelo('Grupo');   
    }





// *********** PAGINA PRINCIPAL SOCIO ***********  
    public function index(){
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
        $this->datos['usu_licencia'] = $this->socioModelo->obtener_licencias($id_usuario);
        $this->datos['tallas'] = $this->socioModelo->obtener_tallas();
        $this->datos['eventos'] = $this->socioModelo->obtener_eventos();
        $this->datos['grupos'] = $this->socioModelo->obtener_grupos();
        $this->datos['categorias'] = $this->socioModelo->obtener_categorias();
        $this->vista('socios/inicio', $this->datos);
    }



    //************* EVENTOS *****************/
    public function eventos(){ 
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
        $this->datos['usu_licencia'] = $this->socioModelo->obtener_licencias($id_usuario);
        $this->datos['eventos'] = $this->eventoModelo->obtener_eventos();
        $this->vista('socios/evento', $this->datos);
    }


    public function ins_evento($id_evento){
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
    
        $this->datos['rolesPermitidos'] = [3];          
        if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
            redireccionar('/usuarios');
        }
       
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           
            $ins = [
                'id_usu' =>$id_usuario,
                'tipo' =>'evento',
                'evento' => $id_evento
                // 'fotoCarnet' => $nomFoto,
            ];
          
            if ($this->socioModelo->inscripcion($ins, $this->datos['datos_user'])) {
                redireccionar('/socio/eventos');
            } else {
                die('Algo ha fallado!!!');
            }
        }
    }



    //************* VER FOTO LICENCIA *****************/
    public function ver_lice($id_licencia){
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
        $this->datos['usu_licen'] = $this->socioModelo->ver_licen_id($id_usuario,$id_licencia);
        $this->vista('socios/ver', $this->datos);
    }




    //************* ESCUELA ARREGLAR *****************/
    public function escuela(){
    
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);

        $this->datos['usu_licencia'] = $this->socioModelo->obtener_licencias($id_usuario);

        $this->datos['grupos'] = $this->grupoModelo->obtener_grupos();

        $this->vista('socios/escuela', $this->datos);
    }




 public function inscripciones(){

    $id_usuario=$this->datos['usuarioSesion']->id_usuario;
    $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);

    $this->datos['rolesPermitidos'] = [3];          
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }
   
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
       
        $ins = [
            'id_usu' =>$id_usuario,
            'tipo' => trim($_POST['tipo']),
            'evento' => trim($_POST['evento']),
            'categoria' => trim($_POST['cat']),
            'grupo' => trim($_POST['gru']),
            // 'fotoCarnet' => $nomFoto,
        ];
      
        if ($this->socioModelo->inscripcion($ins, $this->datos['datos_user'])) {
            redireccionar('/socio');
        } else {
            die('Algo ha fallado!!!');
        }
    }
 
}



// *********** VER MARCAS *******************/

    public function verMarcas(){

        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
        $this->datos['usu_licencia'] = $this->socioModelo->obtener_licencias($id_usuario);     
        $this->datos['usuarios']= $this->socioModelo->obtener_marcas_seguimiento($id_usuario);   

        $tam=count($this->datos['usuarios']);
        if($tam>=2){

            foreach ($this->datos['usuarios'] as $datos){
                $velocidad[]=$datos->velocidad;
                $distancia[]=$datos->kilometros;
            }

        // $ritmo = array(2.350,1.455,23,15,80,20,45,10,5,45,60);
        // $datay2 = array(12,9,12,80,41,15,30,8,48,36,14,25);
        // $datay3 = array(5,17,32,24,4,2,36,2,9,24,21,23);
        
        // Setup the graph
        $graph = new Graph(1000,350);
        $theme_class=new UniversalTheme;
        $graph->SetScale('textlin',0,20);
        

        $graph->SetTheme($theme_class);
        $graph->img->SetAntiAliasing(false);
        // $graph->title->Set('Evolucion');
        $graph->SetBox(false);
        
        $graph->yaxis->HideZeroLabel();
        $graph->yaxis->HideLine(false);
        $graph->yaxis->HideTicks(false,false);
        
        $graph->xgrid->Show();
        $graph->xgrid->SetLineStyle("solid");
        //$graph->xaxis->SetTickLabels(array('Ene','Feb','Mar','Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'));
        $graph->xgrid->SetColor('#E3E3E3');
        
            // Create the first line
        $p1 = new LinePlot($velocidad);
        $graph->Add($p1);
        $p1->SetColor("#B22222");
        $p1->SetLegend('Velocidad');
        
        // Create the second line
        $p2 = new LinePlot($distancia);
        $graph->Add($p2);
        $p2->SetColor("#6495ED");
        $p2->SetLegend('Kilometros');
        
        // // Create the third line
        // $p3 = new LinePlot($datay3);
        // $graph->Add($p3);
        // $p3->SetColor("#FF1493");
        // $p3->SetLegend('Tienda 3');
        
        $graph->legend->SetFrameWeight(1);
        
        $graph->legend->SetPos(0.5,0.98,'center','bottom');
        

        // Display the graph
        //$graph->Stroke();


        $graph->Stroke(_IMG_HANDLER);

        $fileName = "grafica.png";
        $graph->img->Stream($fileName);

        // Mandarlo al navegador
        // $graph->img->Headers();
        // $graph->img->Stream();

        }

        $this->vista('socios/verMarcas', $this->datos);
    }



public function nueva_marca(){
    $id_usuario=$this->datos['usuarioSesion']->id_usuario;

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nueva = [
            'id_usuario'=>$id_usuario,
            'fecha' => trim($_POST["fecha"]),
            'km' => trim($_POST["km"]),
            'metros' => trim($_POST["metros"]),
            'tiempo' => trim($_POST["tiempo"]),
            'observaciones' => trim($_POST['observaciones'])
        ];
            if ($this->socioModelo->nueva_marca($nueva) ){
                redireccionar('/socio/verMarcas');
            } else {
            die('Algo ha fallado!!!');
            }
    } else {
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
        $this->vista('socios/verMarcas', $this->datos);
    }
}


public function borrar_marca($id){
    $this->datos['rolesPermitidos'] = [3];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if ($this->socioModelo->borrar_marca($id)) {
            redireccionar('/socio/verMarcas');
        }else{
            die('Algo ha fallado!!!');
        }
    }else{
        $this->vista('socio/verMarcas', $this->datos);
    }
}




//************* EQUIPACION *****************/
public function equipacion(){
    
    $id_usuario=$this->datos['usuarioSesion']->id_usuario;
    $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
    $this->datos['usu_licencia'] = $this->socioModelo->obtener_licencias($id_usuario);
    $this->datos['equipacion'] = $this->equipacionModelo->obtener_equipaciones();
    $this->datos['talla'] = $this->equipacionModelo->obtener_tallas();
    $this->datos['equi'] = $this->socioModelo->obtener_pedidos($id_usuario);
    $this->vista('socios/equipacion', $this->datos);
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
                redireccionar('/socio/equipacion');
            } else {
            die('Algo ha fallado!!!');
            }
    } else {
        $id_usuario=$this->datos['usuarioSesion']->id_usuario;
        $this->datos['datos_user'] = $this->socioModelo->obtener_datos($id_usuario);
        $this->vista('socios/modificarDatos', $this->datos);
    }
}



public function borrar_pedido($id){
    $this->datos['rolesPermitidos'] = [3];         
    if (!tienePrivilegios($this->datos['usuarioSesion']->id_rol, $this->datos['rolesPermitidos'])) {
        redireccionar('/usuarios');
    }
    $id_usuario=$this->datos['usuarioSesion']->id_usuario;

    if ($this->socioModelo->borrar_pedido($id,$id_usuario)) {
        redireccionar('/socio/equipacion');
        }else{
            die('Algo ha fallado!!!');
        }
    $this->vista('socios/equipacion', $this->datos); 
}

    


}
