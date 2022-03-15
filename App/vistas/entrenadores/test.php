
<?php require_once RUTA_APP . '/vistas/inc/header_entrenador_miga.php' ?>



        <div class="container">

            <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Gestion de test</h4></div>
            </div>
            
           <div class="tabla">
            <table class="table table-hover" >

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>Nº TEST</th>
                            <th>NOMBRE</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['test'] as $test): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $test->id_test?></td>
                            <td class="datos_tabla"><?php echo $test->nombreTest?></td>


                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                            <td>

                                <!--MODAL VER (javascript)-->
                                    <img  class="icono" id="btnModal_<?php echo $test->id_test ?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir(<?php echo $test->id_test ?>);"></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $test->id_test ?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                    <h2 class="col-11">Datos del test</h2>
                                                    <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $test->id_test ?>" onclick="cerrar(<?php echo $test->id_test ?>);">                                              
                                            </div>
                                            <hr>


                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">

                                                <div class="col-12">
                                                    <label for="id_test">Numero de test</label>
                                                    <input type="text" name="id_test" id="id_test" class="form-control form-control-lg" value="<?php echo $test->id_test?>" readonly>
                                                    <br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="nombreTest">Nombre</label>
                                                    <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-lg" value="<?php echo $test->nombreTest?>" readonly>      
                                                    <br>
                                                </div>

                                                <div class="mt-3 mb-3">
                                                        <label for="pruebas">Pruebas incluidas</label>
                                                        <br>
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
                                                                <input type="checkbox" name="id_prueba[]" value="<?php echo $prueba->id_prueba ?>" <?php echo $seleccionado?> disabled>    
                                                                <?php echo $prueba->nombrePrueba.'&nbsp;&nbsp;&nbsp;';
                                                            endforeach; ?>   
                                                    </div>
                                            </div>
                                            
                                            <!--Footer-->
                                            <!-- <div id="footerVer">
                                                <input class="btn" type="button" id="cerrar_<?php echo $test->id_test ?>" onclick="cerrar(<?php echo $test->id_test ?>);" value="Cerrar" >
                                                <br>
                                                <br>
                                            </div>
                                         -->

                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $test->id_test ?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $test->id_test ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de Test</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/entrenador/editarTest/<?php echo $test->id_test ?>" class="card-body">
                                                   
                                                     <div class="mt-3 mb-3">
                                                        <label for="id_test">Id de test</label>
                                                        <input type="text" name="id_test" id="id_test" class="form-control form-control-lg" value="<?php echo $test->id_test?>" readonly>
                                                    </div> 
                                                    
                                                    <div class="mt-3 mb-3">
                                                        <label for="nombreTest">Nombre</label>
                                                        <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-lg" value="<?php echo $test->nombreTest?>">
                                                    </div>
                                                    
                                                    <div class="mt-3 mb-3">
                                                        <br>
                                                        <label for="pruebas_selec">Selecciona las pruebas que quieres incluir en el test</label>
                                                        <br>
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
                                                            <br>
                                                            <br>
                                                    </div>
                                                    <input type="submit" class="btn" value="Confirmar">
                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                    </div>




                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $test->id_test ?>" href="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $test->id_test ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $test->id_test ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar el test <?php echo $test->nombreTest ?> ?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $test->id_test ?>" method="post">
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

                    <!--AÑADIR-->
                    <div class="col text-center">
                        <a class="btn" id="añadir" href="<?php echo RUTA_URL?>/entrenador/nuevo_test/">Nuevo test</a>
                    </div>
                    <br>

            </div>


            
        </div>



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

