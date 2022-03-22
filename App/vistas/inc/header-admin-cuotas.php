<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos-tienda.css">
    <title><?php echo NOMBRE_SITIO ?></title>
</head>

<body>

    <div class="container-fluid min-vh-100">
        <header class="p-4 row">
            <div class="col-6 col-md-3 order-1 order-md-1"><img id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png" width="150"></div>

            <div class="col-xs-12 col-md-7 text-center order-3 order-md-2" style="z-index:1">
                </br>
                <h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px;">ZONA DE TIENDA</h1>
                </br>
                <ol class="breadcrumb v1 justify-content-center">
                    <li class="breadcrumb-level"><a href="<?php echo RUTA_URL ?>">INICIO</a></li>
                    <li class="breadcrumb-level"><a>TIENDA</a></li>
                </ol>
            </div>

            <div class="d-flex col-6 col-md-2 justify-content-end order-2 order-md-3 text-center">
                <div class="col-12">
                    <a aria-current="page" href="<?php echo RUTA_URL ?>/login/logout">
                        <img src="<?php echo RUTA_Icon ?>salirUsu.svg" width="50" height="50">
                    </a>
                    <br>
                    <?php echo $datos['usuarioSesion']->nombre ?>
                    <p id="reloj"></p>
                    <script type="text/javascript">
                        setInterval("verHora()", 500)

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

        <nav class="row">
            <!--BOTON MENU LATERAL-->
            <div class="col-12 order-4" id="fotoMenu">
                <div style="width: 50px; height: 50px; cursor:pointer;" data-bs-toggle="offcanvas" data-bs-target="#menu1">
                    <img src="<?php echo RUTA_Icon ?>menu.svg" width="50" height="50">
                </div>
            </div>
        </nav>

        <div class="offcanvas offcanvas-start" id="menu1" style="overflow: scroll;">
            <!--HEADER-->
            <div class="offcanvas-header">
                <a href="<?php echo RUTA_URL ?>/tienda"><img src="<?php echo RUTA_Icon ?>inicio.svg" width="50" height="50"></a>
                <a href="<?php echo RUTA_URL ?>/tienda">
                    <h1 class="offcanvas-title">INICIO</h1>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <!--BODY-->
            <div class="offcanvas-body">

                <ul id="mInicioGru">
                    <!--EQUIPACIONES-->
                    <li id="mInicioTem">
                        <a href="<?php echo RUTA_URL ?>/tienda/equipaciones" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>usuario.svg" width="35" height="35"></div>
                            <div class="col-12">EQUIPACIONES</div>
                        </a>
                    </li>
                </ul>
            </div>
            <!--FOOTER-->
            <div class="d-flex offcanvas-footer justify-content-center align-items-end">
                <img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png">
            </div>
        </div>