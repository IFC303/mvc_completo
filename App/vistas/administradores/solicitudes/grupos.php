<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>




        <header>
        <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Solicitudes para grupos</span></div>
                <div class="col-2 mt-2">
                        <a type="button" id="botonLogout" class="btn"  href="<?php echo RUTA_URL ?>/login/logout">
                                <span>Logout</span>
                                <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                        </a>
                </div>
        </div>                                   
        </header>



<article>

        <table id="tabla" class="table">

                <!--CABECERA TABLA-->
                <thead>
                        <tr style="background-color:#023ef9; color:white; text-align: center;">
                                <th>NOMBRE</th>
                                <th>GRUPO</th>
                                <th>FECHA INSCRIPCION</th>
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>Acciones</th>
                                        <th >
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

                        <?php foreach ($datos['soliSocioGrupos'] as $usuarios) : ?>
                                <tr>
                                        <td class="datos_tabla"><?php echo $usuarios->nombre_usuario ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->nombre_grupo ?></td>
                                        <td class="datos_tabla"><?php echo $usuarios->fecha_inscripcion ?></td>




                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td class="datos_tabla">
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $usuarios->id_usuario ?>">
                                                                <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                                        </a>
                                                        &nbsp;
                                                        <a data-bs-toggle="modal" data-bs-target="#ModalAceptar_<?php echo $usuarios->id_usuario ?>">
                                                                <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                                        </a>

                                                        <div class="modal" id="ModalBorrar_<?php echo $usuarios->id_usuario ?>">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">

                                                                                <!-- Modal Header -->
                                                                                <div class="modal-header">
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                                                </div>

                                                                                <!-- Modal body -->
                                                                                <div class="modal-body">
                                                                                        <p>Seguro que quiere borrar la solicitud del usuario <?php echo $usuarios->id_usuario ?> del grupo <?php echo $usuarios->id_grupo ?></p>
                                                                                </div>

                                                                                <!-- Modal footer -->
                                                                                <div class="modal-footer">

                                                                                        <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/borrar_solicitudes_grupos/<?php $datBorrar = $usuarios->id_usuario . "_" . $usuarios->id_grupo . "_" . $usuarios->fecha_inscripcion;
                                                                                                                                                                echo $datBorrar ?>" method="post">
                                                                                                <button type="submit">Borrar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                        <div class="modal" id="ModalAceptar_<?php echo $usuarios->id_usuario ?>">
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
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_grupos/<?php $datBorrar = $usuarios->id_usuario . "_" . $usuarios->id_grupo . "_" . $usuarios->fecha_inscripcion;
                                                                                                                                                                echo $datBorrar ?>" method="post">
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
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/borrar_solicitudes_seleccionadas_grupos" method="post">
                                                                                                <div style="display: none;">
                                                                                                        <input name="borrarMas" id="borrarMas" type="text">
                                                                                                </div>
                                                                                                <button type="submit" >Borrar</button>
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
                                                                                        <form action="<?php echo RUTA_URL ?>/admin/aceptar_solicitudes_seleccionadas_grupos" method="post">
                                                                                                <div style="display: none;">
                                                                                                        <input name="aceptarMas" id="aceptarMas" type="text">
                                                                                                </div>
                                                                                                <button type="submit" >Aceptar</button>
                                                                                        </form>
                                                                                </div>
                                                                        </div>
                                                                </div>
                                                        </div>

                                                </td>
                                                <td>
                                                        <?php $datosAcepBorr= $usuarios->id_usuario."_".$usuarios->id_grupo."_".$usuarios->fecha_inscripcion; ?>
                                                        <input type="checkbox" name="masAcepDene" id="<?php echo $datosAcepBorr ?>" value="<?php echo $datosAcepBorr ?>" onchange="borrarAceptarId(this.id)">
                                                </td>
                                        <?php endif ?>
                                </tr>
                        <?php endforeach ?>
                </tbody>

        </table>

</article>


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