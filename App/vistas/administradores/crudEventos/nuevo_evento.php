<?php require_once RUTA_APP.'/vistas/inc/header-admin-miga.php' ?>


<a href=".." class="btn btn-light"><i class="bi bi-chevron-double-left"></i>Volver</a>


<div class="card bg-light mt-5 w-75 card-center" style=" margin: auto;">
    <h2 class="card-header">Nuevo evento</h2>


    <!--FORMULARIO AÑADIR-->
    <form method="post" class="card-body">
        <div class="mt-3 mb-3">
            <label for="id_evento">Numero de evento: <sup>*</sup></label>
            <input type="text" name="id_evento" id="id_evento" class="form-control form-control-lg">
        </div>
        <div class="mt-3 mb-3">
            <label for="id_usuario">Entrenador: <sup>*</sup></label>
            <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <label for="nombre">Nombre del evento: <sup>*</sup></label>
            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg">
        </div>
        <div class="mt-3 mb-3">
            <label for="tipo">Tipo: <sup>*</sup></label>
            <input type="text" name="tipo" id="tipo" class="form-control form-control-lg">
        </div>
        <div class="mt-3 mb-3">
            <label for="precio">Precio: <sup>*</sup></label>
            <input type="text" name="precio" id="precio" class="form-control form-control-lg">
        </div>
        <div class="mt-3 mb-3">
            <label for="descuento">Descuento: <sup>*</sup></label>
            <input type="text" name="descuento" id="descuento" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <label for="fecha_ini">Fecha inicio: <sup>*</sup></label>
            <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg">
        </div>

        <div class="mt-3 mb-3">
            <label for="fecha_fin">Fecha fin: <sup>*</sup></label>
            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg">
        </div>

        <input type="submit" class="btn btn-success" value="Confirmar">
    </form>  

</div>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>