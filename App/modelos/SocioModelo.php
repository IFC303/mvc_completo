<?php

class SocioModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }


    public function obtenerDatosSocio()
    {
        $this->db->query("SELECT * FROM USUARIO WHERE USUARIO.id_rol = '3'");

        return $this->db->registros();
    }


    public function obtenerDatosSocioId($idUsuarioSesion)
    {
        $this->db->query("SELECT * FROM USUARIO WHERE USUARIO.id_rol = '3' AND USUARIO.id_usuario = '$idUsuarioSesion'");

        return $this->db->registros();
    }

    public function actualizarUsuario($editarDatos, $idUsuarioSesion, $datosUser){

        $this->db->query("UPDATE USUARIO SET dni=:dni ,nombre=:nombre, apellidos=:apellidos, email=:email, telefono=:telefono, CCC=:CCC, passw=:passw, talla=:talla, foto=:foto
                           WHERE id_usuario = '$idUsuarioSesion';");


        //print_r($datosUser); exit();
        //vinculamos los valores
        if ($editarDatos['dniEdit']=="") {
            $this->db->bind(':dni', $datosUser[0]->dni);
        }else {
            $this->db->bind(':dni', $editarDatos['dniEdit']);
        }

        if ($editarDatos['nombreEdit']=="") {
            $this->db->bind(':nombre', $datosUser[0]->nombre);
        }else {
            $this->db->bind(':nombre', $editarDatos['nombreEdit']);
        }
        
        if ($editarDatos['apellidosEdit']=="") {
            $this->db->bind(':apellidos', $datosUser[0]->apellidos);
        }else {
            $this->db->bind(':apellidos', $editarDatos['apellidosEdit']);
        }
        
        if ($editarDatos['emailEdit']=="") {
            $this->db->bind(':email', $datosUser[0]->email);
        }else {
            $this->db->bind(':email', $editarDatos['emailEdit']);
        }

        if ($editarDatos['telefonoEdit']=="") {
            $this->db->bind(':telefono', $datosUser[0]->telefono);
        }else {
            $this->db->bind(':telefono', $editarDatos['telefonoEdit']);
        }

        if ($editarDatos['cccEdit']=="") {
            $this->db->bind(':CCC', $datosUser[0]->CCC);
        }else {
            $this->db->bind(':CCC', $editarDatos['cccEdit']);
        }
        
        if ($editarDatos['passwEdit']=="") {
            $this->db->bind(':passw', $datosUser[0]->passw);
        }else {
            $this->db->bind(':passw', MD5($editarDatos['passwEdit']));
        }
        
        if ($editarDatos['tallaEdit']=="") {
            $this->db->bind(':talla', $datosUser[0]->talla);
        }else {
            $this->db->bind(':talla', $editarDatos['tallaEdit']);
        }

        if ($editarDatos['fotoEdit']=="") {
            $this->db->bind(':foto', $datosUser[0]->foto);
        }else {
            $this->db->bind(':foto', $editarDatos['fotoEdit']);
        }
        
        //ejecutamos
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function obtenerMarcas()
    {
        $this->db->query("SELECT * FROM PRUEBA P, PRUEBA_SOCIO PS , TEST T , TEST_PRUEBA TP where P.id_prueba = PS.id_prueba AND P.id_prueba = TP.id_prueba AND TP.id_test = T.id_test ORDER BY P.id_prueba");

        return $this->db->registros();
    }


    public function obtenerMarcasId($idUsuarioSesion)
    {
        $this->db->query("SELECT * FROM PRUEBA P, PRUEBA_SOCIO PS , TEST T , TEST_PRUEBA TP  where '$idUsuarioSesion' = PS.id_usuario AND P.id_prueba = PS.id_prueba AND P.id_prueba = TP.id_prueba AND TP.id_test = T.id_test ORDER BY P.id_prueba");

        return $this->db->registros();
    }

    public function obtenerLicenciasId($idUsuarioSesion)
    {
        $this->db->query("SELECT * FROM LICENCIA L where '$idUsuarioSesion' = L.id_usuario");

        return $this->db->registros();
    }

    public function agregarLicencia($agreLic, $idUsuarioSesion)
    {
        $this->db->query("INSERT INTO LICENCIA (id_usuario, imagen, num_licencia, fecha_cad, tipo, dorsal, regional_nacional) 
        VALUES (:id_usuario, :imagen, :num_licencia, :fecha_cad, :tipo, :dorsal, :regional_nacional);");

        $this->db->bind(':id_usuario', $idUsuarioSesion);
        $this->db->bind(':imagen', $agreLic['imagenLicencia']);
        $this->db->bind(':num_licencia', $agreLic['numLicencia']);
        
        if ($agreLic['fechaCaducidad']=="") {
            $this->db->bind(':fecha_cad', NULL);    
        }else {
            $this->db->bind(':fecha_cad', $agreLic['fechaCaducidad']);
        }
        
        if ($agreLic['tipoLicencia']==1) {
            $this->db->bind(':tipo', 'Federativa');
        }elseif ($agreLic['tipoLicencia']==2) {
            $this->db->bind(':tipo', 'Escolar');
        }
        
        if ($agreLic['dorsal']=="") {
            $this->db->bind(':dorsal', NULL);    
        }else {
            $this->db->bind(':dorsal', $agreLic['dorsal']);
        }
        
        $this->db->bind(':regional_nacional', $agreLic['federativas']);
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}