<?php

class AdminModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    //NOTIFICACIONES
    public function notSocio()
    {
        $this->db->query("SELECT * FROM `SOLICITUD_SOCIO`");
        return $this->db->rowCount();
    }

    public function notGrupo()
    {
        $this->db->query("SELECT * FROM `SOCIO_GRUPO` WHERE activo=0 and acepatado=0 ");
        return $this->db->rowCount();
    }

    public function notPedidos()
    {
        $this->db->query("SELECT * FROM `SOLI_EQUIPACION` WHERE recogido=0");
        return $this->db->rowCount();
    }

    public function notEventos()
    {
        $this->db->query("SELECT * FROM SOLICITUD_EVENTO");
        return $this->db->rowCount();
    }

    // public function notEventos()
    // {
    //     $this->db->query("SELECT * FROM `SOLICITUD_EXTER_EVENTO`");
    //     $notExter = $this->db->rowCount();
    //     $this->db->query("SELECT * FROM `SOLICITUD_SOCIO_EVENTO`");
    //     $notSoci = $this->db->rowCount();
    //     $not = $notExter + $notSoci;
    //     return $not;
    // }

    //CRUDS USUARIOS
    // public function obtenerUsuarios($rol)
    // {
    //     if ($rol == 2) {
    //         $this->db->query("SELECT * FROM USUARIO u, ENTRENADOR e WHERE id_rol = $rol and u.id_usuario=e.id_usuario");
    //         return $this->db->registros();
    //     } else {
    //         $this->db->query("SELECT * FROM USUARIO WHERE id_rol = $rol");
    //         return $this->db->registros();
    //     }
    // }




// ********************************* ADMINISTRADORES **************************//

