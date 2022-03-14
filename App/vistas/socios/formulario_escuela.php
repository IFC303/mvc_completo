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
    <form action="aaa.html">
        
        <label for="">CCC </label><input type="text" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
        <br><br>
        <label for="">Categoría (2022) </label><input type="text" required>
        <br><br>
        <label for="">Grupo entrenamiento </label><input type="text" required>
        <br><br>
        <label for="">Código GIR </label><input type="text">
        <br><br>

        <label for="">Consiento la toma y el uso de fotos </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="siFotos" name="fotos" value="si"><label for="siFotos">SI</label>
        <input type="radio" id="noFotos" name="fotos" value="no"><label for="noFotos">NO</label>
        <br><br>
        <label for="">He leido y acepto el reglamento </label> &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" id="siReglamento" name="reglamento" value="si" required><label for="siReglamento">SI</label>
        <br><br>
        <label for="">Justificante de pago </label><input type="file" required>
        <br><br>
        <label for="">Foto reciente tamaño carnet </label><input type="file" required>
        <br><br>


        <input type="submit" value="enviar">
        
    </form>
</body>

</html>
<script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>