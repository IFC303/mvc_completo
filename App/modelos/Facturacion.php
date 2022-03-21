<?php

class Facturacion
{
    private $db;
    private $paginator;

    public function __construct()
    {
        $this->db = new Base;
    }

    public function getPaginator()
    {
        return $this->paginator;
    }

    public function getCuotasUsuario($limit, $page)
    {
        $query = "SELECT id_ingreso_cuota, CONCAT(apellidos, ', ', nombre) AS 'apellidos_nombre', CCC, importe, dni, concepto, concepto, fecha, concat(apellidos, ', ', nombre) as 'apellidos_nombre', direccion, direccion as 'cod_postal', direccion as 'poblacion', direccion as 'provincia' FROM I_CUOTAS NATURAL JOIN USUARIO";
        $this->paginator = new Paginator($this->db, $query);

        $results    = $this->paginator->getData($limit, $page);
        return $results->data;
    }

    public function getAllCuotasUsuario() {
        $query = "SELECT id_ingreso_cuota, CONCAT(apellidos, ', ', nombre) AS 'apellidos_nombre', CCC, importe, dni, concepto, concepto, fecha, concat(apellidos, ', ', nombre) as 'apellidos_nombre', direccion, direccion as 'cod_postal', direccion as 'poblacion', direccion as 'provincia' FROM I_CUOTAS NATURAL JOIN USUARIO";
        $this->db->query($query);
        return $this->db->registros();
    }

/*******************************************************/
/************** CONSULTAS GASTOS **********************/
/*******************************************************/

   public function obtenerGastos(){
        $this->db->query("SELECT * from GASTOS");
        return $this->db->registros();
    }

    public function gastosPersonal(){
        $this->db->query("SELECT id_gasto, fecha, concepto, importe, G_PERSONAL.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, G_PERSONAL WHERE USUARIO.id_usuario=G_PERSONAL.id_usuario;");
        return $this->db->registros();
    }

    public function gastosOtrosUsuario(){
        $this->db->query("SELECT id_gastos, fecha, concepto, importe, G_OTROS.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, G_OTROS WHERE USUARIO.id_usuario=G_OTROS.id_usuario;");
        return $this->db->registros();
    }

