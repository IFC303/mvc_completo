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

    public function actualizarUsuario($editarDatos, $idUsuarioSesion){

        $this->db->query("UPDATE usuarios SET dni=:dni , nombre=:nombre, apellidos=:apellidos , email=:email, telefono=:telefono, CCC=:CCC , passw=MD5(:passw) , talla=:talla, foto=:foto 
                                                WHERE id_usuario = '$idUsuarioSesion'");

        //vinculamos los valores
        $this->db->bind(':dni', $editarDatos['dni']);
        $this->db->bind(':nombre', $editarDatos['nombre']);
        $this->db->bind(':apellidos', $editarDatos['apellidos']);
        $this->db->bind(':email', $editarDatos['email']);
        $this->db->bind(':telefono', $editarDatos['telefono']);
        $this->db->bind(':CCC', $editarDatos['ccc']);
        $this->db->bind(':passw', $editarDatos['passw']);
        $this->db->bind(':talla', $editarDatos['talla']);

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
        $this->db->query("SELECT * FROM LICENCIA L where '$idUsuarioSesion' = L.id_usuario  ORDER BY L.id_licencia");

        return $this->db->registros();
    }

    public function agregarLicencia($agreLic)
    {
        $this->db->query("INSERT INTO LICENCIA (id_usuario, imagen, num_licencia, fecha_cad, tipo, dorsal, regional_nacional) 
        VALUES (:id_usuario, :imagen, :num_licencia, :fecha_cad, :tipo, :dorsal, :regional_nacional);");

        $this->db->bind(':id_usuario', $agreLic['id_usuario']);
        $this->db->bind(':imagen', $agreLic['imagenLicencia']);
        $this->db->bind(':num_licencia', $agreLic['numLicencia']);
        $this->db->bind(':fecha_cad', $agreLic['fechaCaducidad']);
        $this->db->bind(':tipo', $agreLic['tipoLicencia']);
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