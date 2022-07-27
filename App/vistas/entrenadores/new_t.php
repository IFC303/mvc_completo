<?php require_once RUTA_APP . '/vistas/inc/header.php' ?>
<?php require_once RUTA_APP.'/vistas/inc/head_en.php' ?>


    <div class="card bg-light w-50 card-center" id="ventana">
        <h2 class="card-header">Nuevo Test</h2>
        
        <!--FORMULARIO AÑADIR-->
        <form method="post" class="card-body">
    
                <div class="input-group mt-4 mb-5">
                    <label for="nombreTest" class="input-group-text"><span class="info">Nombre<sup>*</sup></span></label>
                    <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-md" required>
                </div>    

                <p class="info">Selecciona las pruebas que quieres incluir en el test</p>
                <?php $tipo="";
                    foreach($datos['pruebas'] as $prueba):
                        if ($tipo!=$prueba->tipo){
                            $tipo=$prueba->tipo;
                            echo '<br>';
                            echo $tipo.':'.'&nbsp;&nbsp;&nbsp;';
                        } ?>
                        <input type="checkbox" name="id_prueba[]" value="<?php echo $prueba->id_prueba ?>">  
                        <?php echo $prueba->nombrePrueba.'&nbsp;&nbsp;&nbsp;';
                endforeach ?>        
    
                <div class="row mt-5 mb-4">                   
                    <div class="col-3">
                        <input type="submit" class="btn me-1" id="confirmar" value="Confirmar">
                        <a href="<?php echo RUTA_URL?>/entrenador/test">
                            <input class="btn" type="button" id="botonVolver" value="Volver"> 
                        </a>                           
                    </div>
                </div> 
        </form>
    </div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>