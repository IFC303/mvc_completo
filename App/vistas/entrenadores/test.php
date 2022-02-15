
<?php require_once RUTA_APP.'/vistas/inc/header_entrenador.php' ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO?></title>
    
    <style>
         .modal{
            /* 
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
            background-color: rgba(0,0,0,0.4); */
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
                            <th>Nº TEST</th>
                            <th>NOMBRE</th>
                     
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                            <th>Acciones</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <tbody class="table-light">

                        <?php foreach($datos['usuarios'] as $test): ?>
                        <tr>
                                                       
                            <td><?php echo $test->id_test?></td>
                            <td><?php echo $test->Nombre?></td>
                      

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                            <td>

                                <button id="btnModal">Modal</button>
                                <div id="miModal" class="modal">
                                    <div class="modal-content">
                                        <span class="close">X</span>
                                        <h2>prueba de modal</h2>  
                                    </div>
                                </div>

                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo RUTA_URL?>/usuarios/ver/<?php echo $uruario->id_usuario ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg>
                                </a>



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar" href="<?php echo RUTA_URL?>/entrenador/editar/<?php echo $uruario->id_test ?>">
                                  <img src="<?php echo RUTA_Icon?>editar.svg" width="20" height="20"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalEditar">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edicion de Test</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form method="post" class="card-body">
                                                    <div class="mt-3 mb-3">
                                                        <label for="nombre">Id Test: <sup>*</sup></label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $datos['usuarios']->id_test ?>">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="email">Nombre: <sup>*</sup></label>
                                                        <input type="email" name="email" id="email" class="form-control form-control-lg" value="<?php echo $datos['usuarios']->Nombre ?>">
                                                    </div>
                                                    <input type="submit" class="btn btn-success" value="Confirmar">
                                                </form>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="button" style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                            </div>

                                        </div>
                                    </div>
                                    </div>



                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $test->id_test ?>" href="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $test->id_test ?>">
                                  <img src="<?php echo RUTA_Icon?>papelera.svg" width="20" height="20"></img>
                    
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $test->id_test ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Seguro que quiere borrar el test con identificador <?php echo $test->id_test ?></p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/entrenador/borrar/<?php echo $test->id_test ?>" method="post">
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


                    <!-- AÑADIR-->
                    <div class="col text-center">
                        <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/entrenador/nuevo_test/">Añadir</a>
                    </div>
                    <br>

            </div>
        </div>


            <script>
               
                    var modal=document.getElementById("miModal");
                    var boton=document.getElementById("btnModal");
                    var span=document.getElementsByClassName("close")[0];
                    var body=document.getElementsByTagName("body")[0];

                    boton.onclick=function(){
                        modal.style.display="block";
                        body.style.overflow="hidden";
                    }

                    span.onclick=function(){
                        modal.style.display="none";
                        body.style.overflow="visible";
                    }
                
            </script>

