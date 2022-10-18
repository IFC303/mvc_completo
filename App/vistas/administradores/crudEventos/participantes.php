<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de participantes</span>
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
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>TELEFONO</th>
                            <th>EMAIL</th>
                            <th>DORSAL</th>
                            <th>MARCA</th>
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

                            <td class="datos_tabla"><?php echo $pEventos->nombre?></td>
                            <td class="datos_tabla"><?php echo $pEventos->apellidos?></td>
                            <td class="datos_tabla"><?php echo $pEventos->telefono?></td>
                            <td class="datos_tabla"><?php echo $pEventos->email?></td>
                            <td class="datos_tabla"><?php echo $pEventos->dorsal?></td>
                            <td class="datos_tabla"><?php echo $pEventos->marca?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>


                            <!-- EDITAR PARTICIPANTE -->
                            <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $pEventos->id_participante?>">
                            <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                            </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $pEventos->id_participante?>">
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

                                            <form method="post" action="<?php echo RUTA_URL?>/adminEventos/editar_participante/<?php echo $pEventos->id_participante?>">
                                                  
                                                <div class="row mt-4">
                                                    <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="nombre" class="input-group-text datInfo">Nombre <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $pEventos->nombre?>" required>    
                                                        </div> 
                                                    </div>

                                                    <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="apellidos" class="input-group-text datInfo">Apellidos<sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" value="<?php echo $pEventos->apellidos?>"  required >
                                                        </div>
                                                    </div>
                                                </div>  
                        
                                                <div class="row mt-2">
                                                    <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="fecha_naci" class="input-group-text datInfo">Fecha nacimiento <sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" value="<?php echo $pEventos->fecha_nacimiento?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="dni" class="input-group-text datInfo">DNI</label>
                                                            <input type="text" class="form-control form-control-md" id="dni" name="dni" value="<?php echo $pEventos->DNI?>" >
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row mt-2">
                                                    <div class="col-12">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="direccion" class="input-group-text datInfo">Direccion </label>
                                                            <input type="text" class="form-control form-control-md" id="direccion" name="direccion" value="<?php echo $pEventos->direccion?>" >
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row mt-2">
                                                    <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="telefono" class="input-group-text datInfo">Telefono <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $pEventos->telefono?>"  required>
                                                        </div>
                                                    </div>

                                                    <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="email" class="input-group-text datInfo">Correo</label>
                                                            <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $pEventos->email?>" >
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="d-flex justify-content-end">
                                                    <input type="submit" class="btn mt-4 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                                </div> 
                                                        
                  

                                            </form>

                                            </div>
                                            </div>

                                    </div>
                                    </div>
                                    </div>


                              <!-- BORRAR PARTICIPANTE -->
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $pEventos->id_participante?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $pEventos->id_participante?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quiere <b>BORRAR</b> al participante <b><?php echo $pEventos->nombre.' '.$pEventos->apellidos?></b> ? </p>
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


                                <!-- ANOTAR MARCA Y DORSAL -->
                                <a data-bs-toggle="modal" data-bs-target="#ModalAnotar_<?php echo $pEventos->id_participante?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>cronometro.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalAnotar_<?php echo $pEventos->id_participante?>">
                                    <div class="modal-dialog  modal-dialog-centered modal-md">
                                    <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Dorsal y marca</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>
  
                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 

                                            <form method="post" action="<?php echo RUTA_URL?>/adminEventos/anotar_marca/<?php echo $pEventos->id_participante?>">
                                                  
                                                <div class="row mt-2">
                                                    <div class="col-5">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="dorsal" class="input-group-text datInfo">Dorsal <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="dorsal" name="dorsal" value="<?php echo $pEventos->dorsal?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-7">
                                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                            <label for="marca" class="input-group-text datInfo">Marca <sup>*</sup></label>
                                                            <input type="time" step="0.001" class="form-control form-control-md" id="marca" name="marca" value="<?php echo $pEventos->marca?>" required>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class=" d-flex justify-content-end">
                                                    <input type="submit" class="btn mt-4 mb-2 " name="aceptar" id="confirmar" value="Confirmar">        
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


             <!-- AÑADIR PARTICIPANTE -->
            <div class="col text-center mt-5">
                <a data-bs-toggle="modal" data-bs-target="#nuevo">
                    <input type="button" id="anadir" class="btn me-2" value="AÑADIR">
                </a>
                <a class="btn" id="botonVolver" href="<?php echo RUTA_URL?>/adminEventos">VOLVER</a>
            </div>


            <div class="modal" id="nuevo">
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
                                                    
                        <form action="<?php echo RUTA_URL?>/adminEventos/nuevo_participante" method="post">

                                <div class="row mt-4">
                                    <div class="col-5">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="nombre" class="input-group-text datInfo">Nombre <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required>    
                                        </div> 
                                    </div>

                                    <div class="col-7">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="apellidos" class="input-group-text datInfo">Apellidos<sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="apellidos" name="apellidos" required >
                                        </div>
                                    </div>
                                </div>  
           
                                <div class="row mt-2">
                                    <div class="col-5">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="fecha_naci" class="input-group-text datInfo">Fecha nacimiento <sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_naci" name="fecha_naci" required>
                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="dni" class="input-group-text datInfo">DNI</label>
                                            <input type="text" class="form-control form-control-md" id="dni" name="dni">
                                        </div>
                                    </div>
                                </div>

                                <div class="row mt-2">
                                    <div class="col-12">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="direccion" class="input-group-text datInfo">Direccion </label>
                                            <input type="text" class="form-control form-control-md" id="direccion" name="direccion">
                                        </div>
                                    </div>
                                </div>


                                <div class="row mt-2">
                                    <div class="col-5">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="telefono" class="input-group-text datInfo">Telefono <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" required>
                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="input-group col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                            <label for="email" class="input-group-text datInfo">Correo</label>
                                            <input type="text" class="form-control form-control-md" id="email" name="email">
                                        </div>
                                    </div>
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

     
