
<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/public/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO?></title>

    <style>
         .modalVer{
            
            display: none;
            position: fixed;
            z-index: 1;
            padding: 100px 100px 0px 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
        }

        a{
            color:black;
            text-decoration: none;
        }

    </style>

</head>
<body>


        <div class="container">

           <div class="tabla" style="border:solid 1px #023ef9">

            <table class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                            <th>Nº EVENTO</th>
                            <th>NOMBRE</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <th>Acciones</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                    <tbody class="table-light">

                        <?php
                        foreach($datos['evento'] as $evento): ?>
                        <tr>

                            <td><?php echo $evento->id_evento?></td>
                            <td><?php echo $evento->nombre?></td>
                            <td><?php echo $evento->fecha_ini?></td>
                            <td><?php echo $evento->fecha_fin?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>

                                <!--MODAL VER (javascript)-->
                                    <img id="btnModal_<?php echo $evento->id_evento ?>" src="<?php echo RUTA_Icon?>ojo.svg" width="20" height="20" onclick="abrir(<?php echo $evento->id_evento ?>);" ></img>

                                    <div id="<?php echo $evento->id_evento ?>" class="modalVer">
                                        <div class="modal-content">

                                            <div id="headerVer">
                                                <h2 style="text-align:center">ver evento</h2>
                                            </div>

                                            <div id="bodyVer">
                                                <label for="id_evento">Id de evento: <sup>*</sup></label>
                                                <input type="text" name="id_evento" id="id_evento" class="form-control form-control-lg" value="<?php echo $evento->id_evento?>" readonly>
                                                <label for="id_usuario">Id de usuario: <sup>*</sup></label>
                                                <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $evento->id_usuario?>" readonly>
                                                <label for="nombre">Nombre de evento: <sup>*</sup></label>
                                                <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $evento->nombre?>" readonly> 
                                                <label for="tipo">Tipo: <sup>*</sup></label>
                                                <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $evento->tipo?>" readonly>
                                                <label for="precio">Precio: <sup>*</sup></label>
                                                <input type="text" name="precio" id="precio" class="form-control form-control-lg" value="<?php echo $evento->precio?>" readonly>
                                                <label for="descuento">Descuento: <sup>*</sup></label>
                                                <input type="text" name="descuento" id="descuento" class="form-control form-control-lg" value="<?php echo $evento->descuento?>" readonly>
                                                <label for="fecha_ini">Fecha inicio: <sup>*</sup></label>
                                                <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg" value="<?php echo $evento->fecha_ini?>" readonly>      
                                                <label for="fecha_fin">Fecha fin: <sup>*</sup></label>
                                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $evento->fecha_fin?>" readonly>        
                                            </div>
                                            
                                            <div id="footerVer">
                                                <input type="button" style="background-color: #023ef9; color:white"id="cerrar_<?php echo $evento->id_evento ?>" class="close" onclick="cerrar(<?php echo $evento->id_evento ?>);" value="cerrar" >
                                            </div>
                                        
                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $evento->id_evento ?>" >
                                  <img src="<?php echo RUTA_Icon?>editar.svg" width="20" height="20"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $evento->id_evento ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edicion de evento</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminEventos/editarEvento/<?php echo $evento->id_evento ?>" class="card-body">
                                                    <!-- id$evento -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="id_evento">Id de evento: <sup>*</sup></label>
                                                        <input type="text" name="id_evento" id="id_evento" class="form-control form-control-lg" value="<?php echo $evento->id_evento?>">
                                                    </div>
                                                    <!-- id$Usuario -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="id_usuario">Id de usuario: <sup>*</sup></label>
                                                        <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $evento->id_usuario?>">
                                                    </div>
                                                    <!-- nombre$evento -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="nombre">Nombre de evento: <sup>*</sup></label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $evento->nombre?>">
                                                    </div>
                                                    <!-- tipo -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="tipo">Tipo de evento: <sup>*</sup></label>
                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $evento->tipo?>">
                                                    </div>
                                                    <!-- precio -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="precio">precio de evento: <sup>*</sup></label>
                                                        <input type="text" name="precio" id="precio" class="form-control form-control-lg" value="<?php echo $evento->precio?>">
                                                    </div>
                                                    <!-- descuento -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="descuento">descuento: <sup>*</sup></label>
                                                        <input type="text" name="descuento" id="descuento" class="form-control form-control-lg" value="<?php echo $evento->descuento?>">
                                                    </div>
                                                    <!-- nfecha inicio -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="fecha_ini">Fecha inicio: <sup>*</sup></label>
                                                        <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg" value="<?php echo $evento->fecha_ini?>">
                                                    </div>
                                                    <!-- fecha fin -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="fecha_fin">Fecha fin: <sup>*</sup></label>
                                                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $evento->fecha_fin?>">
                                                    </div>
                                                 
                                                    <input type="submit" class="btn btn-success" value="Confirmar">
                                                </form>

                                            </div>
                                            <!-- Footer -->
                                            <div class="modal-footer">
                                                <button type="button" style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                            </div>

                                        </div>
                                    </div>
                                    </div>




                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $evento->id_evento ?>" href="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $evento->id_evento ?>">
                                  <img src="<?php echo RUTA_Icon?>papelera.svg" width="20" height="20"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $evento->id_evento ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Seguro que quiere borrar el evento con identificador <?php echo $evento->id_evento ?></p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEventos/borrar/<?php echo $evento->id_evento ?>" method="post">
                                                    <button style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit">Borrar</button>
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

                    <!--AÑADIR-->
                    <div class="col text-center">
                        <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/adminEventos/nuevo_evento/">Añadir</a>
                    </div>
                    <br>

            </div>
        </div>



            <script>

                    function abrir(idModal){
                        var modal=document.getElementById(idModal);
                         console.log(idModal);
                         var body=document.getElementsByTagName("body")[0];
                         modal.style.display="block";
                         body.style.overflow="hidden";
                    }

                   function cerrar(idModal){
                         var modal=document.getElementById(idModal);
                         var body=document.getElementsByTagName("body")[0];
                         modal.style.display="none";
                         body.style.overflow="visible";
                     }

            </script>

