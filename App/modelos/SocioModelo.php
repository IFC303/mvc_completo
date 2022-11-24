<?php

class SocioModelo{
    
    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    public function obtener_datos($id_usuario){
        $this->db->query("SELECT * FROM v2usuario WHERE v2usuario.id_usuario = :id_usuario");
        $this->db->bind(':id_usuario', $id_usuario);
        return $this->db->registros();
    }

    public function obtener_tallas(){
        $this->db->query("SELECT * from v2talla");
        return $this->db->registros();
    }

    public function obtener_licencias($id_usuario){
        $this->db->query("SELECT * FROM v2licencia where v2licencia .id_usuario=:id_usuario");
        $this->db->bind(':id_usuario', $id_usuario);
        return $this->db->registros();
    }

    public function ver_licen_id($id_usuario,$id_licencia){
        $this->db->query("SELECT * FROM v2licencia where v2licencia.id_usuario=:id_usuario and v2licencia.id_licencia=:id_licencia");
        $this->db->bind(':id_usuario', $id_usuario);
        $this->db->bind(':id_licencia', $id_licencia);
        return $this->db->registros();
    }



    //********** INSCRIPCIONES *******************/

    public function obtener_grupos(){
        $this->db->query("SELECT * FROM v2grupo");
        return $this->db->registros();
    }

    public function obtener_categorias(){
        $this->db->query("SELECT * FROM v2categoria");
        return $this->db->registros();
    }

    public function obtener_eventos(){
        $this->db->query("SELECT * FROM v2evento");
        return $this->db->registros();
    }
        
    public function obtener_soli_grupo_id($id_usuario){
        $this->db->query("SELECT * FROM v2soli_grupo where usuario=:id");
        $this->db->bind(':id', $id_usuario);
        return $this->db->registros();
    }

