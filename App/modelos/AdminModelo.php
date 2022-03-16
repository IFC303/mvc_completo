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

    public function notEventos()
    {
        $this->db->query("SELECT * FROM `SOLICITUD_EXTER_EVENTO`");
        $notExter = $this->db->rowCount();
        $this->db->query("SELECT * FROM `SOLICITUD_SOCIO_EVENTO`");
        $notSoci = $this->db->rowCount();
        $not = $notExter + $notSoci;
        return $not;
    }

    //CRUDS USUARIOS
    public function obtenerUsuarios($rol)
    {
        if ($rol == 2) {
            $this->db->query("SELECT * FROM USUARIO u, ENTRENADOR e WHERE id_rol = $rol and u.id_usuario=e.id_usuario");
            return $this->db->registros();
        } else {
            $this->db->query("SELECT * FROM USUARIO WHERE id_rol = $rol");
            return $this->db->registros();
        }
    }

    public function borrarUsuario($idUsuario)
    {
        $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id_usu");
        $this->db->bind(':id_usu', $idUsuario);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function editarUsuario($usuEditar)
    {
        if ($usuEditar['SueldoEdit'] != "" && $usuEditar['SueldoEdit'] != NULL) {
            $this->db->query("UPDATE `ENTRENADOR` SET `sueldo` = :sueldoEdit WHERE `id_usuario` = :id_usuEdit;");
            $this->db->bind(':id_usuEdit', $usuEditar['idEdit']);
            $this->db->bind(':sueldoEdit', $usuEditar['SueldoEdit']);
            $this->db->execute();
        }

        $coma = 0;
        $dniMet = false;
        $nomMet = false;
        $apeMet = false;
        $fecMet = false;
        $emaMet = false;
        $telMet = false;
        $passMet = false;
        $cccMet = false;
        $tallMet = false;
        $fotMet = false;
        $actMet = false;
        $rolMet = false;
        $girMet = false;
        $cad = "UPDATE `USUARIO` SET ";

        if (($usuEditar['dniEdit'] != "") && ($usuEditar['dniEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `dni` = :dniUsu";
            } else {
                $cad = $cad . " `dni` = :dniUsu";
                $coma = 1;
            }
            $dniMet = true;
        }
        if (($usuEditar['nomEdit'] != "") && ($usuEditar['nomEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `nombre` = :nomUsu";
            } else {
                $cad = $cad . " `nombre` = :nomUsu";
                $coma = 1;
            }
            $nomMet = true;
        }
        if (($usuEditar['apelEdit'] != "") && ($usuEditar['apelEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `apellidos` = :apelUsu";
            } else {
                $cad = $cad . " `apellidos` = :apelUsu";
                $coma = 1;
            }
            $apeMet = true;
        }
        if (($usuEditar['fecEdit'] != "") && ($usuEditar['fecEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `fecha_nacimiento` = :fecUsu";
            } else {
                $cad = $cad . " `fecha_nacimiento` = :fecUsu";
                $coma = 1;
            }
            $fecMet = true;
        }
        if (($usuEditar['telEdit'] != "") && ($usuEditar['telEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `telefono` = :telUsu";
            } else {
                $cad = $cad . " `telefono` = :telUsu";
                $coma = 1;
            }
            $telMet = true;
        }
        if (($usuEditar['emaEdit'] != "") && ($usuEditar['emaEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `email` = :emaUsu";
            } else {
                $cad = $cad . " `email` = :emaUsu";
                $coma = 1;
            }
            $emaMet = true;
        }
        if (($usuEditar['direcEdit'] != "") && ($usuEditar['direcEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `direccion` = :direUsu";
            } else {
                $cad = $cad . " `direccion` = :direUsu";
                $coma = 1;
            }
            $emaMet = true;
        }
        if (($usuEditar['passEdit'] != "") && ($usuEditar['passEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `passw` = MD5(:passUsu)";
            } else {
                $cad = $cad . " `passw` = MD5(:passUsu)";
                $coma = 1;
            }
            $passMet = true;
        }
        if (($usuEditar['CCCEdit'] != "") && ($usuEditar['CCCEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `CCC` = :cccUsu";
            } else {
                $cad = $cad . " `CCC` = :cccUsu";
                $coma = 1;
            }
            $cccMet = true;
        }
        if (($usuEditar['TallaEdit'] != "") && ($usuEditar['TallaEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `talla` = :tallUsu";
            } else {
                $cad = $cad . " `talla` = :tallUsu";
                $coma = 1;
            }
            $tallMet = true;
        }
        if (($usuEditar['FotoEdit'] != "") && ($usuEditar['FotoEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `foto` = :fotUsu";
            } else {
                $cad = $cad . " `foto` = :fotUsu";
                $coma = 1;
            }
            $fotMet = true;
        }
        if (($usuEditar['ActEdit'] != "") && ($usuEditar['ActEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `activado` = :actUsu";
            } else {
                $cad = $cad . " `activado` = :actUsu";
                $coma = 1;
            }
            $actMet = true;
        }
        if (($usuEditar['RolEdit'] != "") && ($usuEditar['RolEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `id_rol` = :idRolUsu";
            } else {
                $cad = $cad . " `id_rol` = :idRolUsu";
                $coma = 1;
            }
            $rolMet = true;
        }

        if (($usuEditar['GirEdit'] != "") && ($usuEditar['GirEdit'] != null)) {
            if ($coma == 1) {
                $cad = $cad . ", `gir` = :girUsu";
            } else {
                $cad = $cad . " `gir` = :girUsu";
                $coma = 1;
            }
            $girMet = true;
        }

        $cad = $cad . " WHERE `id_usuario` = :idUsu;";

        $this->db->query("$cad");
        $this->db->bind(':idUsu', $usuEditar['idEdit']);
        if ($dniMet == true) {
            $this->db->bind(':dniUsu', $usuEditar['dniEdit']);
        }
        if ($nomMet == true) {
            $this->db->bind(':nomUsu', $usuEditar['nomEdit']);
        }
        if ($apeMet == true) {
            $this->db->bind(':apelUsu', $usuEditar['apelEdit']);
        }
        if ($fecMet == true) {
            $this->db->bind(':fecUsu', $usuEditar['fecEdit']);
        }
        if ($emaMet == true) {
            $this->db->bind(':emaUsu', $usuEditar['emaEdit']);
        }
        if ($emaMet == true) {
            $this->db->bind(':direUsu', $usuEditar['direcEdit']);
        }
        if ($telMet == true) {
            $this->db->bind(':telUsu', $usuEditar['telEdit']);
        }
        if ($passMet == true) {
            $this->db->bind(':passUsu', $usuEditar['passEdit']);
        }
        if ($cccMet == true) {
            $this->db->bind(':cccUsu', $usuEditar['CCCEdit']);
        }
        if ($tallMet == true) {
            $this->db->bind(':tallUsu', $usuEditar['TallaEdit']);
        }
        if ($fotMet == true) {
            $this->db->bind(':fotUsu', $usuEditar['FotoEdit']);
        }
        if ($actMet == true) {
            $this->db->bind(':actUsu', $usuEditar['ActEdit']);
        }
        if ($rolMet == true) {
            $this->db->bind(':idRolUsu', $usuEditar['RolEdit']);
        }
        if ($girMet == true) {
            $this->db->bind(':girUsu', $usuEditar['GirEdit']);
        }

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function anadirUsuario($usuAnadir)
    {
        $this->db->query("INSERT INTO USUARIO (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla, foto, activado, id_rol) 
        VALUES (:dniUsu, :nomUsu, :apelUsu, :emaUsu, :direcUsu, :fecUsu, :telUsu, :cccUsu, MD5(:passUsu), :tallUsu, :fotUsu, :actUsu, :idRolUsu);");

        $this->db->bind(':dniUsu', $usuAnadir['dniUsuAna']);
        $this->db->bind(':nomUsu', $usuAnadir['nomUsuAna']);
        $this->db->bind(':apelUsu', $usuAnadir['apelUsuAna']);
        $this->db->bind(':fecUsu', $usuAnadir['fecUsuAna']);
        $this->db->bind(':telUsu', $usuAnadir['telUsuAna']);
        $this->db->bind(':emaUsu', $usuAnadir['emaUsuAna']);
        $this->db->bind(':direcUsu', $usuAnadir['direccionUsuAna']);
        $this->db->bind(':cccUsu', "");
        $this->db->bind(':passUsu', $usuAnadir['passUsuAna']);
        $this->db->bind(':tallUsu', "");
        $this->db->bind(':fotUsu', "");
        $this->db->bind(':actUsu', "1");
        $this->db->bind(':idRolUsu', $usuAnadir['rolUsuAna']);
        $this->db->execute();
        $idSoci = $this->db->ultimoIndice();
        if ($usuAnadir['socioUsuAna'] == "si") {
            $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($idSoci, NULL);");
            $this->db->execute();
        }
        if ($usuAnadir['rolUsuAna'] == 2) {
            if ($usuAnadir['sueldoUsuAna'] != "" && $usuAnadir['sueldoUsuAna'] != NULL) {
                $this->db->query("INSERT INTO `ENTRENADOR` (`id_usuario`, `sueldo`) VALUES ($idSoci, :suel);");
                $this->db->bind(':suel', $usuAnadir['sueldoUsuAna']);
            } else {
                $this->db->query("INSERT INTO `ENTRENADOR` (`id_usuario`) VALUES ($idSoci);");
            }
            $this->db->execute();
        }

        return true;
    }

    //SOLICITUD SELECCIONADAS
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
        foreach ($datAceptar as $idAceptar) {
            $this->db->query("SELECT * FROM `SOLICITUD_SOCIO` WHERE `id_solicitud_soc` = :id_soli");
            $this->db->bind(':id_soli', $idAceptar);
            $datos = $this->db->registro();
            print_r($datos);
            print_r("<br><br><br>");

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
            print_r($idSoli);
            print_r("<br>");
            print_r($dni);
            print_r("<br>");
            print_r($nombre);
            print_r("<br>");
            print_r($apellidos);
            print_r("<br>");
            print_r($CCC);
            print_r("<br>");
            print_r($talla);
            print_r("<br>");
            print_r($fecha_nacimiento);
            print_r("<br>");
            print_r($email);
            print_r("<br>");
            print_r($telefono);
            print_r("<br>");
            print_r($direccion);
            print_r("<br>");
            print_r($es_socio);
            print_r("<br>");

            /*
            $this->db->query("INSERT INTO `USUARIO` (`dni`, `nombre`, `apellidos`, `email`, `direccion`, `fecha_nacimiento`, `telefono`, `CCC`, `passw`, `talla`, `activado`, `id_rol`) VALUES 
        (:dni, :nombre, :apellidos, :email, :direccion, :fecha_nacimiento, :telefono, :CCC, MD5(:dni), :talla, '1', '3');");
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

            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }*/
        }
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

    public function aceptar_solicitudes_socios($datAceptar)
    {

        $idSoli = $datAceptar[0];
        $dni = $datAceptar[1];
        $nombre = $datAceptar[2];
        $apellidos = $datAceptar[3];
        $CCC = $datAceptar[4];
        $talla = $datAceptar[5];
        $fecha_nacimiento = $datAceptar[6];
        $email = $datAceptar[7];
        $telefono = $datAceptar[8];
        $direccion = $datAceptar[9];
        $es_socio = $datAceptar[10];

        $this->db->query("INSERT INTO `USUARIO` (`dni`, `nombre`, `apellidos`, `email`, `direccion`, `fecha_nacimiento`, `telefono`, `CCC`, `passw`, `talla`, `activado`, `id_rol`) VALUES 
        (:dni, :nombre, :apellidos, :email, :direccion, :fecha_nacimiento, :telefono, :CCC, MD5(:dni), :talla, '1', '3');");
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

    //SOLICITUD EVENTOS
    public function obtenerSolicitudesEvenSoci()
    {
        $this->db->query("SELECT e.nombre as evento ,u.nombre, u.apellidos, s.fecha, s.id_usuario as id, s.id_evento FROM `SOLICITUD_SOCIO_EVENTO` s, `EVENTO` e, `USUARIO` u WHERE s.id_usuario= u.id_usuario and s.id_evento=e.id_evento");
        return $this->db->registros();
    }

    public function obtenerSolicitudesEvenExter()
    {
        $this->db->query("SELECT e.nombre as evento ,u.nombre, u.apellidos, s.fecha, s.id_externo as id, s.id_evento FROM `SOLICITUD_EXTER_EVENTO` s, `EVENTO` e, `EXTERNO` u WHERE s.id_externo= u.id_externo and s.id_evento=e.id_evento;");
        return $this->db->registros();
    }



    public function borrar_solicitudes_EvenSoci($datBorrar)
    {
        $idUsu = $datBorrar[0];
        $idEvento = $datBorrar[1];
        $fecha = $datBorrar[2];

        $this->db->query("DELETE FROM `SOLICITUD_SOCIO_EVENTO` WHERE `id_usuario` = :id_usu AND `id_evento` = :id_even AND `fecha` = :id_fecha");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_even', $idEvento);
        $this->db->bind(':id_fecha', $fecha);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function borrar_solicitudes_EvenExter($datBorrar)
    {
        $idUsu = $datBorrar[0];
        $idEvento = $datBorrar[1];
        $fecha = $datBorrar[2];

        $this->db->query("DELETE FROM `SOLICITUD_EXTER_EVENTO` WHERE `id_externo` = :id_usu AND `id_evento` = :id_even AND `fecha` = :id_fecha");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_even', $idEvento);
        $this->db->bind(':id_fecha', $fecha);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function aceptar_solicitudes_EvenExter($datAceptar)
    {
        $idUsu = $datAceptar[0];
        $idEvento = $datAceptar[1];
        $fecha = $datAceptar[2];

        $dorsal = 1;
        $this->db->query("SELECT dorasl FROM `EXTERNO` WHERE id_evento=:id_even ORDER BY `dorasl` DESC;");
        $this->db->bind(':id_even', $idEvento);
        $dorsalExterno = $this->db->registros();
        $this->db->query("SELECT dorsal FROM `SOCIO_EVENTO` WHERE id_evento=:id_even ORDER BY `dorsal` DESC;");
        $this->db->bind(':id_even', $idEvento);
        $dorsalSocio = $this->db->registros();

        if (($dorsalExterno[0]->dorasl) > ($dorsalSocio[0]->dorsal)) {
            $dorsal = ($dorsalExterno[0]->dorasl) + 1;
        } elseif (($dorsalSocio[0]->dorsal) > ($dorsalExterno[0]->dorasl)) {
            $dorsal = ($dorsalSocio[0]->dorsal) + 1;
        }

        $this->db->query("UPDATE `EXTERNO` SET `id_evento` = :id_even, `dorasl` = $dorsal WHERE `id_externo` = :id_usu;");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_even', $idEvento);
        $this->db->execute();

        $this->db->query("DELETE FROM `SOLICITUD_EXTER_EVENTO` WHERE `id_externo` = :id_usu AND `id_evento` = :id_even AND `fecha` = :id_fecha;");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_even', $idEvento);
        $this->db->bind(':id_fecha', $fecha);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function aceptar_solicitudes_EvenSoci($datAceptar)
    {
        $idUsu = $datAceptar[0];
        $idEvento = $datAceptar[1];
        $fecha = $datAceptar[2];

        $dorsal = 1;
        $this->db->query("SELECT dorasl FROM `EXTERNO` WHERE id_evento=:id_even ORDER BY `dorasl` DESC;");
        $this->db->bind(':id_even', $idEvento);
        $dorsalExterno = $this->db->registros();
        $this->db->query("SELECT dorsal FROM `SOCIO_EVENTO` WHERE id_evento=:id_even ORDER BY `dorsal` DESC;");
        $this->db->bind(':id_even', $idEvento);
        $dorsalSocio = $this->db->registros();

        if (($dorsalExterno[0]->dorasl) > ($dorsalSocio[0]->dorsal)) {
            $dorsal = ($dorsalExterno[0]->dorasl) + 1;
        } elseif (($dorsalSocio[0]->dorsal) > ($dorsalExterno[0]->dorasl)) {
            $dorsal = ($dorsalSocio[0]->dorsal) + 1;
        }

        $this->db->query("INSERT INTO `SOCIO_EVENTO` (`id_usuario`, `id_evento`, `fecha`, `dorsal`) VALUES (:id_usu, :id_even, :id_fecha, $dorsal);");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_even', $idEvento);
        $this->db->bind(':id_fecha', $fecha);
        $this->db->execute();

        $this->db->query("DELETE FROM `SOLICITUD_SOCIO_EVENTO`WHERE `id_usuario` = :id_usu AND `id_evento` = :id_even AND `fecha` = :id_fecha");
        $this->db->bind(':id_usu', $idUsu);
        $this->db->bind(':id_even', $idEvento);
        $this->db->bind(':id_fecha', $fecha);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
