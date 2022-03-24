<?php

class ExternoModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function obtenerEventos()
    {
        $this->db->query("SELECT * FROM `EVENTO`");
        return $this->db->registros();
    }

    public function anadirSoliSocio($soliSociAnadir)
    {
        print_r($soliSociAnadir);
        
        $this->db->query("INSERT INTO `SOLICITUD_SOCIO` (`DNI`, `nombre`, `apellidos`, `CCC`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `es_socio`) VALUES 
        (:dniUsu, :nomUsu, :apelUsu, :cccUsu, :tallUsu, :fecUsu, :emaUsu, :telUsu, :direcUsu, :aSocio);");

        $this->db->bind(':dniUsu', $soliSociAnadir['dniUsuAna']);
        $this->db->bind(':nomUsu', $soliSociAnadir['nomUsuAna']);
        $this->db->bind(':apelUsu', $soliSociAnadir['apelUsuAna']);
        $this->db->bind(':fecUsu', $soliSociAnadir['fecUsuAna']);
        $this->db->bind(':telUsu', $soliSociAnadir['telUsuAna']);
        $this->db->bind(':emaUsu', $soliSociAnadir['emaUsuAna']);
        $this->db->bind(':direcUsu', $soliSociAnadir['direccionUsuAna']);
        $this->db->bind(':cccUsu', $soliSociAnadir['cccUsuAna']);
        $this->db->bind(':tallUsu', $soliSociAnadir['tallaUsuAna']);
        if($soliSociAnadir['primerAnoSocio']=="si"){$soliSociAnadir['primerAnoSocio']=1;}elseif($soliSociAnadir['primerAnoSocio']=="no"){$soliSociAnadir['primerAnoSocio']=0;}
        $this->db->bind(':aSocio', $soliSociAnadir['primerAnoSocio']);

        if ($this->db->execute()) {
           return true;
        }else return false;

        
    }

    public function anadirSoliEven($agreEvento)
    {
        $this->db->query("INSERT INTO EXTERNO (DNI, nombre, apellidos, fecha_nacimiento, email, telefono) VALUES 
        (:dniUsu, :nomUsu, :apelUsu, :fecUsu, :emaUsu, :telUsu);");
        
        print_r($agreEvento);
        $this->db->bind(':dniUsu', $agreEvento['dniUsuAna']);
        $this->db->bind(':nomUsu', $agreEvento['nomUsuAna']);
        $this->db->bind(':apelUsu', $agreEvento['apelUsuAna']);
        $this->db->bind(':fecUsu', $agreEvento['fecUsuAna']);
        $this->db->bind(':telUsu', $agreEvento['telUsuAna']);
        $this->db->bind(':emaUsu', $agreEvento['emaUsuAna']);
        $this->db->execute();
        $id_usu = $this->db->ultimoIndice();

        $this->db->query("INSERT INTO `SOLICITUD_EXTER_EVENTO` (`id_externo`, `id_evento`, `fecha`) VALUES ($id_usu, :id_even, :fecha);");

        $this->db->bind(':id_even', $agreEvento['evenUsuAna']);
        $this->db->bind(':fecha', date('Y-m-d'));
          
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

}
