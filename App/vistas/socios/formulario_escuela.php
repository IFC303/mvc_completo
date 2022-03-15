<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>

<body>
    <!-- <?php print_r($datos['usuarios']); ?><br><br><br>
    <?php print_r($datos['categorias']); ?><br><br><br>
    <?php print_r($datos['grupos']); ?><br><br><br> -->

    <form method="post" ENCTYPE="multipart/form-data">

        <label for="ccc">CCC</label><sup>* </sup><input id="ccc" name="ccc" value="<?php $datos['usuarios'][0]->CCC; ?>" type="text" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
        <br><br>
        <label for="cat">Categoría (2022)</label><sup>* </sup>
        <select name="cat" id="cat" required>
            <?php foreach ($datos['categorias'] as $cat) : ?>
            <option value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nombre ?></option>
            <?php endforeach ?>
        </select>
        <br><br>
        <label for="grup">Grupo entrenamiento </label><sup>*</sup>
        <select name="grup" id="grup" required>
            <?php foreach ($datos['grupos'] as $gru) : ?>
            <option value="<?php echo $gru->id_grupo ?>"><?php echo $gru->nombre ?></option>
            <?php endforeach ?>
        </select>
        <br><br>
        <label for="">Código GIR </label><input type="text" name="gir" value="<?php $datos['usuarios'][0]->gir; ?>">
        <br><br>

        <label for="">Consiento la toma y el uso de fotos</label><sup>*</sup> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="siFotos" name="fotos" value="si"><label for="siFotos">SI</label>
        <input type="radio" id="noFotos" name="fotos" value="no"><label for="noFotos">NO</label>
        <br><br>
        <label for="">He leido y acepto el reglamento</label><sup>*</sup> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="siReglamento" name="reglamento" value="si" required><label for="siReglamento">SI</label>
        <br><br>
        <label for="">Foto reciente tamaño carnet</label><sup>* </sup><input type="file" name="imgCarnet" accept="image/*" required>
        <br><br>


        <input type="submit" value="enviar">

    </form>
</body>

</html>
<script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>