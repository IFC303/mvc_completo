<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos-admin.css">
    <title><?php echo NOMBRE_SITIO ?> - Administrador</title>
</head>

<body>
    <div class="container-fluid min-vh-100" style="border: solid;">

        <header class="p-4 row">
            <div class="col-6 col-md-3 order-1 order-md-1"><img id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png" width="150"></div>

            <br><br><br><br>
            <div class="col-xs-12 col-md-7 text-center order-3 order-md-2">
                <h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px;">ZONA DE ADMINISTRADOR</h1>
            </div>

            <br><br><br><br>
            <div class="d-flex col-6 col-md-2 justify-content-end order-2 order-md-3 text-center">
                <div class="col-12">
                    <a aria-current="page" href="<?php echo RUTA_URL ?>/login/logout">
                        <img src="<?php echo RUTA_Icon ?>salirUsu.svg" width="50" height="50">
                    </a>
                    <br>
                    <?php echo $datos['usuarioSesion']->nombre ?>
                    <p id="reloj"></p>
                    <script type="text/javascript">
                        setInterval("verHora()", 500);

                        function verHora() {
                            let d = new Date();
                            let minutes = d.getMinutes();
                            minutes = minutes > 9 ? minutes : '0' + minutes;
                            let reloj = d.getHours() + ":" + minutes
                            document.getElementById("reloj").innerHTML = reloj;
                        }
                    </script>
                </div>
            </div>
        </header>