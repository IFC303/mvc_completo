<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


        <header>
        <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center"><span id="textoHead">Gestion de licencias</span></div>
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
                            <th>USUARIO</th>
                            <th>Nº LICENCIA</th>
                            <th>GIR</th>
                            <th>TIPO_LICENCIA</th>
                            <th>AUTONÓMICA/NACIONAL</th>
                            <th>DORSAL</th>
                            <th>FECHA_CADUCIDAD</th>       
                            <th>IMÁGEN</th>
                   
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['licencia'] as $licencia): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $licencia->nombre." ".$licencia->apellidos?></td>
                            <td class="datos_tabla"><?php if ($licencia->num_licencia==''){echo '-';}else {echo $licencia->num_licencia;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->gir=='' || ($licencia->num_licencia!='')){echo '-';}else {echo $licencia->gir;}?></td>
                            <td class="datos_tabla"><?php echo $licencia->tipo?></td>
                            <td class="datos_tabla"><?php if ($licencia->regional_nacional==''){echo '-';}else {echo $licencia->regional_nacional;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->dorsal==''){echo '-';}else {echo $licencia->dorsal;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->fecha_cad==''){echo '-';}else {echo $licencia->fecha_cad;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->imagen==''){echo '-';}else {?> <a href="<?php echo RUTA_URL?>/adminLicencias/verFoto/<?php echo $licencia->id_licencia?>" target="_blank"><img width="30" height="30" src="<?php echo RUTA_ImgDatos.'licencias/'.$licencia->imagen?>"></a><?php ;}?></td>
                                                    
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            
                            <td class="d-flex justify-content-center">

                                <!--MODAL VER (javascript)-->
                                    
                                    <a data-bs-toggle="modal" data-bs-target="#ModalVer_<?php echo $licencia->id_licencia ?>">
                                    <img class="icono" src="<?php echo RUTA_Icon?>ojo.svg"     ></img>
                                    </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalVer_<?php echo $licencia->id_licencia ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content" >

                                            <!--Header-->
                                            <div class="modal-header">
                                                    <h2 class="modal-title">Datos de la licencia</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>                             
                                            </div>
                                            

                                            <!--Body-->
                                            
                                            <?php 
                                            
                                                if ($licencia->tipo=="Adulto") { ?>

                                                    <!-- VER ADULTO -->

                                                    <div id="bodyVer" class="row m-3">
                                                <div class="col-12">
                                                    <label for="id_usuario">USUARIO</label>
                                                    <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $licencia->nombre ?>" readonly>
                                                    <br><br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="num_licencia">NUM_LICENCIA</label>
                                                    <input type="text" name="num_licencia" id="num_licencia" class="form-control form-control-lg" value="<?php echo $licencia->num_licencia?>" readonly> 
                                                    <br><br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="tipo">TIPO_LICENCIA</label>
                                                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $licencia->tipo?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="regional_nacional">AUTONÓMICA/NACIONAL</label>
                                                    <input type="text" name="regional_nacional" id="regional_nacional" class="form-control form-control-lg" value="<?php echo $licencia->regional_nacional?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="dorsal">DORSAL</label>
                                                    <input type="text" name="dorsal" id="dorsal" class="form-control form-control-lg" value="<?php echo $licencia->dorsal?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="fecha_cad">FECHA_CADUCIDAD</label>
                                                    <input type="text" name="fecha_cad" id="fecha_cad" class="form-control form-control-lg" value="<?php echo $licencia->fecha_cad?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="imagen">IMÁGEN</label><br>
                                                    <?php if ($licencia->imagen=='') {?><img id="imagen" name="imagen" ><?php ;}else {?><a href="<?php echo RUTA_URL?>/adminLicencias/verFoto/<?php echo $licencia->id_licencia ?>" target="_blank"><img id="imagen" name="imagen"  width="150" height="150" src='<?php echo RUTA_ImgDatos.'licencias/'.$licencia->imagen?>'></a><?php ;} ?> 
                                                    <br><br>
                                                </div>
                                            </div>
                                            <?php    }elseif($licencia->tipo=="Escolar"){ ?>

                                                <!-- VER ESCOLAR -->

                                                <div id="bodyVer" class="row m-3">
                                                <div class="col-12">
                                                    <label for="id_usuario">USUARIO</label>
                                                    <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $licencia->nombre ?>" readonly>
                                                    <br><br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="gir">GIR</label>
                                                    <input type="text" name="gir" id="gir" class="form-control form-control-lg" value="<?php echo $licencia->gir?>" readonly> 
                                                    <br><br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="tipo">TIPO_LICENCIA</label>
                                                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $licencia->tipo?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="dorsal">DORSAL</label>
                                                    <input type="text" name="dorsal" id="dorsal" class="form-control form-control-lg" value="<?php echo $licencia->dorsal?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="imagen">IMÁGEN</label><br>
                                                    <?php if ($licencia->imagen=='') {?><img id="imagen" name="imagen" ><?php ;}else {?><a href="<?php echo RUTA_URL?>/adminLicencias/verFoto/<?php echo $licencia->id_licencia ?>" target="_blank"><img id="imagen" name="imagen"  width="150" height="150" src='<?php echo RUTA_ImgDatos.'licencias/'.$licencia->imagen?>'></a><?php ;} ?> 
                                                    <br><br>
                                                </div>
                                            </div>
                                            <?php }

                                            ?>

                                        </div>
                                    </div>
                                    </div>

                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $licencia->id_licencia  ?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $licencia->id_licencia  ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de la licencia</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" ENCTYPE="multipart/form-data" action="<?php echo RUTA_URL?>/adminLicencias/editarLicencia/<?php echo $licencia->id_licencia?>" class="card-body">
                                                    <?php 
                                                    if ($licencia->tipo=="Adulto") { ?>

                                                        <!-- EDITAR ADULTO -->

                                                    <div class="col-12" style="display:none">
                                                        <label for="id_usuario">ID_USUARIO</label>
                                                        <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $licencia->id_usuario ?>" readonly>
                                                        <br><br>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <label for="usuario">USUARIO</label>
                                                        <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" value="<?php echo $licencia->nombre ?>" readonly>
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="tipo">TIPO_LICENCIA</label>
                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $licencia->tipo?>" readonly> 
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="num_licencia">NUM_LICENCIA</label>
                                                        <input type="text" name="num_licencia" id="num_licencia" class="form-control form-control-lg" value="<?php echo $licencia->num_licencia?>"> 
                                                        <br><br>
                                                    </div>
                                                    
                                                    <div class="col-12" style="display:none">
                                                        <label for="num_licencia">GIR</label>
                                                        <input type="text" name="gir" id="gir" class="form-control form-control-lg" value="<?php echo $licencia->gir?>" > 
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="regional_nacional">AUTONÓMICA/NACIONAL</label>
                                                        <select name="regional_nacional" id="regional_nacional" class="form-control form-control-lg">
                                                            <?php if ($licencia->regional_nacional == "Autonómica") { ?>
                                                                <option value="0">Puedes elegir...</option>
                                                                <option value="1" selected>Autonómica</option>
                                                                <option value="2">Nacional</option> <?php
                                                            }elseif ($licencia->regional_nacional == "Nacional") { ?>
                                                                <option value="0">Puedes elegir...</option>
                                                                <option value="1">Autonómica</option>
                                                                <option value="2" selected>Nacional</option><?php
                                                            }elseif ($licencia->regional_nacional == "") {?>
                                                                <option value="0" selected>Puedes elegir...</option>
                                                                <option value="1">Autonómica</option>
                                                                <option value="2">Nacional</option><?php
                                                            }
                                                            ?>
                                                            
                                                        </select>
                                                        
                                                        <br>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <label for="dorsal">DORSAL</label>
                                                        <input type="number" min="0" name="dorsal" id="dorsal" class="form-control form-control-lg" value="<?php echo $licencia->dorsal?>" >    
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="fecha_cad">FECHA_CADUCIDAD</label>
                                                        <input type="date" name="fecha_cad" id="fecha_cad" class="form-control form-control-lg" value="<?php echo $licencia->fecha_cad?>" >    
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="imagen">IMÁGEN</label>
                                                        <input type="file" accept="image/*" name="imagen" id="imagen" class="form-control form-control-lg">
                                                        <br><br>
                                                    </div>

                                                    
                                                    
                                                    <?php }elseif($licencia->tipo=="Escolar"){ ?>

                                                        <!-- EDITAR ESCOLAR -->


                                                    <div class="col-12" style="display:none">
                                                        <label for="id_usuario">ID_USUARIO</label>
                                                        <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $licencia->id_usuario ?>" readonly>
                                                        <br><br>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <label for="usuario">USUARIO</label>
                                                        <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" value="<?php echo $licencia->nombre ?>" readonly>
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="tipo">TIPO_LICENCIA</label>
                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $licencia->tipo?>" readonly> 
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12" style="display:none">
                                                        <label for="num_licencia">NUM_LICENCIA</label>
                                                        <input type="text" name="num_licencia" id="num_licencia" class="form-control form-control-lg" value="<?php echo $licencia->num_licencia?>"> 
                                                        <br><br>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <label for="num_licencia">GIR</label>
                                                        <input type="text" name="gir" id="gir" class="form-control form-control-lg" value="<?php echo $licencia->gir?>" > 
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12" style="display:none">
                                                        <label for="regional_nacional">AUTONÓMICA/NACIONAL</label>
                                                        <select name="regional_nacional" id="regional_nacional" class="form-control form-control-lg">
                                                            <?php if ($licencia->regional_nacional == "Autonómica") { ?>
                                                                <option value="0">Puedes elegir...</option>
                                                                <option value="1" selected>Autonómica</option>
                                                                <option value="2">Nacional</option> <?php
                                                            }elseif ($licencia->regional_nacional == "Nacional") { ?>
                                                                <option value="0">Puedes elegir...</option>
                                                                <option value="1">Autonómica</option>
                                                                <option value="2" selected>Nacional</option><?php
                                                            }elseif ($licencia->regional_nacional == "") {?>
                                                                <option value="0" selected>Puedes elegir...</option>
                                                                <option value="1">Autonómica</option>
                                                                <option value="2">Nacional</option><?php
                                                            }
                                                            ?>
                                                            
                                                        </select>
                                                        
                                                        <br>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <label for="dorsal">DORSAL</label>
                                                        <input type="number" min="0" name="dorsal" id="dorsal" class="form-control form-control-lg" value="<?php echo $licencia->dorsal?>" >    
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12" style="display:none">
                                                        <label for="fecha_cad">FECHA_CADUCIDAD</label>
                                                        <input type="date" name="fecha_cad" id="fecha_cad" class="form-control form-control-lg" value="<?php echo $licencia->fecha_cad?>" >    
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="imagen">IMÁGEN</label>
                                                        <input type="file" accept="image/*" name="imagen" id="imagen" class="form-control form-control-lg">
                                                        <br><br>
                                                    </div>

                                                    
                                                    <?php } ?>
                                                    
                                                    
                                                    <input type="submit" class="btn" value="Confirmar">
                                                    
                                                    
                                                </form>

                                            </div>
                                            
                                        </div>
                                    </div>
                                    </div>




                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $licencia->id_licencia ?>" href="<?php echo RUTA_URL?>/adminLicencias/borrar/<?php echo $licencia->id_licencia  ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $licencia->id_licencia ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar la licencia <?php if ($licencia->num_licencia=="") {
                                                    echo $licencia->gir;
                                                }else {
                                                    echo $licencia->num_licencia;
                                                } ?> ?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminLicencias/borrar/<?php echo $licencia->id_licencia?>" method="post">
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
                    <div class="col text-center mt-5">
                        <a class="btn"style="background-color: #023ef9; color:white" id="añadir" href="<?php echo RUTA_URL?>/adminLicencias/nueva_licencia/">Nueva licencia</a>
                    </div>
                    

                    <div class="mt-4">
                        <a href="<?php echo RUTA_URL?>/adminLicencias/exportarLicencias" class="btn bg-warning">Exportar a Excel</a>
                    </div>
      
</article>
<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>





