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

    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/css/estilos-admin.css">
    <title><?php echo NOMBRE_SITIO ?></title>
</head>

<body>
    <div class="container-fluid min-vh-100" style="border: solid;">

        <header class="p-4 row">
            <div class="col-6 col-md-3 order-1 order-md-1"><img id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png" width="150"></div>
            <br><br><br><br>
            <div class="col-xs-12 col-md-7 text-center order-3 order-md-2">
                <h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px;">ZONA DE ADMINISTRADOR</h1>

                <ol class="breadcrumb v1 justify-content-center">
                    <li class="breadcrumb-level"><a href="<?php echo RUTA_URL ?>/admin">INICIO</a></li>
                    <li class="breadcrumb-level"><a><?php if($this->datos['idTengo']=="1"){echo "ADMIN";}elseif($this->datos['idTengo']=="2"){echo "ENTRENADORES";
                    }elseif($this->datos['idTengo']=="3"){echo "SOCIOS";}elseif($this->datos['idTengo']=="4"){echo "TIENDAS";} ?></a></li>
                </ol>
            </div>
            <br><br><br><br>
            <div class="d-flex col-6 col-md-2 justify-content-end order-2 order-md-3 text-center">
                <div class="col-12">
                    <a aria-current="page" href="<?php echo RUTA_URL ?>/login/logout">
                        <img src="<?php echo RUTA_Icon ?>salirUsu.svg" width="50" height="50">
                    </a>
                    <br>
                    <?php echo $datos['usuarioSesion']->nombre ?>
                    <script type="text/javascript">
                        var d = new Date();
                        var minutes = d.getMinutes();
                        minutes = minutes > 9 ? minutes : '0' + minutes;
                        document.write(d.getHours() + ":" + minutes);
                    </script>
                </div>
            </div>

            <div class="col-12 order-4" id="fotoMenu">
                <div style="width: 50px; height: 50px; cursor:pointer;"  data-bs-toggle="offcanvas" data-bs-target="#menu1"><img src="<?php echo RUTA_Icon ?>menu.svg" width="50" height="50"></div>
            </div>

            <!--MENU-->
            <div class="offcanvas offcanvas-start" id="menu1">
                <div class="offcanvas-header">
                    <a href="<?php echo RUTA_URL ?>/admin"><img src="<?php echo RUTA_Icon ?>inicio.svg" width="50" height="50"></a>
                    <a href="<?php echo RUTA_URL ?>/admin"><h1 class="offcanvas-title">INICIO</h1></a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>

                <!--MENU USUARIOS-->
                <ul id="mInicioUsu">
                    <li id="mInicioUsu">
                        <a href="#submenuUsu" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>usuario.svg" width="35" height="35"></div>
                            <div class=" d-none d-sm-inline">USUARIOS</div>
                        </a>
                    </li>
                    <ul class="collapse nav flex-column" id="submenuUsu" data-bs-parent="#menu">
                        <li id="sInicio">
                            <a href="<?php echo RUTA_URL ?>/admin/crud_admin" class="nav-link">ADMIN</a>
                        </li>
                        <li id="sInicio">
                            <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" class="nav-link ">ENTRENADORES</a>
                        </li>
                        <li id="sInicio">
                            <a href="<?php echo RUTA_URL ?>/admin/crud_socios" class="nav-link ">SOCIOS</a>
                        </li>
                        <li id="sInicio">
                            <a href="<?php echo RUTA_URL ?>/admin/crud_tiendas" class="nav-link ">TIENDAS</a>
                        </li>
                    </ul>
                </ul>

                <!--MENU SOLICITUDES-->
                <ul id="mInicioSol">
                    <li id="mInicioSol">
                        <a href="#submenuSol" data-bs-toggle="collapse" class="nav-link px-0 align-middle ">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>solicitudes.svg" width="35" height="35"></div>
                            <div class=" d-none d-sm-inline">SOLICITUDES</div>
                        </a>
                    </li>
                    <ul class="collapse nav flex-column " id="submenuSol" data-bs-parent="#menu">
                        <li id="sInicio">
                            <a href="#" class="nav-link">SOCIOS</a>
                        </li>
                        <li id="sInicio">
                            <a href="#" class="nav-link ">GRUPOS</a>
                        </li>
                        <li id="sInicio">
                            <a href="#" class="nav-link ">EVENTOS</a>
                        </li>
                    </ul>
                </ul>

                <!--MENU GRUPOS-->
                <ul id="mInicioGru">
                    <li id="mInicioGru">
                        <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>grupos.svg" width="35" height="35"></div>
                            <div class="col-12">GRUPOS</div>
                        </a>
                    </li>
                </ul>

                <!--MENU EVENTOS-->
                <ul id="mInicioEve">
                    <li id="mInicioEve">
                        <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>eventos.svg" width="35" height="35"></div>
                            <div class="col-12">EVENTOS</div>
                        </a>
                    </li>
                </ul>

                <!--MENU LICENCIAS-->
                <ul id="mInicioLic">
                    <li id="mInicioLic">
                        <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>licencias.svg" width="35" height="35"></div>
                            <div class="col-12">LICENCIAS</div>
                        </a>
                    </li>
                </ul>

                <!--MENU ENTIDADES-->
                <ul id="mInicioEnt">
                    <li id="mInicioEnt">
                        <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>entidad.svg" width="35" height="35"></div>
                            <div class="col-12">ENTIDADES</div>
                        </a>
                    </li>
                </ul>

                <!--MENU TEMPORADAS-->
                <ul id="mInicioTem">
                    <li id="mInicioTem">
                        <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>temporadas.svg" width="35" height="35"></div>
                            <div class="col-12">TEMPORADAS</div>
                        </a>
                    </li>
                </ul>

                <!--MENU FACTURACION-->
                <ul id="mInicioFac">
                    <li id="mInicioFac">
                        <a href="#submenuFac" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>euro.svg" width="35" height="35"></div>
                            <div class="col-12">FACTURACION</div>
                        </a>
                    </li>
                    <ul class="collapse nav flex-column " id="submenuFac" data-bs-parent="#menu">
                        <li id="sInicio">
                            <a href="#" class="nav-link">INGRESOS</a>
                        </li>
                        <li id="sInicio">
                            <a href="#" class="nav-link ">GASTOS</a>
                        </li>
                    </ul>
                </ul>

                <!--MENU MENSAJERIA-->
                <ul id="mInicioMen">
                    <li id="mInicioMen">
                        <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" data-bs-toggle="collapse" class="nav-link px-0 align-middle">
                            <div id="imgMenu"><img src="<?php echo RUTA_Icon ?>mensajeria.svg" width="35" height="35"></div>
                            <div class="col-12">MENSAJERIA</div>
                        </a>
                    </li>
                </ul>
                <div class="d-flex offcanvas-footer justify-content-center h-100 align-items-end">
                    <img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png">
                </div>
            </div>
        </header>