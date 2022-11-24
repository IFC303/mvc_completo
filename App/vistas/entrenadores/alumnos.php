<?php require_once RUTA_APP . '/vistas/inc/navE.php' ?>

      

    <!------------------------------ CABECERA -------------------------------->
    <header>
        <div class="row mb-5">
            <div class="col-10 d-flex align-items-center justify-content-center ">
                <span id="textoHead"><?php echo $datos['grupo_info'][0]->nombre?></span>
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

        <table id="tabla" class="table w-50">

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th style="text-align:left" >ATLETAS</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                    <!--BODY TABLA-->
                    <tbody>

                        <?php
                        foreach($datos['alumnos'] as $alumnos): ?>
                        <tr id="manita" >

                            <td style="text-align:left" data-bs-toggle="modal" data-bs-target="#ver_ficha<?php echo $alumnos->id_usuario?>">
                               <img  style="width: 70px;"
                                <?php if ($alumnos->foto==''){
                                    ?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;
                                    }else {?> src='<?php echo RUTA_ImgDatos.$alumnos->id_usuario.'.jpg';} ?>'
                                ><span class="ms-2" style="font-size: 22px;"><?php echo $alumnos->nombre.' '.$alumnos->apellidos?></span>
                            </td>
     
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                
                            <td>


                                <a data-bs-toggle="modal" data-bs-target="#ModalMarcas_<?php echo $alumnos->id_usuario ?>">
                                    <img class="icono justify-content-center ms-3" src="<?php echo RUTA_Icon ?>test.svg"></img>
                                </a>            
                                <a data-bs-toggle="modal" data-bs-target="#ver<?php echo $alumnos->id_usuario?>">
                                    <img class="icono" src="<?php echo RUTA_Icon ?>ojo.svg"></img>
                                </a>


                                <!-- MODAL VER RESULTADOS--> 
                                <div class="modal fade" id="ver<?php echo $alumnos->id_usuario?>">
                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header azul">
                                            <p class="modal-title ms-3"><?php echo $alumnos->nombre.' '.$alumnos->apellidos?></p> 
                                            <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                        </div>
                            
                                        <!-- Modal body -->
                                        <div class="modal-body info mb-3">    
                                        <div class="row ms-1">     

                                            <table class="table mb-5">
                                                <!--CABECERA TABLA-->
                                                <thead>
                                                    <tr> 
                                                        <th>FECHA REALIZACION</th>
                                                        <th>TEST / PRUEBA</th>
                                                        <th>MARCA</th>                                            
                                                    </tr>
                                                </thead>
                                                <!--BODY TABLA-->
                                                <tbody>   

                                                    <?php foreach ($datos['ver_marcas'] as $alu) :?>
                                                        <?php if($alu->id_socio==$alumnos->id_usuario){?>
                                                            <tr>
                                                                
                                                                <td><?php echo date("d/m/Y", strtotime($alu->fecha))?></td>
                                                                <td><?php echo $alu->nombreTest.' ( '.$alu->tipo.' - '.$alu->nombrePrueba.')'?></td>
                                                                <td><?php echo $alu->marca?></td>
                                                                <td>
                                                                       
                                                                    <form method="post" action="<?php echo RUTA_URL?>/entrenador/borrar_marca/<?php echo $alu->id?>">
                                                                        <input type="hidden" name="grupo" value="<?php echo $alu->id_grupo?>">
                                                                        <input type="submit" class="btn" id="confirmar" value="Borrar"></img>
                                                                    </form>
                                                                   
                                                                    
                                                                </td>
                                                            </tr>  
                                                        <?php }?>                   
                                                    <?php endforeach ?>            

                                                </tbody>      
                                            </table>                 
                                        </div>
                                        </div>
                                </div>
                                </div>
                                </div>


                                  <!-- MODAL ANOTAR MARCAS -->
                                        <div class="modal fade" id="ModalMarcas_<?php echo $alumnos->id_usuario ?>">
                                        <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content"> 

                                                <!-- Header -->
                                                 <div class="modal-header azul">
                                                    <h2 class="modal-title">Nueva marca</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <!-- Body -->
                                                <div class="modal-body info">
                                                <form method="post" action="<?php echo RUTA_URL ?>/entrenador/marca_alu/<?php echo $alumnos->id_usuario ?>" class="card-body">
                                                             
                                                        <div class="input-group mb-4 mt-2">
                                                            <label for="elegir" class="input-group-text"><span class="info">Test y prueba</span></label>
                                                            <select class="form-select" name="idPrueba" id="idPrueba" style="width:300px;" required>
                                                                    <option value="">Seleciona una opcion</option>
                                                                    <?php foreach ($datos['testPruebas'] as $infoP) :?>
                                                                    <option name="idPrueba" class="form-control" value="<?php echo $infoP->id_test.":".$infoP->id_prueba ?>"><?php echo $infoP->nombreTest . ": " . $infoP->nombrePrueba . " (" . $infoP->tipo . ")" ?></option>
                                                                    <?php endforeach ?>
                                                            </select>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <div class="input-group">
                                                            <label for="fecha" class="input-group-text"><span class="info">Fecha realizacion</span></label>
                                                            <input type="date" name="fecha" id="fecha" class="form-control" required>
                                                            </div>
                                                        </div> 
                                                                    
                                                        <div class="row mb-4">
                                                            <div class="input-group">
                                                            <label for="marca" class="input-group-text"><span class="info">Marca ( hrs : min : seg )</span></label>
                                                            <input type="time" name="marca" id="marca" class="form-control" step="0.001" required>
                                                            </div>
                                                        </div>

                                                        <div class="row mb-4">
                                                            <textarea name="observaciones" class="form-control" id="observaciones"  rows="7" placeholder="Observaciones"></textarea>
                                                        </div>

                                                        <div class=" d-flex justify-content-end">
                                                            <input type="submit" class="btn mt-3 mb-3 " name="aceptar" id="confirmar" value="Confirmar">        
                                                        </div> 
                                                        
                                                </form>
                                                </div>
                                        </div>
                                        </div>
                                        </div> 


                                <!-- MODAL FICHA ALUMNO-->
                                    <!-- Ventana -->
                                    <div class="modal fade" id="ver_ficha<?php echo $alumnos->id_usuario?>">
                                    <div class="modal-dialog modal-dialog-centered ">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header azul">
                                                <p class="modal-title ms-3"></p> 
                                                <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                                            </div>
                                      
                                            <!-- Body -->
                                            <div class="modal-body info d-flex justify-content-center mt-4 mb-5">                         
                                                <div class="card" style="width:400px">
                                                    <img class="card-img-top"  style="width:100%"
                                                    <?php if ($alumnos->foto==''){
                                                        ?> src='<?php echo RUTA_Icon?>usuario.svg'<?php ;
                                                        }else {?> src='<?php echo RUTA_ImgDatos.$alumnos->id_usuario.'.jpg';} ?>'
                                                    >
                                                    <div class="card-body " style="text-align:left">
                                                        <h4 class="card-title" ><?php echo $alumnos->nombre.' '.$alumnos->apellidos?></h4>
                                                        <p class="card-text">Fecha nacimiento: <?php echo date("d/m/Y", strtotime($alumnos->fecha_nacimiento))?></p>
                                                        <p class="card-text">Telefono: <?php echo $alumnos->telefono?></p>
                                                        <p class="card-text">Direccion: <?php echo $alumnos->direccion?></p>
                                                        <p class="card-text">Email: <?php echo $alumnos->email?></p>
                                                    </div>
                                                </div>
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

            <div class="col text-center mt-5">
                <a data-bs-toggle="modal" data-bs-target="#ranking">
                    <input type="button" id="anadir" class="btn me-2" value="RANKINGS">
                </a>
                <a class="btn" id="botonVolver" href="<?php echo RUTA_URL?>/entrenador/grupos">VOLVER</a>
            </div>


            <div class="modal fade" id="ranking">
            <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header azul">

                        <div class="input-group info w-75">
                             <label for="fecha" class="input-group-text"><span class="info">Busqueda por test, fecha o atleta</span></label>
                             <input type="text"  class="form-control" id="busqueda" onkeyup="filtrar()" placeholder="Busqueda ...">
                        </div>
                        <button type="button" class="btn-close me-4" data-bs-dismiss="modal"></button>
                </div>

                <!-- Modal body -->
                <div class="modal-body info">                         
                <div class="row ms-1 me-1"> 

                        <table id="mi_tabla" class="mt-3 mb-5">
                            <thead>
                                <tr class="header">
                                    <th>TEST / PRUEBA</th>
                                    <th>ATLETAS</th>
                                    <th>FECHA REALIZACION</th>
                                    <th>MARCA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($datos['ver_marcas'] as $info) :?>
                                <tr>
                                    <td><?php echo $info->nombreTest . ": " . $info->nombrePrueba . " (" . $info->tipo . ")" ?></td>
                                    <td><?php echo $info->nombre.' '.$info->apellidos?></td>
                                    <td><?php echo date("d/m/Y", strtotime($info->fecha))?></td>
                                    <td><?php echo $info->marca?></td>
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


<script>
    function filtrar() {

        var  i;

        var busqueda = document.getElementById("busqueda");
        var filtro = busqueda.value.toUpperCase();
        var tabla = document.getElementById("mi_tabla");
        var fila = tabla.getElementsByTagName("tr");

        for (i = 0; i < fila.length; i++) {

                var celda = fila[i].getElementsByTagName("td")[0];
                var celda_socio = fila[i].getElementsByTagName("td")[1];
                var celda_fecha = fila[i].getElementsByTagName("td")[2];

                if (celda || celda_fecha || celda_socio) {
                    var texto = celda.textContent || celda.innerText;
                    var texto_socio = celda_socio.textContent || celda_socio.innerText;
                    var texto_fecha = celda_fecha.textContent || celda_fecha.innerText;

                if ((texto.toUpperCase().indexOf(filtro) > -1) || (texto_socio.toUpperCase().indexOf(filtro) > -1) || (texto_fecha.toUpperCase().indexOf(filtro) > -1)) {
                    fila[i].style.display = "";
                } else {
                    fila[i].style.display = "none";
                }
                }
        }
    }
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>












    
        



                                      

