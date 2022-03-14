<?php

class Facturacion
{
    private $db;

    public function __construct()
    {
        $this->db = new Base;
      
    }


    public function obtenerIngresos(){
        $this->db->query("SELECT * from INGRESOS");
        return $this->db->registros();
    }

    public function ingresosCuotas(){
        $this->db->query("SELECT id_ingreso_cuota, fecha, concepto, importe, tipo, I_CUOTAS.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, I_CUOTAS WHERE usuario.id_usuario=I_CUOTAS.id_usuario;");
        return $this->db->registros();
    }
   
    public function ingresosActividadesSocios(){
        $this->db->query("SELECT id_ingreso_actividades,I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_usuario, I_ACTIVIDADES.id_evento,fecha,concepto, importe,
        USUARIO.nombre,USUARIO.apellidos, EVENTO.nombre as nom_evento from USUARIO,I_ACTIVIDADES,EVENTO 
        where USUARIO.id_usuario=I_ACTIVIDADES.id_usuario and EVENTO.id_evento=I_ACTIVIDADES.id_evento;");
        return $this->db->registros();
    }

    public function ingresosActividadesExternos(){
        $this->db->query("SELECT id_ingreso_actividades, I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_externo,I_ACTIVIDADES.id_evento,fecha,concepto, importe,
        EXTERNO.nombre,EXTERNO.apellidos, EVENTO.nombre as nom_evento from EXTERNO,I_ACTIVIDADES,EVENTO
        where EXTERNO.id_externo=I_ACTIVIDADES.id_externo and EVENTO.id_evento=I_ACTIVIDADES.id_evento ;");
        return $this->db->registros();
    }

    public function ingresosOtros(){
        $this->db->query("SELECT id_ingreso_otros, fecha, concepto, importe,I_OTROS.id_entidad,OTRAS_ENTIDADES.nombre
        from OTRAS_ENTIDADES, I_OTROS where OTRAS_ENTIDADES.id_entidad=I_OTROS.id_entidad;");
        return $this->db->registros();
    }


    public function borrarIngresoCuotas($id){
        $this->db->query("DELETE FROM I_CUOTAS WHERE id_ingreso_cuota =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarIngresoActividades($id){
        $this->db->query("DELETE FROM I_ACTIVIDADES WHERE id_ingreso_actividades =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }

    public function borrarIngresoOtros($id){
        $this->db->query("DELETE FROM I_OTROS WHERE id_ingreso_otros =:idIngreso");
        $this->db->bind(':idIngreso',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function obtenerUsuarios(){
        $this->db->query("SELECT * from USUARIO");
        return $this->db->registros();
    }

    public function obtenerEntidades(){
        $this->db->query("SELECT * from OTRAS_ENTIDADES");
        return $this->db->registros();
    }

    public function obtenerExternos(){
        $this->db->query("SELECT * from EXTERNO");
        return $this->db->registros();
    }


    // public function obtenerIngresosOtros(){
    //     $this->db->query("SELECT * FROM I_OTROS");
    //     return $this->db->registros();
    // }

    // public function obtenerGastosPersonal(){
    //     $this->db->query("SELECT * FROM G_PERSONAL");
    //     return $this->db->registros();
    // }

    // public function obtenerGastosOtros(){
    //     $this->db->query("SELECT * FROM G_OTROS");
    //     return $this->db->registros();
    // }

}