public function obtenerAdmin(){
    $this->db->query("SELECT * FROM USUARIO WHERE id_rol = 1");
    return $this->db->registros();
}



 public function nuevoAdmin($nuevo_admin){
  
        $pass=$nuevo_admin['nombre'].'-'.$nuevo_admin['telefono'];
 
        $this->db->query("INSERT INTO USUARIO (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla, activado, id_rol) 
                          VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_naci, :telefono, :ccc, MD5(:pass), :talla, 1, 1);");

         $this->db->bind(':nombre', $nuevo_admin['nombre']);
         $this->db->bind(':apellidos', $nuevo_admin['apellidos']);
         $this->db->bind(':dni', $nuevo_admin['dni']);
         $this->db->bind(':fecha_naci', $nuevo_admin['fecha_naci']);
         $this->db->bind(':telefono', $nuevo_admin['telefono']);
         $this->db->bind(':email',$nuevo_admin['email']);
         $this->db->bind(':direccion', $nuevo_admin['direccion']);
         $this->db->bind(':ccc', $nuevo_admin['ccc']);
         $this->db->bind(':talla', $nuevo_admin['talla']);

         $this->db->bind(':pass', $pass);
         $this->db->execute();

        $idSoci = $this->db->ultimoIndice();
        $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($idSoci, NULL);");

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
 }

 public function borrarAdmin($id){

     $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id_usu");
     $this->db->bind(':id_usu', $id);

     if ($this->db->execute()) {
         return true;
     } else {
         return false;
     }
 }


 public function editarAdmin($id,$editar_admin){
  
        $this->db->query("UPDATE USUARIO SET dni=:dni, nombre=:nombre, apellidos=:apellidos, email=:email, direccion=:direccion, fecha_nacimiento=:fecha_naci, 
                        telefono=:telefono, CCC=:ccc, talla=:talla WHERE id_usuario=:id");

        $this->db->bind(':nombre', $editar_admin['nombre']);
        $this->db->bind(':apellidos', $editar_admin['apellidos']);
        $this->db->bind(':dni', $editar_admin['dni']);
        $this->db->bind(':fecha_naci', $editar_admin['fecha_naci']);
        $this->db->bind(':telefono', $editar_admin['telefono']);
        $this->db->bind(':email',$editar_admin['email']);
        $this->db->bind(':direccion', $editar_admin['direccion']);
        $this->db->bind(':ccc', $editar_admin['ccc']);
        $this->db->bind(':talla', $editar_admin['talla']);
        $this->db->bind(':id', $id);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
}


// ********************************* ENTRENADORES **************************//

public function obtenerEnt(){
    $this->db->query("SELECT * FROM USUARIO WHERE id_rol = 2");
    return $this->db->registros();
}


public function nuevoEnt($nuevo_ent){
  
    $pass=$nuevo_ent['nombre'].'-'.$nuevo_ent['telefono'];

    $this->db->query("INSERT INTO USUARIO (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla, activado, id_rol) 
                      VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_naci, :telefono, :ccc, MD5(:pass), :talla, 1, 2);");

     $this->db->bind(':nombre', $nuevo_ent['nombre']);
     $this->db->bind(':apellidos', $nuevo_ent['apellidos']);
     $this->db->bind(':dni', $nuevo_ent['dni']);
     $this->db->bind(':fecha_naci', $nuevo_ent['fecha_naci']);
     $this->db->bind(':telefono', $nuevo_ent['telefono']);
     $this->db->bind(':email',$nuevo_ent['email']);
     $this->db->bind(':direccion', $nuevo_ent['direccion']);
     $this->db->bind(':ccc', $nuevo_ent['ccc']);
     $this->db->bind(':talla', $nuevo_ent['talla']);

     $this->db->bind(':pass', $pass);
     $this->db->execute();

    $idSoci = $this->db->ultimoIndice();

    $this->db->query("INSERT INTO ENTRENADOR (`id_usuario`, `sueldo`) VALUES ($idSoci, NULL);");
    $this->db->execute();

    $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($idSoci, NULL);");

    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

public function borrarEnt($id){

 $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id_usu");
 $this->db->bind(':id_usu', $id);

 if ($this->db->execute()) {
     return true;
 } else {
     return false;
 }
}


public function editarEnt($id,$editar_ent){

    $this->db->query("UPDATE USUARIO SET dni=:dni, nombre=:nombre, apellidos=:apellidos, email=:email, direccion=:direccion, fecha_nacimiento=:fecha_naci, 
                    telefono=:telefono, CCC=:ccc, talla=:talla WHERE id_usuario=:id");

    $this->db->bind(':nombre', $editar_ent['nombre']);
    $this->db->bind(':apellidos', $editar_ent['apellidos']);
    $this->db->bind(':dni', $editar_ent['dni']);
    $this->db->bind(':fecha_naci', $editar_ent['fecha_naci']);
    $this->db->bind(':telefono', $editar_ent['telefono']);
    $this->db->bind(':email',$editar_ent['email']);
    $this->db->bind(':direccion', $editar_ent['direccion']);
    $this->db->bind(':ccc', $editar_ent['ccc']);
    $this->db->bind(':talla', $editar_ent['talla']);
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}


// ********************************* SOCIOS **************************//

public function obtenerSocios(){
    $this->db->query("SELECT * FROM USUARIO WHERE id_rol = 3");
    return $this->db->registros();
}

public function nuevoSocio($nuevo_soc){
  
    $pass=$nuevo_soc['nombre'].'-'.$nuevo_soc['telefono'];

    $this->db->query("INSERT INTO USUARIO (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla,ha_sido, activado, id_rol,nom_pa,ape_pa,dni_pa) 
                      VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_naci, :telefono, :ccc, MD5(:pass), :talla, :priSocio, 1, 3, :nomPa, :apePa, :dniPa);");

     $this->db->bind(':nombre', $nuevo_soc['nombre']);
     $this->db->bind(':apellidos', $nuevo_soc['apellidos']);
     $this->db->bind(':dni', $nuevo_soc['dni']);
     $this->db->bind(':fecha_naci', $nuevo_soc['fecha_naci']);
     $this->db->bind(':telefono', $nuevo_soc['telefono']);
     $this->db->bind(':email',$nuevo_soc['email']);
     $this->db->bind(':direccion', $nuevo_soc['direccion']);
     $this->db->bind(':ccc', $nuevo_soc['ccc']);
     $this->db->bind(':talla', $nuevo_soc['talla']);
     $this->db->bind(':priSocio', $nuevo_soc['priSocio']);
     $this->db->bind(':nomPa', $nuevo_soc['nomPa']);
     $this->db->bind(':apePa', $nuevo_soc['apePa']);
     $this->db->bind(':dniPa', $nuevo_soc['dniPa']);

     $this->db->bind(':pass', $pass);
     $this->db->execute();

    $idSoci = $this->db->ultimoIndice();

    $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($idSoci, NULL);");

    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}

    public function borrarSocio($id){
        $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id_usu");
        $this->db->bind(':id_usu', $id);  
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }


   public function editarSocio($id,$editar_soc){

    $this->db->query("UPDATE USUARIO SET dni=:dni, nombre=:nombre, apellidos=:apellidos, email=:email, direccion=:direccion, fecha_nacimiento=:fecha_naci, 
                    telefono=:telefono, CCC=:ccc, talla=:talla, ha_sido=:priSocio, nom_pa=:nomPa, ape_pa=:apePa, dni_pa=:dniPa WHERE id_usuario=:id");

    $this->db->bind(':nombre', $editar_soc['nombre']);
    $this->db->bind(':apellidos', $editar_soc['apellidos']);
    $this->db->bind(':dni', $editar_soc['dni']);
    $this->db->bind(':fecha_naci', $editar_soc['fecha_naci']);
    $this->db->bind(':telefono', $editar_soc['telefono']);
    $this->db->bind(':email',$editar_soc['email']);
    $this->db->bind(':direccion', $editar_soc['direccion']);
    $this->db->bind(':ccc', $editar_soc['ccc']);
    $this->db->bind(':talla', $editar_soc['talla']);
    $this->db->bind(':priSocio', $editar_soc['priSocio']);
    $this->db->bind(':nomPa', $editar_soc['nomPa']);
    $this->db->bind(':apePa', $editar_soc['apePa']);
    $this->db->bind(':dniPa', $editar_soc['dniPa']);
    $this->db->bind(':id', $id);

    if ($this->db->execute()) {
        return true;
    } else {
        return false;
    }
}


  //********************************************************************************************************************************************** */

    //SOLICITUD SELECCIONADAS SOCIOS
    public function borrar_solicitudes_seleccionadas_socios($datBorrar)
    {
        foreach ($datBorrar as $idBorrar) {
            $this->db->query("DELETE FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = :id_soli");
            $this->db->bind(':id_soli', $idBorrar);
            $this->db->execute();
        }
        return true;
    }

    public function aceptar_solicitudes_seleccionadas_socios($datAceptar)
    {
        // INSERT INTO `SOLICITUD_SOCIO` (`id_solicitud_soc`, `DNI`, `nombre`, `apellidos`, `CCC`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `es_socio`) VALUES ('1', '1', 'socio1', 'socio1', '67568', 'l', '2022-03-09', 'socio1@gmail.com', '79789070', 'jnmbmngh', '0');
        // INSERT INTO `SOLICITUD_SOCIO` (`id_solicitud_soc`, `DNI`, `nombre`, `apellidos`, `CCC`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `es_socio`) VALUES ('2', '2', 'socio2', 'socio2', '568', '2', '2022-01-09', 'socio2@gmail.com', '89070', 'bmngh', '0');
        // INSERT INTO `SOLICITUD_SOCIO` (`id_solicitud_soc`, `DNI`, `nombre`, `apellidos`, `CCC`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `es_socio`) VALUES ('3', '3', 'socio3', 'socio3', '68', '3', '2022-05-09', 'socio3@gmail.com', '9070', 'mngh', '0');

        foreach ($datAceptar as $idAceptar) {

            $this->db->query("SELECT * FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = :id_soli");
            $this->db->bind(':id_soli', $idAceptar);
            $datos = $this->db->registro();

            $idSoli = $datos->id_solicitud_soc;
            $dni = $datos->DNI;
            $nombre = $datos->nombre;
            $apellidos = $datos->apellidos;
            $CCC = $datos->CCC;
            $talla = $datos->talla;
            $fecha_nacimiento = $datos->fecha_nacimiento;
            $email = $datos->email;
            $telefono = $datos->telefono;
            $direccion = $datos->direccion;
            $es_socio = $datos->es_socio;

            $this->db->query("INSERT INTO `USUARIO` (`dni`, `nombre`, `apellidos`, `email`, `direccion`, `fecha_nacimiento`, `telefono`, `CCC`, `passw`, `talla`, `activado`, `id_rol`) VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_nacimiento, :telefono, :CCC, MD5(:dni), :talla, '1', '3');");
            $this->db->bind(':dni', $dni);
            $this->db->bind(':nombre', $nombre);
            $this->db->bind(':apellidos', $apellidos);
            $this->db->bind(':CCC', $CCC);
            $this->db->bind(':talla', $talla);
            $this->db->bind(':fecha_nacimiento', $fecha_nacimiento);
            $this->db->bind(':email', $email);
            $this->db->bind(':telefono', $telefono);
            $this->db->bind(':direccion', $direccion);
            $this->db->bind(':es_socio', $es_socio);
            $this->db->execute();

            $this->db->query("SELECT id_usuario FROM `USUARIO` WHERE `dni`= :dniId and `nombre`= :nombreId and `apellidos`= :apellidosId and `email`= :emailId");
            $this->db->bind(':dniId', $dni);
            $this->db->bind(':nombreId', $nombre);
            $this->db->bind(':apellidosId', $apellidos);
            $this->db->bind(':emailId', $email);
            $idUsu = $this->db->registros();
            $idUsu = $idUsu[0]->id_usuario;

            $this->db->query("DELETE FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = $idSoli;");
            $this->db->execute();

            $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($idUsu, NULL);");
            $this->db->execute();
        }
        return true;
    }

    //SOLICITUD SELECCIONADAS GRUPOS
    public function borrar_solicitudes_seleccionadas_grupos($datBorrar)
    {
        foreach ($datBorrar as $idBorrar) {
            $idBorrar = explode('_', $idBorrar);

            $idUsu = $idBorrar[0];
            $idGrupo = $idBorrar[1];
            $fecha = $idBorrar[2];

            $this->db->query("DELETE FROM `SOCIO_GRUPO` WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
            $this->db->bind(':id_usu', $idUsu);
            $this->db->bind(':id_grup', $idGrupo);
            $this->db->bind(':id_fecha', $fecha);
            $this->db->execute();
        }

        return true;
    }

    public function aceptar_solicitudes_seleccionadas_grupos($datAceptar)
    {
        foreach ($datAceptar as $idAceptar) {
            $idAceptar = explode('_', $idAceptar);

            $idUsu = $idAceptar[0];
            $idGrupo = $idAceptar[1];
            $fecha = $idAceptar[2];

            $this->db->query("UPDATE `SOCIO_GRUPO` SET `acepatado` = '1', `activo` = '0' WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
            $this->db->bind(':id_usu', $idUsu);
            $this->db->bind(':id_grup', $idGrupo);
            $this->db->bind(':id_fecha', $fecha);

            $this->db->execute();
        }

        return true;
    }



    //SOLICITUD SOCIOS
    public function obtenerSolicitudesSocios()
    {
        $this->db->query("SELECT * FROM SOLICITUD_SOCIO");
        return $this->db->registros();
    }

    public function borrar_solicitudes_socios($datBorrar)
    {
        $this->db->query("DELETE FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = :id_soli");
        $this->db->bind(':id_soli', $datBorrar);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function aceptar_solicitudes_socios($aceptarSocio)
    {
        //var_dump($aceptarSocio);
      
        $pass=$aceptarSocio['nombre'].$aceptarSocio['id'];
        //echo $pass;
        //exit;
         //MD5(:idSoli)

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


        $this->db->query("DELETE FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = :id;");
        $this->db->bind(':id', $aceptarSocio['id']);
        //$this->db->execute();


        //  $this->db->query("SELECT id_usuario FROM `USUARIO` WHERE `dni`= :dniId");
        //  $this->db->bind(':dniId', $dni);     
        //  $idUsu = $this->db->registros();        
        //  $idUsu = $idUsu[0]->id_usuario;

        //inserta en la tabla EQUIPACION
        //  $this->db->query("INSERT INTO SOLI_EQUIPACION (id_usuario,id_equipacion,fecha_peticion,talla,recogido,cantidad) 
        //                   VALUES (:id_usuario,1,CURDATE(),:talla,0,1)");
        //  $this->db->bind(':talla', $talla);
        //  $this->db->bind(':id_usuario',$idUsu);
        //  $this->db->execute();
      

        //  $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($idUsu, NULL);");

         if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
    }

    //SOLICITUD GRUPOS
    public function obtenerSolicitudesGrupos()
    {
        $this->db->query("SELECT s.id_grupo, s.id_usuario, s.fecha_inscripcion, u.nombre as nombre_usuario, g.nombre as nombre_grupo FROM `SOCIO_GRUPO` s, `SOCIO` so, `USUARIO` u, `GRUPO` g WHERE s.id_grupo=g.id_grupo and s.id_usuario=so.id_socio and u.id_usuario=so.id_socio and s.acepatado= 0");
        return $this->db->registros();
    }

    public function borrar_solicitudes_grupos($datBorrar)
    {
        $idUsu = $datBorrar[0];
        $idGrupo = $datBorrar[1];
        $fecha = $datBorrar[2];

        $this->db->query("DELETE FROM `SOCIO_GRUPO` WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_grup', $idGrupo);
        $this->db->bind(':id_fecha', $fecha);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function aceptar_solicitudes_grupos($datAceptar)
    {
        $idUsu = $datAceptar[0];
        $idGrupo = $datAceptar[1];
        $fecha = $datAceptar[2];

        $this->db->query("UPDATE `SOCIO_GRUPO` SET `acepatado` = '1', `activo` = '0' WHERE `id_grupo` = :id_grup AND `id_usuario` = :id_usu AND `fecha_inscripcion` = :id_fecha;");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_grup', $idGrupo);
        $this->db->bind(':id_fecha', $fecha);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

  

}
