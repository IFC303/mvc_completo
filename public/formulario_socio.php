<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

        @media (max-width: 600px) {
            #fotoBici{display: none;}
        }
    </style>
</head>

<body style="margin: 0px;">
    <div class="container-fluid min-vh-100 m-0 p-0">
        <div class="row">
            <div id="fotoBici" class="col-lg-6 col-md-6 col-sm-6 col-xs-0 m-0 p-0">
                <img src="http://localhost/tragamillas/public/img/fotos/bici3.png" width="100%" height="100%">
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 m-0 p-0">
                <form action="">
                    <label for="">¿Eres socio?</label> &nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" id="siSocio" name="socio" value="si" onclick="ereSocio();" required><label for="siSocio">SI</label>
                    <input type="radio" id="noSocio" name="socio" value="no" onclick="ereSocio();" required><label for="noSocio">NO</label>
                    <label id="prueba"></label>
                    <br><br>
                    <label for="">Fecha Nacimiento (atleta) </label><input id="fecha" type="date" onchange="mayorEdad()" required>
                    <br><br>

                    <div id="esMenor" style="display: none;">
                        <label for="">DNI (padre) </label><input type="text" value="" id="dniPad" name="dniPad" onblur="return dni(this.id)" style="text-transform:uppercase;"> <label id="error"></label>
                        <br><br>
                        <label for="">Nombre (padre) </label><input id="nomPadre" type="text" onkeypress="return Solo_Texto(event);">
                        <br><br>
                        <label for="">Apellidos (padre) </label><input id="apelPadre" type="text" onkeypress="return Solo_Texto(event);">
                        <br><br>
                    </div>

                    <label for="">DNI (atleta) </label><input type="text" value="" id="dniAtl" name="dniAtl" style="text-transform:uppercase;">
                    <br><br>
                    <label for="">Nombre (atleta) </label><input type="text" required onkeypress="return Solo_Texto(event);">
                    <br><br>
                    <label for="">Apellidos (atleta) </label><input type="text" required onkeypress="return Solo_Texto(event);">
                    <br><br>
                    <label for="">Dirección </label><input type="text" required>
                    <br><br>
                    <label for="">Telefono </label><input type="text" value="" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                    <br><br>
                    <label for="">Correo </label><input type="text" value="" id="email" name="email" onblur="return correo(this.id)" required> <label id="errorMail"></label>
                    <br><br>
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

                    <div id="hacerSoci" style="display: none;">
                        <label for="" id="borTallaLabel" name="talla">Talla </label><input type="text" id="borTalla">
                        <br><br>
                        <label for="" id="borSocioLabel">¿Has sido socio?</label> &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="siHasSocio" name="hasSocio" value="si" class="borrar"><label for="siHasSocio" id="borSiLabel">SI</label>
                        <input type="radio" id="noHasSocio" name="hasSocio" value="no" class="borrar"><label for="noHasSocio" id="borNoLabel">NO</label>
                        <br><br>
                    </div>

                    <input type="submit" value="enviar">

                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="js/validar.js"></script>