    public function obtener_marcas_grupo($id_usuario){
        $this->db->query("SELECT * from v2prueba_socio
            left join v2prueba on v2prueba_socio.id_prueba=v2prueba.id_prueba
            left join v2test on v2test.id_test=v2prueba_socio.id_test
            where id_socio=:id_socio order by fecha desc");
        $this->db->bind(':id_socio', $id_usuario);
        return $this->db->registros();
    }
        



    



    public function inscripcion($ins,$datos_usu){

        if($ins['tipo']=="evento"){
            $this->db->query("INSERT INTO v2soli_evento (id_evento, fecha, nombre, apellidos, dni, fecha_nacimiento, direccion, email, telefono, foto, estado) 
            VALUES (:id_evento, CURDATE(),:nombre, :apellidos,:dni,:fecha_naci, :direccion, :email, :telefono, :pago, 0);");
            $this->db->bind(':id_evento', $ins["evento"]);
            $this->db->bind(':nombre', $datos_usu[0]->nombre);
            $this->db->bind(':apellidos', $datos_usu[0]->apellidos);  
            $this->db->bind(':dni', $datos_usu[0]->dni);  
            $this->db->bind(':fecha_naci', $datos_usu[0]->fecha_nacimiento);  
            $this->db->bind(':direccion', $datos_usu[0]->direccion);
            $this->db->bind(':email', $datos_usu[0]->email);
            $this->db->bind(':telefono', $datos_usu[0]->telefono);  
            $this->db->bind(':pago', $ins['pago']);  
            $this->db->execute();

            $id = $this->db->ultimoIndice();

            //COPIO LA FOTO EN EL DIRECTORIO Y CAMBIO NOMBRE EN LA BBDD  
            //$directorio = "/var/www/html/tragamillas/public/img/fotos_equipacion/";
            $directorio="C:/xampp/htdocs/tragamillas/public/img/eventos/";  
            copy($_FILES['pago']['tmp_name'], $directorio.$id.'.jpg');
            chmod($directorio.$id.'.jpg',0777);
   
           $foto=$id.'.jpg';
           $this->db->query("UPDATE v2soli_evento SET foto=:pago where id_solicitud=:id_soli;");
           $this->db->bind(':pago', $foto);
           $this->db->bind(':id_soli', $id);
           if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
 

        }else{

            $this->db->query("INSERT INTO v2soli_grupo (fecha_soli, dni, nombre, apellidos, cuenta, fecha_nacimiento, email, telefono, direccion,gir,id_categoria,id_grupo,
            es_socio, usuario, nom_pa, ape_pa, dni_pa, pago, foto, estado) 
            VALUES (CURDATE(), :dni, :nombre, :apellidos, :cuenta, :fecha_naci, :email, :telefono, :direccion, :gir, :categoria, :grupo,
            1, :usuario, :nom_pa, :ape_pa, :dni_pa, :pago, :foto, 0);");

            $this->db->bind(':dni', $datos_usu[0]->dni);  
            $this->db->bind(':nombre', $datos_usu[0]->nombre);
            $this->db->bind(':apellidos', $datos_usu[0]->apellidos);  
            $this->db->bind(':cuenta', $datos_usu[0]->cuenta); 
            $this->db->bind(':fecha_naci', $datos_usu[0]->fecha_nacimiento);  
            $this->db->bind(':email', $datos_usu[0]->email);
            $this->db->bind(':telefono', $datos_usu[0]->telefono);        
            $this->db->bind(':direccion', $datos_usu[0]->direccion);
            $this->db->bind(':gir', $datos_usu[0]->gir);
            $this->db->bind(':categoria', $ins["cat"]);
            $this->db->bind(':grupo', $ins["grupo"]);
            $this->db->bind(':usuario', $ins['id_usu']);  
            $this->db->bind(':nom_pa', $datos_usu[0]->nom_pa);  
            $this->db->bind(':ape_pa', $datos_usu[0]->ape_pa);  
            $this->db->bind(':dni_pa', $datos_usu[0]->dni_pa);
            $this->db->bind(':pago', $ins['pago']);  
            $this->db->bind(':foto', $datos_usu[0]->foto);
            $this->db->execute();

            $id = $this->db->ultimoIndice();

            //COPIO LA FOTO EN EL DIRECTORIO Y CAMBIO NOMBRE EN LA BBDD  
            //$directorio = "/var/www/html/tragamillas/public/img/fotos_equipacion/";
            $directorio="C:/xampp/htdocs/tragamillas/public/img/eventos/";  
            copy($_FILES['pago']['tmp_name'], $directorio.$id.'.jpg');
            chmod($directorio.$id.'.jpg',0777);
   
           $foto=$id.'.jpg';
           $this->db->query("UPDATE v2soli_grupo SET pago=:pago where id_soli_grupo=:id_soli;");
           $this->db->bind(':pago', $foto);
           $this->db->bind(':id_soli', $id);
           if ($this->db->execute()){
                return true;
            }else{
                return false;
            }
 
        }
            return true;
    }



    /****************************** EQUIPACIONES *****************************/

    public function obtener_pedidos($id){
        $this->db->query("SELECT * FROM v2soli_equipacion, v2equipacion, v2talla 
        where v2soli_equipacion.id_equipacion=v2equipacion.id_equipacion and v2soli_equipacion.id_usuario=:id_usuario and v2talla.id_talla=v2soli_equipacion.talla;");
        $this->db->bind(':id_usuario', $id);
        return $this->db->registros();
    }

    public function borrar_pedido($id,$id_usu){
        $this->db->query("DELETE FROM v2soli_equipacion WHERE id_soli_equi=:id and id_usuario=:id_usu");
        $this->db->bind(':id',$id);
        $this->db->bind(':id_usu',$id_usu);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


     /****************************** MARCAS SEGUIMIENTO *****************************/

     public function obtener_marcas_seguimiento(){
        $this->db->query("SELECT * FROM v2seguimiento order by fecha");
        return $this->db->registros();
    }


    public function borrar_marca($id){
        $this->db->query("DELETE FROM v2seguimiento WHERE id_seguimiento=:id");
        $this->db->bind(':id',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function nueva_marca($nueva){

        $this->db->query("INSERT INTO v2seguimiento (id_usuario, fecha, kilometros, metros, tiempo, velocidad, ritmo, observaciones) 
        values (:id_usuario, :fecha, :kilometros, :metros, :tiempo, :velocidad, :ritmo, :observaciones);");

        $this->db->bind(':id_usuario', $nueva['id_usuario']);  
        $this->db->bind(':fecha', $nueva['fecha']);
        $this->db->bind(':kilometros', $nueva['km']);  
        $this->db->bind(':metros', $nueva['metros']);
        $this->db->bind(':tiempo', $nueva['tiempo']);

            //paso del tiempo a horas
            $tiempo=explode(':',$nueva['tiempo']);

            $horas=$tiempo[0];

            $minutos=$tiempo[1];
            $min=$minutos/60;

            $segundos=$tiempo[2];
            $sg=explode('.',$segundos);
            $sg=$sg[0]/3600;

            $tiempo_horas=$horas+$min+$sg;
      
            //paso de espacio a kilometros
            $metros=$nueva['metros']/1000;
            $espacio_km=$metros+$nueva['km'];

            $velocidad=$espacio_km/$tiempo_horas;
            $this->db->bind(':velocidad', $velocidad);

            //CALCULO DE RITMO
            $horas=$tiempo[0];
            $hrs_r=$horas*60;

            $minutos_r=$tiempo[1];

            $segundos_r=$tiempo[2];
            $sg_r=explode('.',$segundos_r);
            $sg_r=$sg_r[0]/60;

            $tiempo_minutos=$hrs_r+$minutos_r+$sg_r;

            $ritmo=$tiempo_minutos/$espacio_km;
            $this->db->bind(':ritmo', $ritmo);


            $this->db->bind(':observaciones', $nueva['observaciones']);

        if ($this->db->execute()){
            return $this->db->ultimoIndice();
        }else{
            return false;
        }
    }


    public function obtener_marcas_usuario($id_usuario){
        $this->db->query("SELECT * FROM v2prueba, v2prueba_socio, v2test, v2test_prueba
        where v2prueba_socio.id_socio=:id_usuario 
        AND v2prueba.id_prueba = v2prueba_socio.id_prueba 
        AND v2prueba.id_prueba = v2test_prueba.id_prueba
        AND v2test_prueba.id_test = v2test.id_test 
        ORDER BY v2prueba.id_prueba");

        $this->db->bind(':id_usuario', $id_usuario);
        return $this->db->registros();
    }

  


   



}