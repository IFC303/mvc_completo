<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

<div style="text-align: center;">
<form method="post" class="card-body" action="<?php echo RUTA_URL ?>/admin/crud_solicitudes_eventos/">
<input type="radio" name="opcion" value="socio" id="socio" <?php if($datos['radioCheck']=="socio"){ echo "checked";} ?> >&nbsp;<label for="socio">Ver solicitudes socio</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="opcion" value="externo" id="externo" <?php if($datos['radioCheck']=="externo"){ echo "checked";} ?> >&nbsp;<label for="externo">Ver solicitudes externo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" name="enviar" value="Cargar" style="background-color: #023ef9; color:white"> 
</form>
</div>

<?php print_r($datos['soliEventos']); ?>
<br>

<div class="tabla" style="border:solid 1px #023ef9">

        
        <table class="table table-hover">

                <!--CABECERA TABLA-->
                <thead>
                        <tr style="background-color:#023ef9; color:white; text-align: center;">
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>EVENTO</th>
                                <th>FECHA SOLICITUD</th>
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>Acciones</th>
                                <?php endif ?>
                        </tr>
                </thead>


                <tbody class="table-light">                                   
                        <?php foreach ($datos['soliEventos'] as $usuarios) : ?>
                                <tr>
                                        <td><?php echo $usuarios->nombre ?></td>
                                        <td><?php echo $usuarios->apellidos ?></td>
                                        <td><?php echo $usuarios->evento ?></td>
                                        <td><?php echo $usuarios->fecha ?></td>




                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td>
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id ?>">
                                                                <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                                        </a>
                                                        &nbsp;
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalAceptar_<?php echo $usuarios->id ?>">
                                                                <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                                        </a>

                                                        <div class="modal" id="ModalBorrar_<?php echo $usuarios->id ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>Seguro que quiere borrar la solicitud de <?php echo $usuarios->nombre." ".$usuarios->apellidos ?> del evento <?php echo $usuarios->evento ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <?php if($datos['radioCheck']=="socio"){$rutaCrud= RUTA_URL."/admin/borrar_solicitudes_EvenSoci/";}elseif($datos['radioCheck']=="externo"){$rutaCrud= RUTA_URL."/admin/borrar_solicitudes_EvenExter/";} ?>
                                                                                        <form action="<?php $datBorrar = $usuarios->id . "_" . $usuarios->id_evento . "_" . $usuarios->fecha; echo $rutaCrud.$datBorrar ?>" method="post">
                                                                                                <button type="submit">Borrar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="modal" id="ModalAceptar_<?php echo $usuarios->id ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>Seguro que quiere aceptar la solicitud del usuario <?php echo $usuarios->id ?> del grupo <?php echo $usuarios->id_grupo ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_grupos/<?php $datBorrar = $usuarios->id . "_" . $usuarios->id_grupo . "_" . $usuarios->fecha_inscripcion;
                                                                                                                                                                echo $datBorrar ?>" method="post">
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

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>