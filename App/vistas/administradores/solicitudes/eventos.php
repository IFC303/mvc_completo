<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Solicitudes eventos</span>
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

<!-- <div style="text-align: center;">
        <form method="post" id="radioChe" class="card-body" action="<?php echo RUTA_URL ?>/admin/crud_solicitudes_eventos/">
                <input type="radio" name="opcion" value="socio" id="socio" <?php if ($datos['radioCheck'] == "socio") {
                                                                                        echo "checked";
                                                                                } ?>>&nbsp;<label for="socio">Ver solicitudes socio</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="opcion" value="externo" id="externo" <?php if ($datos['radioCheck'] == "externo") {
                                                                                        echo "checked";
                                                                                } ?>>&nbsp;<label for="externo">Ver solicitudes externo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input onclick="enviarSociExter()" class="btn" type="submit" name="enviar" value="Cargar">
        </form>
</div> -->

        <article>
                <table id="tabla" class="table">

                        <!--CABECERA TABLA-->
                        <thead>
                        <tr>
                                <th>ID</th>  
                                <th>FECHA SOLICITUD</th>        
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>EVENTO</th>
                                <th>JUSTIFICANTE</th>
                                

                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>ACCIONES</th>
                        
                                <?php endif ?>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($datos['soliEvento'] as $usuarios) : ?>
                                <tr>
                                <td><?php echo $usuarios->id_solicitud?></td>   
                                <td><?php echo $usuarios->fecha?></td>                           
                                <td><?php echo $usuarios->nombre?></td>
                                <td><?php echo $usuarios->apellidos?></td>
                                <td><?php echo $usuarios->nombre_evento?></td>

                                <td><?php if ($usuarios->foto==''){echo '-';
                                 }else {?> 
                                    <a data-bs-toggle="modal" data-bs-target="#justi<?php echo $usuarios->id_solicitud?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>foto.svg"></img>
                                    </a>
                                    <div class="modal" id="justi<?php echo $usuarios->id_solicitud?>">
                                    <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info"> 
                                            <div>
                                                <img id="output" height=75% width=75% src="<?php echo RUTA_Justificante.$usuarios->id_solicitud.'.jpg'?>">
                                            </div> 
                                        </div>

                                    </div>
                                    </div>
                                    </div>
                                <?php } ?>
                            </td>
                                


                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                <td>


                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $usuarios->id_solicitud?>" >
                                <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="editar_<?php echo $usuarios->id_solicitud?>">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Solicitud Nº: <?php echo $usuarios->id_solicitud?> </p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>
                                      
                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 

                                            <form method="post" action="<?php echo RUTA_URL?>/adminSolicitudes/editar_evento/<?php echo $usuarios->id_solicitud?>">
                                                
                                                <div class="row mt-4 mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="fecha" class="input-group-text">Fecha solicitud</label>
                                                                <input type="text" class="form-control form-control-md" name="fecha" id="fecha" value="<?php echo $usuarios->fecha?>" readonly> 
                                                        </div> 
                                                        </div> 

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="nombre_evento" class="input-group-text">Evento</label>
                                                                <select class="form-control" name="evento" id="evento" required>
                                                                        <option value="">-- Seleciona un evento --</option>
                                                                        <?php foreach ($datos['eventos'] as $even) : ?>
                                                                        <option value="<?php echo $even->id_evento?>" <?php if($even->id_evento==$usuarios->id_evento){ echo "selected";};?>><?php echo $even->nombre ?></option>
                                                                        <?php endforeach ?>
                                                                </select>
                                                        </div>
                                                        </div>
       
                                                </div>
                                                         
                                        
                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="nombre" class="input-group-text">Nombre</label>
                                                                <input type="text" class="form-control form-control-md" name="nombre" id="nombre" value="<?php echo $usuarios->nombre?>">    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="apellidos" class="input-group-text">Apellidos</label> 
                                                                <input type="text" class="form-control form-control-md"  name="apellidos" id="apellidos" value="<?php echo $usuarios->apellidos?>">        
                                                        </div>
                                                        </div>
                                                </div>  

                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="dni" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $usuarios->DNI?>">    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="f_naci" class="input-group-text">Fecha Nacimiento</label>
                                                                <input type="date" class="form-control form-control-md" name="f_naci" id="f_naci" value="<?php echo $usuarios->fecha_nacimiento?>"> 
                                                        </div>
                                                        </div>
                                                </div> 


                                                <div class="row mb-4">
                                                        <div class="input-group">
                                                                <label for="direccion" class="input-group-text">Direccion</label>
                                                                <input type="text" class="form-control form-control-md" name="direccion" id="direccion" value="<?php echo $usuarios->direccion?>"> 
                                                        </div> 
                                                </div>


                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="telefono" class="input-group-text">Telefono</label>
                                                                <input type="text" class="form-control form-control-md" name="telefono" id="telefono" value="<?php echo $usuarios->telefono?>"> 
                                                        </div>
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="email" class="input-group-text">Email</label> 
                                                                <input type="text" class="form-control form-control-md" name="email" id="email"  value="<?php echo $usuarios->email?>"> 
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
                                        <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $usuarios->id_solicitud?>">
                                                <img class="icono" src="<?php echo RUTA_Icon ?>x1.png"></img>
                                        </a>

                                        <div class="modal" id="borrar_<?php echo $usuarios->id_solicitud?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                        <p>Estas seguro que quieres <b>BORRAR</b> la solicitud para el evento <?php echo $usuarios->nombre_evento?> de <b><?php echo $usuarios->nombre . " " . $usuarios->apellidos ?></b> ?</p>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                        <form action="<?php echo RUTA_URL ?>/adminSolicitudes/borrar_evento/<?php echo $usuarios->id_solicitud?>" method="post">
                                                        <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                        </form>
                                                </div>

                                        </div>
                                        </div>
                                        </div>



                                        <!-- MODAL ACEPTAR-->
                                        <a data-bs-toggle="modal" data-bs-target="#confirmar_<?php echo $usuarios->id_solicitud?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>tick.png"></img>
                                        </a>                                        

                                        <div class="modal" id="confirmar_<?php echo $usuarios->id_solicitud ?>">
                                        <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header mb-3 ">
                                                <p class="modal-title">SOLICITUD Nº: <?php echo $usuarios->id_solicitud?></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info">                         
                                        <div class="row ms-1 me-1">                                              
                                                                                                    
                                                    
                                        <form action="<?php echo RUTA_URL ?>/adminSolicitudes/aceptar_evento/<?php echo $usuarios->id_solicitud?>" method="post">
                                                                                      
                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="fecha" class="input-group-text">Fecha solicitud</label>
                                                                <input type="date" class="form-control form-control-md" name="fecha" id="fecha" value="<?php echo $usuarios->fecha?>" readonly> 
                                                        </div> 
                                                        </div> 

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="nombre_evento" class="input-group-text">Evento</label>
                                                                <input type="text" class="form-control form-control-md" name="nombre_evento" id="nombre_evento" value="<?php echo $usuarios->nombre_evento?>" readonly> 
                                                        </div>
                                                        </div>
       
                                                </div>
                                                         
                                        
                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="nombre" class="input-group-text">Nombre</label>
                                                                <input type="text" class="form-control form-control-md" name="nombre" id="nombre" value="<?php echo $usuarios->nombre?>" readonly>    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="apellidos" class="input-group-text">Apellidos</label> 
                                                                <input type="text" class="form-control form-control-md"  name="apellidos" id="apellidos" value="<?php echo $usuarios->apellidos?>"readonly >        
                                                        </div>
                                                        </div>
                                                </div>  

                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="dni" class="input-group-text">DNI</label>
                                                                <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $usuarios->DNI?>" readonly>    
                                                        </div> 
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="f_naci" class="input-group-text">Fecha Nacimiento</label>
                                                                <input type="date" class="form-control form-control-md" name="f_naci" id="f_naci" value="<?php echo $usuarios->fecha_nacimiento?>" readonly> 
                                                        </div>
                                                        </div>
                                                </div> 


                                                <div class="row mb-4">
                                                        <div class="input-group">
                                                                <label for="direccion" class="input-group-text">Direccion</label>
                                                                <input type="text" class="form-control form-control-md" name="direccion" id="direccion" value="<?php echo $usuarios->direccion?>" readonly> 
                                                        </div> 
                                                </div>


                                                <div class="row mb-4">
                                                        <div class="col-5">
                                                        <div class="input-group">
                                                                <label for="telefono" class="input-group-text">Telefono</label>
                                                                <input type="text" class="form-control form-control-md" name="telefono" id="telefono" value="<?php echo $usuarios->telefono?>" readonly> 
                                                        </div>
                                                        </div>

                                                        <div class="col-7">
                                                        <div class="input-group">
                                                                <label for="email" class="input-group-text">Email</label> 
                                                                <input type="text" class="form-control form-control-md" name="email" id="email"  value="<?php echo $usuarios->email?>" readonly> 
                                                        </div>
                                                        </div>
                                                </div>

                                                <div class=" d-flex justify-content-end">
                                                        <input type="hidden" name="id_evento" value="<?php echo $usuarios->id_evento?>">
                                                        <input type="hidden" name="nombre_evento" value="<?php echo $usuarios->nombre_evento?>">
                                                        <input type="submit" class="btn mt-3 mb-4 " name="aceptar" id="confirmar" value="Confirmar solicitud">        
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

        var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
        URL.revokeObjectURL(output.src)
        }
        };

        var loadFile2 = function(event,id) {
        var output = document.getElementById('outputEdit'+id);
        console.log(output);
        output.src = URL.createObjectURL(event.target.files[0]);
        //console.log(output.src);
        output.onload = function() {
        URL.revokeObjectURL(output.src)
        }
        };


</script>




        
