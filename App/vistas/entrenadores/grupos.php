<?php require_once RUTA_APP . '/vistas/inc/header_entrenador_miga.php' ?>


    <form method="post" action="<?php echo RUTA_URL?>/entrenador/grupos">
        <select class="form-select" name='filtro'>
                <option value="">Selecciona un grupo</option>
                <?php 
                    foreach($datos['grupos'] as $info){
                        $id_grupo=$info->id_grupo;
                        $nombre=$info->nombre;?>
                        <option name="filtro" value="<?php echo $id_grupo?>"><?php echo $nombre?></option>
                <?php }
                ?>
        </select>
        <input type="submit">
    </form>



<div class="container">

        <div class="row" style="text-align:center">     
            <div class="col-12">
                <h4 id="titulo">Gestion de grupos y marcas/test</h4>
            </div>
        </div>


        <div class="tabla" style="border:solid 1px #023ef9">
            <table class="table table-hover">

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                     <!--BODY TABLA-->
                    <tbody class="table-light">
                        <?php foreach($datos['alumnosGrupo'] as $info): ?> 
                            <tr>
                                <td class="datos_tabla"><?php echo $info->nombre?></td>
                                <td class="datos_tabla"><?php echo $info->apellidos?></td>

                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>   
                                <td>

                                    <!-- MODAL MARCAS -->
                                    &nbsp;&nbsp;&nbsp;
                                    <a data-bs-toggle="modal" data-bs-target="#ModalMarcas_<?php echo $info->id_usuario?>" >
                                        <img class="icono" src="<?php echo RUTA_Icon?>test.svg"></img>
                                    </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalMarcas_<?php echo $info->id_usuario ?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                            
                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Anotar marcas: <?php echo $info->nombre." ".$info->apellidos?></h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/entrenador/marca/<?php echo $info->id_usuario?>" class="card-body">
                                                    <div class="row">   
                                                        <div class="col-3">
                                                            <label for="marca"><p>Marca</p></label>   
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="fecha"><p>Fecha</p></label> 
                                                        </div>       
                                                    </div> 

                                                    <div class="row"> 
                                                        <div class="col-2">
                                                            <input type="text" name="marca" id="marca" class="form-control" style="width:100px;">  
                                                        </div>
                                                        <div class="col-1">
                                                            <label for="tiempo"><p>seg.</p></label>
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="date" name="fecha" id="fecha" class="form-control">    
                                                        </div>
                                                        <div class="col-3">
                                                            <select class="form-select" name="idPrueba" id="idPrueba" style="width:300px;">
                                                                <option value="idPrueba">Seleciona una opcion</option>
                                                                <?php foreach($datos['testPruebas'] as $infoP):?>    
                                                                <option name="idPrueba" class="form-control"  value="<?php echo $infoP->id_prueba?>"><?php echo $infoP->nombreTest.": ".$infoP->nombrePrueba." (".$infoP->tipo.")"?></option>
                                                                <?php endforeach ?> 
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <br><br>
                                                    <div class="row"> 
                                                        <br>
                                                        <div class="col-2">
                                                            <input type="submit" class=" btn" value="Confirmar">
                                                        </div>
                                                        <div class="col-3">
                                                            <a href="<?php echo RUTA_URL?>/entrenador/grupos">
                                                                <input class="btn" type="button" id="botonVolver" value="Volver">  
                                                            </a>
                                                        </div>
                                                        <br> 
                                                    </div>       
                                                </form>
                                            </div>                  
                                    </div>
                                    </div>
                                    </div>



                                    <!-- MODAL RESULTADOS -->
                                    &nbsp;&nbsp;&nbsp;
                                    <a data-bs-toggle="modal" data-bs-target="#ModalVer_<?php echo $info->id_usuario?>" >
                                        <img class="icono" src="<?php echo RUTA_Icon?>ojo.svg"></img>
                                    </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalVer_<?php echo $info->id_usuario;?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                                    
                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Resultados: <?php echo $info->nombre." ".$info->apellidos?></h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <div class="row">   
                                                    <div class="col-5">
                                                        <label for="nomTest"><p>Test y prueba</p></label>   
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="marca"><p>Marca</p></label>   
                                                    </div>
                                                    <div class="col-5">
                                                        <label for="fecha"><p>Fecha</p></label> 
                                                    </div> 
                                                </div>               
                                                       
                                                
                                                <?php foreach ($datos['marcas'] as $marcas){
                                                if($info->id_usuario == $marcas->id_usuario){echo $marcas->id_prueba;?>
                                                <div class="row">   
                                                        <div class="col-5">
                                                            <label for="nomTest"><?php echo $marcas->nombreTest.": ".$marcas->nombrePrueba." (".$marcas->tipo.")"?></label>   
                                                        </div>
                                                        <div class="col-2">
                                                            <input type="text" name="marca" id="marca" value="<?php echo $marcas->marca?>" class="form-control" style="width:100px;" readonly>        
                                                        </div>
                                                        <div class="col-4">
                                                            <input type="date" name="fecha" id="fecha" value="<?php echo $marcas->fecha?>" class="form-control" style="width:150px;" readonly>   
                                                        </div> 

                                                        <div class="col-1">
                                                        <!--MODAL BORRAR (javascript)-->
                                                        <img class="icono" id="btnModal_<?php echo $marcas->id_prueba;?>" src="<?php echo RUTA_Icon?>papelera.svg" onclick="abrir(<?php echo $marcas->id_prueba;?>);" ></img>                         
                                                            <!--Ventana-->
                                                            <div id="<?php echo $marcas->id_prueba;?>" class="modalVer">
                                                                <div class="modal-content">
                                                                <!--Header-->
                                                                <div id="headerVer" class="row">
                                                                    <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $marcas->id_prueba;?>" onclick="cerrar(<?php echo $marcas->id_prueba;?>);">  
                                                                </div>
                                                                <hr>
                                                                <!--Body-->
                                                                <div id="bodyVer" class="row m-3">
                                                                    <h6>Seguro que quiere borrar el evento <?php echo $marcas->nombre?> ?</h6>
                                                                </div>
                                                                <!--Footer-->
                                                                <div id="footerBorrar">
                                                                    <input type="button" style="background-color: #023ef9; color:white"id="cerrar_<?php echo $evento->id_evento ?>" class="close" onclick="cerrar(<?php echo $evento->id_evento ?>);" value="cerrar" >
                                                                </div>                           
                                                            </div>   
                                                </div> 
                                                <?php
                                                }
                                                }?>              
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

                    <!--VER TODOS LOS RESULTADOS DEL GRUPO-->
                    <div class="col text-center">
                        <a class="btn" id="verTodos" href="<?php echo RUTA_URL?>/entrenador/resultados/">Ver resultados</a>
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
