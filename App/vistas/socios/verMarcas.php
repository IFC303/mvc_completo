<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>



        <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Mis marcas</span>
                </div>
                <div class="col-2 mt-2">
                    <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_URL ?>/login/logout">
                        <span>Logout</span>
                        <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                    </a>
                </div>
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->


<article>

        <table id="tabla" class="table">

        <!--CABECERA TABLA-->
        <thead>
            <tr>
                <th>FECHA REALIZACION</th>
                <th>DISTANCIA</th>  
                <th>TIEMPO</th>
                <th>VELOCIDAD (km/h)</th> 
                <th>RITMO MED (min/km)</th> 
                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>
                    <th>OPCIONES</th>
                <?php endif ?>
            </tr>
        </thead>


        <!--BODY TABLA-->
        <tbody>
        <?php foreach ($datos['usuarios'] as $marcas) :?>

                <tr>
                    <td><?php echo $marcas->fecha?></td>
                    <td><?php echo $marcas->kilometros.'km '.$marcas->metros.'m'?></td>
                    <td><?php echo $marcas->tiempo?></td>
                    <td><?php echo $marcas->velocidad?></td>
                    <td><?php echo $marcas->ritmo?></td>
                

            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>
            
        <td>

            <!-- MODAL BORRAR -->
            <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $marcas->id_seguimiento?>">
              <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
            </a>

                <!-- VENTANA -->
                <div class="modal" id="borrar_<?php echo $marcas->id_seguimiento?>">
                <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body mt-3">
                        <p>Estas seguro que quieres <b>BORRAR</b> la marca del dia <b><?php echo $marcas->fecha?></b> ? </p>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <form action="<?php echo RUTA_URL?>/socio/borrar_marca/<?php echo $marcas->id_seguimiento?>" method="post">
                                <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
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



        <!-- AÑADIR NUEVA MARCA-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nueva_marca">
                <input type="button" id="anadir" class="btn" value="Nueva Marca">
            </a>
            <a id="botonVolver" data-bs-toggle="modal" data-bs-target="#grafico" class="btn" href="<?php echo RUTA_URL?>/socio/exportarLicencias" >Mi evolucion</a>
        </div>


        <div class="modal fade" id="nueva_marca">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Nueva marca</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                    <form action="<?php echo RUTA_URL?>/socio/nueva_marca" method="post">

                        <div class="row mt-4 mb-4">
                            <div class="input-group">
                                <label for="nombre" class="input-group-text">Fecha<sup>*</sup></label>
                                <input type="date" class="form-control form-control-md" id="nfecha" name="fecha" required >
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <div class="input-group">
                                    <label for="km" class="input-group-text">Kilometros<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-md" id="km" name="km" maxlength="9" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="input-group">
                                    <label for="metros" class="input-group-text">Metros<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-md" id="metros" name="metros" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="input-group">
                                <label for="tiempo" class="input-group-text">Tiempo<sup>*</sup></label>
                                <input type="time" step="0.001" class="form-control form-control-md" id="tiempo" name="tiempo" required >
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="input-group">
                                <textarea  type="text" style="height:150px" class="form-control" id="observaciones" name="observaciones" placeholder="Observaciones"></textarea>
                            </div> 
                        </div>

                        <div class="d-flex justify-content-end">
                            <input type="submit" class="btn mt-3 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                        </div> 

                    </form>

                </div>
                </div>

        </div>
        </div>
        </div>

</article>


<div class="modal fade" id="grafico">
<div class="modal-dialog modal-xl modal-dialog-centered">
<div class="modal-content">

        <!-- Modal Header -->
         <div class="modal-header azul">
            <p class="modal-title ms-3">Grafico de evolucion</p> 
            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body mt-3 mb-5 d-flex justify-content-center">
            <img src="<?php echo RUTA_Public?>/grafica.png" alt="">
        </div>

 </div>
 </div>
 </div>

      

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>