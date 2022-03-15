<?php require_once RUTA_APP.'/vistas/inc/header_entrenador_miga.php' ?>



<div class="card bg-light w-50 card-center" id="ventana">
    <h2 class="card-header">Nuevo Test</h2>


    <!--FORMULARIO AÑADIR-->
    <form method="post" class="card-body">

        <div class="mt-3 mb-3">
            <label for="id_test">Numero de test<sup>*</sup></label>
            <input type="text" name="id_test" id="id_test" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <label for="nombreTest">Nombre<sup>*</sup></label>
            <input type="text" name="nombreTest" id="nombreTest" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <br>
            <p>Selecciona las pruebas que quieres incluir en el test</p>

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
        </div>


        <div class="row">
                <div class="col-3">
                    <input type="submit" class=" btn" value="Confirmar">
                    <a href="<?php echo RUTA_URL?>/entrenador/test">
                        <input class="btn" type="button" id="botonVolver" value="Volver">  
                    </a>
                </div>
          </div>

    </form>


    

</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>