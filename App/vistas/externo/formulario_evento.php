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
    <title><?php echo NOMBRE_SITIO ?></title>

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
        
        #fotoBici{
            background-image: url("<?php echo RUTA_Foto ?>bici3.png");
            background-size: 100% 100%;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        @media (max-width: 600px) {
            #fotoBici {
                display: none;
            }
        }
        sup{
            color: #023EF9;
            font-weight: bold;
            font-size: small;
        }
    </style>
</head>

<body style="margin: 0px;">

    <div class="container-fluid min-vh-100 ">
    <div class="row">

            <div id="fotoBici" class="col-lg-5 col-md-5 col-sm-5 m-0 p-0 min-vh-100" ></div>

            <div class="col-lg-7 col-md-7 col-sm-7 col-xs-12 m-0 p-0">

                <div class="p-3" style="text-align: center;"><a href="<?php echo RUTA_URL ?>/socio"><img src="<?php echo RUTA_Foto ?>corredor.png" width="150"><img src="<?php echo RUTA_Foto ?>letras.png" width="200"></a></div>
                <div class="p-3" style="text-align: center;"><h1>INSCRIPCION EVENTO</h1></div>

                <form action="" onsubmit="return validarSoliSocio()" method="POST"> 
                <div class="row mt-4">

                        <div class="row mt-3 mb-3">
                            <div class="col-5">
                                <div class="input-group">
                                   <label for="nomAtl" class="input-group-text">Nombre <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el nombre" id="nomAtl" name="nomAtl" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                  <label for="apelAtl" class="input-group-text">Apellidos <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Escriba los apellidos" id="apelAtl" name="apelAtl" required onkeypress="return Solo_Texto(event);">
                                </div>
                            </div>
                        </div>


                        <div class="row mt-4 mb-4">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="fecha" class="input-group-text">Fecha Nacimiento <sup>*</sup></label>
                                    <input class="form-control" type="date" id="fecha" name="fecha" onchange="mayorEdad()" required>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="dniAtl" class="input-group-text" id="dniObli">DNI</label>
                                    <input type="text" class="form-control" placeholder="Escriba el dni" id="dniAtl" name="dniAtl">
                                </div>
                            </div>                           
                        </div>

                        <div class="row mt-3 mb-5">
                            <div class="col-12 input-group">
                                <label for="direc" class="input-group-text">Dirección <sup>*</sup></label>
                                <input type="text" class="form-control" placeholder="Escriba la dirección" id="direc" name="direc" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-5">
                                <div class="input-group">
                                    <label for="telf" class="input-group-text">Telefono <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el telefono" id="telf" name="telf" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
                                </div>
                            </div>
                            <div class="col-7">
                                <div class="input-group">
                                    <label for="email" class="input-group-text">Correo <sup>*</sup></label>
                                    <input type="text" class="form-control" placeholder="Escriba el correo" id="email" name="email" onblur="return correo(this.id)" required>
                                </div>
                            </div>                           
                        </div>


                        <div class="row mt-4 mb-3">
                            <div class="col-6 w-50 input-group">
                                <label for="even" class="input-group-text">EVENTOS <sup>* </sup></label>
                                    <select class="form-control" name="even" id="even" required>
                                        <option value=""></option>
                                        <?php foreach ($datos['eventos'] as $even) : ?>
                                        <option value="<?php echo $even->id_evento ?>"><?php echo $even->nombre ?></option>
                                        <?php endforeach ?>
                                    </select>
                            </div>
                        </div>


                        <label id="error"></label>
                        <label id="errorMail"></label>

                        <input type="submit" class="btn btn-primary mt-4 ms-3 w-25" value="Enviar">

                </div>
                </form>

            </div>
        </div>
    </div>
</body>

</html>


<script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>