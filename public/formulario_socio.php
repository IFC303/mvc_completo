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
            #fotoBici {
                display: none;
            }
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
                <form action="" onsubmit="return validar()">
                    <div class="row m-3">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="fecha">Fecha Nacimiento (atleta) </label>
                            <input class="form-control" type="date" id="fecha" name="fecha" onchange="mayorEdad()" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="dniAtl">DNI (atleta) </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="dniAtl" name="dniAtl" style="text-transform:uppercase;">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="nomAtl">Nombre (atleta) </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="nomAtl" name="nomAtl" required onkeypress="return Solo_Texto(event);">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="apelAtl">Apellidos (atleta) </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="apelAtl" name="apelAtl" required onkeypress="return Solo_Texto(event);">
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="direc">Dirección </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="direc" name="direc" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="telf">Telefono </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="email">Correo </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="email" name="email" onblur="return correo(this.id)" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="ccc">CCC </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="ccc" name="ccc" maxlength="20" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                            <label for="talla">Talla camiseta </label>
                            <input type="text" class="form-control" placeholder="Escriba los apellidos" id="talla" name="talla" required>
                        </div>

                        <label for="">¿Es tu primer año como socio? </label> &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" id="siFotos" name="fotos" value="si"><label for="siFotos">SI</label>
                        <input type="radio" id="noFotos" name="fotos" value="no"><label for="noFotos">NO</label>
                        <br><br>

                        <label id="error"></label>
                        <label id="errorMail"></label>

                        <input type="submit" value="enviar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
<script src="js/validar.js"></script>