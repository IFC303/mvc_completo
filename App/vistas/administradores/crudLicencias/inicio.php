<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de Licencias</span>
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
                            <th>USUARIO</th>
                            <th>TIPO</th>
                            <th>AUTONÓMICA/NACIONAL</th>
                            <th>FECHA CADUCIDAD</th>       
                            <th>IMÁGEN</th>
                   
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['licencia'] as $licencia): ?>
                        <tr>

                            <td><?php echo $licencia->nombre." ".$licencia->apellidos?></td>
                            <!-- <td class="datos_tabla"><?php if ($licencia->num_licencia==''){echo '-';}else {echo $licencia->num_licencia;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->gir=='' || ($licencia->num_licencia!='')){echo '-';}else {echo $licencia->gir;}?></td> -->
                            <td><?php echo $licencia->tipo?></td>
                            <td><?php if ($licencia->regional_nacional==''){echo '-';}else {echo $licencia->regional_nacional;}?></td>
                            <td><?php if ($licencia->fecha_cad==''){echo '-';}else {echo $licencia->fecha_cad;}?></td>
                            <td><?php if ($licencia->imagen==''){echo '-';}else {?> <a href="<?php echo RUTA_URL?>/adminLicencias/verFoto/<?php echo $licencia->id_licencia?>" target="_blank"><img width="30" height="30" src="<?php echo RUTA_ImgDatos.'licencias/'.$licencia->imagen?>"></a><?php ;}?></td>
                                                    
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            
                            <td>

                                <!--MODAL VER -->
                                    
                                    <a data-bs-toggle="modal" data-bs-target="#ver_<?php echo $licencia->id_licencia ?>">
                                        <img class="icono" src="<?php echo RUTA_Icon?>ojo.svg"></img>
                                    </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ver_<?php echo $licencia->id_licencia ?>">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content" >

                                                <!--Header-->
                                                <div class="modal-header azul">
                                                    <p class="modal-title ms-3">Informacion</p> 
                                                    <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                                </div>
                                            

                                            <!--Body-->
                                            <?php 
                                            
                                                if ($licencia->tipo=="Adulto") { ?>

                                                    <!-- VER ADULTO -->
                                                    <div class="modal-body info mb-3">    
                                                    <div class="container">
                                                        <div class="row mt-4">  

                                                            <div class="col-4">
                                                                <div><img id="outputVer" width="300px" height="300px" 
                                                                <?php if ($licencia->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php ;
                                                                        }else {?> src='<?php '.jpg';} ?>'                                                                                             
                                                                >
                                                                </div>                                    
                                                            </div>

                                                            <div class="col-8">

                                                                    <div class="row">                         
                                                                        <div class="input-group mb-4">
                                                                            <label for="id_usuario" class="input-group-text">Usuario</label>
                                                                            <input type="text" class="form-control form-control-md" id="id_usuario" name="id_usuario" value="<?php echo $licencia->nombre ?>" readonly> 
                                                                        </div>                           
                                                                    </div> 
                                                                    <div class="row">                         
                                                                        <div class="input-group mb-4">
                                                                            <label for="num_licencia" class="input-group-text">NUM_LICENCIA</label>
                                                                            <input type="text" class="form-control form-control-md" name="num_licencia" id="num_licencia"  value="<?php echo $licencia->num_licencia?>" readonly>
                                                                        </div>                           
                                                                    </div> 
                                                                    <div class="row">                         
                                                                        <div class="input-group mb-4">
                                                                            <label for="tipo" class="input-group-text">Tipo de licencia</label>
                                                                            <input type="text" class="form-control form-control-md" name="tipo" id="tipo" value="<?php echo $licencia->tipo?>" readonly> 
                                                                        </div>                           
                                                                    </div> 
                                                                    <div class="row">                         
                                                                        <div class="input-group mb-4">
                                                                            <label for="regional_nacional" class="input-group-text">Autonomica / Nacional</label>
                                                                            <input type="text" class="form-control form-control-md" name="regional_nacional" id="regional_nacional"  value="<?php echo $licencia->regional_nacional?>" readonly>
                                                                        </div>                           
                                                                    </div> 
                                                                    <div class="row"> 
                                                                        <div class="col-5">                       
                                                                            <div class="input-group mb-4">
                                                                                <label for="dorsal" class="input-group-text">Dorsal</label>
                                                                                <input type="text" class="form-control form-control-md" name="dorsal" id="dorsal"  value="<?php echo $licencia->dorsal?>" readonly>
                                                                            </div>                           
                                                                        </div> 
                                                                        <div class="col-7">   
                                                                            <div class="input-group mb-5">
                                                                                <label for="fecha_cad" class="input-group-text">Fecha caducidad</label>
                                                                                <input type="date" class="form-control form-control-md" name="fecha_cad" id="fecha_cad"  value="<?php echo $licencia->fecha_cad?>" readonly>
                                                                            </div>  
                                                                        </div>
                                                                    </div>
                                                            </div>  
                                                        </div>         
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
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $licencia->id_licencia ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                <div class="modal" id="borrar_<?php echo $licencia->id_licencia?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body mt-3">
                                                <p>Estas eguro que quieres <b>BORRAR</b> la licencia <b> <?php if ($licencia->num_licencia=="") {
                                                    echo $licencia->gir;
                                                }else {
                                                    echo $licencia->num_licencia;
                                                } ?> </b>?</p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminLicencias/borrar/<?php echo $licencia->id_licencia?>" method="post">
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

                    <!--AÑADIR-->
                    <div class="col text-center mt-5">
                        <a class="btn"style="background-color: #023ef9; color:white" id="añadir" href="<?php echo RUTA_URL?>/adminLicencias/nueva_licencia/">Nueva licencia</a>
                    </div>
                    

                    <div class="mt-4">
                        <a href="<?php echo RUTA_URL?>/adminLicencias/exportarLicencias" class="btn bg-warning">Exportar a Excel</a>
                    </div>
      
</article>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>





