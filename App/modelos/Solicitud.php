<?php

class Solicitud{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }



    //************************************** SOLICITUDES SOCIOS *****************************************************************/


    public function solicitudes_socio(){
        $this->db->query("SELECT * FROM SOLICITUD_SOCIO");
        return $this->db->registros();
    }


    public function borrar_socio($id){
        $this->db->query("DELETE FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = :id_soli");
        $this->db->bind(':id_soli', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


    public function editar_socio($editar,$id){
        $this->db->query("UPDATE SOLICITUD_SOCIO set DNI=:dni, nombre=:nombre, apellidos=:apellidos, CCC=:ccc, talla=:talla, fecha_nacimiento=:fecha_naci,
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

         $this->db->query("INSERT INTO USUARIO (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla, ha_sido,activado, id_rol,nom_pa, ape_pa, dni_pa) 
                          VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_nacimiento, :telefono, :CCC, MD5(:pass), :talla, :ha_sido,1,3,:nom_pa,:ape_pa,:dni_pa)");
        
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

        $this->db->query("DELETE FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = :id;");
        $this->db->bind(':id', $aceptarSocio['id']);
        $this->db->execute();

        $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES (:id_usu, NULL);");
        $this->db->bind(':id_usu', $id_usu);      
         if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
    }


    public function editar_evento($editar,$id){
        $this->db->query("UPDATE SOLICITUD_EVENTO set id_evento=:evento, fecha=:fecha, nombre=:nombre, apellidos=:apellidos, DNI=:dni, 
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


//************************************** SOLICITUDES EVENTOS *****************************************************************/


public function solicitudes_eventos(){
    $this->db->query("SELECT id_solicitud, SOLICITUD_EVENTO.id_evento, EVENTO.nombre as nombre_evento, fecha, SOLICITUD_EVENTO.nombre, apellidos, DNI, fecha_nacimiento, direccion, email, telefono
    FROM SOLICITUD_EVENTO, EVENTO where EVENTO.id_evento=SOLICITUD_EVENTO.id_evento order by id_solicitud");
    return $this->db->registros();
}


public function borrar_evento($id){
    $this->db->query("DELETE FROM SOLICITUD_EVENTO WHERE id_solicitud=:id");
    $this->db->bind(':id', $id);
    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}


public function aceptar_evento($aceptar){

        $this->db->query("INSERT INTO PARTICIPANTE (id_evento,nombre, apellidos, DNI, fecha_nacimiento, email, telefono) 
        VALUES (:evento, :nombre, :apellidos,:dni, :fecha_naci,:telefono, :email);");

        $this->db->bind(':evento', $aceptar['evento']);
        $this->db->bind(':nombre', $aceptar['nombre']);
        $this->db->bind(':apellidos', $aceptar['apellidos']);
        $this->db->bind(':dni', $aceptar['dni']);
        $this->db->bind(':fecha_naci', $aceptar['f_naci']);       
        $this->db->bind(':telefono', $aceptar['telefono']);
        $this->db->bind(':email', $aceptar['email']);

        $this->db->execute(); 

        $this->db->query("DELETE FROM SOLICITUD_EVENTO WHERE `id_solicitud` = :id;");
        $this->db->bind(':id', $aceptar['id']);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }

}




   


    // //SOLICITUD SELECCIONADAS GRUPOS
    // public function borrar_solicitudes_seleccionadas_grupos($datBorrar)
    // {
    //     foreach ($datBorrar as $idBorrar) {
    //         $idBorrar = explode('_', $idBorrar);

    //         $idUsu = $idBorrar[0];
    //         $idGrupo = $idBorrar[1];
    //         $fecha = $idBorrar[2];

    //         $this->db->query("DELETE FROM `SOCIO_GRUPO` WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
    //         $this->db->bind(':id_usu', $idUsu);
    //         $this->db->bind(':id_grup', $idGrupo);
    //         $this->db->bind(':id_fecha', $fecha);
    //         $this->db->execute();
    //     }

    //     return true;
    // }

    // public function aceptar_solicitudes_seleccionadas_grupos($datAceptar)
    // {
    //     foreach ($datAceptar as $idAceptar) {
    //         $idAceptar = explode('_', $idAceptar);

    //         $idUsu = $idAceptar[0];
    //         $idGrupo = $idAceptar[1];
    //         $fecha = $idAceptar[2];

    //         $this->db->query("UPDATE `SOCIO_GRUPO` SET `acepatado` = '1', `activo` = '0' WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
    //         $this->db->bind(':id_usu', $idUsu);
    //         $this->db->bind(':id_grup', $idGrupo);
    //         $this->db->bind(':id_fecha', $fecha);

    //         $this->db->execute();
    //     }

    //     return true;
    // }



    

  

    // //SOLICITUD GRUPOS
    // public function obtenerSolicitudesGrupos()
    // {
    //     $this->db->query("SELECT s.id_grupo, s.id_usuario, s.fecha_inscripcion, u.nombre as nombre_usuario, g.nombre as nombre_grupo FROM `SOCIO_GRUPO` s, `SOCIO` so, `USUARIO` u, `GRUPO` g WHERE s.id_grupo=g.id_grupo and s.id_usuario=so.id_socio and u.id_usuario=so.id_socio and s.acepatado= 0");
    //     return $this->db->registros();
    // }

    // public function borrar_solicitudes_grupos($datBorrar)
    // {
    //     $idUsu = $datBorrar[0];
    //     $idGrupo = $datBorrar[1];
    //     $fecha = $datBorrar[2];

    //     $this->db->query("DELETE FROM `SOCIO_GRUPO` WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
    //     $this->db->bind(':id_usu', $idUsu);
    //     $this->db->bind(':id_grup', $idGrupo);
    //     $this->db->bind(':id_fecha', $fecha);

    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

    // public function aceptar_solicitudes_grupos($datAceptar)
    // {
    //     $idUsu = $datAceptar[0];
    //     $idGrupo = $datAceptar[1];
    //     $fecha = $datAceptar[2];

    //     $this->db->query("UPDATE `SOCIO_GRUPO` SET `acepatado` = '1', `activo` = '0' WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
    //     $this->db->bind(':id_usu', $idUsu);
    //     $this->db->bind(':id_grup', $idGrupo);
    //     $this->db->bind(':id_fecha', $fecha);

    //     if ($this->db->execute()) {
    //         return true;
    //     } else {
    //         return false;
    //     }
    // }

  

}
