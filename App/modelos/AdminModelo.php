<?php

class AdminModelo{

    private $db;

    public function __construct(){
        $this->db = new Base;
    }


   //**************************** NOTIFICACIONES ***************************************/

    public function notSocio(){
        $this->db->query("SELECT * FROM `SOLICITUD_SOCIO`");
        return $this->db->rowCount();
    }

    public function notGrupo(){
        $this->db->query("SELECT * FROM solicitud_escuela");
        return $this->db->rowCount();
    }

    public function notEventos(){
        $this->db->query("SELECT * FROM SOLICITUD_EVENTO");
        return $this->db->rowCount();
    }

    public function contar_pedidos(){
        $this->db->query("SELECT * FROM `SOLI_EQUIPACION` WHERE recogido=0");
        return $this->db->rowCount();
    }

    

//**************************** EDITAR DATOS DEL ADMIN ***************************************/

public function obtenerDatosId($id){
    $this->db->query("SELECT * FROM USUARIO WHERE id_usuario=:id");
    $this->db->bind(':id', $id);
    return $this->db->registros();
}



public function editar_datos($nuevo,$id,$datosUser){


    $this->db->query("UPDATE USUARIO SET dni=:dni, nombre=:nombre, apellidos=:apellidos, email=:email, direccion=:direccion, 
    fecha_nacimiento=:fecha_naci, telefono=:telefono, CCC=:ccc, passw=:passw, talla=:talla, foto=:foto where id_usuario=:id;");

     $this->db->bind(':nombre', $nuevo['nombre']);
     $this->db->bind(':apellidos', $nuevo['apellidos']);
     $this->db->bind(':dni', $nuevo['dni']);
     $this->db->bind(':fecha_naci', $nuevo['fecha_naci']);
     $this->db->bind(':telefono', $nuevo['telefono']);
     $this->db->bind(':email',$nuevo['email']);
     $this->db->bind(':direccion', $nuevo['direccion']);
     $this->db->bind(':ccc', $nuevo['ccc']);
     $this->db->bind(':talla', $nuevo['talla']);

    if ($nuevo['password']==$datosUser[0]->passw) {
        $this->db->bind(':passw', $datosUser[0]->passw);
    }else {
        $this->db->bind(':passw',MD5($nuevo['password']));
    }

     $this->db->bind(':foto', $nuevo['foto']);
     $this->db->bind(':id', $id);
     

    if ($this->db->execute()){
        return true;
    }else{
        return false;
    }
}



//**************************** CRUD DE USUARIOS (ver, borrar, nuevo, editar) ***************************************/

public function obtenerUsuarios(){
    $this->db->query("SELECT * FROM USUARIO order by id_rol");
    return $this->db->registros();
}


public function obtenerRoles(){
        $this->db->query("SELECT * FROM ROL");
        return $this->db->registros();
}


public function borrar_usuario($id){
        $this->db->query("DELETE FROM USUARIO WHERE id_usuario = :id");
        $this->db->bind(':id', $id);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
}


public function nuevo_usuario($nuevo){

    $this->db->query("INSERT INTO USUARIO (dni, nombre, apellidos, email, direccion, fecha_nacimiento, telefono, CCC, passw, talla, ha_sido, activado, id_rol, nom_pa, ape_pa, dni_pa) 
                    VALUES (:dni, :nombre, :apellidos, :email, :direccion, :fecha_naci, :telefono, :ccc, MD5(:pass), :talla, :pri_socio, 1, :rol, :nom_pa, :ape_pa, :dni_pa);");

        $this->db->bind(':nombre', $nuevo['nombre']);
        $this->db->bind(':apellidos', $nuevo['apellidos']);
        $this->db->bind(':dni', $nuevo['dni']);
        $this->db->bind(':fecha_naci', $nuevo['fecha_naci']);
        $this->db->bind(':telefono', $nuevo['telefono']);
        $this->db->bind(':email',$nuevo['email']);
        $this->db->bind(':direccion', $nuevo['direccion']);
        $this->db->bind(':ccc', $nuevo['ccc']);
        $this->db->bind(':talla', $nuevo['talla']);
        $this->db->bind(':rol', $nuevo['id_rol']);
        $this->db->bind(':pri_socio', $nuevo['pri_socio']);
        $this->db->bind(':nom_pa', $nuevo['nom_pa']);
        $this->db->bind(':ape_pa', $nuevo['ape_pa']);
        $this->db->bind(':dni_pa', $nuevo['dni_pa']);
        $this->db->bind(':pass', $nuevo['pass']);
        $this->db->execute();

        $id_usu = $this->db->ultimoIndice();  

        $this->db->query("INSERT INTO `SOCIO` (`id_socio`, `familiar`) VALUES ($id_usu, NULL);");
        $this->db->execute();


        $rol_usu=$nuevo['id_rol'];
        if($rol_usu=='2'){
            $this->db->query("INSERT INTO `ENTRENADOR` (`id_usuario`, `sueldo`) VALUES ($id_usu, NULL);");
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
        } else{
            return true;
        }      
 }



 public function editar_usuario($nuevo,$id){

    $this->db->query("UPDATE USUARIO SET dni=:dni, nombre=:nombre, apellidos=:apellidos, email=:email, direccion=:direccion, 
    fecha_nacimiento=:fecha_naci, telefono=:telefono, CCC=:ccc, talla=:talla, ha_sido=:pri_socio, id_rol=:rol , nom_pa=:nom_pa, ape_pa=:ape_pa, dni_pa=:dni_pa where id_usuario=:id;");

     $this->db->bind(':nombre', $nuevo['nombre']);
     $this->db->bind(':apellidos', $nuevo['apellidos']);
     $this->db->bind(':dni', $nuevo['dni']);
     $this->db->bind(':fecha_naci', $nuevo['fecha_naci']);
     $this->db->bind(':telefono', $nuevo['telefono']);
     $this->db->bind(':email',$nuevo['email']);
     $this->db->bind(':direccion', $nuevo['direccion']);
     $this->db->bind(':ccc', $nuevo['ccc']);
     $this->db->bind(':talla', $nuevo['talla']);
     $this->db->bind(':rol', $nuevo['id_rol']);
     $this->db->bind(':pri_socio', $nuevo['pri_socio']);
     $this->db->bind(':nom_pa', $nuevo['nom_pa']);
     $this->db->bind(':ape_pa', $nuevo['ape_pa']);
     $this->db->bind(':dni_pa', $nuevo['dni_pa']);

     $this->db->bind(':id', $id);
     
     $this->db->execute();


    $rol_usu=$nuevo['id_rol'];

     if($rol_usu=='2'){

        $this->db->query("SELECT count(id_usuario) as total from entrenador where id_usuario=$id;");
        $total= $this->db->registros();

       if($total[0]->total==0){
            $this->db->query("INSERT INTO `ENTRENADOR` (`id_usuario`, `sueldo`) VALUES ($id, NULL);");
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }
       }else{
            $this->db->query("UPDATE ENTRENADOR SET id_usuario=$id  where id_usuario=$id;");
            if ($this->db->execute()) {
                return true;
            } else {
                return false;
            }       
       }
    }else{
        return true;
    } 
}



  

}
