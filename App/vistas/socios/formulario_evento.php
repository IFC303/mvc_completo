<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>
<div class="container mt-3">
    <style>
        label[id^="error"] {
            color: red;
            font-size: 15px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>


    <form method="post">
        <div class="row">

            <!-- <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-3 mt-3">
                <label for="nombre">NOMBRE <sup>*</sup></label>
                <input type="text" class="form-control" placeholder="Escriba el nombre" id="nombre" name="nombre" placeholder="NOMBRE" required>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-3 mt-3">
                <label for="apellidos">APELLIDOS <sup>*</sup></label>
                <input type="text" class="form-control" placeholder="Escriba los apellidos" id="apellidos" name="apellidos" placeholder="APELLIDOS" required>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-3 mt-3">
                <label for="dniSoc" id="dniObli">DNI <sup>*</sup></label>
                <input type="text" class="form-control" placeholder="Escriba el DNI" id="dniSoc" name="dniSoc" style="text-transform:uppercase;" onchange="return dni(this.id)" required>
            </div>

            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-3 mt-3">
                <label for="telf">Telefono <sup>*</sup></label>
                <input type="text" class="form-control" placeholder="Escriba el tlf" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
            </div> -->

            <div class="col-12 mb-3 mt-3">
                <label for="even">EVENTOS <sup>* </sup></label>
                <select class="form-control" name="even" id="even" required>
                    <option value=""></option>
                    <?php foreach ($datos['eventos'] as $even) : ?>
                        <option value="<?php echo $even->id_evento ?>"><?php echo $even->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <label id="error"></label>
            <div class="col-12">
                <input type="submit" value="Enviar" style="background-color: #023ef9; color:white;">
            </div>


        </div>
    </form>

    <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
    <script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>