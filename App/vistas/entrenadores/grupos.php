
<?php require_once RUTA_APP . '/vistas/inc/navE.php' ?>


<header>              
    <div class="row">
        <div class="col-10"><span id="tHead">Grupos</span></div>     
        <div class="col-2">
            <a type="button" class="btn" style="background-color:#0b2a85" href="<?php echo RUTA_URL ?>/login/logout">
                <span style="font-size:25px;color:white">Logout</span>
                <img class="ms-2" id="salirHeader" src="<?php echo RUTA_Icon ?>logout.png" style="width:35px;height:35px" >
            </a>
        </div>
    </div>                                 
</header>



                 
                        <form method="post" action="<?php echo RUTA_URL ?>/entrenador/grupos">
                                <select class="form-select" style="width:330px; display: inline;" name='filtro' onchange="this.form.submit()">
                                    <option value="">Selecciona un grupo</option>
                                    <option value="0">-- VER TODOS --</option>
                                    <?php
                                    foreach ($datos['todosEntrenadoresGrupos'] as $info) {
                                        $nombre = $info->nombre_grupo;
                                        $id_grupo = $info->id_grupo;
                                    ?>
                                        <option name="filtro" value="<?php echo $id_grupo ?>"><?php echo $nombre ?></option>
                                    <?php }
                                    ?>
                                </select>                                                    
                        </form>                              
          


             <article>
            <table id="tabla" class="table"> 

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [2])) : ?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody class="table-light">
                        <?php foreach ($datos['alumnosGrupo'] as $todos) : ?>
                            <tr>
                                <td class="datos_tabla"><?php echo $todos->nombre ?></td>
                                <td class="datos_tabla"><?php echo $todos->apellidos ?></td>

                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [2])) : ?>
                                <td class="d-flex justify-content-center">


                                        <!-- MODAL ANOTAR MARCAS -->
                                        <a data-bs-toggle="modal" data-bs-target="#ModalMarcas_<?php echo $todos->id_usuario ?>">
                                            <img class="icono justify-content-center ms-3" src="<?php echo RUTA_Icon ?>test.svg"></img>
                                        </a>

                                        <!-- Ventana -->
                                        <div class="modal" id="ModalMarcas_<?php echo $todos->id_usuario ?>">
                                        <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content">

                                                <!-- Header -->
                                                <div class="modal-header">
                                                    <h2 class="modal-title">Anotar marcas: <?php echo $todos->nombre . " " . $todos->apellidos ?></h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Body -->
                                                <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL ?>/entrenador/marca/<?php echo $todos->id_usuario ?>" class="card-body">
                                                             
                                                        <div class="input-group mb-4">
                                                            <label for="elegir" class="input-group-text"><span class="info">Test y prueba</span></label>
                                                            <select class="form-select" name="idPrueba" id="idPrueba" style="width:300px;" required>
                                                                    <option value="">Seleciona una opcion</option>
                                                                    <?php foreach ($datos['testPruebas'] as $infoP) :?>
                                                                    <option name="idPrueba" class="form-control" value="<?php echo $infoP->id_test.":".$infoP->id_prueba ?>"><?php echo $infoP->nombreTest . ": " . $infoP->nombrePrueba . " (" . $infoP->tipo . ")" ?></option>
                                                                    <?php endforeach ?>
                                                            </select>
                                                        </div>
                                                                   
                                                        <div class="row mb-4">
                                                            <div class="col-6">
                                                                <div class="input-group">
                                                                <label for="marca" class="input-group-text"><span class="info">Marca ( hrs : min : seg )</span></label>
                                                                <input type="time" name="marca" id="marca" class="form-control" step="0.001" required>
                                                                </div>
                                                            </div>
                                                            <div class="col-6">
                                                                <div class="input-group">
                                                                <label for="fecha" class="input-group-text"><span class="info">Fecha realizacion</span></label>
                                                                <input type="date" name="fecha" id="fecha" class="form-control" required>
                                                                </div>
                                                            </div> 
                                                        </div>

                                                        <div class="row mb-5">
                                                            <div class="col-12">
                                                                <div class="input-group">
                                                                <label for="observaciones" class="input-group-text"><span class="info">Observaciones</span></label>
                                                                <input type="text" name="observaciones" id="observaciones" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <input type="submit" id="confirmar" class="btn" value="Confirmar">
                                                            </div>
                                                        </div>

                                                </form>
                                                </div>
                                        </div>
                                        </div>
                                        </div>

                                        <a href="<?php echo RUTA_URL?>/entrenador/gru_res/<?php echo $todos->id_usuario ?>"><img class="icono justify-content-center ms-3" src="<?php echo RUTA_Icon ?>ojo.svg"></img></a>

                   

                                </td>
                                <?php endif ?>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
                </article>


                <!--VER TODOS LOS RESULTADOS DEL GRUPO-->
                <!-- <div class="col text-center">
                        <a class="btn" id="añadir" href="<?php echo RUTA_URL ?>/entrenador/verTodos/">Ver todos</a>
                    </div>
                     -->

            
       







<script>
    function abrir(idModal) {
        var modal = document.getElementById(idModal);
        var body = document.getElementsByTagName("body")[0];
        modal.style.display = "block";
        body.style.overflow = "hidden";
    }

    function cerrar(idModal) {
        var modal = document.getElementById(idModal);
        var body = document.getElementsByTagName("body")[0];
        modal.style.display = "none";
        body.style.overflow = "visible";
    }
</script>