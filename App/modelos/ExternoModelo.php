<?php

class ExternoModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function obtenerEventos(){
        $this->db->query("SELECT * FROM `EVENTO`");
        return $this->db->registros();
    }


    // ******************** REGISTRA LA SOLICITUD DE SOCIO ******************* //
    public function anadirSoliSocio($soliSociAnadir){
        
        $this->db->query("INSERT INTO `SOLICITUD_SOCIO` (`DNI`, `nombre`, `apellidos`, `CCC`, `talla`, `fecha_nacimiento`, `email`, `telefono`, `direccion`, `ha_sido`,`nom_pa`,`ape_pa`,`dni_pa`) 
        VALUES (:dniUsu,:nomUsu,:apelUsu,:cccUsu,:tallUsu,:fecUsu,:emaUsu,:telUsu,:direcUsu,:aSocio,:nom_pa,:ape_pa,:dni_pa);");

        $this->db->bind(':dniUsu', $soliSociAnadir['dniUsuAna']); 
        $this->db->bind(':nomUsu', $soliSociAnadir['nomUsuAna']);
        $this->db->bind(':apelUsu', $soliSociAnadir['apelUsuAna']);
        $this->db->bind(':cccUsu', $soliSociAnadir['cccUsuAna']);
        $this->db->bind(':tallUsu', $soliSociAnadir['tallaUsuAna']);
        $this->db->bind(':fecUsu', $soliSociAnadir['fecUsuAna']);
        $this->db->bind(':emaUsu', $soliSociAnadir['emaUsuAna']);
        $this->db->bind(':telUsu', $soliSociAnadir['telUsuAna']);
        $this->db->bind(':direcUsu', $soliSociAnadir['direccionUsuAna']);

        if($soliSociAnadir['primerAnoSocio']=="si"){
            $soliSociAnadir['primerAnoSocio']=1;
        }elseif($soliSociAnadir['primerAnoSocio']=="no"){
            $soliSociAnadir['primerAnoSocio']=0;}
        
        $this->db->bind(':aSocio', $soliSociAnadir['primerAnoSocio']);       
        $this->db->bind(':nom_pa',$soliSociAnadir['nom_pa']);  
        $this->db->bind(':ape_pa',$soliSociAnadir['ape_pa']);  
        $this->db->bind(':dni_pa',$soliSociAnadir['dni_pa']);     
        
        if ($this->db->execute()) {
           return true;
        }else 
            return false;        
    }




// *****************************************  SOLICITUDES EVENTOS   ******************************************//


    //********* REGISTRA SOLICITUD ************/
      public function anadir_soli_eve($soli_eve){

            $this->db->query("INSERT INTO SOLICITUD_EVENTO (id_evento, fecha, nombre, apellidos, DNI, fecha_nacimiento, direccion, email, telefono) 
            VALUES (:evento, CURDATE(), :nombre, :apellidos,:dni, :fecha_naci, :direccion, :email, :telefono);");
            
            $this->db->bind(':nombre', $soli_eve['nombre']);
            $this->db->bind(':apellidos', $soli_eve['apellidos']);
            $this->db->bind(':fecha_naci', $soli_eve['fecha_naci']);
            $this->db->bind(':dni', $soli_eve['dni']);
            $this->db->bind(':direccion', $soli_eve['direccion']);
            $this->db->bind(':telefono', $soli_eve['telefono']);
            $this->db->bind(':email', $soli_eve['email']);
            $this->db->bind(':evento', $soli_eve['evento']);
            
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        }


    // ******** VISUALIZA TODAS LAS SOLICITUDES ******* //
    public function obtener_soli_eventos(){
            $this->db->query("SELECT id_solicitud, SOLICITUD_EVENTO.id_evento, EVENTO.nombre as nombre_evento, fecha, SOLICITUD_EVENTO.nombre, apellidos, DNI, fecha_nacimiento, direccion, email, telefono
            FROM SOLICITUD_EVENTO, EVENTO where EVENTO.id_evento=SOLICITUD_EVENTO.id_evento order by id_solicitud");
            return $this->db->registros();
    }


    // ******** BORRA SOLICITUD ******* //
    public function borrar_soli_eve($id){
            $this->db->query("DELETE FROM SOLICITUD_EVENTO WHERE id_solicitud=:id");
            $this->db->bind(':id', $id);
            
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
    }

  // ******** ACEPTAR SOLICITUD ******* //
    public function aceptar_soli_even($aceptar){

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

        $this->db->query("DELETE FROM  SOLICITUD_EVENTO WHERE `id_solicitud` = :id;");
        $this->db->bind(':id', $aceptar['id']);
  
        if ($this->db->execute()) {
             return true;
         } else {
             return false;
         }
        
    }



}
