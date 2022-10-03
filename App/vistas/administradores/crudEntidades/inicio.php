<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <header>
        <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Gestion de entidades</span></div>
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
                        <tr>
                            <th>CIF</th>
                            <th>NOMBRE</th>
                            <th>DIRECCION</th>
                            <th>TELEFONO</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['entidad'] as $entidad): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $entidad->id_entidad?></td>
                            <td class="datos_tabla"><?php echo $entidad->nombre?></td>
                            <td class="datos_tabla"><?php echo $entidad->direccion?></td>
                            <td class="datos_tabla"><?php echo $entidad->telefono?></td>
     
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            <td class="d-flex justify-content-center">

                                <!--MODAL VER (javascript)-->
                                    <img class="icono mt-1" id="btnModal_<?php echo $entidad->id_entidad?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir('<?php echo $entidad->id_entidad?>');" ></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $entidad->id_entidad?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                <h2 class="col-11">Datos de la entidad</h2>
                                                <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $entidad->id_entidad?>" onclick="cerrar('<?php echo $entidad->id_entidad?>');">                                              
                                            </div>
                                            <hr>

                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">

                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="id_entidad">CIF</label>
                                                        <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" value="<?php echo $entidad->id_entidad?>" readonly>
                                                    </div>
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <input  type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $entidad->nombre?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="mt-3 mb-3">
                                                    <label for="direccion">Direccion</label>
                                                    <input type="text" name="direccion" id="direccion" class="form-control form-control-lg" value="<?php echo $entidad->direccion?>" readonly>
                                                </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="telefono">Telefono</label>
                                                        <input type="text" name="telefono" id="telefono" class="form-control form-control-lg" value="<?php echo $entidad->telefono?>" readonly>
                                                    </div>
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="email">Email</label>
                                                        <input type="text" name="email" id="email" class="form-control form-control-lg" value="<?php echo $entidad->email?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                <div class="mt-3 mb-3">
                                                    <label for="observaciones">Observaciones</label>
                                                    <input type="text" name="observaciones" id="observaciones" class="form-control form-control-lg" value="<?php echo $entidad->observaciones?>" readonly>
                                                    <br>
                                                </div></div>

                                            </div>
                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $entidad->id_entidad?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $entidad->id_entidad?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de la entidad</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminEntidades/editarEntidad/<?php echo $entidad->id_entidad?>" class="card-body">
                                                    <div class="row">
                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="id_entidad">CIF</label>
                                                            <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" value="<?php echo $entidad->id_entidad?>" readonly>
                                                        </div>
                                                            <div class="col-6 mt-3 mb-3">
                                                            <label for="nombre">Nombre</label>
                                                            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $entidad->nombre ?>" required>
                                                        </div>
                                                    </div>
                                                  
                                                    <div class="mt-3 mb-3">
                                                        <label for="direccion">Direccion</label>
                                                        <input type="text" name="direccion" id="direccion" class="form-control form-control-lg" value="<?php echo $entidad->direccion ?>" required>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="telefono">Telefono</label>
                                                            <input type="text" name="telefono" id="telefono" class="form-control form-control-lg" value="<?php echo $entidad->telefono ?>" required>
                                                        </div>
                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="email">Email</label>
                                                            <input type="text" name="email" id="email" class="form-control form-control-lg" value="<?php echo $entidad->email?>" required>
                                                        </div>
                                                    </div>

                                                    <div class="mt-3 mb-3">
                                                        <label for="observaciones">Observaciones</label>
                                                        <input type="text" name="observaciones" id="observaciones" class="form-control form-control-lg">
                                                    </div>
               
                                                    <br>
                                                    <input type="submit" class="btn" value="Confirmar">
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $entidad->id_entidad?>" href="<?php echo RUTA_URL?>/adminEntidades/borrar/<?php echo $entidad->id_entidad?>">
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
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar la entidad <?php echo $entidad->nombre?>?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEntidades/borrar/<?php echo $entidad->id_entidad?>" method="post">
                                                    <button type="submit" class="btn">Borrar</button>
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

<!--CREAR NUEVO GRUPO Y AÑADIR PARTICIPANTES-->
<div class="col text-center mt-5">
    <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/adminEntidades/nuevaEntidad/">Nueva entidad</a>
</div>

</article>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>










            <script>

                    function abrir(idModal){
                        var modal=document.getElementById(idModal);
                         console.log(idModal);
                         var body=document.getElementsByTagName("body")[0];
                         modal.style.display="block";
                         body.style.overflow="hidden";
                    }

                   function cerrar(idModal){
                         var modal=document.getElementById(idModal);
                         var body=document.getElementsByTagName("body")[0];
                         modal.style.display="none";
                         body.style.overflow="visible";
                     }

            </script>

