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
                                <tr>
                                        <td><?php echo $usuarios->id_usuario ?></td>
                                        <td><?php echo $usuarios->nombre ?></td>
                                        <td><?php echo $usuarios->apellidos ?></td>
                                        <td><?php echo $usuarios->telefono ?></td>


                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td>

                                                        <!--MODAL VER (javascript)-->
                                                        <img id="btnModal_<?php echo $usuarios->id_usuario ?>" src="<?php echo RUTA_Icon ?>ojo.svg" width="20" height="20" onclick="abrir(usuarios->id_usuario)"></img> 

                                                        <div id="miModal_<?php echo $usuarios->id_usuario ?>" class="modalVer">
                                                                <div class="modal-content">

                                                                        <div id="headerVer">
                                                                                <div class="col-12" style="text-align:right"><input type="button" id="cerrar_<?php echo $usuarios->id_usuario ?>" class="btn-close" onclick="cerrar(this);"></div>
                                                                                <h2 style="text-align:center">Ver Usuario</h2>
                                                                        </div>

                                                                        <div id="bodyVer" class="row m-3">


                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verDni">dni: </label>
                                                                                        <label name="verDni" class="form-control form-control-lg"><?php echo $usuarios->dni ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verDni">Nombre: </label>
                                                                                        <label name="verDni" class="form-control form-control-lg"><?php echo $usuarios->nombre ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verApel">Apellidos: </label>
                                                                                        <label name="verApel" class="form-control form-control-lg"><?php echo $usuarios->apellidos ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verEmail">Email: </label>
                                                                                        <label name="verEmail" class="form-control form-control-lg"><?php echo $usuarios->email ?></label>
                                                                                </div>
                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verFecha">Fecha Nacimiento: </label>
                                                                                        <label name="verFecha" class="form-control form-control-lg"><?php echo $usuarios->fecha_nacimiento ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verTlf">Telefono: </label>
                                                                                        <label name="verTlf" class="form-control form-control-lg"><?php echo $usuarios->telefono ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verCCC">CCC: </label>
                                                                                        <label name="verCCC" class="form-control form-control-lg"><?php echo $usuarios->CCC ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verTalla">Talla: </label>
                                                                                        <label name="verTalla" class="form-control form-control-lg"><?php echo $usuarios->talla ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verAct">Activado: </label>
                                                                                        <label name="verAct" class="form-control form-control-lg"><?php echo $usuarios->activado ?></label>
                                                                                </div>

                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                                        <label for="verRol">Rol: </label>
                                                                                        <label name="verRol" class="form-control form-control-lg"><?php echo $usuarios->id_rol ?></label>
                                                                                </div>

                                                                        </div>

                                                                        <div id="footerVer">
                                                                                <input type="button" style="background-color: #023ef9; color:white" id="cerrar_<?php echo $usuarios->id_usuario ?>" class="close" onclick="cerrar(this);" value="cerrar">
                                                                        </div>

                                                                </div>
                                                        </div>


                                                        <!-- VENTANA -->
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalEditar<?php echo $usuarios->id_usuario ?>" href="<?php echo RUTA_URL ?>/admin/editarAdmin/<?php echo $uruario->id_usuario ?>">
                                                                <img src="<?php echo RUTA_Icon ?>editar.svg" width="20" height="20"></img>
                                                        </a>
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
                                                                                        <form method="post" class="card-body" autocomplete="off" action="<?php echo RUTA_URL ?>/admin/editarUsuario/<?php echo $usuarios->id_usuario ?>">
                                                                                                <div class="row">
                                                                                                        <p style="color: #023EF9;">*Si dejas un campo vacio se guardara el dato anterior</p>
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
                                                                                                                <input autocomplete="false" type="email" name="editEmail" id="editEmail" class="form-control form-control-lg" placeholder="<?php echo $usuarios->email ?>">
                                                                                                        </div>
                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editFecha">Fecha Nacimiento: <sup>*</sup></label>
                                                                                                                <input type="date" name="editFecha" id="editFecha" class="form-control form-control-lg" placeholder="<?php echo $usuarios->fecha_nacimiento ?>">
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
                                                                                                                <input autocomplete="false" type="password" name="editPas" id="editPas" class="form-control form-control-lg">
                                                                                                        </div>

                                                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                                <label for="editTalla">Talla: <sup>*</sup></label>
                                                                                                                <input type="text" name="editTalla" id="editTalla" class="form-control form-control-lg" placeholder="<?php echo $usuarios->talla ?>">
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
                                                                                                                <select name="editRol" id="editRol" class="form-control form-control-lg">
                                                                                                                        <?php if ($usuarios->id_rol == 1) { ?>
                                                                                                                                <option selected value="1">Admin</option>
                                                                                                                                <option value="2">Socio</option>
                                                                                                                                <option value="3">Entrenador</option>
                                                                                                                                <option value="4">Tienda</option>
                                                                                                                        <?php } elseif ($usuarios->id_rol == 2) { ?>
                                                                                                                                <option value="1">Admin</option>
                                                                                                                                <option selected value="2">Socio</option>
                                                                                                                                <option value="3">Entrenador</option>
                                                                                                                                <option value="4">Tienda</option>
                                                                                                                        <?php } elseif ($usuarios->id_rol == 3) { ?>
                                                                                                                                <option value="1">Admin</option>
                                                                                                                                <option value="2">Socio</option>
                                                                                                                                <option selected value="3">Entrenador</option>
                                                                                                                                <option value="4">Tienda</option>
                                                                                                                        <?php } elseif ($usuarios->id_rol == 4) { ?>
                                                                                                                                <option value="1">Admin</option>
                                                                                                                                <option value="2">Socio</option>
                                                                                                                                <option value="3">Entrenador</option>
                                                                                                                                <option selected value="4">Tienda</option>
                                                                                                                        <?php } ?>

                                                                                                                </select>
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

                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_usuario ?>">
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
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/borrarUsuario/<?php $idUsuTengo= $datos['idTengo']."-".$usuarios->id_usuario; echo $idUsuTengo ?>" method="post">
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
                <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL ?>/admin/nuevoUsuario/<?php echo $datos['idTengo'] ?>">Añadir</a>
        </div>
        <br>

</div>
<script>
        function abrir(idAbrir) {
                console.log(idAbrir);
                //var modal = document.getElementById("miModal_<?php //echo $idAbrir ?>");
                var body = document.getElementsByTagName("body")[0];
                idAbrir.style.display = "block";
                body.style.overflow = "hidden";
        }

        function cerrar(idCerrar) {
                var modal = document.getElementById("miModal_<?php echo $idCerrar?>");
                var body = document.getElementsByTagName("body")[0];
                modal.style.display = "none";
                body.style.overflow = "visible";
        }
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>