<?php

class SocioModelo
{
    private $db;

    public function __construct(){
        $this->db = new Base;
    }


    public function obtenerDatosSocio(){
        $this->db->query("SELECT * FROM USUARIO WHERE USUARIO.id_rol = '3'");
        return $this->db->registros();
    }


    public function obtenerDatosSocioId($idUsuarioSesion){
        $this->db->query("SELECT * FROM USUARIO WHERE USUARIO.id_rol = '3' AND USUARIO.id_usuario = '$idUsuarioSesion'");
        return $this->db->registros();
    }


    /*********** ACTUALIZAR DATOS SOCIO **********/

    public function actualizarUsuario($editarDatos, $idUsuarioSesion, $datosUser){

        $this->db->query("UPDATE USUARIO SET email=:email, telefono=:telefono, direccion=:direccion, CCC=:CCC, passw=:passw, talla=:talla, foto=:foto
                           WHERE id_usuario = '$idUsuarioSesion';");

        //print_r($editarDatos); exit();
        
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

        if ($editarDatos['direccion']=="") {
            $this->db->bind(':direccion', $datosUser[0]->direccion);
        }else {
            $this->db->bind(':direccion', $editarDatos['direccion']);
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

    public function obtenerLicenciasUsuarioId($idUsuarioSesion)
    {
        $this->db->query("SELECT * FROM LICENCIA L , USUARIO U where $idUsuarioSesion = U.id_usuario AND $idUsuarioSesion = U.id_usuario");

        return $this->db->registros();
    }

    public function obtenerFotoLicencia($idLic){
        $this->db->query("SELECT imagen FROM LICENCIA WHERE id_licencia = '$idLic'");
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

    public function obtenergrupos()
    {
        $this->db->query("SELECT * FROM `GRUPO`");
        return $this->db->registros();
    }

    public function obtenerCategorias()
    {
        $this->db->query("SELECT * FROM `CATEGORIA`");
        return $this->db->registros();
    }

    public function obtenerEventos()
    {
        $this->db->query("SELECT * FROM `EVENTO`");
        return $this->db->registros();
    }

    public function escuela($agreEscuela)
    {
        $this->db->query("INSERT INTO `SOCIO_GRUPO` (`id_grupo`, `id_usuario`, `fecha_inscripcion`, `acepatado`, `activo`, `id_categoria`, `foto`) VALUES (:id_gru, :id_usu, :fecha, '0', '0', :cat, :foto);");
        
        $this->db->bind(':id_gru', $agreEscuela["grupo"]);
        $this->db->bind(':id_usu', $agreEscuela["id_usu"]);
        $this->db->bind(':fecha', $agreEscuela["fecha"]);  
        $this->db->bind(':cat', $agreEscuela["categoria"]);  
        $this->db->bind(':foto', $agreEscuela["fotoCarnet"]);   
    
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

//********** SOLICITUD EVENTO ****************** */
    public function eventoSoli($idEvento,$datosUser){ 
        $this->db->query("INSERT INTO SOLICITUD_EVENTO (id_evento, fecha, nombre, apellidos, DNI, fecha_nacimiento, direccion, email, telefono) 
        VALUES (:id_evento, CURDATE(), :nombre, :apellidos,:dni, :fecha_naci, :direccion, :email, :telefono);");
        
        $this->db->bind(':id_evento', $idEvento);
        $this->db->bind(':nombre', $datosUser[0]->nombre);
        $this->db->bind(':apellidos', $datosUser[0]->apellidos);
        $this->db->bind(':dni', $datosUser[0]->dni);
        $this->db->bind(':direccion', $datosUser[0]->direccion);
        $this->db->bind(':fecha_naci', $datosUser[0]->fecha_nacimiento);
        $this->db->bind(':email', $datosUser[0]->email);
        $this->db->bind(':telefono', $datosUser[0]->telefono);
        
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }   
    
    }
    

}