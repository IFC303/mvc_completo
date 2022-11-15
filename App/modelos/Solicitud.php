<?php

class Solicitud{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    public function obtener_tallas(){
        $this->db->query("SELECT * FROM v2talla ");
        return $this->db->registros();
    }

  
    public function obtener_categoria(){
        $this->db->query("SELECT * FROM v2categoria ");
        return $this->db->registros();
    }

    public function obtener_grupos(){
        $this->db->query("SELECT * FROM v2grupo ");
        return $this->db->registros();
    }

    public function obtener_usuarios(){
        $this->db->query("SELECT * FROM v2usuario ");
        return $this->db->registros();
    }


    //************************************** SOLICITUDES SOCIOS *****************************************************************/



    public function solicitudes_socio(){
        $this->db->query("SELECT * FROM v2soli_socio ");
        return $this->db->registros();
    }


    public function borrar_socio($id){
        $this->db->query("DELETE FROM v2soli_socio WHERE `id_solicitud_soc` = :id_soli");
        $this->db->bind(':id_soli', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function editar_socio($editar,$id){
        $this->db->query("UPDATE v2soli_socio set DNI=:dni, nombre=:nombre, apellidos=:apellidos, CCC=:ccc, talla=:talla, fecha_nacimiento=:fecha_naci,
        email=:email, telefono=:telefono , direccion=:direccion, ha_sido=:ha_sido, nom_pa=:nom_pa, ape_pa=:ape_pa, dni_pa=:dni_pa WHERE `id_solicitud_soc` = :id_soli");

        $this->db->bind(':id_soli', $id);
        $this->db->bind(':nombre', $editar['nombre']);
        $this->db->bind(':apellidos', $editar['apellidos']);
        $this->db->bind(':dni', $editar['dni']);
        $this->db->bind(':fecha_naci', $editar['fecha']);
        $this->db->bind(':telefono', $editar['telefono']);
        $this->db->bind(':email', $editar['email']);
        $this->db->bind(':direccion', $editar['direccion']);
        $this->db->bind(':ccc', $editar['cuenta']);
        $this->db->bind(':talla', $editar['talla']);
        $this->db->bind(':ha_sido', $editar['socio']);
        $this->db->bind(':nom_pa', $editar['nom_pa']);
        $this->db->bind(':ape_pa', $editar['ape_pa']);
        $this->db->bind(':dni_pa', $editar['dni_pa']);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }



    public function aceptar_socio($aceptarSocio){

        $pass=$aceptarSocio['nombre'].$aceptarSocio['id'];

         $this->db->query("INSERT INTO v2usuario (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla, ha_sido,activado, id_rol,nom_pa, ape_pa, dni_pa, fecha_acep) 
                          VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_nacimiento, :telefono, :CCC, MD5(:pass), :talla, :ha_sido,1,3,:nom_pa,:ape_pa,:dni_pa, CURDATE())");
        
        $this->db->bind(':nombre', $aceptarSocio['nombre']);
        $this->db->bind(':apellidos', $aceptarSocio['apellidos']);
        $this->db->bind(':dni', $aceptarSocio['dni']);
        $this->db->bind(':fecha_nacimiento', $aceptarSocio['fecha']);
        $this->db->bind(':telefono', $aceptarSocio['telefono']);
        $this->db->bind(':email', $aceptarSocio['email']);
        $this->db->bind(':direccion', $aceptarSocio['direccion']);
        $this->db->bind(':CCC', $aceptarSocio['cuenta']);
        $this->db->bind(':talla', $aceptarSocio['talla']);
        $this->db->bind(':ha_sido', $aceptarSocio['socio']);
        $this->db->bind(':nom_pa', $aceptarSocio['nom_pa']);
        $this->db->bind(':ape_pa', $aceptarSocio['ape_pa']);
        $this->db->bind(':dni_pa', $aceptarSocio['dni_pa']);
        $this->db->bind(':pass', $pass);
        $this->db->execute();
        $id_usu = $this->db->ultimoIndice();

        $this->db->query("DELETE FROM v2soli_socio` WHERE `id_solicitud_soc` = :id;");
        $this->db->bind(':id', $aceptarSocio['id']);
        $this->db->execute();

        $this->db->query("INSERT INTO v2socio (`id_socio`, `familiar`) VALUES (:id_usu, NULL);");
        $this->db->bind(':id_usu', $id_usu);      
         if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
    }


   


//************************************** SOLICITUDES EVENTOS *****************************************************************/


public function solicitudes_eventos(){
    $this->db->query("SELECT id_solicitud, v2soli_evento.id_evento, v2evento.nombre as nombre_evento, foto , fecha, 
    v2soli_evento.nombre, apellidos, dni, fecha_nacimiento, direccion, email, telefono
    FROM v2soli_evento, v2evento where v2evento.id_evento = v2soli_evento.id_evento order by id_solicitud");
    return $this->db->registros();
}


public function borrar_evento($id){
    $this->db->query("DELETE FROM v2soli_evento WHERE id_solicitud=:id");
    $this->db->bind(':id', $id);
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}



public function editar_evento($editar,$id){
    $this->db->query("UPDATE v2soli_evento set id_evento=:evento, fecha=:fecha, nombre=:nombre, apellidos=:apellidos, DNI=:dni, 
     fecha_nacimiento=:f_naci,direccion=:direccion,email=:email, telefono=:telefono WHERE `id_solicitud` = :id_soli");

    $this->db->bind(':id_soli', $id);
    $this->db->bind(':nombre', $editar['nombre']);
    $this->db->bind(':apellidos', $editar['apellidos']);
    $this->db->bind(':dni', $editar['dni']);
    $this->db->bind(':fecha', $editar['fecha']);
    $this->db->bind(':f_naci', $editar['f_naci']);
    $this->db->bind(':telefono', $editar['telefono']);
    $this->db->bind(':email', $editar['email']);
    $this->db->bind(':direccion', $editar['direccion']);
    $this->db->bind(':evento', $editar['evento']);

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}

public function aceptar_evento($aceptar,$id){

        $this->db->query("INSERT INTO v2participante (id_evento, nombre, apellidos, DNI, fecha_nacimiento ,direccion, email, telefono, dorsal,marca,foto) 
        VALUES (:evento, :nombre, :apellidos, :dni, :fecha_naci, :direc, :email, :tel, null,null,null);");

        $this->db->bind(':evento', $aceptar['evento']);
        $this->db->bind(':nombre', $aceptar['nombre']);
        $this->db->bind(':apellidos', $aceptar['apellidos']);
        $this->db->bind(':dni', $aceptar['dni']);
        $this->db->bind(':fecha_naci', $aceptar['f_naci']);    
        $this->db->bind(':direc', $aceptar['direccion']);     
        $this->db->bind(':tel', $aceptar['telefono']);
        $this->db->bind(':email', $aceptar['email']);

        $this->db->execute(); 

        $this->db->query("DELETE FROM v2soli_evento WHERE `id_solicitud` = :id;");
        $this->db->bind(':id', $aceptar['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

}


 //************************************** SOLICITUDES ESCUELA *****************************************************************/
 
 public function obtener_soli_grupos(){
    $this->db->query("SELECT * FROM v2soli_grupo ");
    return $this->db->registros();
}


 public function borrar_escuela($id){
    $this->db->query("DELETE FROM v2soli_grupo WHERE id_soli_escuela=:id");
    $this->db->bind(':id', $id);
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function editar_escuela($editar,$id){

    $this->db->query("UPDATE v2soli_grupo set dni=:dni, nombre=:nombre, apellidos=:apellidos, cuenta=:cuenta, fecha_nacimiento=:fecha_naci, email=:email,
     telefono=:telefono, direccion=:direc, gir=:gir,id_categoria=:cat, id_grupo=:grup, es_socio=:es, usuario=:usus, nom_pa=:nom_pa, ape_pa=:ape_pa, dni_pa=:dni_pa 
     WHERE id_soli_escuela=:id");

    $this->db->bind(':id', $id);
    $this->db->bind(':dni', $editar['dni']);
    $this->db->bind(':nombre', $editar['nombre']);
    $this->db->bind(':apellidos', $editar['apellidos']);
    $this->db->bind(':cuenta', $editar['cuenta']);
    $this->db->bind(':fecha_naci', $editar['fecha_naci']);
    $this->db->bind(':email', $editar['email']);
    $this->db->bind(':telefono', $editar['telefono']);
    $this->db->bind(':direc', $editar['direccion']);
    $this->db->bind(':gir', $editar['gir']);
    $this->db->bind(':cat', $editar['cat']);
    $this->db->bind(':grup', $editar['grup']);
    $this->db->bind(':es', $editar['socio']);

    if($editar['usus']!=""){
        $this->db->bind(':usus', $editar['usus']);
    }else{
        $this->db->bind(':usus', null);  
    }
    
    $this->db->bind(':nom_pa', $editar['nom_pa']);
    $this->db->bind(':ape_pa', $editar['ape_pa']);
    $this->db->bind(':dni_pa', $editar['dni_pa']);

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }

}

public function aceptar_escuela($aceptar,$id){

    $this->db->query("INSERT INTO v2socio_grupo (id_grupo,id_usuario,fecha_acep, aceptado,activo,id_categoria) 
    VALUES (:grupo,:usuario,CURDATE(),1,1,:categoria);");

    $this->db->bind(':grupo', $aceptar['grup']);
    $this->db->bind(':usuario', $aceptar['usus']);
    $this->db->bind(':categoria', $aceptar['cat']);
 
    $this->db->execute(); 

    $this->db->query("DELETE FROM v2soli_grupo WHERE `id_soli_escuela` = :id;");
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }

}



}