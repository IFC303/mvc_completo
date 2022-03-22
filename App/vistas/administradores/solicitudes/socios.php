<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>
<style>
          .datos_tabla{
            text-align:center;
        }
</style>


<div class="container">
<div class="tabla" style="border:solid 1px #023ef9">

        <table class="table table-hover">

                <!--CABECERA TABLA-->
                <thead>
                        <tr style="background-color:#023ef9; color:white;">
                                <th class="datos_tabla">ID</th>
                                <th class="datos_tabla">NOMBRE</th>
                                <th class="datos_tabla">APELLIDOS</th>
                                <th class="datos_tabla">EMAIL</th>
                                <th class="datos_tabla">TELEFONO</th>
                                <th class="datos_tabla">HA SIDO SOCIO</th>
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th class="datos_tabla">Acciones</th>
                                        <th class="datos_tabla">
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

                        <?php foreach ($datos['soliSocio'] as $usuarios) : ?>
                                <tr>
                                        <td class="datos_tabla"><?php echo $usuarios->id_solicitud_soc ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->nombre ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->apellidos ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->email ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->telefono ?></td>
                                        <td class="datos_tabla"><?php if ($usuarios->es_socio == 1) {
                                                        echo "NO";
                                                } elseif ($usuarios->es_socio == 0) {
                                                        echo "SI";
                                                } else {
                                                        echo "";
                                                } ?></td>


                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td class="datos_tabla">
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
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/borrar_solicitudes_seleccionadas_socios" method="post">
                                                                                                <div style="display: none;">
                                                                                                        <input name="borrarMas" id="borrarMas" type="text">
                                                                                                </div>
                                                                                                <button type="submit" >Borrar</button>
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
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_seleccionadas_socios" method="post">
                                                                                                <div style="display: none;">
                                                                                                        <input name="aceptarMas" id="aceptarMas" type="text">
                                                                                                </div>
                                                                                                <button type="submit" >Aceptar</button>
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
                                                <td>
                                                        <input type="checkbox" name="masAcepDene" id="<?php echo $usuarios->id_solicitud_soc ?>" value="<?php echo $usuarios->id_solicitud_soc ?>" onchange="borrarAceptarId(this.id)">
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
        var aceptarBorrar=[];
        function borrarAceptarId(id){
                if(document.getElementById(id).checked==true){
                        aceptarBorrar.push(id);
                }
                if(document.getElementById(id).checked==false){
                        for (let i = 0; i < aceptarBorrar.length; i++) {
                                if(aceptarBorrar[i]==id){
                                        aceptarBorrar.splice(i,1);
                                }
                        }
                        
                }
        }

        function borrarMas(){
                document.getElementById("borrarMas").value="";
                document.getElementById("borrarMas").value=aceptarBorrar.toString();
        }
        function aceptarMas(){
                document.getElementById("aceptarMas").value="";
                document.getElementById("aceptarMas").value=aceptarBorrar.toString();
        }
</script>