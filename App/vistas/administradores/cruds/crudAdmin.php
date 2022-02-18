<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

<div class="tabla" style="border:solid 1px #023ef9">

        <table class="table table-hover">


                <!--CABECERA TABLA-->
                <thead>
                        <tr style="background-color:#023ef9; color:white;">
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>TELEFONO</th>
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>Acciones</th>
                                <?php endif ?>
                        </tr>
                </thead>


                <tbody class="table-light">

                        <?php foreach ($datos['usuAdmin'] as $usuarios) : ?>
                                <?php print_r($usuarios); ?>
                                <tr>
                                        <td><?php echo $usuarios->id_usuario ?></td>
                                        <td><?php echo $usuarios->nombre ?></td>
                                        <td><?php echo $usuarios->apellidos ?></td>
                                        <td><?php echo $usuarios->telefono ?></td>


                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td>

                                                        <a>
                                                                <img src="<?php echo RUTA_Icon ?>ojo.svg" width="20" height="20">
                                                        </a>


                                                        <a data-bs-toggle="modal" data-bs-target="#ModalEditar<?php echo $usuarios->id_usuario ?>" href="<?php echo RUTA_URL ?>/admin/editarAdmin/<?php echo $uruario->id_usuario ?>">
                                                                <img src="<?php echo RUTA_Icon ?>editar.svg" width="20" height="20"></img>
                                                        </a>

                                                        <!-- VENTANA -->
                                                        <div class="modal" id="ModalEditar<?php echo $usuarios->id_usuario ?>">
                                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <h4 class="modal-title">Edicion de Admin</h4>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <form method="post" class="card-body">
                                                                                                <div class="row">
                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editDni">dni: <sup>*</sup></label>
                                                                                                                <input type="text" name="editDni" id="editDni" class="form-control form-control-lg" placeholder="<?php echo $usuarios->dni ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editNombre">Nombre: <sup>*</sup></label>
                                                                                                                <input type="text" name="editNombre" id="editNombre" class="form-control form-control-lg" placeholder="<?php echo $usuarios->nombre ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editApellidos">Apellidos: <sup>*</sup></label>
                                                                                                                <input type="text" name="editApellidos" id="editApellidos" class="form-control form-control-lg" placeholder="<?php echo $usuarios->apellidos ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editEmail">Email: <sup>*</sup></label>
                                                                                                                <input type="email" name="editEmail" id="editEmail" class="form-control form-control-lg" placeholder="<?php echo $usuarios->email ?>">
                                                                                                        </div>
                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editFecha">Fecha Nacimiento: <sup>*</sup></label>
                                                                                                                <input type="text" name="editFecha" id="editFecha" class="form-control form-control-lg" placeholder="<?php echo $usuarios->fecha_nacimiento ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editTlf">Telefono: <sup>*</sup></label>
                                                                                                                <input type="text" name="editTlf" id="editTlf" class="form-control form-control-lg" placeholder="<?php echo $usuarios->telefono ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editCCC">CCC: <sup>*</sup></label>
                                                                                                                <input type="text" name="editCCC" id="editCCC" class="form-control form-control-lg" placeholder="<?php echo $usuarios->CCC ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editPas">Contraseña: <sup>*</sup></label>
                                                                                                                <input type="password" name="editPas" id="editPas" class="form-control form-control-lg">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editTalla">Talla: <sup>*</sup></label>
                                                                                                                <input type="text" name="editTalla" id="editTalla" class="form-control form-control-lg" placeholder="<?php echo $usuarios->talla ?>">
                                                                                                                <select>
                                                                                                                        <option>L</option>
                                                                                                                        <option>M</option>
                                                                                                                        <option>S</option>
                                                                                                                </select>
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editFoto">Foto: <sup>*</sup></label>
                                                                                                                <input type="text" name="editFoto" id="editFoto" class="form-control form-control-lg" placeholder="<?php echo $usuarios->foto ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editAct">Activado: <sup>*</sup></label>
                                                                                                                <input type="text" name="editAct" id="editAct" class="form-control form-control-lg" placeholder="<?php echo $usuarios->activado ?>">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editRol">Rol: <sup>*</sup></label>
                                                                                                                <input type="text" name="editRol" id="editRol" class="form-control form-control-lg" placeholder="<?php echo $usuarios->id_rol ?>">
                                                                                                        </div>
                                                                                                </div>
                                                                                                <input type="submit" class="btn btn-success" value="Confirmar">
                                                                                        </form>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">
                                                                                        <button type="button" style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                        </div>



                                                        <!-- MODAL BORRAR -->

                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_usuario ?>" href="<?php echo RUTA_URL ?>/admin/borrarUsuario/<?php echo $usuarios->id_usuario ?>">
                                                                <img src="<?php echo RUTA_Icon ?>papelera.svg" width="20" height="20"></img>

                                                        </a>

                                                        <!-- VENTANA -->
                                                        <div class="modal" id="ModalBorrar_<?php echo $usuarios->id_usuario ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>Seguro que quiere borrar el usuario con identificador <?php echo $usuarios->id_usuario ?> y nombre <?php echo $usuarios->nombre ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/borrarUsuario/<?php echo $usuarios->id_usuario ?>" method="post">
                                                                                                <button type="submit">Borrar</button>
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


        <!-- AÑADIR-->
        <div class="col text-center">
                <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL ?>/admin/nuevoUsuario/">Añadir</a>
        </div>
        <br>

</div>



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>