    public function gastosOtrosEntidad(){
        $this->db->query("SELECT id_gastos, fecha, concepto, importe, G_OTROS.id_entidad,OTRAS_ENTIDADES.nombre
        from OTRAS_ENTIDADES, G_OTROS WHERE OTRAS_ENTIDADES.id_entidad=G_OTROS.id_entidad;");
        return $this->db->registros();
    }

    //OBTENER SOCIOS PARA GASTOS OTROS
    public function obSocios(){
        $this->db->query("SELECT SOCIO.id_socio,USUARIO.nombre,USUARIO.apellidos from SOCIO, USUARIO 
        where SOCIO.id_socio=USUARIO.id_usuario");
        return $this->db->registros();
    }

    //OBTENER ENTIDADES PARA GASTOS OTROS
    public function obEntidades(){
        $this->db->query("SELECT * from OTRAS_ENTIDADES");
        return $this->db->registros();
    }

    //OBTENER ENTRENADORES PARA GASTOS PERSONAL
    public function obEntrenadores(){
        $this->db->query("SELECT ENTRENADOR.id_usuario,USUARIO.nombre,USUARIO.apellidos,ENTRENADOR.sueldo from USUARIO, ENTRENADOR
        where ENTRENADOR.id_usuario=USUARIO.id_usuario");
        return $this->db->registros();
    }

    // AÑADIR GASTO PERSONAL
    public function agregarGastosPersonal($gasto){
        $this->db->query("INSERT INTO G_PERSONAL (fecha, concepto, importe, id_usuario) 
                          VALUES (:fecha,:concepto,:importe,:id_usuario)");

             $this->db->bind(':fecha',$gasto['fecha']);
             $this->db->bind(':concepto', $gasto['concepto']);
             $this->db->bind(':importe',$gasto['importe']);
             $this->db->bind(':id_usuario',$gasto['id_entrenador']);

             if($this->db->execute()){
                return true;
             }else{
                 return false;
             }
    }

    // AÑADIR GASTO OTROS
    public function agregarGastosOtros($gastos){
        var_dump($gastos);

        
        $this->db->query("INSERT INTO G_OTROS (fecha, concepto, importe, id_usuario, id_entidad) 
                          VALUES (:fecha, :concepto, :importe, :id_usuario, :id_entidad)");

              $this->db->bind(':fecha',$gastos['fecha']);
              $this->db->bind(':concepto',$gastos['concepto']);
              $this->db->bind(':importe',$gastos['importe']);
              $this->db->bind(':id_usuario',$gastos['id_usuario']); 
              $this->db->bind(':id_entidad',$gastos['id_entidad']); 
  
                 if($this->db->execute()){
                    return true;
                 }else{
                     return false;
                 }
    }



     //FUNCIONES BORRADO GASTOS
     public function borrarGastosPersonal($id){
        $this->db->query("DELETE FROM G_PERSONAL WHERE id_gasto =:idGasto");
        $this->db->bind(':idGasto',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function borrarGastosOtros($id){
        $this->db->query("DELETE FROM G_OTROS WHERE id_gastos =:idGasto");
        $this->db->bind(':idGasto',$id);
        if ($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }











/*******************************************************/
/**************CONSULTAS INGRESOS **********************/
/*******************************************************/


    public function obtenerIngresos(){
        $this->db->query("SELECT * from INGRESOS");
        return $this->db->registros();
    }

    
    //OBTENER SOCIOS PARA INGRESO CUOTAS
     public function obtenerSocios(){
        $this->db->query("SELECT SOCIO.id_socio,USUARIO.nombre,USUARIO.apellidos from SOCIO, USUARIO 
        where SOCIO.id_socio=USUARIO.id_usuario");
        return $this->db->registros();
    }
    //INGRESOs CUOTAS
    public function obtenerIngresosCuotas(){
        $this->db->query("SELECT id_ingreso_cuota, fecha, concepto, importe, I_CUOTAS.id_usuario,USUARIO.nombre,USUARIO.apellidos 
        from USUARIO, I_CUOTAS WHERE USUARIO.id_usuario=I_CUOTAS.id_usuario;");
        return $this->db->registros();
    }

    //OBTENER ENTIDADES PARA INGRESO EN OTROS
    public function obtenerEntidades(){
        $this->db->query("SELECT * from OTRAS_ENTIDADES");
        return $this->db->registros();
    }
    //INGRESOS OTROS
    public function obtenerIngresosOtros(){
        $this->db->query("SELECT id_ingreso_otros, fecha, concepto, importe,I_OTROS.id_entidad,OTRAS_ENTIDADES.nombre
        from OTRAS_ENTIDADES, I_OTROS where OTRAS_ENTIDADES.id_entidad=I_OTROS.id_entidad;");
        return $this->db->registros();
    }
   
    //OBTENER EVENTOS PARA INGRESO ACTIVIDADES
    public function obtenerEventos(){
        $this->db->query("SELECT * from EVENTO");
        return $this->db->registros();
    }
    //OBTENER PARTICIPAMTES (socio y externo) PARA INGRESO ACTIVIDADES
    public function obtenerParticipante(){
        $this->db->query("SELECT * from PARTICIPANTE");
        return $this->db->registros();
    }


    //TODO INGRESOS PARTICIPANTES
    public function todosIngresosParticipantes(){
        $this->db->query("SELECT PARTICIPANTE.id_participante, PARTICIPANTE.id_evento, PARTICIPANTE.nombre, PARTICIPANTE.apellidos, PARTICIPANTE.tipoParticipante, 
        fecha, concepto, importe, id_ingreso_actividades from I_ACTIVIDADES,PARTICIPANTE
        where PARTICIPANTE.id_participante=I_ACTIVIDADES.id_externo or PARTICIPANTE.id_participante=I_ACTIVIDADES.id_usuario");
        return $this->db->registros();

    }


    // AÑADIR NUEVO INGRESO
    public function agregarIngresoOtros($ingreso){
        $this->db->query("INSERT INTO I_OTROS (fecha, concepto, importe,id_entidad) 
                          VALUES (:fecha,:concepto,:importe,:id_entidad)");

             $this->db->bind(':fecha',$ingreso['fecha']);
             $this->db->bind(':concepto', $ingreso['concepto']);
             $this->db->bind(':importe',$ingreso['importe']);
             $this->db->bind(':id_entidad',$ingreso['id_entidad']);

             if($this->db->execute()){
                return true;
             }else{
                 return false;
             }
    }


    public function agregarIngresoCuotas($ingreso){
        //var_dump($ingreso);
              $this->db->query("INSERT INTO I_CUOTAS (fecha, concepto, importe,id_usuario) 
                                VALUES (:fecha,:concepto,:importe,:id_socio)");

              $this->db->bind(':fecha',$ingreso['fecha']);
              $this->db->bind(':concepto', $ingreso['concepto']);
              $this->db->bind(':importe',$ingreso['importe']);
             $this->db->bind(':id_socio',$ingreso['id_usuario']);

              if($this->db->execute()){
                  return true;
              }else{
                return false;
              }
    }


     public function agregarIngresoActividadesExterno($ingreso,$id){
        //var_dump($ingreso);

              $this->db->query("INSERT INTO I_ACTIVIDADES (id_externo,id_evento,fecha, concepto, importe) 
                                VALUES (:id_externo,:id_evento,:fecha,:concepto,:importe)");

              $this->db->bind(':fecha',$ingreso['fecha']);
               $this->db->bind(':concepto', $ingreso['concepto']);
               $this->db->bind(':importe',$ingreso['importe']);
               $this->db->bind(':id_externo',$id);
               $this->db->bind(':id_evento',$ingreso['id_evento']);

               if($this->db->execute()){
                   return true;
               }else{
                   return false;
              }
    }


    public function agregarIngresoActividadesSocio($ingreso,$id){
        //var_dump($ingreso);
      $this->db->query("INSERT INTO I_ACTIVIDADES (id_usuario,id_evento,fecha, concepto, importe) 
         VALUES (:id_usuario,:id_evento,:fecha,:concepto,:importe)");

         $this->db->bind(':fecha',$ingreso['fecha']);
         $this->db->bind(':concepto', $ingreso['concepto']);
         $this->db->bind(':importe',$ingreso['importe']);
         $this->db->bind(':id_usuario',$id);
         $this->db->bind(':id_evento',$ingreso['id_evento']);

         if($this->db->execute()){
         return true;
         }else{
         return false;
         }
}
    
  


    //FUNCIONES BORRADO INGRESOS
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

   


    
    

 

   

   

    






   

  

    




  

}