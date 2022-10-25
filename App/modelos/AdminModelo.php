<?php

class AdminModelo{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }


   //**************************** NOTIFICACIONES ***************************************/

    public function notSocio(){
        $this->db->query("SELECT * FROM `SOLICITUD_SOCIO`");
        return $this->db->rowCount();
    }

    public function notGrupo(){
        $this->db->query("SELECT * FROM `SOCIO_GRUPO` WHERE activo=0 and acepatado=0 ");
        return $this->db->rowCount();
    }

    public function notEventos(){
        $this->db->query("SELECT * FROM SOLICITUD_EVENTO");
        return $this->db->rowCount();
    }

    public function contar_pedidos(){
        $this->db->query("SELECT * FROM `SOLI_EQUIPACION` WHERE recogido=0");
        return $this->db->rowCount();
    }

    

//**************************** EDITAR DATOS DEL ADMIN ***************************************/

public function obtenerDatosId($id){
    $this->db->query("SELECT * FROM USUARIO WHERE id_usuario=:id");
    $this->db->bind(':id', $id);
    return $this->db->registros();
}



public function editar_datos($nuevo,$id,$datosUser){


    $this->db->query("UPDATE USUARIO SET dni=:dni, nombre=:nombre, apellidos=:apellidos, email=:email, direccion=:direccion, 
    fecha_nacimiento=:fecha_naci, telefono=:telefono, CCC=:ccc, passw=:passw, talla=:talla, foto=:foto where id_usuario=:id;");

     $this->db->bind(':nombre', $nuevo['nombre']);
     $this->db->bind(':apellidos', $nuevo['apellidos']);
     $this->db->bind(':dni', $nuevo['dni']);
     $this->db->bind(':fecha_naci', $nuevo['fecha_naci']);
     $this->db->bind(':telefono', $nuevo['telefono']);
     $this->db->bind(':email',$nuevo['email']);
     $this->db->bind(':direccion', $nuevo['direccion']);
     $this->db->bind(':ccc', $nuevo['ccc']);
     $this->db->bind(':talla', $nuevo['talla']);

    if ($nuevo['password']==$datosUser[0]->passw) {
        $this->db->bind(':passw', $datosUser[0]->passw);
    }else {
        $this->db->bind(':passw',MD5($nuevo['password']));
    }

     $this->db->bind(':foto', $nuevo['foto']);
     $this->db->bind(':id', $id);
     

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}



//**************************** CRUD DE USUARIOS (ver, borrar, nuevo, editar) ***************************************/

public function obtenerUsuarios(){
    $this->db->query("SELECT * FROM USUARIO order by id_rol");
    return $this->db->registros();
}


public function obtenerRoles(){
        $this->db->query("SELECT * FROM ROL");
        return $this->db->registros();
}


public function borrar_usuario($id){
        $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
}


public function nuevo_usuario($nuevo){

    $pass=$nuevo['nombre'].'-'.$nuevo['telefono'];

    $this->db->query("INSERT INTO USUARIO (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla, ha_sido, activado, id_rol, nom_pa, ape_pa, dni_pa) 
                    VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_naci, :telefono, :ccc, MD5(:pass), :talla, :pri_socio, 1, :rol, :nom_pa, :ape_pa, :dni_pa);");

        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':apellidos', $nuevo['apellidos']);
        $this->db->bind(':dni', $nuevo['dni']);
        $this->db->bind(':fecha_naci', $nuevo['fecha_naci']);
        $this->db->bind(':telefono', $nuevo['telefono']);
        $this->db->bind(':email',$nuevo['email']);
        $this->db->bind(':direccion', $nuevo['direccion']);
        $this->db->bind(':ccc', $nuevo['ccc']);
        $this->db->bind(':talla', $nuevo['talla']);
        $this->db->bind(':rol', $nuevo['id_rol']);
        $this->db->bind(':pri_socio', $nuevo['pri_socio']);
        $this->db->bind(':nom_pa', $nuevo['nom_pa']);
        $this->db->bind(':ape_pa', $nuevo['ape_pa']);
        $this->db->bind(':dni_pa', $nuevo['dni_pa']);

        $this->db->bind(':pass', $pass);
        $this->db->execute();

        $id_usu = $this->db->ultimoIndice();  


        $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($id_usu, NULL);");
        $this->db->execute();


        $rol_usu=$nuevo['id_rol'];
        if($rol_usu=='2'){
            $this->db->query("INSERT INTO `ENTRENADOR` (`id_usuario`, `sueldo`) VALUES ($id_usu, NULL);");
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else{
            return true;
        }      
 }



 public function editar_usuario($nuevo,$id){

    $this->db->query("UPDATE USUARIO SET dni=:dni, nombre=:nombre, apellidos=:apellidos, email=:email, direccion=:direccion, 
    fecha_nacimiento=:fecha_naci, telefono=:telefono, CCC=:ccc, talla=:talla, ha_sido=:pri_socio, id_rol=:rol , nom_pa=:nom_pa, ape_pa=:ape_pa, dni_pa=:dni_pa where id_usuario=:id;");

     $this->db->bind(':nombre', $nuevo['nombre']);
     $this->db->bind(':apellidos', $nuevo['apellidos']);
     $this->db->bind(':dni', $nuevo['dni']);
     $this->db->bind(':fecha_naci', $nuevo['fecha_naci']);
     $this->db->bind(':telefono', $nuevo['telefono']);
     $this->db->bind(':email',$nuevo['email']);
     $this->db->bind(':direccion', $nuevo['direccion']);
     $this->db->bind(':ccc', $nuevo['ccc']);
     $this->db->bind(':talla', $nuevo['talla']);
     $this->db->bind(':rol', $nuevo['id_rol']);
     $this->db->bind(':pri_socio', $nuevo['pri_socio']);
     $this->db->bind(':nom_pa', $nuevo['nom_pa']);
     $this->db->bind(':ape_pa', $nuevo['ape_pa']);
     $this->db->bind(':dni_pa', $nuevo['dni_pa']);

     $this->db->bind(':id', $id);
     
     $this->db->execute();


    $rol_usu=$nuevo['id_rol'];

     if($rol_usu=='2'){

        $this->db->query("SELECT count(id_usuario) as total from entrenador where id_usuario=$id;");
        $total= $this->db->registros();

       if($total[0]->total==0){
            $this->db->query("INSERT INTO `ENTRENADOR` (`id_usuario`, `sueldo`) VALUES ($id, NULL);");
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
       }else{
            $this->db->query("UPDATE ENTRENADOR SET id_usuario=$id  where id_usuario=$id;");
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }       
       }
    }else{
        return true;
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
