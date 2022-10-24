<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de temporadas</span>
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
                            <th>NOMBRE</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['temporada'] as $temporada): ?>
                        <tr>

                            <td><?php echo $temporada->id_temp?></td>
                            <td><?php echo $temporada->nombre?></td>
                            <td><?php echo $temporada->fecha_inicio?></td>
                            <td><?php echo $temporada->fecha_fin?></td>
     
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            <td>

                                <!-- MODAL VER-->                 
                                <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $temporada->id_temp?>">
                                    <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                                </a>

                                <div class="modal" id="ver<?php echo $temporada->id_temp?>">
                                <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3">Informacion</p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>
                            

                                        <!-- Modal body -->
                                        <div class="modal-body info mb-3">    
                                        <div class="row ms-1">                      
                             
                                                <div class="row mt-4">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="nombre" class="input-group-text">Nombre</label>
                                                            <input type="text" class="form-control form-control-md"  id="nombre" name="nombre" value="<?php echo $temporada->nombre?>" readonly>
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="fecha_ini" class="input-group-text">Fecha inicio<sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" value="<?php echo $temporada->fecha_inicio?>" readonly>    
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="fecha_fin" class="input-group-text">Fecha fin<sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_fin" name="fecha_fin" value="<?php echo $temporada->fecha_fin?>" readonly >
                                                        </div> 
                                                    </div> 
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <textarea  type="text" style="height:200px" class="form-control" id="observaciones" name="observaciones" readonly> <?php echo $temporada->observaciones?></textarea>
                                                        </div> 
                                                    </div> 
                                                </div>
                                        </div>
                                        </div>
                                </div>
                                </div>
                                </div>


                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $temporada->id_temp?>" >
                                <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="editar_<?php echo $temporada->id_temp?>">
                                    <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>
                                      
                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 

                                            <form method="post" action="<?php echo RUTA_URL?>/adminTemporadas/editar/<?php echo $temporada->id_temp?>">

                                                <div class="row mt-4">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="nombre" class="input-group-text">Nombre</label>
                                                            <input type="text" class="form-control form-control-md"  id="nombre" name="nombre" value="<?php echo $temporada->nombre?>" required>
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="fecha_ini" class="input-group-text">Fecha inicio<sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" value="<?php echo $temporada->fecha_inicio?>" required>    
                                                        </div> 
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="fecha_fin" class="input-group-text">Fecha fin<sup>*</sup></label>
                                                            <input type="date" class="form-control form-control-md" id="fecha_fin" name="fecha_fin" value="<?php echo $temporada->fecha_fin?>" required>
                                                        </div> 
                                                    </div> 
                                                </div>

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <textarea  type="text" style="height:200px" class="form-control" id="observaciones" name="observaciones"  value="<?php echo $temporada->observaciones?>"><?php echo $temporada->observaciones?></textarea>
                                                        </div> 
                                                    </div> 
                                                </div>
                                            
                                                
                                                <div class=" d-flex justify-content-end">
                                                    <input type="submit" class="btn mt-3 mb-4 " name="aceptar" id="confirmar" value="Confirmar">        
                                                </div> 
                  

                                            </form>

                                            </div>
                                            </div>

                                    </div>
                                    </div>
                                    </div>



                                <!-- MODAL BORRAR -->
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $temporada->id_temp?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="borrar_<?php echo $temporada->id_temp?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quieres <b>BORRAR</b> la temporada <b><?php echo $temporada->nombre?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminTemporadas/borrar/<?php echo $temporada->id_temp?>" method="post">
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


        

        <!-- AÑADIR NUEVA TEMPORADA-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nueva Temporada">
            </a>
        </div>


        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Alta de temporadas</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/adminTemporadas/nuevo" method="post">

                                <div class="row mt-4">
                                    <div class="col-12">
                                        <div class="input-group mb-4">
                                            <label for="nombre" class="input-group-text">Nombre</label>
                                            <input type="text" class="form-control form-control-md"  id="nombre" name="nombre" required>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group mb-4">
                                            <label for="fecha_ini" class="input-group-text">Fecha inicio<sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_ini" name="fecha_ini" required>    
                                        </div> 
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group mb-4">
                                            <label for="fecha_fin" class="input-group-text">Fecha fin<sup>*</sup></label>
                                            <input type="date" class="form-control form-control-md" id="fecha_fin" name="fecha_fin" required >
                                        </div> 
                                    </div> 
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group mb-4">
                                            <textarea  type="text" style="height:200px" class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones"></textarea>
                                        </div> 
                                    </div> 
                                </div>


                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                               </div> 

                        </form>

                        </div>
                        </div>

        </div>
        </div>
        </div>


</article>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

