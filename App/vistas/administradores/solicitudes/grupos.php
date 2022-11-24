<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Solicitudes escuela</span>
                </div>
                <div class="col-2 mt-2">
                    <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_URL ?>/login/logout">
                        <span>Logout</span>
                        <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                    </a>
                </div>
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->



<article>

        <table id="tabla" class="table">

                <!--CABECERA TABLA-->
                <thead>
                        <tr>
                                
                        <th>ID</th>
                        <th>FECHA SOLICITUD</th>
                        <th>NOMBRE</th>
                        <th>APELLIDOS</th>
                        <th>CATEGORIA</th>
                        <th>GRUPO</th>
                        <th>ES SOCIO</th>
              
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                <th>ACCIONES</th>
                        <?php endif ?>
                        </tr>
                </thead>


                <tbody>

                        <?php foreach ($datos['soli_grupos'] as $usuarios) : ?>
                                <tr>
                                        <td><?php echo $usuarios->id_soli_grupo?></td>
                                        <td><?php echo $usuarios->fecha_soli?></td>
                                        <td><?php echo $usuarios->nombre ?></td>
                                        <td><?php echo $usuarios->apellidos?></td>   
                                        <td><?php foreach($datos['categoria'] as $categoria){
                                                if($usuarios->id_categoria==$categoria->id_categoria){
                                                echo $categoria->nombre;}     
                                        }?></td> 
                                        <td><?php foreach($datos['grupo'] as $grupo){
                                                if($usuarios->id_grupo==$grupo->id_grupo){
                                                echo $grupo->nombre;}     
                                        }?></td>  
                                        <td><?php if($usuarios->es_socio==1){
                                                echo "Si";
                                        }else{ echo "No";
                                        }?></td>   


                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>

                                        <td>

                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $usuarios->id_soli_grupo?>" >
                                <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="editar_<?php echo $usuarios->id_soli_grupo?>">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">SOLICITUD Nº: <?php echo $usuarios->id_soli_grupo?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>
                                      
                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 

                                            <form method="post" action="<?php echo RUTA_URL?>/adminSolicitudes/editar_escuela/<?php echo $usuarios->id_soli_grupo?>">

                                                <p class="mt-3 mb-3 titulito">Datos del atleta</p>  
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="fecha" class="input-group-text">Fecha solicitud</label>
                                                                <input type="text" class="form-control form-control-md" name="fecha" id="fecha" value="<?php echo $usuarios->fecha_soli?>" readonly> 
                                                        </div> 
                                                        </div> 
                                                </div>
                                                         
                                        
                                                <div class="row mt-3 mb-3">
                                                <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="nomAtl" class="input-group-text">Nombre</label>
                                                        <input type="text" class="form-control" id="nomAtl" name="nombre" value="<?php echo $usuarios->nombre?>" required>
                                                        </div>
                                                </div>
                                                <div class="col-7">
                                                        <div class="input-group">
                                                        <label for="apelAtl" class="input-group-text">Apellidos</label>
                                                        <input type="text" class="form-control" id="apelAtl" name="apellidos" value="<?php echo $usuarios->apellidos?>" required>
                                                        </div>
                                                </div>
                                                </div>

                                                <div class="row mb-3">
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="fecha" class="input-group-text">Fecha Nacimiento <sup>*</sup></label>
                                                                <input class="form-control" type="date" id="fecha" name="fecha_naci"  value="<?php echo $usuarios->fecha_nacimiento?>" required>
                                                                </div>
                                                        </div>
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="dniAtl" id="dniObli" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control" id="dniAtl" name="dni" value="<?php echo $usuarios->dni?>">
                                                                </div>
                                                        </div>
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="telf" class="input-group-text">Telefono <sup>*</sup></label>
                                                                <input type="text" class="form-control" value="<?php echo $usuarios->telefono?>" required id="telf" name="telf" >
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="row mb-3">                            
                                                        <div class="col-12 input-group">
                                                                <label for="direc" class="input-group-text">Dirección <sup>*</sup></label>
                                                                <input type="text" class="form-control" id="direc" name="direc" value="<?php echo $usuarios->direccion?>" >
                                                        </div>
                                                </div>
                                                <div class="row mb-3">                            
                                                        <div class="col-5">
                                                                <div class="input-group">
                                                                <label for="ccc" class="input-group-text">CCC <sup>*</sup></label>
                                                                <input type="text" class="form-control"  id="ccc" name="ccc" value="<?php echo $usuarios->cuenta?>" required>
                                                                </div>
                                                        </div>
                                                        <div class="col-7">
                                                                <div class="input-group">
                                                                <label for="email" class="input-group-text">Email <sup>*</sup></label>
                                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $usuarios->email?>" required>
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                                <div class="input-group">                                          
                                                                <label for="cat" class="input-group-text">Categoría</label>
                                                                <select name="cat" id="cat" class="form-control" required>
                                                                        <option value="">-- Selecciona una categoria --</option>
                                                                        <?php foreach ($datos['categoria'] as $cat) : ?>
                                                                <option value="<?php echo $cat->id_categoria?>" <?php if($cat->id_categoria==$usuarios->id_categoria) echo "selected";?>> <?php echo $cat->nombre ?></option>
                                                                <?php endforeach ?>
                                                                </select>                                                                                         
                                                                </div>
                                                        </div>
                                                        <div class="col-7">
                                                                <div class="input-group">
                                                                <label for="grup" class="input-group-text">Grupo entrenamiento</label>
                                                                <select name="grup" id="grup" class="form-control" required>
                                                                        <option value="">-- Selecciona una categoria --</option>
                                                                        <?php foreach ($datos['grupo'] as $gru) : ?>
                                                                <option value="<?php echo $gru->id_grupo?>" <?php if($gru->id_grupo==$usuarios->id_grupo) echo "selected";?>> <?php echo $gru->nombre ?></option>
                                                                <?php endforeach ?>
                                                                </select>
                                                                </div>
                                                        </div>                           
                                                </div>
                                                <div class="row mb-3">                            
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="gir" class="input-group-text">GIR</label>
                                                                <input type="text" class="form-control" value="<?php echo $usuarios->gir?>" id="gir" name="gir">
                                                                </div>
                                                        </div>
                                                        <div class="col-2">
                                                                <div class="input-group">
                                                                <label for="" class="input-group-text">Es socio</label>
                                                                <select name="socio" id="socio<?php echo $usuarios->id_soli_escuela?>" class="form-control" onchange="asociar(<?php echo $usuarios->id_soli_escuela?>)" required>
                                                                        <option value="1" <?php if($usuarios->es_socio==1) echo "selected";?>>Si</option>
                                                                        <option value="0" <?php if($usuarios->es_socio==0) echo "selected";?>>No</option>
                                                                </select>
                                                                </div>
                                                        </div>

                                                      
                                                        <div class="col-6" id="elegir<?php echo $usuarios->id_soli_grupo?>" <?php if($usuarios->es_socio==1){ echo "style='display:block'";}elseif($usuarios->es_socio==0){echo "style='display:none'";}?>id="elegir">
                                                        <div class="input-group">
                                                        <label for="" class="input-group-text">Asocia un solicitud a socio</label>
                                                        <input class="form-control" type="text" name="usus" list="ele">
                                                        <datalist  id="ele" name="">
                                                     
                                                                <?php foreach ($datos['usus'] as $usus) : ?>
                                                                <option value="<?php echo $usus->id_usuario?>" > <?php echo $usus->nombre.' '. $usus->apellidos ?></option>
                                                                <?php endforeach ?>      
                                                
                                                        </datalist>
                                                        
                                                        </div>
                                                        </div>

      

                                                </div>
                                                <div class="row mb-1">
                                                <p class="mt-4 mb-3 titulito">Datos del padre,madre o tutor</p>  
                                                </div>
                                                <div class="row mb-3">
                                                <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="nomPa" class="input-group-text">Nombre</label>
                                                        <input type="text" class="form-control" value="<?php echo $usuarios->nom_pa?>"  id="nomPa" name="nom_pa">
                                                        </div>
                                                </div>
                                                <div class="col-7">
                                                        <div class="input-group">
                                                        <label for="apelPa" class="input-group-text">Apellidos</label>
                                                        <input type="text" class="form-control" value="<?php echo $usuarios->ape_pa?>"id="apePa" name="ape_pa">
                                                        </div>
                                                </div>
                                                </div>

                                                <div class="row mb-4">
                                                <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="dniPa" id="dniPa" class="input-group-text">DNI</label>
                                                        <input type="text" class="form-control" value="<?php echo $usuarios->dni_pa?>" id="dniPa" name="dni_pa">
                                                        </div>
                                                </div>
                                                </div>


                                          

                                                <div class=" d-flex justify-content-end">
                                                    <input type="submit" class="btn mt-3 mb-4 " name="aceptar" id="confirmar" value="Guardar cambios">        
                                                </div> 
                  

                                            </form>

                                            </div>
                                            </div>

                                    </div>
                                    </div>
                                    </div>



                                        <!--MODAL BORRAR-->
                                        <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $usuarios->id_soli_grupo?>">
                                                <img class="icono" src="<?php echo RUTA_Icon ?>x1.png"></img>
                                        </a>

                                        <div class="modal" id="borrar_<?php echo $usuarios->id_soli_grupo?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                        <p>Estas seguro que quieres <b>BORRAR</b> la solicitud para la escuela de <b><?php echo $usuarios->nombre . " " . $usuarios->apellidos ?></b> ?</p>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                        <form action="<?php echo RUTA_URL ?>/adminSolicitudes/borrar_escuela/<?php echo $usuarios->id_soli_grupo?>" method="post">
                                                        <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                        </form>
                                                </div>

                                        </div>
                                        </div>
                                        </div>



                                        <!-- MODAL ACEPTAR-->
                                        <a data-bs-toggle="modal" data-bs-target="#confirmar_<?php echo $usuarios->id_soli_grupo?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>tick.png"></img>
                                        </a>                                        

                                        <div class="modal" id="confirmar_<?php echo $usuarios->id_soli_grupo?>">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul ">
                                                <p class="modal-title">SOLICITUD Nº: <?php echo $usuarios->id_soli_grupo?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info">                         
                                        <div class="row ms-1 me-1">                                              
                                                                                                    
                                                    
                                        <form action="<?php echo RUTA_URL ?>/adminSolicitudes/aceptar_escuela/<?php echo $usuarios->id_soli_grupo?>" method="post">
                                                           
                                                <p class="mt-3 mb-3 titulito">Datos del atleta</p>  
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="fecha" class="input-group-text">Fecha solicitud</label>
                                                                <input type="text" class="form-control form-control-md" name="fecha" id="fecha" value="<?php echo $usuarios->fecha_soli?>" readonly> 
                                                        </div> 
                                                        </div> 
                                                </div>
                                                         
                                        
                                                <div class="row mt-3 mb-3">
                                                <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="nomAtl" class="input-group-text">Nombre</label>
                                                        <input type="text" class="form-control" id="nomAtl" name="nombre" value="<?php echo $usuarios->nombre?>" readonly >
                                                        </div>
                                                </div>
                                                <div class="col-7">
                                                        <div class="input-group">
                                                        <label for="apelAtl" class="input-group-text">Apellidos</label>
                                                        <input type="text" class="form-control" id="apelAtl" name="apellidos" value="<?php echo $usuarios->apellidos?>" readonly>
                                                        </div>
                                                </div>
                                                </div>

                                                <div class="row mb-3">
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="fecha" class="input-group-text">Fecha Nacimiento <sup>*</sup></label>
                                                                <input class="form-control" type="date" id="fecha" name="fecha_naci"  value="<?php echo $usuarios->fecha_nacimiento?>" readonly>
                                                                </div>
                                                        </div>
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="dniAtl" id="dniObli" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control" id="dniAtl" name="dni" value="<?php echo $usuarios->dni?>" readonly>
                                                                </div>
                                                        </div>
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="telf" class="input-group-text">Telefono <sup>*</sup></label>
                                                                <input type="text" class="form-control" value="<?php echo $usuarios->telefono?>" readonly id="telf" name="telf" >
                                                                </div>
                                                        </div>
                                                </div>

                                                <div class="row mb-3">                            
                                                        <div class="col-12 input-group">
                                                                <label for="direc" class="input-group-text">Dirección <sup>*</sup></label>
                                                                <input type="text" class="form-control" id="direc" name="direc" value="<?php echo $usuarios->direccion?>" readonly>
                                                        </div>
                                                </div>
                                                <div class="row mb-3">                            
                                                        <div class="col-5">
                                                                <div class="input-group">
                                                                <label for="ccc" class="input-group-text">CCC <sup>*</sup></label>
                                                                <input type="text" class="form-control"  id="ccc" name="ccc" value="<?php echo $usuarios->cuenta?>" readonly  >
                                                                </div>
                                                        </div>
                                                        <div class="col-7">
                                                                <div class="input-group">
                                                                <label for="email" class="input-group-text">Email <sup>*</sup></label>
                                                                <input type="text" class="form-control" id="email" name="email" value="<?php echo $usuarios->email?>" readonly>
                                                                </div>
                                                        </div>
                                                </div>
                                        
                                                <div class="row mb-3">
                                                        <div class="col-5">
                                                                <div class="input-group">                                          
                                                                <label for="cat" class="input-group-text">Categoría</label>
                                                                <input type="text" class="form-control"   
                                                                        <?php foreach ($datos['categoria'] as $cat){ 
                                                                        if ($cat->id_categoria==$usuarios->id_categoria){?>
                                                                        value="<?php echo $cat->nombre ?>"
                                                                <?php }}?>                                                      
                                                                readonly  >    
                                                                <input type="hidden" name="cat" value="<?php echo $usuarios->id_categoria?>">                                     
                                                                </div>
                                                        </div>
                                                        <div class="col-7">
                                                                <div class="input-group">
                                                                <label for="grup" class="input-group-text">Grupo entrenamiento</label>
                                                                <input type="text" class="form-control"   
                                                                        <?php foreach ($datos['grupo'] as $gru){ 
                                                                        if ($gru->id_grupo==$usuarios->id_grupo){?>
                                                                        value="<?php echo $gru->nombre ?>"
                                                                <?php }}?>                                                      
                                                                readonly  >
                                                                <input type="hidden" name="grup" value="<?php echo $usuarios->id_grupo?>">  
                                                                </div>
                                                        </div>                           
                                                </div>
                                                <div class="row mb-3">                            
                                                        <div class="col-4">
                                                                <div class="input-group">
                                                                <label for="gir" class="input-group-text">GIR</label>
                                                                <input type="text" class="form-control" value="<?php echo $usuarios->gir?>" id="gir" name="gir" readonly>
                                                                </div>
                                                        </div>
                                                        <div class="col-2">
                                                                <div class="input-group">
                                                                <label for="" class="input-group-text">Es socio</label>
                                                                <input type="text" name="socio" class="form-control" value="<?php 
                                                                    if ($usuarios->es_socio =='1'){
                                                                        echo 'Si';
                                                                    }else{
                                                                        echo 'No';
                                                                    }?>"readonly>
                                                                </div>
                                                        </div>
                                                        <div class="col-6">
                                                                <div class="input-group">
                                                                <label for="" class="input-group-text">Solicitud asociada a</label>
                                                                <input type="text" id="usua<?php echo $usuarios->id_soli_grupo?>" class="form-control"   
                                                                        <?php foreach ($datos['usus'] as $usu){ 
                                                                        if ($usu->id_usuario==$usuarios->usuario){?>
                                                                        value="<?php echo $usu->nombre.' '.$usu->apellidos?>"
                                                                <?php }}?> 
                                                                    readonly>
                                                                    <input type="hidden" name="usus" value="<?php echo $usuarios->usuario?>">  
                                                                </div>
                                                        </div>
                                                        


                                                </div>
                                                <div class="row mb-1">
                                                <p class="mt-4 mb-3 titulito">Datos del padre,madre o tutor</p>  
                                                </div>
                                                <div class="row mb-3">
                                                <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="nomPa" class="input-group-text">Nombre</label>
                                                        <input type="text" class="form-control" value="<?php echo $usuarios->nom_pa?>"  id="nomPa" name="nom_pa" readonly>
                                                        </div>
                                                </div>
                                                <div class="col-7">
                                                        <div class="input-group">
                                                        <label for="apelPa" class="input-group-text">Apellidos</label>
                                                        <input type="text" class="form-control" value="<?php echo $usuarios->ape_pa?>"id="apePa" name="ape_pa" readonly>
                                                        </div>
                                                </div>
                                                </div>

                                                <div class="row mb-4">
                                                <div class="col-5">
                                                        <div class="input-group">
                                                        <label for="dniPa" id="dniPa" class="input-group-text">DNI</label>
                                                        <input type="text" class="form-control" value="<?php echo $usuarios->dni_pa?>" id="dniPa" name="dni_pa" readonly>
                                                        </div>
                                                </div>
                                                </div>


                                                <div class=" d-flex justify-content-end">
                                                        <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" onclick="return confi(<?php echo $usuarios->id_soli_grupo?>)" value="Confirmar solicitud">        
                                                </div> 

                                        </form>                                                
                                        </div>
                                        </div>
                                        
                                        </div>
                                        </div>
                                        </div>
                                                       
                                        </td>

                                        <?php endif ?>
                                </tr>
                        <?php endforeach ?>
                </tbody>

        </table>

</article>



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

<script>


function confi(id){
        var usuario=document.getElementById("usua"+id).value
        if(usuario!=''){
               return true;              
        }else{
                alert("Esta solicutud no esta asociada a ningun socio. No se puede confirmar. Edita la solicitud y asociala a un socio para poder confirmarla") 
                return false;
        }
}


function asociar(id){
 var socio=document.getElementById("socio"+id).value
 console.log(socio);

 if(socio==1){
         document.getElementById("elegir"+id).style.display ="block";
 }else if(socio==0){
        document.getElementById("elegir"+id).style.display ="none";
 }

}


</script>