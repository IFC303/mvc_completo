<?php require_once RUTA_APP . '/vistas/inc/navE.php' ?>



    <!------------------------------ CABECERA -------------------------------->
    <header>
        <div class="row mb-5">
            <div class="col-10 d-flex align-items-center justify-content-center ">
                <span id="textoHead">Gestion de test y pruebas</span>
            </div>
            <div class="col-2 mt-1">
                <a href="<?php echo RUTA_URL ?>/login/logout">
                    <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
                </a>
            </div>            
        </div>                                   
    </header>
    <!----------------------------------------------------------------------->



    <article class="pt-4">

                <table id="tabla" class="table w-50">
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
                    <tbody>
                        <?php foreach($datos['test'] as $test): ?>
                        <tr id="manita">
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $test->id_test?>"><?php echo $test->nombreTest?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $test->id_test?>"><?php echo date("d/m/Y", strtotime($test->fecha_alta))?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                            <td> 

                                    <!-- MODAL VER-->        
                                    <!-- Ventana -->
                                    <div class="modal fade" id="ver<?php echo $test->id_test?>">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content ">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3">Test: <?php echo $test->nombreTest?></p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>
                            
                                        <!-- Modal body -->
                                        <div class="modal-body info mb-4">                         

                                            <div class="row mt-4 mb-4">
                                                <div class="col-7">
                                                    <div class="input-group">
                                                        <label for="nombreTest" class="input-group-text"><span class="info">Nombre</span></label>
                                                        <input type="text" name="nombreTest" id="nombreTest" class="form-control" value="<?php echo $test->nombreTest?>" readonly>
                                                    </div> 
                                                </div>
                                                <div class="col-5">
                                                    <div class="input-group">
                                                        <label for="fecha" class="input-group-text">Fecha alta</label>
                                                        <input type="date" class="form-control" id="fecha" name="fecha" value="<?php echo $test->fecha_alta?>"readonly>
                                                    </div>
                                                </div>
                                            </div> 

                                            <div class="row mb-4">                         
                                                <div class="input-group">
                                                    <textarea  type="text" style="height:100px" class="form-control" placeholder ="Observaciones" id="descripcion" name="descripcion" readonly><?php echo $test->descripcion?></textarea>
                                                </div>                           
                                            </div> 
                              

                                            <div class="titulito ms-3"><span>Pruebas incluidas</span></div>   
   
                                            <div class="ms-3" style="text-align:left">
                                                    <?php 
                                                    $tipo="";
                                                    foreach($datos['pruebas'] as $prueba):
                                                        if ($tipo!=$prueba->tipo){
                                                            $tipo=$prueba->tipo;
                                                            echo '<br>';?>
                                                            <span style="text-decoration:underline" class="me-3"><?php echo $tipo.':';?></span>
                                                        <?php } 

                                                        $seleccionado="";
                                                        foreach($test->pruebas as $pruebaTest):
                                                            if ($pruebaTest->id_prueba==$prueba->id_prueba){
                                                                $seleccionado = "checked";
                                                            }endforeach;?>
                                                        
                                                        <input class="mt-2 mb-4" type="checkbox" name="id_prueba[]" value="<?php echo $prueba->id_prueba ?>" <?php echo $seleccionado?> disabled> 
                                                        <?php echo $prueba->nombrePrueba;?> 

                                                    <?php endforeach;?>   
                                            </div>                                                          
                                         
                                        </div>
                                       
                                    </div>
                                    </div>
                                    </div>
                                    


                                <!-- MODAL EDITAR -->                               
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $test->id_test ?>" >
                                  <img class="icono justify-content-center ms-3" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal fade" id="editar_<?php echo $test->id_test ?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header azul">
                                                <h2 class="modal-title">Edicion de Test</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Body -->
                                            <div class="modal-body">
                                            <form method="post" action="<?php echo RUTA_URL?>/entrenador/editarTest/<?php echo $test->id_test?>" class="card-body">
                                                
                                                <div class="row mt-3 mb-4">
                                                    <div class="col-7">
                                                        <div class="input-group">
                                                            <label for="nombreTest" class="input-group-text"><span class="info">Nombre</span></label>
                                                            <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-md" value="<?php echo $test->nombreTest?>" >
                                                        </div> 
                                                    </div>
                                                    <div class="col-5">
                                                        <div class="input-group">
                                                            <label for="fecha" class="input-group-text">Fecha alta</label>
                                                            <input type="date" class="form-control form-control-md" id="fecha" name="fecha" value="<?php echo $test->fecha_alta?>">
                                                        </div>
                                                    </div>
                                                </div>  

                                                <div class="row mb-3">                         
                                                    <div class="input-group">
                                                        <textarea  type="text" style="height:100px" class="form-control" placeholder ="Observaciones" id="descripcion" name="descripcion"><?php echo $test->descripcion?></textarea>
                                                    </div>                           
                                                </div> 
                                    
                                              
                                                <div class="titulito"><span>Selecciona las pruebas que quieres incluir en el test</span></div>    

                                                <div style="text-align:left">
                                                    <?php 
                                                          $tipo="";
                                                            foreach($datos['pruebas'] as $prueba):
                                                                if ($tipo!=$prueba->tipo){
                                                                    $tipo=$prueba->tipo;
                                                                    echo '<br>';
                                                                   ?> <span style="text-decoration:underline" class="me-3"><?php echo $tipo.':';?></span>
                                                                <?php } 
                                                                $seleccionado="";
                                                                foreach($test->pruebas as $pruebaTest):
                                                                    if ($pruebaTest->id_prueba==$prueba->id_prueba){
                                                                        $seleccionado = "checked";
                                                                    }
                                                                endforeach;
                                                            ?>
                                                        <input class="mt-2 mb-4"  type="checkbox" name="id_prueba[]" value="<?php echo $prueba->id_prueba ?>" <?php echo $seleccionado?> >    
                                                        <?php echo $prueba->nombrePrueba.'&nbsp;&nbsp;&nbsp;';
                                                    endforeach; ?> 
                                                </div> 
                                           

                                                <input type="hidden" name="id_test" value="<?php echo $test->id_test?>">  

                                                <div class=" d-flex justify-content-end">
                                                    <input type="submit" class="btn mt-4 mb-3 " name="aceptar" id="confirmar" value="Confirmar">        
                                                </div> 
                  

                                            </form>
                                            </div>
                                    </div>
                                    </div>
                                    </div>
                                   


                                <!-- MODAL BORRAR -->
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $test->id_test?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal fade" id="borrar_<?php echo $test->id_test?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                            <p>Estas seguro que quieres <b>BORRAR</b> el test <b><?php echo $test->nombreTest ?></b> ? </p>
                                            <p>(Si aceptas,se borraran todas las marcas asociadas a este test)</p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $test->id_test?>" method="post">
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
                                          




        <!-- AÑADIR NUEVO TEST-->
        <div class="col text-center mt-5">
            <a data-bs-toggle="modal" data-bs-target="#nuevo">
                <input type="button" id="anadir" class="btn" value="Nuevo Test">
            </a>
        </div>


        <div class="modal fade" id="nuevo">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">
                        <p class="modal-title ms-3">Creacion de test</p> 
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1">                                                                                                           
                                                    
                        <form action="<?php echo RUTA_URL?>/entrenador/nuevo_test" method="post">

                            <div class="input-group mt-4 mb-4">
                                <label for="nombreTest" class="input-group-text"><span class="info">Nombre<sup>*</sup></span></label>
                                <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-md" required>
                            </div>   
                            
                            <div class="row mb-5">                         
                                <div class="input-group">
                                    <textarea  type="text" style="height:100px" class="form-control" placeholder ="Observaciones" id="descripcion" name="descripcion"></textarea>
                                </div>                           
                            </div> 

                            <div class="titulito"><span>Selecciona las pruebas que quieres incluir en el test</span></div>
                            
                            <?php $tipo="";
                                foreach($datos['pruebas'] as $prueba):
                                    if ($tipo!=$prueba->tipo){
                                        $tipo=$prueba->tipo;
                                        echo '<br>'; ?>
                                        <span style="text-decoration:underline" class="me-3"><?php echo $tipo.':';?></span>
                                    <?php } ?>
                                    <input class="mt-2 mb-4"  type="checkbox" name="id_prueba[]" value="<?php echo $prueba->id_prueba ?>">  
                                    <?php echo $prueba->nombrePrueba.'&nbsp;&nbsp;&nbsp;';
                            endforeach ?>      


                                <div class="mt-4 mb-4 d-flex justify-content-end">
                                    <input type="submit" class="btn " name="aceptar" id="confirmar" value="Confirmar"> 
                               </div> 

                        </form>

                        </div>
                        </div>

        </div>
        </div>
        </div>


</article>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>






