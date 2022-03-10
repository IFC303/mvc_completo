<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

<div class="tabla" style="border:solid 1px #023ef9">

        <table class="table table-hover">

                <!--CABECERA TABLA-->
                <thead>
                        <tr style="background-color:#023ef9; color:white; text-align: center;">
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>EMAIL</th>
                                <th>TELEFONO</th>
                                <th>HA SIDO SOCIO</th>
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>Acciones</th>
                                <?php endif ?>
                        </tr>
                </thead>


                <tbody class="table-light">

                        <?php foreach ($datos['soliSocio'] as $usuarios) : ?>
                                <tr>
                                        <td><?php echo $usuarios->id_solicitud_soc ?></td>
                                        <td><?php echo $usuarios->nombre ?></td>
                                        <td><?php echo $usuarios->apellidos ?></td>
                                        <td><?php echo $usuarios->email ?></td>
                                        <td><?php echo $usuarios->telefono ?></td>
                                        <td><?php if ($usuarios->es_socio == 1) {
                                                        echo "SI";
                                                } elseif ($usuarios->es_socio == 0) {
                                                        echo "NO";
                                                } else {
                                                        echo "";
                                                } ?></td>


                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                                        </a>
                                                        &nbsp;
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalAceptar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                                        </a>
                                                        &nbsp;
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <img src="<?php echo RUTA_Icon ?>ojo.svg" width="30" height="30"></img>
                                                        </a>

                                                        <div class="modal" id="ModalBorrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>Seguro que quiere borrar la solicitud del socio <b> <?php echo $usuarios->nombre . " " . $usuarios->apellidos ?> </b></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/borrar_solicitudes_socios/<?php echo $usuarios->id_solicitud_soc ?>" method="post">
                                                                                                <button type="submit">Borrar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="modal" id="ModalAceptar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>Seguro que quiere aceptar la solicitud del socio <b> <?php echo $usuarios->nombre . " " . $usuarios->apellidos ?> </b></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_socios/<?php $datBorrar = $usuarios->id_solicitud_soc . "_" . $usuarios->DNI . "_" . $usuarios->nombre . "_" . $usuarios->apellidos . "_" . $usuarios->CCC . "_" . $usuarios->talla . "_" . $usuarios->fecha_nacimiento . "_" . $usuarios->email . "_" . $usuarios->telefono . "_" . $usuarios->direccion . "_" . $usuarios->es_socio;
                                                                                                                                                                echo $datBorrar ?>" method="post">
                                                                                                <button type="submit">Aceptar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="modal" id="ModalEditar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <div class="modal-dialog modal-xl modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <h4 class="modal-title">Ver Solicitud Socio</h4>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">

                                                                                        <div class="row">

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verIdSoli">Id Solicitud: </label>
                                                                                                        <label name="verIdSoli" id="verIdSoli" class="form-control form-control-lg"><?php echo $usuarios->id_solicitud_soc ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verDni">DNI: </label>
                                                                                                        <label name="verDni" id="verDni" class="form-control form-control-lg"><?php echo $usuarios->DNI ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verNombre">Nombre: </label>
                                                                                                        <label name="verNombre" id="verNombre" class="form-control form-control-lg"><?php echo $usuarios->nombre ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verApellidos">Apellidos: </label>
                                                                                                        <label name="verApellidos" id="verApellidos" class="form-control form-control-lg"><?php echo $usuarios->apellidos ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verEmail">Email: </label>
                                                                                                        <label name="verEmail" id="verEmail" class="form-control form-control-lg"><?php echo $usuarios->email ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verDirec">Direccion: </label>
                                                                                                        <label name="verDirec" id="verDirec" class="form-control form-control-lg"><?php echo $usuarios->direccion ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verFecha">Fecha Nacimiento: </label>
                                                                                                        <label name="verFecha" id="verFecha" class="form-control form-control-lg"><?php echo $usuarios->fecha_nacimiento ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verTlf">Telefono: </label>
                                                                                                        <label name="verTlf" id="verTlf" class="form-control form-control-lg"><?php echo $usuarios->telefono ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verCCC">CCC: </label>
                                                                                                        <label name="verCCC" id="verCCC" class="form-control form-control-lg"><?php echo $usuarios->CCC ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verTalla">Talla: </label>
                                                                                                        <label name="verTalla" id="verTalla" class="form-control form-control-lg"><?php echo $usuarios->talla ?></label>
                                                                                                </div>

                                                                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3">
                                                                                                        <label for="verEsSocio">Ha sido socio: </label>
                                                                                                        <label name="verEsSocio" id="verEsSocio" class="form-control form-control-lg"><?php if ($usuarios->es_socio == 0) {
                                                                                                                                                                                                echo "No";
                                                                                                                                                                                        } elseif ($usuarios->es_socio == 1) {
                                                                                                                                                                                                echo "Si";
                                                                                                                                                                                        } else {
                                                                                                                                                                                                echo "";
                                                                                                                                                                                        } ?></label>
                                                                                                </div>

                                                                                        </div>

                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">
                                                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                                                <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                                                                        </a>
                                                                                        &nbsp;
                                                                                        <a data-bs-toggle="modal" data-bs-target="#ModalAceptar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                                                <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                                                                        </a>
                                                                                        <button type="button" style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
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




</div>
<script>
        function abrir(idAbrir) {
                console.log(idAbrir);
                var modal = document.getElementById(idAbrir);
                var body = document.getElementsByTagName("body")[0];
                modal.style.display = "block";
                body.style.overflow = "hidden";
        }

        function cerrar(idCerrar) {
                var modal = document.getElementById(idCerrar);
                var body = document.getElementsByTagName("body")[0];
                modal.style.display = "none";
                body.style.overflow = "visible";
        }
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>