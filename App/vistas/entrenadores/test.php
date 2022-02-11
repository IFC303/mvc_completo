
<?php require_once RUTA_APP.'/vistas/inc/header_entrenador.php' ?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css" integrity="sha384-7ynz3n3tAGNUYFZD3cWe5PDcE36xj85vyFkawcF6tIwxvIecqKvfwLiaFdizhPpN" crossorigin="anonymous">
    
    <link rel="stylesheet" href="<?php echo RUTA_URL?>/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO?></title>
    
    <style>
        .modal{
            display: none; 
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding: 100px 100px 0px 100px;
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0,0,0); /* Fallback color */
            background-color: rgba(0,0,0,0.4);
        }

        a{
            color:black;
            text-decoration: none; 
        }

    </style>

</head>
<body>


        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">Menu</button>




        <div class="container">

           <div class="tabla" style="border:solid 1px #023ef9">

            <table class="table table-hover" >
                    
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                            <th>Nº TEST</th>
                            <th>NOMBRE</th>
                     
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <th>Acciones</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <tbody class="table-light">
                        <?php foreach($datos['usuarios'] as $uruario): ?>
                        <tr>
                            <td><?php echo $uruario->id_usuario ?></td>
                            <td><?php echo $uruario->nombre ?></td>
                            <td><?php echo $uruario->email ?></td>
                            <td><?php echo $uruario->telefono ?></td>
                            <td><?php echo $uruario->id_rol ?></td>

                            
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
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

                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo RUTA_URL?>/usuarios/editar/<?php echo $uruario->id_usuario ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                    </svg>
                                </a>


                                <!--BORRAR-->
                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo RUTA_URL?>/usuarios/borrar/<?php echo $uruario->id_usuario ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                    </svg>
                                </a>



                                &nbsp;&nbsp;&nbsp;
                                <a href="javascript:getSesiones(<?php echo $uruario->id_usuario ?>)">Sesiones</a>


                            </td>
                            <?php endif ?>
                        </tr>
                        <?php endforeach ?>
                    </tbody>

            </table>

                    <div class="col text-center">
                        <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/usuarios/agregar/">Añadir</a>
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

