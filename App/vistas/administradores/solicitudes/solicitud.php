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
                                <tr style="text-align: center;">
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
                                                <td style="text-align: center;">
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                                        </a>
                                                        &nbsp;
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalAceptar_<?php echo $usuarios->id_solicitud_soc ?>">
                                                                <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                                        </a>
                                                        &nbsp;
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalEditar<?php echo $usuarios->id_solicitud_soc ?>">
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
                                                                                        <p>Seguro que quiere borrar la solicitud del usuario <?php echo $usuarios->nombre ?></p>
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
                                                                                        <p>Seguro que quiere aceptar la solicitud del usuario <?php echo $usuarios->id_usuario ?> del grupo <?php echo $usuarios->id_grupo ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_socios/<?php $datBorrar = $usuarios->id_solicitud_soc . "_" . $usuarios->DNI . "_" . $usuarios->nombre . "_" . $usuarios->apellidos . "_" . $usuarios->CCC . "_" . $usuarios->talla . "_" . $usuarios->fecha_nacimiento . "_" . $usuarios->email . "_" . $usuarios->telefono . "_" . $usuarios->direccion . "_" . $usuarios->es_socio; echo $datBorrar ?>" method="post">
                                                                                                <button type="submit">Aceptar</button>
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