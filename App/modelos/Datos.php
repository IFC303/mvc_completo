<?php

class Datos
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

    public function actualizarUsuario($datos, $idUsuarioSesion){

        $this->db->query("UPDATE usuarios SET dni=:dni , nombre=:nombre, apellidos=:apellidos , email=:email, telefono=:telefono, CCC=:CCC , passw=:passw , talla=:talla, foto=:foto 
                                                WHERE id_usuario = '$idUsuarioSesion'");

        //vinculamos los valores
        $this->db->bind(':dni', $datos['id_usuario']);
        $this->db->bind(':nombre', $datos['nombre']);
        $this->db->bind(':apellidos', $datos['apellidos']);
        $this->db->bind(':email', $datos['email']);
        $this->db->bind(':telefono', $datos['telefono']);
        $this->db->bind(':CCC', $datos['CCC']);
        $this->db->bind(':passw', $datos['passw']);
        $this->db->bind(':talla', $datos['talla']);
        $this->db->bind(':foto', $datos['foto']);

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

}