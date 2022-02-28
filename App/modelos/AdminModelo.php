<?php

class AdminModelo
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function obtenerUsuarios($rol)
    {
        $this->db->query("SELECT * FROM USUARIO WHERE id_rol = $rol");
        return $this->db->registros();
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
        $coma= 0;
        $dniMet= false;$nomMet= false;$apeMet= false;$fecMet= false;$emaMet= false;$telMet= false;$passMet= false;$cccMet= false;$tallMet= false;$fotMet= false;$actMet= false;$rolMet= false;
        $cad="UPDATE `USUARIO` SET ";
        
        if(($usuEditar['dniEdit']!="")&&($usuEditar['dniEdit']!=null)){
            if($coma==1){$cad=$cad . ", `dni` = :dniUsu";}else{$cad=$cad . " `dni` = :dniUsu";$coma=1;}
            $dniMet= true;
        }
        if(($usuEditar['nomEdit']!="")&&($usuEditar['nomEdit']!=null)){
            if($coma==1){$cad=$cad . ", `nombre` = :nomUsu";}else{$cad=$cad . " `nombre` = :nomUsu";$coma=1;}
            $nomMet= true;
        }
        if(($usuEditar['apelEdit']!="")&&($usuEditar['apelEdit']!=null)){
            if($coma==1){$cad=$cad . ", `apellidos` = :apelUsu";}else{$cad=$cad . " `apellidos` = :apelUsu";$coma=1;}
            $apeMet= true;
        }
        if(($usuEditar['fecEdit']!="")&&($usuEditar['fecEdit']!=null)){
            if($coma==1){$cad=$cad . ", `fecha_nacimiento` = :fecUsu";}else{$cad=$cad . " `fecha_nacimiento` = :fecUsu";$coma=1;}
            $fecMet= true;
        }
        if(($usuEditar['telEdit']!="")&&($usuEditar['telEdit']!=null)){
            if($coma==1){$cad=$cad . ", `telefono` = :telUsu";}else{$cad=$cad . " `telefono` = :telUsu";$coma=1;}
            $telMet= true;
        }
        if(($usuEditar['emaEdit']!="")&&($usuEditar['emaEdit']!=null)){
            if($coma==1){$cad=$cad . ", `email` = :emaUsu";}else{$cad=$cad . " `email` = :emaUsu";$coma=1;}
            $emaMet= true;
        }
        if(($usuEditar['passEdit']!="")&&($usuEditar['passEdit']!=null)){
            if($coma==1){$cad=$cad . ", `passw` = MD5(:passUsu)";}else{$cad=$cad . " `passw` = MD5(:passUsu)";$coma=1;}
            $passMet= true;
        }
        if(($usuEditar['CCCEdit']!="")&&($usuEditar['CCCEdit']!=null)){
            if($coma==1){$cad=$cad . ", `CCC` = :cccUsu";}else{$cad=$cad . " `CCC` = :cccUsu";$coma=1;}
            $cccMet= true;
        }
        if(($usuEditar['TallaEdit']!="")&&($usuEditar['TallaEdit']!=null)){
            if($coma==1){$cad=$cad . ", `talla` = :tallUsu";}else{$cad=$cad . " `talla` = :tallUsu";$coma=1;}
            $tallMet= true;
        }
        if(($usuEditar['FotoEdit']!="")&&($usuEditar['FotoEdit']!=null)){
            if($coma==1){$cad=$cad . ", `foto` = :fotUsu";}else{$cad=$cad . " `foto` = :fotUsu";$coma=1;}
            $fotMet= true;
        }
        if(($usuEditar['ActEdit']!="")&&($usuEditar['ActEdit']!=null)){
            if($coma==1){$cad=$cad . ", `activado` = :actUsu";}else{$cad=$cad . " `activado` = :actUsu";$coma=1;}
            $actMet= true;
        }
        if(($usuEditar['RolEdit']!="")&&($usuEditar['RolEdit']!=null)){
            if($coma==1){$cad=$cad . ", `id_rol` = :idRolUsu";}else{$cad=$cad . " `id_rol` = idRolUsu:";$coma=1;}
            $rolMet= true;
        }

        $cad= $cad." WHERE `id_usuario` = :idUsu;";
        
        $this->db->query("$cad");
        $this->db->bind(':idUsu', $usuEditar['idEdit']);
        if($dniMet== true){$this->db->bind(':dniUsu', $usuEditar['dniEdit']);}
        if($nomMet== true){$this->db->bind(':nomUsu', $usuEditar['nomEdit']);}
        if($apeMet== true){$this->db->bind(':apelUsu', $usuEditar['apelEdit']);}
        if($fecMet== true){$this->db->bind(':fecUsu', $usuEditar['fecEdit']);}
        if($emaMet== true){$this->db->bind(':emaUsu', $usuEditar['emaEdit']);}
        if($telMet== true){$this->db->bind(':telUsu', $usuEditar['telEdit']);}
        if($passMet== true){$this->db->bind(':passUsu', $usuEditar['passEdit']);}
        if($cccMet== true){$this->db->bind(':cccUsu', $usuEditar['CCCEdit']);}
        if($tallMet== true){$this->db->bind(':tallUsu', $usuEditar['TallaEdit']);}
        if($fotMet== true){$this->db->bind(':fotUsu', $usuEditar['FotoEdit']);}
        if($actMet== true){$this->db->bind(':actUsu', $usuEditar['ActEdit']);}
        if($rolMet== true){$this->db->bind(':idRolUsu', $usuEditar['RolEdit']);}

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function anadirUsuario($usuAnadir)
    {
        $this->db->query("SELECT id_usuario FROM `USUARIO` ORDER BY `id_usuario` DESC LIMIT 1");
        $idBDD = $this->db->registros();
        $idBDD = $idBDD[0]->id_usuario;
        $idUsuAna = $idBDD + 1;

        $this->db->query("INSERT INTO USUARIO (id_usuario, dni, nombre, apellidos, email, fecha_nacimiento, telefono, CCC, passw, talla, foto, activado, id_rol) 
        VALUES (:idUsu, :dniUsu, :nomUsu, :apelUsu, :emaUsu, :fecUsu, :telUsu, :cccUsu, MD5(:passUsu), :tallUsu, :fotUsu, :actUsu, :idRolUsu);");

        $this->db->bind(':idUsu', $idUsuAna);
        $this->db->bind(':dniUsu', $usuAnadir['dniUsuAna']);
        $this->db->bind(':nomUsu', $usuAnadir['nomUsuAna']);
        $this->db->bind(':apelUsu', $usuAnadir['apelUsuAna']);
        $this->db->bind(':fecUsu', $usuAnadir['fecUsuAna']);
        $this->db->bind(':telUsu', $usuAnadir['telUsuAna']);
        $this->db->bind(':emaUsu', $usuAnadir['emaUsuAna']);
        $this->db->bind(':cccUsu', "" /*$usuAnadir['cccUsuAna']*/);
        $this->db->bind(':passUsu', $usuAnadir['passUsuAna']);
        $this->db->bind(':tallUsu', ""/*$usuAnadir['tallUsuAna']*/);
        $this->db->bind(':fotUsu', ""/*$usuAnadir['fotUsuAna']*/);
        $this->db->bind(':actUsu', "1"/*$usuAnadir['actUsuAna']*/);
        $this->db->bind(':idRolUsu', "1"/*$usuAnadir['idRolUsuAna']*/);

        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}
