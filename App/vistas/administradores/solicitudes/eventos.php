<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

<style>
 .btn{
            background-color: #023ef9;  
            color:white;
        }
        .datos_tabla{
            text-align:center;
        }
</style>




<div style="text-align: center;">
        <form method="post" id="radioChe" class="card-body" action="<?php echo RUTA_URL ?>/admin/crud_solicitudes_eventos/">
                <input type="radio" name="opcion" value="socio" id="socio" <?php if ($datos['radioCheck'] == "socio") {
                                                                                        echo "checked";
                                                                                } ?>>&nbsp;<label for="socio">Ver solicitudes socio</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="radio" name="opcion" value="externo" id="externo" <?php if ($datos['radioCheck'] == "externo") {
                                                                                        echo "checked";
                                                                                } ?>>&nbsp;<label for="externo">Ver solicitudes externo</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input onclick="enviarSociExter()" class="btn" type="submit" name="enviar" value="Cargar">
        </form>
</div>

<br>
<div class="container">
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
                                        <th>
                                                <a onclick="borrarMas()" data-bs-toggle="modal" data-bs-target="#ModalBorrar_mas">
                                                        <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                                </a>
                                                &nbsp;
                                                <a onclick="aceptarMas()" data-bs-toggle="modal" data-bs-target="#ModalAceptar_mas">
                                                        <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                                </a>
                                        </th>
                                <?php endif ?>
                        </tr>
                </thead>


                <tbody class="table-light">
                        <?php foreach ($datos['soliEventos'] as $usuarios) : ?>
                                <tr>
                                        <td class="datos_tabla"><?php echo $usuarios->nombre ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->apellidos ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->evento ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->fecha ?></td>




                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td class="datos_tabla">
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
                                                                                        <p>Seguro que quiere borrar la solicitud de <?php echo $usuarios->nombre . " " . $usuarios->apellidos ?> del evento <?php echo $usuarios->evento ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <?php if ($datos['radioCheck'] == "socio") {
                                                                                                $rutaCrud = RUTA_URL . "/admin/borrar_solicitudes_EvenSoci/";
                                                                                        } elseif ($datos['radioCheck'] == "externo") {
                                                                                                $rutaCrud = RUTA_URL . "/admin/borrar_solicitudes_EvenExter/";
                                                                                        } ?>
                                                                                        <form action="<?php $datBorrar = $usuarios->id . "_" . $usuarios->id_evento . "_" . $usuarios->fecha;
                                                                                                        echo $rutaCrud . $datBorrar ?>" method="post">
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
                                                                                        <p>Seguro que quiere aceptar la solicitud de <?php echo $usuarios->nombre . " " . $usuarios->apellidos ?> del evento <?php echo $usuarios->evento ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        </form>
                                                                                        <?php if ($datos['radioCheck'] == "socio") {
                                                                                                $rutaCrud = RUTA_URL . "/admin/aceptar_solicitudes_EvenSoci/";
                                                                                        } elseif ($datos['radioCheck'] == "externo") {
                                                                                                $rutaCrud = RUTA_URL . "/admin/aceptar_solicitudes_EvenExter/";
                                                                                        } ?>
                                                                                        <form action="<?php $datBorrar = $usuarios->id . "_" . $usuarios->id_evento . "_" . $usuarios->fecha;
                                                                                                        echo $rutaCrud . $datBorrar ?>" method="post">
                                                                                                <button type="submit">Aceptar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="modal" id="ModalBorrar_mas">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>¿Seguro que quiere borrar las solicitudes seleccionadas?</p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <?php if ($datos['radioCheck'] == "socio") {
                                                                                                $rutaAcepBorr = RUTA_URL . "/admin/borrar_solicitudes_seleccionadas_eventosSoci";
                                                                                        } elseif ($datos['radioCheck'] == "externo") {
                                                                                                $rutaAcepBorr = RUTA_URL . "/admin/borrar_solicitudes_seleccionadas_eventosExter";
                                                                                        } ?>
                                                                                        <form action="<?php echo $rutaAcepBorr ?>" method="post">
                                                                                                <div style="display: none;">
                                                                                                        <input name="borrarMas" id="borrarMas" type="text">
                                                                                                </div>
                                                                                                <button type="submit">Borrar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="modal" id="ModalAceptar_mas">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>¿Seguro que quiere aceptar las solicitudes seleccionadas?</p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <?php if ($datos['radioCheck'] == "socio") {
                                                                                                $rutaAcepBorr = RUTA_URL . "/admin/aceptar_solicitudes_seleccionadas_eventosSoci";
                                                                                        } elseif ($datos['radioCheck'] == "externo") {
                                                                                                $rutaAcepBorr = RUTA_URL . "/admin/aceptar_solicitudes_seleccionadas_eventosExter";
                                                                                        } ?>
                                                                                        <form action="<?php echo $rutaAcepBorr ?>" method="post">
                                                                                                <div style="display: none;">
                                                                                                        <input name="aceptarMas" id="aceptarMas" type="text">
                                                                                                </div>
                                                                                                <button type="submit">Aceptar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                </td>

                                                <td>
                                                        <?php $datosAcepBorr = $usuarios->id . "_" . $usuarios->id_evento . "_" . $usuarios->fecha; ?>
                                                        <input type="checkbox" name="masAcepDene" id="<?php echo $datosAcepBorr ?>" value="<?php echo $datosAcepBorr ?>" onchange="borrarAceptarId(this.id)">
                                                </td>
                                        <?php endif ?>
                                </tr>
                        <?php endforeach ?>
                </tbody>

        </table>

</div>
</div>
<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
<script>
        var aceptarBorrar = [];

        function borrarAceptarId(id) {
                if (document.getElementById(id).checked == true) {
                        aceptarBorrar.push(id);
                }
                if (document.getElementById(id).checked == false) {
                        for (let i = 0; i < aceptarBorrar.length; i++) {
                                if (aceptarBorrar[i] == id) {
                                        aceptarBorrar.splice(i, 1);
                                }
                        }

                }
        }

        function borrarMas() {
                document.getElementById("borrarMas").value = "";
                document.getElementById("borrarMas").value = aceptarBorrar.toString();
        }

        function aceptarMas() {
                document.getElementById("aceptarMas").value = "";
                document.getElementById("aceptarMas").value = aceptarBorrar.toString();
        }

        function enviarSociExter(){
                if(document.getElementById("externo").checked==true){
                        var rutaURL= document.getElementById("radioChe").action;
                        document.getElementById("radioChe").action=rutaURL+"externo";
                }
                if(document.getElementById("socio").checked==true){
                        var rutaURL= document.getElementById("radioChe").action;
                        document.getElementById("radioChe").action=rutaURL+"socio";
                }
                
        }
</script>