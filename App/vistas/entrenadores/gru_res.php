<?php require_once RUTA_APP . '/vistas/inc/header.php' ?>
<?php require_once RUTA_APP . '/vistas/inc/head_en.php' ?>


<div class="container">

        <div class="row" style="text-align:center">
            <div class="col-12"><h4 id="titulo">Resultados <?php echo $datos['aluInfo']->nombre." ".$datos['aluInfo']->apellidos?></h4></div>
        </div>

        <div id="tabla">
            <table class="table table-hover" >
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Test y prueba</th>
                            <th>Marca</th>
                            <th>Observaciones</th>                           
                            <th>Opciones</th>
                        </tr>
                    </thead>                                  
                                              
                    <tbody>                            
                      <?php foreach ($datos['un_alu'] as $todos):?>                          
                                <tr>
                                    <td class="datos_tabla"><?php echo $todos->fecha ?></td>
                                    <td class="datos_tabla"><?php echo $todos->nombreTest . ": " . $todos->nombrePrueba . " (" . $todos->tipo . ")" ?></td>
                                    <td class="datos_tabla"><?php echo $todos->marca?></td>
                                    <td class="datos_tabla"><?php echo $todos->observaciones?></td>

                                    <td class="d-flex justify-content-center">
                                        <!-- MODAL BORRAR -->                                                            
                                        <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $todos->id?>" href="<?php echo RUTA_URL?>/entrenador/borrarMarca/<?php echo $todos->id?>">
                                        <img class="icono justify-content-center ms-3" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                        </a>

                                        <!-- VENTANA -->
                                        <div class="modal" id="ModalBorrar_<?php echo $todos->id?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar el test <?php echo $todos->id ?> ?</h6>
                                            </div>
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/entrenador/borrarMarca/<?php echo $todos->id?>" method="post">
                                                    <input type="hidden" name="idUsu" value="<?php echo $datos['aluInfo']->id_usuario ?>">
                                                    <button type="submit" id="confirmar" class="btn">Borrar</button>
                                                </form>
                                            </div>
                                        </div>
                                        </div>
                                        </div>                
                                    </td>
                                </tr>
                        <?php endforeach ?>       
                    </tbody>
                                                   
            </table>   
        </div>  
        
        <div class="row mt-4" style="text-align:center">
            <a href="<?php echo RUTA_URL?>/entrenador/grupos">
                <input class="btn" type="button" id="botonVolver" value="Volver"> 
            </a>  
        </div> 
        
</div> 
                                                
       
    
                                                