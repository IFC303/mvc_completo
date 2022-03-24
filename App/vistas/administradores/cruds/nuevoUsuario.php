<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

<style>
    label[id^="error"] {
        color: red;
        font-size: 15px;
    }

    #ventana {
        margin: auto;
    }

    label,
    h2 {
        color: #023ef9;
    }

    .btn {
        background-color: #023ef9;
        color: white;
    }

    #botonVolver {
        background-color: white;
        color: #023ef9;
        border-color: #023ef9;
    }
</style>





<div id="ventana" class="card bg-light w-50 card-center">

    <h2 class="card-header">Nuevo usuario</h2>


    <form action="<?php echo RUTA_URL ?>/admin/nuevoUsuario/<?php echo $datos['idTengo'] ?>" method="post" class="card-body" onsubmit="return validarSoliUsu()">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="fecha">Fecha Nacimiento <sup>*</sup></label>
                <input type="date" class="form-control form-control-lg" id="fecha" name="fecha" onchange="mayorEdad()">
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="dniAtl" id="dniObli">DNI </label>
                <input type="text" class="form-control form-control-lg" id="dniAtl" placeholder="Escriba el DNI" name="dniAtl">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="nombre">Nombre <sup>*</sup></label>
                <input type="text" class="form-control form-control-lg" placeholder="Escriba el nombre" id="nombre" name="nombre" required onkeypress="return Solo_Texto(event);">
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="apellidos">Apellidos <sup>*</sup></label>
                <input type="text" class="form-control form-control-lg" placeholder="Escriba los apellidos" id="apellidos" name="apellidos" required onkeypress="return Solo_Texto(event);">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="telf">Telefono <sup>*</sup></label>
                <input type="text" class="form-control form-control-lg" placeholder="Escriba el telefono" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="email">Correo <sup>*</sup></label>
                <input type="text" class="form-control form-control-lg" placeholder="Escriba el correo" id="email" name="email" onblur="return correo(this.id)" required>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="direccion">Direccion <sup>*</sup></label>
                <input type="text" class="form-control form-control-lg" placeholder="Escriba la direccion" id="direccion" name="direccion" required>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="pass">Contraseña </label>
                <input type="password" class="form-control form-control-lg" placeholder="Escriba la contraseña" id="pass" name="pass">
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">Quiere que sea Socio: <sup>*</sup></label> <span style="margin-left: 10px;"></span>
                <input type="radio" id="siSocio" name="socio" value="si" required><label for="siSocio">SI</label><span style="margin-left: 20px;"></span>
                <input type="radio" id="noSocio" name="socio" value="no" required><label for="noSocio">NO</label>
            </div>
        </div>

        <div class="row">
            <div class="col-12 mb-3 mt-3">
                <label id="error"></label>
                <label id="errorMail"></label>
            </div>
        </div>

        <div class="row">
            <div class="col-3">
                <input type="submit" class="btn" value="Confirmar">
                <?php if ($this->datos['idTengo'] == "1") {
                    $miga1 = RUTA_URL . "/admin/crud_admin";
                } elseif ($this->datos['idTengo'] == "2") {
                    $miga1 = RUTA_URL . "/admin/crud_entrenadores";
                } elseif ($this->datos['idTengo'] == "3") {
                    $miga1 = RUTA_URL . "/admin/crud_socios";
                } elseif ($this->datos['idTengo'] == "4") {
                    $miga1 = RUTA_URL . "/admin/crud_tiendas";
                } ?>
                <a href="<?php echo $miga1 ?>">
                    <input type="button" class="btn" id="botonVolver" value="Volver">
                </a>
            </div>
        </div>
        <br>


    </form>
</div>
</body>


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
<script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>
<script>
    function Solo_Texto(e) {
        var code;
        if (!e) var e = window.event;
        if (e.keyCode) code = e.keyCode;
        else if (e.which) code = e.which;
        var character = String.fromCharCode(code);
        var AllowRegex = /^[\ba-zA-Z\s-]$/;
        if (AllowRegex.test(character)) return true;
        return false;
    }
</script>