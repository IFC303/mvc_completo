<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos-admin.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">
    <title><?php echo NOMBRE_SITIO ?></title>
</head>


<body>

        <?php
            $miga1 = "";
            $miga1Nom = "";
            $miga2 = "";
            $miga2Nom = "";
            $miga3 = "";

            if (isset($this->datos['miga1'])) {
                if ($this->datos['miga1'] == "GRUPOS") {
                    $miga1Nom = "GRUPOS";
                } elseif ($this->datos['miga1'] == "TEST") {
                    $miga1Nom = "TEST";
                } elseif ($this->datos['miga1'] == "MENSAJERIA") {
                    $miga1Nom = "MENSAJERIA";
                }
            } else {
                $miga1Nom = "EN MANTENIMIENTO";
            }

            if (isset($this->datos['nuevoMiga'])) {
                if ($this->datos['nuevoMiga'] == "TEST") {
                    $miga1 = RUTA_URL . "/entrenador/test";
                    $miga1Nom = "TEST";
                    $miga2Nom = "NUEVO TEST";
                } 
            }
        ?>



        <div class="container-fluid min-vh-100">
            <header class="p-4 row" style="background-color:#CCE6FA">


             <!--LOGO -->
             <div class="col-6 col-md-3 order-1 order-md-1"><img id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png" width="150"></div>
                
                <!--TEXTO -->
                <div class="col-xs-12 col-md-7 text-center order-3 order-md-2">
                    <h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px; padding:25px">Bienvenid@ <?php echo $datos['usuarioSesion']->nombre?></h1>
                </div>

                <!--LOGIN Y RELOJ-->
                <div class="d-flex col-6 col-md-2 justify-content-end order-2 order-md-3 text-center">
                    <div class="col-12">
                        <a aria-current="page" href="<?php echo RUTA_URL ?>/login/logout">
                            <img src="<?php echo RUTA_Icon ?>salirUsu.svg" width="50" height="50">
                        </a>
                        <br>
                        <?php echo $datos['usuarioSesion']->nombre?>
                        <span id="reloj"></span>
                        <script type="text/javascript">
                            setInterval("verHora()", 500);
                            function verHora(){
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


                <!-- <ol class="breadcrumb v1 justify-content-center">
                        <li class="breadcrumb-level"><a href="<?php echo RUTA_URL ?>">INICIO</a></li>
                        <li class='breadcrumb-level'><a href="<?php echo $miga1 ?>"><?php echo $miga1Nom ?></a></li>
                        <?php if (isset($this->datos['nuevoMiga'])) {
                            echo "<li class='breadcrumb-level'><a href=" . $miga2 . ">" . $miga2Nom . "</a></li>";
                        }
                        ?>
                </ol> -->
     
      

            <!--MENU-->
            <div class="offcanvas offcanvas-start" id="menu1">
               
                <div class="offcanvas-header">
                    <a href="<?php echo RUTA_URL ?>/socio"><img src="<?php echo RUTA_Icon ?>inicio.svg" width="50" height="50"></a>
                    <a href="<?php echo RUTA_URL ?>/socio"><h1 class="offcanvas-title">INICIO</h1></a>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>                  
                <hr>

                <div class="offcanvas-body">       
                            <li id="mInicioDatos">
                                <a href="<?php echo RUTA_URL ?>/socio/modificarDatos" class="nav-link px-0 align-middle">
                                <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>editar.svg" width="35" height="35"></div>
                                <div class="col-12">MIS DATOS</div>
                                </a>
                            </li>
                            <li id="mInicioLic">
                                <a href="<?php echo RUTA_URL ?>/socio/licencias" class="nav-link px-0 align-middle">
                                <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>licencias.svg" width="35" height="35"></div>
                                <div class="col-12">LICENCIAS</div>
                                </a>
                            </li>
                            <li id="mInicioMarcas">
                                <a href="<?php echo RUTA_URL ?>/socio/verMarcas" class="nav-link px-0 align-middle">
                                    <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>cronometro.svg" width="35" height="35"></div>
                                    <div class="col-12">MARCAS</div>
                                </a>
                            </li>
                            <li id="mInicioEquipacion">
                                <a href="<?php echo RUTA_URL ?>/socio/equipacion" class="nav-link px-0 align-middle">
                                <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>carrito.svg" width="35" height="35"></div>
                                <div class="col-12">EQUIPACION</div>
                                </a>
                            </li>
                            <li id="mInicioEscuela">
                                <a href="<?php echo RUTA_URL ?>/socio/escuela" class="nav-link px-0 align-middle">
                                    <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>escuela.png" width="35" height="35"></div>
                                    <div class="col-12">ESCUELA</div>
                                </a>
                            </li>       
                                                       
                            <div class="d-flex justify-content-center h-100 align-items-end">
                                <a href="<?php echo RUTA_URL ?>/socio"><img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png"></a>
                            </div>
                </div>
            </div>


            <nav class="row">
            <!--BOTON MENU LATERAL-->
            <div class="col-12 order-4" id="fotoMenu">
                <div style="width: 50px; height: 50px; cursor:pointer;" data-bs-toggle="offcanvas" data-bs-target="#menu1">
                    <img src="<?php echo RUTA_Icon ?>menu.svg" width="50" height="50">
                </div>
            </div>
            </nav>