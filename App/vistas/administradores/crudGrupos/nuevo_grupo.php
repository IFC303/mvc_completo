<?php require_once RUTA_APP.'/vistas/inc/header-admin-miga.php' ?>


<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>


<div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
    <h2 class="card-header">Nuevo Grupo</h2>


    <!--FORMULARIO AÑADIR-->
    <form method="post" class="card-body">
        <div class="mt-3 mb-3">
            <label for="id_test">Numero de grupo: <sup>*</sup></label>
            <input type="text" name="id_grupo" id="id_grupo" class="form-control form-control-lg">
        </div>
        <div class="mt-3 mb-3">
            <label for="nombreTest">Nombre del grupo: <sup>*</sup></label>
            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <label for="nombreTest">Fecha inicio: <sup>*</sup></label>
            <input type="text" name="fecha_inicio" id="fecha_inicio" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <label for="nombreTest">Fecha fin: <sup>*</sup></label>
            <input type="text" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg">
        </div>

        <input type="submit" class="btn btn-success" value="Confirmar">
    </form>  

</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>