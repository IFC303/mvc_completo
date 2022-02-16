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

                                                        <a>
                                                                <img src="<?php echo RUTA_Icon ?>ojo.svg" width="20" height="20">
                                                        </a>


                                                        <!-- MODAL EDITAR -->

                                                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                                                <img src="<?php echo RUTA_Icon ?>editar.svg" width="20" height="20"></img>
                                                        </a>
                                                        <!-- The Modal -->
                                                        <div class="modal" id="myModal">
                                                                <div class="modal-dialog modal-lg">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <div class="row">
                                                                                                <div class="col-3"><img src="<?php echo RUTA_Foto ?>foto_carnet.jpg" width="150" height="150"></div>

                                                                                                <div class="col-9">
                                                                                                        <div class="col-12">
                                                                                                                <label for="">NOMBRE: <input type="text" placeholder="<?php echo $usuarios->nombre ?>"></label>
                                                                                                                 
                                                                                                        </div>

                                                                                                        <div class="col-12">
                                                                                                                APELLIDOS: <?php echo $usuarios->nombre ?>
                                                                                                        </div>

                                                                                                        <div class="col-12">
                                                                                                                EMAIL: <?php echo $usuarios->nombre ?>
                                                                                                        </div>

                                                                                                        <div class="col-12">
                                                                                                                DNI: <?php echo $usuarios->nombre ?>
                                                                                                        </div>

                                                                                                        <div class="col-12">
                                                                                                                FECHA NACIMIENTO: <?php echo $usuarios->nombre ?>
                                                                                                        </div>
                                                                                                </div>

                                                                                        </div>
                                                                                </div>

                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <!-- VENTANA -->
                                                        <div class="modal" id="ModalEditar">
                                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <h4 class="modal-title">Edicion de Test</h4>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <form method="post" class="card-body">
                                                                                                <div class="mt-3 mb-3">
                                                                                                        <label for="nombre">Id Test: <sup>*</sup></label>
                                                                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $datos['usuarios']->id_test ?>">
                                                                                                </div>
                                                                                                <div class="mb-3">
                                                                                                        <label for="email">Nombre: <sup>*</sup></label>
                                                                                                        <input type="email" name="email" id="email" class="form-control form-control-lg" value="<?php echo $datos['usuarios']->Nombre ?>">
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

                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_test ?>" href="<?php echo RUTA_URL ?>/entrenador/borrar/<?php echo $usuarios->id_test ?>">
                                                                <img src="<?php echo RUTA_Icon ?>papelera.svg" width="20" height="20"></img>

                                                        </a>

                                                        <!-- VENTANA -->
                                                        <div class="modal" id="ModalBorrar_<?php echo $usuarios->id_test ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>Seguro que quiere borrar el test con identificador <?php echo $usuarios->id_test ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">
                                                                                        <form action="<?php echo RUTA_URL ?>/entrenador/borrar/<?php echo $usuarios->id_test ?>" method="post">
                                                                                                <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
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
                <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL ?>/entrenador/nuevo_test/">Añadir</a>
        </div>
        <br>

</div>



<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>