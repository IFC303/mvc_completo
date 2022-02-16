<?php require_once RUTA_APP.'/vistas/inc/header_entrenador.php' ?>



<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>


<div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
    <h2 class="card-header">Nuevo Test</h2>

    <form method="post" class="card-body">
        <div class="mt-3 mb-3">
            <label for="id_test">Id de test: <sup>*</sup></label>
            <input type="text" name="id_test" id="id_test" class="form-control form-control-lg">
        </div>
        <div class="mt-3 mb-3">
            <label for="nombre">Nombre de test: <sup>*</sup></label>
            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <p>Selecciona las pruebas que quieres incluir en el test:</p>
             

            <?php $tipo="";
             foreach($datos['pruebas'] as $prueba):
                if ($tipo!=$prueba->tipo){
                    $tipo=$prueba->tipo;
                    echo '<br>';
                    echo $tipo.':'.'&nbsp;&nbsp;&nbsp;';
                } ?>
                <input type="checkbox" value="<?php echo $prueba->nombre?>">
                 <?php echo $prueba->nombre.'&nbsp;&nbsp;&nbsp;';
             endforeach ?>
        </div>



        <input type="submit" class="btn btn-success" value="Confirmar">
    </form>

</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>