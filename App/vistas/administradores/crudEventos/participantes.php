<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center ">
                    <span id="textoHead">Participantes - <?php echo $datos['datos_evento']->nombre ?></span>
                </div>
                <div class="col-2 mt-1">
                    <a href="<?php echo RUTA_URL ?>/login/logout">
                        <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
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
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>TELEFONO</th>
                            <th>EMAIL</th>
                            <th>PAGO</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                     <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['participantesEventos'] as $pEventos): ?>
                        <tr>

                            <td><?php echo $pEventos->nombre?></td>
                            <td><?php echo $pEventos->apellidos?></td>
                            <td><?php echo $pEventos->telefono?></td>
                            <td><?php echo $pEventos->email?></td>
                            <td><?php if ($pEventos->foto_pago==''){echo '-';
                                 }else {?> 
                                    <a data-bs-toggle="modal" data-bs-target="#foto<?php echo $pEventos->id_participante?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>foto.svg"></img>
                                    </a>
                                    <div class="modal" id="foto<?php echo $pEventos->id_participante?>">
                                    <div class="modal-dialog modal-fullscreen">
                                    <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body info"> 
                                            <div>
                                            <img id="output" src="<?php echo RUTA_Justificante.$pEventos->id_participante.'.jpg'?>">
                                            </div> 
                                        </div>

                                    </div>
                                    </div>
                                    </div>
                                <?php } ?>
                            </td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>


                            <!-- EDITAR PARTICIPANTE -->
                            <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $pEventos->id_participante?>">
                            <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                            </a>

                            
                                    <!-- Ventana -->
                                    <div class="modal fade" id="editar_<?php echo $pEventos->id_participante?>">
                                    <div class="modal-dialog  modal-dialog-centered modal-xl">
                                    <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 

                                            <form method="post" enctype="multipart/form-data" action="<?php echo RUTA_URL?>/adminEventos/editar_participante/<?php echo $pEventos->id_participante?>">
                                                  
                                                <div class="row mt-4 mb-4">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $pEventos->nombre?>" required>    
                                                        </div> 
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="apellidos" class="input-group-text">Apellidos<sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $pEventos->apellidos?>"  required >
                                                        </div>
                                                    </div>
                                                </div>  
                        
                                                <div class="row mb-4">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="fecha_naci" class="input-group-text">Fecha nacimiento <sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" value="<?php echo $pEventos->fecha_nacimiento?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="dni" class="input-group-text">DNI</label>
                                                            <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $pEventos->dni?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mb-4">
                                                    <div class="input-group">
                                                        <label for="direccion" class="input-group-text">Direccion </label>
                                                        <input type="text" class="form-control form-control-md" id="direccion" name="direccion" value="<?php echo $pEventos->direccion?>" >
                                                    </div>
                                                </div>


                                                <div class="row mb-5">
                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $pEventos->telefono?>"  required>
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="input-group">
                                                            <label for="email" class="input-group-text">Correo</label>
                                                            <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $pEventos->email?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-4 text-start">
                                                    <p style="font-weight:bold;color:#0070c6;text-decoration:underline">Adjuntar justificante de pago (formato .jpg)</p>
                                                </div>
                                                <div class="mt-2 text-start">
                                                    <input  accept="image/*" type="file"  onchange="loadFile(event)" id="editar_foto" name="editar_foto">
                                                    <input type="hidden" id="foto_anterior" name="foto_anterior" value=<?php echo $pEventos->foto_pago?>>
                                                </div>


                                                <div class="d-flex justify-content-end">
                                                    <input type="hidden" name="id_evento" id="id_evento" value="<?php echo $datos['id_evento'][0]?>">
                                                    <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                                </div> 
                                                        
                                            </form>

                                            </div>
                                            </div>

                                    </div>
                                    </div>
                                    </div>


                              <!-- BORRAR PARTICIPANTE -->
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $pEventos->id_participante?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="borrar_<?php echo $pEventos->id_participante?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quieres <b>BORRAR</b> al participante <b><?php echo $pEventos->nombre.' '.$pEventos->apellidos?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEventos/borrar_participante/<?php echo $pEventos->id_participante?>" method="post">
                                                    <input type="hidden" name="id_evento" id="id_evento" value="<?php echo $datos['id_evento'][0]?>">
                                                    <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                                </form>
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


             <!-- AÑADIR PARTICIPANTE -->
            <div class="col text-center mt-5">
                <a data-bs-toggle="modal" data-bs-target="#nuevo">
                    <input type="button" id="anadir" class="btn me-2" value="Nuevo participante">
                </a>
                <a class="btn" id="botonVolver" href="<?php echo RUTA_URL?>/adminEventos">VOLVER</a>
            </div>


            <div class="modal fade" id="nuevo">
            <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Alta de participantes</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/adminEventos/nuevo_participante"  enctype="multipart/form-data" method="post">

                                <div class="row mt-4 mb-4">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required>    
                                        </div> 
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="apellidos" class="input-group-text">Apellidos<sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" required >
                                        </div>
                                    </div>
                                </div>  
           
                                <div class="row mb-4">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="fecha_naci" class="input-group-text">Fecha nacimiento <sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="dni" class="input-group-text">DNI</label>
                                            <input type="text" class="form-control form-control-md" id="dni" name="dni">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="input-group">
                                        <label for="direccion" class="input-group-text">Direccion </label>
                                        <input type="text" class="form-control form-control-md" id="direccion" name="direccion">
                                    </div>
                                </div>


                                <div class="row mb-5">
                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" required>
                                        </div>
                                    </div>

                                    <div class="col-6">
                                        <div class="input-group">
                                            <label for="email" class="input-group-text">Correo</label>
                                            <input type="text" class="form-control form-control-md" id="email" name="email">
                                        </div>
                                    </div>
                                </div>

                              
                                <div class="row mt-4">
                                    <p style="font-weight:bold;color:#0070c6;text-decoration:underline">Adjuntar justificante de pago (formato .jpg)</p>
                                </div>
                                <div class="mt-2">
                                    <input  accept="image/*" type="file"  onchange="loadFile(event)" id="subirFoto" name="subirFoto">
                                </div>


                                
                                <div class="d-flex justify-content-end">
                                    <input type="hidden" id="id_evento" name="id_evento" value="<?php echo $datos['id_evento'][0]?>">
                                    <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                               </div> 

                        </form>

                    </div>
                    </div>

            </div>
            </div>
            </div>

    </article>





<script>

    var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
    URL.revokeObjectURL(output.src)
    }
    };


</script>
