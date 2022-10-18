<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de entidades</span>
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
                            <th>CIF</th>
                            <th>NOMBRE</th>
                            <th>TELEFONO</th>
                            <th>CORREO</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['entidad'] as $entidad): ?>
                        <tr>

                            <td><?php echo $entidad->cif?></td>
                            <td><?php echo $entidad->nombre?></td>
                            <td><?php echo $entidad->telefono?></td>
                            <td><?php echo $entidad->email?></td>
     
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            <td>

                                <!-- MODAL VER-->                 
                                <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $entidad->id_entidad?>">
                                    <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                                </a>

                                <div class="modal" id="ver<?php echo $entidad->id_entidad?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
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
                                                    <div class="col-5">
                                                        <div class="input-group mb-4">
                                                            <label for="cif" class="input-group-text">CIF </label>
                                                            <input type="text" class="form-control form-control-md" id="cif" name="cif" value="<?php echo $entidad->cif?>"readonly>    
                                                        </div> 
                                                    </div>
                                                    <div class="col-7">
                                                        <div class="input-group mb-4">
                                                            <label for="nombre" class="input-group-text">Nombre </label>
                                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $entidad->nombre?>"readonly>
                                                        </div>
                                                    </div>
                                                </div>  

                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="direccion" class="input-group-text">Direccion </label>
                                                            <input type="text" class="form-control form-control-md"  id="direccion" name="direccion" value="<?php echo $entidad->direccion?>"readonly>
                                                        </div> 
                                                    </div> 
                                                </div>


                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="input-group mb-4">
                                                            <label for="telefono" class="input-group-text">Telefono </label>
                                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $entidad->telefono?>"readonly>
                                                        </div>
                                                    </div>

                                                    <div class="col-7">
                                                        <div class="input-group mb-4">
                                                            <label for="email" class="input-group-text">Email </label>
                                                            <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $entidad->email?>"readonly>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-5">
                                                            <label for="observaciones" class="input-group-text">Observaciones </label>
                                                            <input type="text" class="form-control form-control-md"  id="observaciones" name="observaciones" value="<?php echo $entidad->observaciones?>"readonly>
                                                        </div> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                    

                
                                </div>
                                </div>
                                </div>


                                <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $entidad->id_entidad?>" >
                                <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $entidad->id_entidad?>">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>
                                      
                                            <!-- Body -->
                                            <div class="modal-body info ">                         
                                            <div class="row ms-1 me-1"> 

                                            <form method="post" action="<?php echo RUTA_URL?>/adminEntidades/editarEntidad/<?php echo $entidad->id_entidad?>">

                                                <div class="row mt-4">
                                                    <div class="col-5">
                                                        <div class="input-group mb-4">
                                                            <label for="cif" class="input-group-text">CIF <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="cif" name="cif" value="<?php echo $entidad->cif?>" required>    
                                                        </div> 
                                                    </div>

                                                    <div class="col-7">
                                                        <div class="input-group mb-4">
                                                            <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $entidad->nombre?>" required >
                                                        </div>
                                                    </div>
                                                </div>  

           
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="direccion" class="input-group-text">Direccion <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md"  id="direccion" name="direccion" value="<?php echo $entidad->direccion?>"required>
                                                        </div> 
                                                    </div> 
                                                </div>


                                                <div class="row">
                                                    <div class="col-5">
                                                        <div class="input-group mb-4">
                                                            <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" value="<?php echo $entidad->telefono?>" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                                        </div>
                                                    </div>

                                                    <div class="col-7">
                                                        <div class="input-group  mb-4">
                                                            <label for="email" class="input-group-text">Email</label>
                                                            <input type="text" class="form-control form-control-md" id="email" name="email" value="<?php echo $entidad->email?>" onblur="return correo(this.id)">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="input-group mb-4">
                                                            <label for="observaciones" class="input-group-text">Observaciones </label>
                                                            <input type="text" class="form-control form-control-md"  id="observaciones" name="observaciones" value="<?php echo $entidad->observaciones?>">
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
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $entidad->id_entidad?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $entidad->id_entidad?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quieres <b>BORRAR</b> la entidad <b><?php echo $entidad->nombre?></b> ? </p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEntidades/borrar/<?php echo $entidad->id_entidad?>" method="post">
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



        <!-- AÑADIR NUEVA ENTIDAD-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nueva Entidad">
            </a>
        </div>


        <div class="modal" id="nuevo">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Alta de entidades</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/adminEntidades/nuevaEntidad" method="post">

                                <div class="row mt-4">
                                    <div class="col-5">
                                        <div class="input-group mb-4">
                                            <label for="cif" class="input-group-text">CIF <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="cif" name="cif" required>    
                                        </div> 
                                    </div>

                                    <div class="col-7">
                                        <div class="input-group mb-4">
                                            <label for="nombre" class="input-group-text">Nombre <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required >
                                        </div>
                                    </div>
                                </div>  

           
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group mb-4">
                                            <label for="direccion" class="input-group-text">Direccion <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md"  id="direccion" name="direccion" required>
                                        </div> 
                                    </div> 
                                </div>


                                <div class="row">
                                    <div class="col-5">
                                        <div class="input-group mb-4">
                                            <label for="telefono" class="input-group-text">Telefono <sup>*</sup></label>
                                            <input type="text" class="form-control form-control-md" id="telefono" name="telefono" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                        </div>
                                    </div>

                                    <div class="col-7">
                                        <div class="input-group mb-4">
                                            <label for="email" class="input-group-text">Email</label>
                                            <input type="text" class="form-control form-control-md" id="email" name="email" onblur="return correo(this.id)">
                                        </div>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-group mb-4">
                                            <label for="observaciones" class="input-group-text">Observaciones </label>
                                            <input type="text" class="form-control form-control-md"  id="observaciones" name="observaciones">
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


