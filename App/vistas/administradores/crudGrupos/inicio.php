<?php require_once RUTA_APP . '/vistas/inc/navA.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Gestion de grupos</span>
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
                            <th>Nº GRUPO</th>
                            <th>NOMBRE</th>
                            <th>FECHA INCIO</th>
                            <th>FECHA FIN</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <tbody>
                        
                        <?php 
                            foreach($datos['grupo'] as $grupo): 
                            ?>

                            <tr>
                                <td><?php echo $grupo->id_grupo?></td>
                                <td><?php echo $grupo->nombre?></td>
                                <td><?php echo $grupo->fecha_ini?></td>
                                <td><?php echo $grupo->fecha_fin?></td>
                                
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>

                                <td>

                                      
                                 <!-- MODAL VER-->                 
                                <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $grupo->id_grupo?>">
                                    <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                                </a>

                                <div class="modal" id="ver<?php echo $grupo->id_grupo?>">
                                <div class="modal-dialog modal-dialog-centered ">
                                <div class="modal-content">


                                    <!-- Modal Header -->
                                    <div class="modal-header azul">
                                        <p class="modal-title ms-3">Informacion</p> 
                                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                    </div>


                                    <!-- Modal body -->
                                    <div class="modal-body info mb-3">                                 
                                    <div class="container mt-4">

                                            <div class="row">                         
                                                <div class="input-group mb-4">
                                                    <label for="nombreTest" class="input-group-text">Nombre</label>
                                                    <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $grupo->nombre?>" readonly> 
                                                </div>                           
                                            </div> 
                                            <div class="row">                         
                                                <div class="input-group mb-4">
                                                    <label for="fecha_inicio" class="input-group-text">Fecha inicio</label>
                                                    <input type="date" class="form-control form-control-md" name="fecha_inicio" id="fecha_inicio" value="<?php echo $grupo->fecha_ini?>" readonly> 
                                                </div>                           
                                            </div>
                                            <div class="row mb-4">                         
                                                <div class="input-group mb-4">
                                                    <label for="fecha_fin" class="input-group-text">Fecha fin</label>
                                                    <input type="date" class="form-control form-control-md" name="fecha_fin" id="fecha_fin" value="<?php echo $grupo->fecha_fin?>" readonly> 
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

                                                    foreach($datos['grupos_y_horarios'] as $info){
                                                        
                                                        if($info->id_grupo==$grupo->id_grupo){
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

                                                <div class="row mt-3 mb-2" style="text-align:left">
                                                    <p style="color:#0070c6;font-weight:bold">Dia, hora de inicio y hora de fin</p>
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

       
                                    </div>         
                                    </div> 
                                    </div>

                                </div>
                                </div>    
                                </div> 



                                  <!-- MODAL EDITAR -->
                                <a data-bs-toggle="modal" data-bs-target="#editar_<?php echo $grupo->id_grupo ?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="editar_<?php echo $grupo->id_grupo ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3">Edicion</p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body info">                        
                                            <form method="post" action="<?php echo RUTA_URL?>/adminGrupos/editar/<?php echo $grupo->id_grupo?>" class="card-body">

                                                <div class="row">                         
                                                    <div class="input-group mb-4">
                                                        <label for="nombreTest" class="input-group-text">Nombre</label>
                                                        <input type="text" class="form-control form-control-md" id="nombre" name="nombre" value="<?php echo $grupo->nombre?>"> 
                                                    </div>                           
                                                </div> 
                                                <div class="row ">                         
                                                    <div class="input-group mb-4">
                                                        <label for="fecha_inicio" class="input-group-text">Fecha inicio</label>
                                                        <input type="date" class="form-control form-control-md" name="fecha_inicio" id="fecha_inicio" value="<?php echo $grupo->fecha_ini?>"> 
                                                    </div>                           
                                                </div>
                                                <div class="row ">                         
                                                    <div class="input-group mb-4">
                                                        <label for="fecha_fin" class="input-group-text">Fecha fin</label>
                                                        <input type="date" class="form-control form-control-md" name="fecha_fin" id="fecha_fin" value="<?php echo $grupo->fecha_fin?>"> 
                                                    </div>                           
                                                </div>

                                                <div class="row mt-4 mb-2" style="text-align:left">
                                                    <p style="color:#0070c6;font-weight:bold">Seleciona dia, hora de inicio y hora de fin</p>
                                                </div>

                                                        <?php 
                                                            $lunesCK="";
                                                            $martesCK="";
                                                            $miercolesCK="";
                                                            $juevesCK="";
                                                            $viernesCK="";

                                                            $lunesIni="";
                                                            $lunesFin="";
                                                            $lunesId="";

                                                            $martesIni="";
                                                            $martesFin="";
                                                            $martesId="";

                                                            $miercolesIni="";
                                                            $miercolesFin="";
                                                            $miercolesId="";

                                                            $juevesIni="";
                                                            $juevesFin="";
                                                            $juevesId="";

                                                            $viernesIni="";
                                                            $viernesFin="";
                                                            $viernesId="";

                                                            foreach($datos['grupos_y_horarios'] as $info){
                                                                
                                                                if($info->id_grupo==$grupo->id_grupo){
                                                                    if ($info->dia_sem=="Lunes"){
                                                                        $lunesCK="checked";
                                                                        $lunesIni=$info->hora_ini;
                                                                        $lunesFin=$info->hora_fin; 
                                                                        $lunesId="$info->id_horario";
                                                                    }else if($info->dia_sem=="Martes"){
                                                                        $martesCK="checked";
                                                                        $martesIni=$info->hora_ini;
                                                                        $martesFin=$info->hora_fin; 
                                                                        $martesId="$info->id_horario";
                                                                    }else if($info->dia_sem=="Miercoles"){
                                                                        $miercolesCK="checked";
                                                                        $miercolesIni=$info->hora_ini;
                                                                        $miercolesFin=$info->hora_fin; 
                                                                        $miercolesId="$info->id_horario";
                                                                    }else if($info->dia_sem=="Jueves"){
                                                                        $juevesCK="checked";   
                                                                        $juevesIni=$info->hora_ini;
                                                                        $juevesFin=$info->hora_fin; 
                                                                        $juevesId="$info->id_horario";
                                                                    }else if($info->dia_sem=="Viernes"){
                                                                        $viernesCK="checked";
                                                                        $viernesIni=$info->hora_ini;
                                                                        $viernesFin=$info->hora_fin; 
                                                                        $viernesId="$info->id_horario";
                                                                    }  
                                                                }
                                                            }?>


                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" id="lunes" name="lunesDia" value="Lunes" <?php echo $lunesCK ?>> 
                                                        <label for="Lunes">Lunes</label>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="time" id="lunesIni" name="lunesIni" value="<?php echo $lunesIni?>" class="form-control form-control-sm">  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="lunesFin" id="lunesFin" value="<?php echo $lunesFin?>" class="form-control form-control-sm">
                                                    </div>
                                                    <input type="hidden" name="horario[]" value="<?php echo $lunesId?>">
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="martesDia" value="Martes" <?php echo $martesCK?>> 
                                                        <label for="Martes">Martes</label>
                                                    </div>  
                                                    <div class="col-3">
                                                        <input type="time" name="martesIni" id="martesIni" value="<?php echo $martesIni?>" class="form-control form-control-sm">  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="martesFin" id="martesFin" value="<?php echo $martesFin?>" class="form-control form-control-sm">
                                                    </div>
                                                    <input type="hidden" name="horario[]" value="<?php echo $martesId?>">
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="miercolesDia" value="Miercoles" <?php echo $miercolesCK?>> 
                                                        <label for="Miercoles">Miercoles</label>
                                                    </div>  
                                                    <div class="col-3">
                                                        <input type="time" name="miercolesIni" id="hora_ini" value="<?php echo $miercolesIni?>" class="form-control form-control-sm">  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="miercolesFin" id="hora_fin" value="<?php echo $miercolesFin?>" class="form-control form-control-sm">
                                                    </div>
                                                    <input type="hidden" name="horario[]" value="<?php echo $miercolesId?>">
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="juevesDia" value="Jueves" <?php echo $juevesCK?>> 
                                                        <label for="Jueves">Jueves</label>
                                                    </div>
                                                    <div class="col-3">
                                                        <input type="time" name="juevesIni" id="hora_ini" value="<?php echo $juevesIni?>" class="form-control form-control-sm">  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="juevesFin" id="hora_fin" value="<?php echo $juevesFin?>" class="form-control form-control-sm">
                                                    </div>
                                                    <input type="hidden" name="horario[]" value="<?php echo $juevesId?>">
                                                </div>

                                                <div class="row mb-3">
                                                    <div class="col-3" style="text-align:left">
                                                        <input type="checkbox" name="viernesDia" value="Viernes" <?php echo $viernesCK?>> 
                                                        <label for="Viernes">Viernes</label>
                                                    </div>  
                                                    <div class="col-3">
                                                        <input type="time" name="viernesIni" id="hora_ini" value="<?php echo $viernesIni?>" class="form-control form-control-sm">  
                                                    </div>   
                                                    <div class="col-3">   
                                                        <input type="time" name="viernesFin" id="hora_fin" value="<?php echo $viernesFin?>" class="form-control form-control-sm">
                                                    </div>
                                                    <input type="hidden" name="horario[]" value="<?php echo $viernesId?>">
                                                </div>     
                                                

                                                <div class="row"> 
                                                    <div class="d-flex justify-content-end">
                                                        <input type="submit" class="btn mt-5 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                                    </div>
                                                </div>

                                            </form>
                                            </div>

                                </div>
                                </div>
                                </div>


                       
                                <!-- MODAL BORRAR -->
                                <a data-bs-toggle="modal" data-bs-target="#borrar_<?php echo $grupo->id_grupo ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                <div class="modal" id="borrar_<?php echo $grupo->id_grupo?>">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>

                                    <!-- Modal body -->
                                    <div class="modal-body mt-3">
                                    <p>Estas seguro que quieres <b>BORRAR</b> el grupo <b><?php echo $grupo->nombre?></b> ? </p>
                                    </div>

                                    <!-- Modal footer -->
                                    <div class="modal-footer">
                                        <form action="<?php echo RUTA_URL?>/adminGrupos/borrar/<?php echo $grupo->id_grupo?>" method="post">
                                            <input type="submit" class="btn" name="borrar" id="borrar" value="Borrar">
                                        </form>
                                    </div>
                                    
                                </div>
                                </div>
                                </div>


                                <!-- PARTICIPANTES -->
                                <a href="<?php echo RUTA_URL?>/adminGrupos/participantes/<?php echo $grupo->id_grupo?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>grupos.svg"></img>
                                </a> 



                </td>
            
            <?php endif ?>
        </tr>
            <?php endforeach ?>
    </tbody>

</table>


                    <!-- NUEVO GRUPO-->
                    <div class="col text-center mt-5">
                        <a data-bs-toggle="modal" data-bs-target="#nuevo">
                            <input type="button" id="anadir" class="btn" value="Nuevo grupo">
                        </a>
                    </div>

                    <div class="modal" id="nuevo">
                    <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header azul">
                            <p class="modal-title ms-3">Alta de grupos</p> 
                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Body -->
                        <div class="modal-body info">                        
                        <form method="post" action="<?php echo RUTA_URL?>/adminGrupos/nuevo/<?php echo $grupo->id_grupo?>" class="card-body">

                            <div class="row">                         
                                <div class="input-group mb-4">
                                    <label for="nombreTest" class="input-group-text">Nombre<sup>*</sup></label>
                                    <input type="text" class="form-control form-control-md" id="nombre" name="nombre" required> 
                                </div>                           
                            </div> 
                            <div class="row ">                         
                                <div class="input-group mb-4">
                                    <label for="fecha_inicio" class="input-group-text">Fecha inicio</label>
                                    <input type="date" class="form-control form-control-md" name="fecha_inicio" id="fecha_inicio"> 
                                </div>                           
                            </div>
                            <div class="row ">                         
                                <div class="input-group mb-4">
                                    <label for="fecha_fin" class="input-group-text">Fecha fin</label>
                                    <input type="date" class="form-control form-control-md" name="fecha_fin" id="fecha_fin" > 
                                </div>                           
                            </div>

                            <div class="row mt-4 mb-2" style="text-align:left">
                                <p style="color:#0070c6;font-weight:bold">Selecciona dia, hora de inicio y hora de fin</p>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <input type="checkbox" name="lunesDia" value="Lunes"> 
                                    <label for="Lunes">Lunes</label>
                                </div>
                                <div class="col-3">
                                    <input type="time" name="lunesIni" id="hora_ini" class="form-control form-control-sm">  
                                </div>   
                                <div class="col-3">   
                                    <input type="time" name="lunesFin" id="hora_fin" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <input type="checkbox" name="martesDia" value="Martes"> 
                                    <label for="Martes">Martes</label>
                                </div>  
                                <div class="col-3">
                                    <input type="time" name="martesIni" id="hora_ini" class="form-control form-control-sm">  
                                </div>   
                                <div class="col-3">   
                                    <input type="time" name="martesFin" id="hora_fin" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <input type="checkbox" name="miercolesDia" value="Miercoles"> 
                                    <label for="Miercoles">Miercoles</label>
                                </div>  
                                <div class="col-3">
                                    <input type="time" name="miercolesIni" id="hora_ini" class="form-control form-control-sm">  
                                </div>   
                                <div class="col-3">   
                                    <input type="time" name="miercolesFin" id="hora_fin" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3 ">
                                    <input type="checkbox" name="juevesDia" value="Jueves"> 
                                    <label for="Jueves">Jueves</label>
                                </div>
                                <div class="col-3">
                                    <input type="time" name="juevesIni" id="hora_ini" class="form-control form-control-sm">  
                                </div>   
                                <div class="col-3">   
                                    <input type="time" name="juevesFin" id="hora_fin" class="form-control form-control-sm">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-3">
                                    <input type="checkbox" name="viernesDia" value="Viernes"> 
                                    <label for="Viernes">Viernes</label>
                                </div>  
                                <div class="col-3">
                                    <input type="time" name="viernesIni" id="hora_ini" class="form-control form-control-sm">  
                                </div>   
                                <div class="col-3">   
                                    <input type="time" name="viernesFin" id="hora_fin" class="form-control form-control-sm">
                                </div>
                            </div> 

                            <div class="row"> 
                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="btn mt-5 mb-4" name="aceptar" id="confirmar" value="Confirmar"> 
                                </div>
                            </div>

                        </form>
                        </div>

                </div>
                </div>
                </div>


</article>





<script>
        
        function arrastre(ev) {
            //var id=document.getElementById(id);
            //console.log(ev.target.id);
            ev.dataTransfer.setData('Data',ev.target.id);
        }  
       
        function sobre(ev) {
            ev.preventDefault();
        }

        //***********CAJAS ENTRENADORES**************

        function suelta(ev){
            var caja=document.getElementById("cajaEntrenador");
            var numero = caja.getElementsByTagName('div').length + 1;
            console.log(numero);
            
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);

           if(clase.className=="entrenador" && numero==1){ 
                caja.appendChild(document.getElementById(dato)); 
                //console.log(ent)  
                ent.push(dato);

                var entrena = JSON.stringify(ent); 
                var entre=document.getElementById("entrenadorActual");
                entre.setAttribute("value",entrena);
           }else{
               alert("No se puede añadir mas de un entrenador a un grupo");
           }

        }  


        function suelta2(ev){
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);
            //console.log(clase);
            if(clase.className=="entrenador"){
                var caja=document.getElementById("entrenadores");   
                caja.appendChild(document.getElementById(dato));
                for(var i=0; i<ent.length;i++){
                    if(ent[i]==dato){
                        ent.splice(i,1);
                    }
                    var entrena = JSON.stringify(ent); 
                    var entre=document.getElementById("entrenadorActual");
                    entre.setAttribute("value",entrena);
                }
            }else{
                alert ("no se puede");
            }
        } 


        //***********CAJAS ALUMNOS**************

        function alumnoUno(ev){

            var caja=document.getElementById("cajaAlumnos");
       
            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            //console.log(dato);
            var clase=document.getElementById(dato);
            // console.log(clase);
            

           if(clase.className=="alumno"){ 
                caja.appendChild(document.getElementById(dato));    
                uno.push(dato);
                      
                   for(var i=0; i<cero.length;i++){
                        //console.log(alumnosCero[i])
                       if(cero[i]==dato){
                          cero.splice(i,1);
                     }
                 } 

                 //console.log("alumnos cero")               
                 console.log(cero);
                 //console.log("alumnos uno")
                 console.log(uno);

                //para que no mande string
                var participaUno = JSON.stringify(uno); 
                var partUno=document.getElementById("alumnosActuales");
                partUno.setAttribute("value",participaUno);

                 var participaCero = JSON.stringify(cero); 
                 var partCero=document.getElementById("alumnosAntes");
                 partCero.setAttribute("value",participaCero);
                
           }else{
               alert("No se puede añadir mas de un entrenador a un grupo");
           }  
         
        }  


        function alumnoCero(ev){

            var caja=document.getElementById("alumnos");
            //var numero = caja.getElementsByTagName('div').length;
            //console.log(numero);

            ev.preventDefault();
            var dato=ev.dataTransfer.getData('Data');
            var clase=document.getElementById(dato);
            //console.log(dato);

            if(clase.className=="alumno"){
                caja.appendChild(document.getElementById(dato));
                cero.push(dato);

                 for(var i=0;i<uno.length;i++){
                     //console.log(alumnosUno[i])
                     if(uno[i]==dato){
                       uno.splice(i,1);
                     }   
                 } 

                //alumnosCero.push(dato)
                console.log("alumnos Cero vuelta")
                console.log(cero); 
                console.log("alumnos Uno vuelta")
                console.log(uno);
                
                    //para que no mande string
                    var participaUno = JSON.stringify(uno); 
                    var partUno=document.getElementById("alumnosActuales");
                    partUno.setAttribute("value",participaUno);

                     //para que no mande string
                    var participaCero = JSON.stringify(cero); 
                    var partCero=document.getElementById("alumnosAntes");
                    partCero.setAttribute("value",participaCero);

                
            }else{
                alert ("no se puede");
            }
        } 


    </script>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>



                