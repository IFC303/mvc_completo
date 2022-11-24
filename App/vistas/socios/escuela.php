<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>



     <!------------------------------ CABECERA -------------------------------->
     <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center ">
                    <span id="textoHead">Grupos de entrenamiento</span>
                </div>
                <div class="col-2 mt-1">
                    <a href="<?php echo RUTA_URL ?>/login/logout">
                        <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
                    </a>
                </div>            
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->

    <article>
            <table id="tabla" class="table"> 
                <thead>
                    <tr>
                        <th>GRUPO</th>
                        <th>FECHA INICIO</th> 
                        <th>CUOTA / MES</th>                                                 
                    </tr>
                </thead> 
                 <tbody>               
                    <?php foreach ($datos['grupos'] as $grupos) :?>
                        <tr id="manita">
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>"><?php echo $grupos->nombre?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>"><?php echo date("d/m/Y", strtotime($grupos->fecha_ini))?></td>
                            <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>"><?php echo $grupos->cuota?> €</td>
                            
                            <?php  if($datos['cantidad']=='0'){?>
                                <td><a id="botonVolver"  style="font-size:13px" data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>"class="btn">Inscribirse</a></td> 
                            <?php }?>

                            <?php
                                foreach ($datos['soli_grupo'] as $soli_grupo){
                                    if (($soli_grupo->id_grupo==$grupos->id_grupo) && ($soli_grupo->estado==1)){?>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#marcas_grupo" >
                                            <input type="button" id="anadir" style="font-size:13px" class="btn" value="Mis marcas">
                                            </a>
                                        </td>
                                  <?php }else if(($soli_grupo->id_grupo==$grupos->id_grupo) && ($soli_grupo->estado==0)){?>
                                        <td><img class="icono" src="<?php echo RUTA_Icon ?>tramite.png"></img> Solicitud pendiente</td>
                                    <?php }else{?>
                                        <td data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupos->id_grupo?>">-</td>
                                    <?php }
                                }      
                            ?>
                  


                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[3])):?>



                                <!-- MODAL VER-->
                                <!-- Ventana -->
                                <div class="modal" id="ver<?php echo $grupos->id_grupo?>">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header azul">
                                        <p class="modal-title ms-3">Grupo: <?php echo $grupos->id_grupo?></p> 
                                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body info mb-3">                           
                                    <div class="container">

                                            <div class="row mt-4 mb-4">
                                                <div class="col-8">
                                                <div class="input-group">
                                                    <label for="nombre" class="input-group-text">Nombre</label>
                                                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $grupos->nombre?> " readonly> 
                                                </div>
                                                </div> 
                                                <div class="col-4">
                                                <div class="input-group ">
                                                    <label class="input-group-text">Cuota mensual</label>
                                                    <input type="text" class="form-control" value="<?php echo $grupos->cuota?> €" readonly> 
                                                </div> 
                                                </div> 
                                            </div>

                                            <div class="row mt-4 mb-4">  
                                                <div class="col-6">
                                                <div class="input-group ">
                                                    <label class="input-group-text">Fecha Inicio</label>
                                                    <input type="date" class="form-control" value="<?php echo $grupos->fecha_ini?>"  readonly> 
                                                </div> 
                                                </div>                     
                                            
                                                <div class="col-6">  
                                                <div class="input-group ">
                                                    <label class="input-group-text">Fecha Fin</label>
                                                    <input type="date" class="form-control" value="<?php echo $grupos->fecha_fin?>"  readonly> 
                                                </div>  
                                                </div>                   
                                            </div>

                                            <?php 
                                                    $lunesCK="";
                                                    $martesCK="";
                                                    $miercolesCK="";
                                                    $juevesCK="";
                                                    $viernesCK="";
                                                    $lunesIni="";
                                                    $lunesFin="";
                                                    $martesIni="";
                                                    $martesFin="";
                                                    $miercolesIni="";
                                                    $miercolesFin="";
                                                    $juevesIni="";
                                                    $juevesFin="";
                                                    $viernesIni="";
                                                    $viernesFin="";

                                                    foreach($datos['horarios_grupos'] as $info){
                                                        
                                                        if($info->id_grupo==$grupos->id_grupo){
                                                            if ($info->dia_sem=="Lunes"){
                                                                $lunesCK="checked";
                                                                $lunesIni=$info->hora_ini;
                                                                $lunesFin=$info->hora_fin; 
                                                            }else if($info->dia_sem=="Martes"){
                                                                $martesCK="checked";
                                                                $martesIni=$info->hora_ini;
                                                                $martesFin=$info->hora_fin; 
                                                            }else if($info->dia_sem=="Miercoles"){
                                                                $miercolesCK="checked";
                                                                $miercolesIni=$info->hora_ini;
                                                                $miercolesFin=$info->hora_fin; 
                                                            }else if($info->dia_sem=="Jueves"){
                                                                $juevesCK="checked";   
                                                                $juevesIni=$info->hora_ini;
                                                                $juevesFin=$info->hora_fin; 
                                                            }else if($info->dia_sem=="Viernes"){
                                                                $viernesCK="checked";
                                                                $viernesIni=$info->hora_ini;
                                                                $viernesFin=$info->hora_fin; 
                                                            }  

                                                        }
                                                    }  
                                                ?>


                                                <div class="row pt-4 mb-2" style="text-align:left">
                                                    <p style="color:#0070c6;font-weight:bold">Dia, hora de inicio y hora de fin del entrenamiento</p>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" id="lunes" name="lunesDia" value="Lunes" <?php echo $lunesCK ?> disabled> 
                                                        <label for="Lunes">Lunes</label>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="time" id="lunesIni" name="lunesIni" value="<?php echo $lunesIni?>" class="form-control form-control-sm" disabled>  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="lunesFin" id="hora_fin" value="<?php echo $lunesFin?>" class="form-control form-control-sm" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="martesDia" value="Martes" <?php echo $martesCK?> disabled> 
                                                        <label for="Martes">Martes</label>
                                                    </div>  
                                                    <div class="col-3">
                                                        <input type="time" name="martesIni" id="hora_ini" value="<?php echo $martesIni?>" class="form-control form-control-sm" disabled>  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="martesFin" id="hora_fin" value="<?php echo $martesFin?>" class="form-control form-control-sm" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="miercolesDia" value="Miercoles" <?php echo $miercolesCK?> disabled> 
                                                        <label for="Miercoles">Miercoles</label>
                                                    </div>  
                                                    <div class="col-3">
                                                        <input type="time" name="miercolesIni" id="hora_ini" value="<?php echo $miercolesIni?>" class="form-control form-control-sm" disabled>  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="miercolesFin" id="hora_fin" value="<?php echo $miercolesFin?>" class="form-control form-control-sm" disabled>
                                                    </div>
                                                </div>

                                                <div class="row  mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="juevesDia" value="Jueves" <?php echo $juevesCK?> disabled> 
                                                        <label for="Jueves">Jueves</label>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="time" name="juevesIni" id="hora_ini" value="<?php echo $juevesIni?>" class="form-control form-control-sm" disabled>  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="juevesFin" id="hora_fin" value="<?php echo $juevesFin?>" class="form-control form-control-sm" disabled>
                                                    </div>
                                                </div>

                                                <div class="row mb-5">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="viernesDia" value="Viernes" <?php echo $viernesCK?> disabled> 
                                                        <label for="Viernes">Viernes</label>
                                                    </div>  
                                                    <div class="col-3">
                                                        <input type="time" name="viernesIni" id="hora_ini" value="<?php echo $viernesIni?>" class="form-control form-control-sm" disabled>  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="viernesFin" id="hora_fin" value="<?php echo $viernesFin?>" class="form-control form-control-sm" disabled>
                                                    </div>
                                                </div> 


                                            <div class="row mb-4">                         
                                                <div class="input-group">
                                                    <textarea  type="text" style="height:100px" class="form-control" id="descripcion" name="descripcion" placeholder="Descripcion" readonly><?php echo $grupos->observaciones?></textarea>
                                                </div>                           
                                            </div> 
                                        
                                            <!-- Modal footer -->
                                            <form enctype="multipart/form-data" action="<?php echo RUTA_URL?>/socio/ins_grupo/<?php echo $grupos->id_grupo?>" method="post">  
                                            
                                                <div class="row mt-4 mb-4">  
                                                    <div class="col-8">
                                                    <div class="input-group ">
                                                        <label class="input-group-text">Escoge una categoria <sup>*</sup> </label>
                                                        <select name="cat" id="cat" class="form-control"  required>
                                                            <option value="">-- Opciones --</option>
                                                            <?php foreach ($datos['categorias'] as $cat) : ?>
                                                            <option id="cat" value="<?php echo $cat->id_categoria?>" >
                                                                <?php echo $cat->nombre?>
                                                            </option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div> 
                                                    </div>               
                                                </div>

                                            
                                                <div class="row pt-3 pb-3">
                                                    <div class="col-6"><input  accept="image/*" type="file" name="pago" required></div>
                                                    <div class="col-6 d-flex justify-content-end"><input type="submit" class="btn" name="aceptar" id="confirmar" value="Inscribirse" 
                                                        <?php if($datos['cantidad']>0){
                                                            echo "disabled";
                                                        } ?>
                                                    ></div>
                                                </div>
                                            </form>
                                        
                                    </div>
                                    </div>
                                    
                                </div>
                                </div>
                                </div>



                                <?php endif ?>
                        </tr>                   
                    <?php endforeach ?>                
                </tbody>      

            </table>     



                  <!-- VENTANA -->
                  <div class="modal fade" id="marcas_grupo">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                <div class="modal-content">

                         <!-- Modal Header -->
                         <div class="modal-header azul">
                            <p class="modal-title ms-3">Mis marcas</p> 
                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                        </div>
                                      

                        <!-- Modal body -->
                        <div class="modal-body info ">                         
                        <div class="row ms-1 me-1"> 

                            <table class="table mb-5">
                                <!--CABECERA TABLA-->
                                <thead>
                                    <tr> 
                                    <th>FECHA</th>
                                    <th>TEST </th>
                                    <th>TIPO / PRUEBA</th>
                                    <th>MARCA</th>
                                    <th>VELOCIDAD</th>                            
                                    </tr>
                                </thead>
                                <!--BODY TABLA-->
                                <tbody>               
                                    <?php foreach($datos['marcas_grupo'] as $marcas_grupo):?>
                                        <tr>
                                        <td><?php echo date("d/m/Y", strtotime($marcas_grupo->fecha))?></td>
                                        <td><?php echo $marcas_grupo->nombreTest?></td>
                                        <td><?php echo $marcas_grupo->tipo.' ('.$marcas_grupo->nombrePrueba.')'?></td>
                                        <td><?php echo $marcas_grupo->marca?></td>
                                        <td><?php echo $marcas_grupo->velocidad?> km/h</td> 
                                        </tr>                   
                                    <?php endforeach ?>                
                                </tbody>      

                            </table>
                        </div>
                        </div>

                </div>
                </div>
                </div>


        </article>



        

          

        


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>