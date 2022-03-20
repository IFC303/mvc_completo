<?php require_once RUTA_APP . '/vistas/inc/header-tienda-equipaciones.php' ?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->

    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/paginate.css">
    <script src="<?php echo RUTA_URL ?>/public/js/paginate.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO ?></title>

    <style>
        .modalVer {
            display: none;
            position: fixed;
            z-index: 1;
            padding: 100px 100px 0px 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            width: 50%;
            margin: auto;
        }

        .modal-title {
            color: #023ef9;
        }

        #modalEditar {
            width: 70%;
            margin: auto;
        }

        label {
            color: #023ef9;
        }

        a {
            color: black;
            text-decoration: none;
        }

        /*ESTILOS TABLA */

        .tabla {
            border: solid 1px #023ef9;
            width: 100%;
            margin: auto;
        }

        thead tr {
            background-color: #023ef9;
            color: white;
            text-align: center;
        }

        .datos_tabla {
            text-align: center;
        }

        .icono {
            width: 20px;
            height: 20px;
        }

        #headerVer h2 {
            padding: 30px;
            color: #023ef9;
        }



        .btn {
            background-color: #023ef9;
            color: white;
        }

        #añadir {
            color: white;
        }

        #titulo {
            font-family: 'Anton', sans-serif;
            color: #023ef9;
            letter-spacing: 5px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="panel">
            <div class="body">
                <div class="input-group">
                    <label for="searchBox">Filtrar</label>
                    <input type="search" id="searchBox" placeholder="Filtrar...">
                </div>
            </div>
        </div>

        <div class="tabla">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SOCIO</th>
                        <th>ENTREGADO</th>

                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [4])) : ?>
                            <th></th>
                        <?php endif ?>
                    </tr>
                </thead>

                <tbody class="myTable table-light">
                    <?php foreach ($datos['equipaciones'] as $equipacion) : ?>
                        <tr>
                            <td class="datos_tabla"><?php echo $equipacion->id_equipacion ?></td>
                            <td class="datos_tabla"><?php echo $equipacion->nombre . ' ' . $equipacion->apellidos ?></td>
                            <td class="datos_tabla">
                                <?php if ($equipacion->entregado) : ?>
                                    <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                <?php else : ?>
                                    <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                <?php endif; ?>
                            </td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [4])) : ?>
                                <td>

                                    <!--MODAL VER (javascript)-->
                                    <img class="icono" id="btnModal_<?php echo $equipacion->id_equipacion ?>" src="<?php echo RUTA_Icon ?>ojo.svg" onclick="abrir(<?php echo $equipacion->id_equipacion ?>);"></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $equipacion->id_equipacion ?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                <h2 class="col-11">Datos del usuario de la equipación</h2>
                                                <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $equipacion->id_equipacion ?>" onclick="cerrar(<?php echo $equipacion->id_equipacion ?>);">
                                            </div>
                                            <hr>


                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">

                                                <div class="col-12">
                                                    <label for="id_usuario">id_usuario</label>
                                                    <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $equipacion->id_usuario ?>" readonly>
                                                    <br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="talla">TALLA</label>
                                                    <input type="text" name="talla" id="talla" class="form-control form-control-lg" value="<?php echo $equipacion->talla; ?>" readonly>
                                                    <br>
                                                </div>
                                            </div>

                                            <!--Footer-->
                                            <!-- <div id="footerVer">
                                                <input class="btn" type="button" id="cerrar_<?php echo $equipacion->id_usuario ?>" onclick="cerrar(<?php echo $equipacion->id_usuario ?>);" value="Cerrar" >
                                                <br>
                                                <br>
                                            </div>
                                         -->

                                        </div>
                                    </div>



                                    <!-- MODAL EDITAR -->
                                    &nbsp;&nbsp;&nbsp;
                                    <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $equipacion->id_usuario ?>">
                                        <img class="icono" src="<?php echo RUTA_Icon ?>editar.svg"></img>
                                    </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $equipacion->id_usuario ?>">
                                        <div class="modal-dialog modal-xl modal-dialog-centered">
                                            <div class="modal-content" id="modalEditar">

                                                <!-- Header -->
                                                <div class="modal-header">
                                                    <h2 class="modal-title">Edicion de Equipacion</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Body -->
                                                <div class="modal-body">
                                                    <form method="post" action="<?php echo RUTA_URL ?>/tienda/editarEquipacion/<?php echo $equipacion->id_usuario ?>" class="card-body">

                                                        <div class="mt-3 mb-3">
                                                            <label for="id_usuario">Id de usuario</label>
                                                            <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $equipacion->id_usuario ?>" readonly>
                                                        </div>

                                                        <div class="mt-3 mb-3">
                                                            <select name="entregado" id="entregado" class="form-control form-control-lg" value="<?php echo $equipacion->entregado ?>">
                                                                <option value="0">No entregado</option>
                                                                <option value="1" <?php if (!$equipacion->entregado) echo "selected" ?>>Entregado</option>
                                                            </select>
                                                        </div>

                                                        <input type="submit" class="btn" value="Confirmar">
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>


        </div>
    </div>

    <script>
        //region paginacion
        let options = {
            numberPerPage: 4, //Cantidad de datos por pagina
            goBar: true, //Barra donde puedes digitar el numero de la pagina al que quiere ir
            pageCounter: true, //Contador de paginas, en cual estas, de cuantas paginas
        };

        let filterOptions = {
            el: '#searchBox' //Caja de texto para filtrar, puede ser una clase o un ID
        };

        paginate.init('.myTable', options, filterOptions);
        //endregion
        function abrir(idModal) {
            var modal = document.getElementById(idModal);
            console.log(idModal);
            var body = document.getElementsByTagName("body")[0];
            modal.style.display = "block";
            body.style.overflow = "hidden";
        }

        function cerrar(idModal) {
            var modal = document.getElementById(idModal);
            var body = document.getElementsByTagName("body")[0];
            modal.style.display = "none";
            body.style.overflow = "visible";
        }
    </script>