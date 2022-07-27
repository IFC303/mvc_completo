<?php require_once RUTA_APP . '/vistas/inc/header.php' ?>
<?php require_once RUTA_APP . '/vistas/inc/head_en.php' ?>



        <div class="container">

            <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Gestion de test</h4></div>
            </div>
            

            <div id="tabla">
            <table class="table table-hover" >

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>NOMBRE</th>
                            <th>FECHA ALTA</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                    <!--BODY TABLA-->
                    <tbody class="table-light">
                        <?php foreach($datos['test'] as $test): ?>
                        <tr>
                            <td class="datos_tabla"><?php echo $test->nombreTest?></td>
                            <td class="datos_tabla"><?php echo $test->fecha_alta?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                            <td class="d-flex justify-content-center"> 
                              

                                <!--MODAL VER (javascript)-->
                                <img class="icono mt-1" id="btnModal_<?php echo $test->id_test ?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir(<?php echo $test->id_test ?>);"></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $test->id_test ?>" class="modalVer">
                                    <div class="modal-content modal-lg" style="margin:auto">

                                        <!--Header-->
                                        <div id="headerVer" class="row">
                                            <h2 class="col-11">Informacion del test</h2>
                                            <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $test->id_test ?>" onclick="cerrar(<?php echo $test->id_test ?>);">                                              
                                        </div><hr>

                                        <!--Body-->
                                        <div id="bodyVer" class="row m-3">

                                            <div class="input-group mt-3 mb-5">
                                                <label for="nombreTest" class="input-group-text"><span class="info">Nombre<sup>*</sup></span></label>
                                                <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-md" value="<?php echo $test->nombreTest?>" readonly>
                                            </div> 

                                            <div class="mb-5">
                                                <label class="mb-3" for="pruebas">Pruebas incluidas</label>
                                                    <?php $tipo="";
                                                        $tipo="";
                                                        foreach($datos['pruebas'] as $prueba):
                                                            if ($tipo!=$prueba->tipo){
                                                                $tipo=$prueba->tipo;
                                                                echo '<br>';
                                                                echo $tipo.':'.'&nbsp;&nbsp;&nbsp;';
                                                            } 

                                                            $seleccionado="";
                                                            foreach($test->pruebas as $pruebaTest):
                                                                if ($pruebaTest->id_prueba==$prueba->id_prueba){
                                                                    $seleccionado = "checked";
                                                                }
                                                            endforeach;?>

                                                            <input type="checkbox" name="id_prueba[]" value="<?php echo $prueba->id_prueba ?>" <?php echo $seleccionado?> disabled>    
                                                            <?php echo $prueba->nombrePrueba.'&nbsp;&nbsp;&nbsp;';
                                                        endforeach;?>                                                             
                                            </div>
                                        </div>
                                    </div>  
                                    </div> 
                                    


                                <!-- MODAL EDITAR -->                               
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $test->id_test ?>" >
                                  <img class="icono justify-content-center ms-3" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $test->id_test ?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de Test</h2>
                                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal"></button> -->
                                            </div>
                                            <!-- Body -->
                                            <div class="modal-body">
                                            <form method="post" action="<?php echo RUTA_URL?>/entrenador/editarTest/<?php echo $test->id_test?>" class="card-body">
                                                
                                                <div class="input-group mt-3 mb-5">
                                                    <label for="nombreTest" class="input-group-text"><span class="info">Nombre<sup>*</sup></span></label>
                                                    <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-md" value="<?php echo $test->nombreTest?>" required>
                                                </div> 
                                    
                                                <div class="mt-3 mb-3">                                            
                                                    <label class="mb-3" for="pruebas_selec">Selecciona las pruebas que quieres incluir en el test</label>
                                                    <?php $tipo="";
                                                          $tipo="";
                                                            foreach($datos['pruebas'] as $prueba):
                                                                if ($tipo!=$prueba->tipo){
                                                                    $tipo=$prueba->tipo;
                                                                    echo '<br>';
                                                                    echo $tipo.':'.'&nbsp;&nbsp;&nbsp;';
                                                                } 
                                                                    $seleccionado="";
                                                                    foreach($test->pruebas as $pruebaTest):
                                                                        if ($pruebaTest->id_prueba==$prueba->id_prueba){
                                                                            $seleccionado = "checked";
                                                                        }
                                                                    endforeach;
                                                            ?>
                                                                <input type="checkbox" name="id_prueba[]" value="<?php echo $prueba->id_prueba ?>" <?php echo $seleccionado?> >    
                                                                <?php echo $prueba->nombrePrueba.'&nbsp;&nbsp;&nbsp;';
                                                            endforeach; ?>   
                                                </div>

                                                <input type="hidden" name="id_test" value="<?php echo $test->id_test?>">  

                                                <!-- Modal footer  -->
                                                <div class="modal-footer">
                                                <!-- BOTONES CONFIRMAR Y CERRAR-->  
                                                <input type="submit" class="btn me-1" id="confirmar" value="Confirmar">
                                                <a href="<?php echo RUTA_URL?>/entrenador/test"><input class="btn" type="button" id="botonVolver" value="Cerrar"></a> 
                                                </div>

                                            </form>
                                            </div>
                                    </div>
                                    </div>
                                    </div>
                                   



                                <!-- MODAL BORRAR -->                                                            
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $test->id_test ?>" href="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $test->id_test ?>">
                                  <img class="icono justify-content-center ms-3" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $test->id_test ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <!-- Modal body -->
                                        <div class="modal-body mt-5" style="text-align:center">
                                            <h6>Seguro que quiere borrar el test <?php echo $test->nombreTest ?> ?</h6>
                                            <p>( Se borraran todas las marcas asociadas a este test )</p>
                                        </div>
                                        <!-- Modal footer  -->
                                        <div class="modal-footer">
                                            <form action="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $test->id_test ?>" method="post">
                                                <!-- BOTONES CONFIRMAR Y CERRAR-->  
                                                <input type="submit" class="btn me-1" id="confirmar" value="Confirmar">
                                                <a href="<?php echo RUTA_URL?>/entrenador/test"><input class="btn" type="button" id="botonVolver" value="Cerrar"></a>                            
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

                <!--NUEVO TEST-->
                <div class="col text-center">
                    <a class="btn" id="confirmar" href="<?php echo RUTA_URL?>/entrenador/nuevo_test/">Nuevo test</a>
                </div>

        </div>





<script>
function abrir(idModal){
    var modal=document.getElementById(idModal);
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
