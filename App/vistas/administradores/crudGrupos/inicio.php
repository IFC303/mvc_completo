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
            <div class="tabla" style="border:solid 1 px #023ef9">
                <table class="table table-hover">


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                            <th>Nº GRUPO</th>
                            <th>NOMBRE</th>
                            <th>FECHA INCIO</th>
                            <th>FECHA FIN</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>ACCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <tbody class="table-light">
                        
                        <?php
                            foreach($datos['grupo'] as $grupo):
                            ?>

                            <tr>
                                <td><?php echo $grupo->id_grupo?></td>
                                <td><?php echo $grupo->nombre?></td>
                                <td><?php echo $grupo->fecha_ini?></td>
                                <td><?php echo $grupo->fecha_fin?></td>
                                
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <td>
                                   
                                


                            <!--MODAL VER (javascript)-->
                            <img id="btnModal_<?php echo $grupo->id_grupo ?>" src="<?php echo RUTA_Icon?>ojo.svg" width="20" height="20" onclick="abrir(<?php echo $test->id_test ?>);" ></img>

                        <div id="<?php echo $grupo->id_grupo ?>" class="modalVer">
                            <div class="modal-content">

                                <div id="headerVer">
                                    <h2 style="text-align:center">ver grupo</h2>
                                </div>

                                <div id="bodyVer">
                                    <label for="id_grupo">Id de grupo: <sup>*</sup></label>
                                    <input type="text" name="id_grupo" id="id_grupo" class="form-control form-control-lg" value="<?php echo $grupo->id_grupo?>" readonly>
                                    <label for="nombreGrupo">Nombre de grupo: <sup>*</sup></label>
                                    <input type="text" name="nombreGrupo" id="nombreGrupo" class="form-control form-control-lg" value="<?php echo $grupo->nombreGrupo?>" readonly>      
                                    
                        




                                </div>
                                
                                <div id="footerVer">
                                    <input type="button" style="background-color: #023ef9; color:white"id="cerrar_<?php echo $grupo->id_grupo ?>" class="close" onclick="cerrar(<?php echo $test->id_test ?>);" value="cerrar" >
                                </div>
                            
                            </div>  
                        </div> 






















                       
                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $grupo->id_grupo ?>" href="<?php echo RUTA_URL?>/adminGrupos/borrar/<?php echo $grupo->id_grupo?>">
                                  <img src="<?php echo RUTA_Icon?>papelera.svg" width="20" height="20"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $grupo->id_grupo ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <p>Seguro que quiere borrar el test con identificador <?php echo $grupo->id_grupo ?></p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminGrupos/borrar/<?php echo $grupo->id_grupo ?>" method="post">
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


                    <!--CREAR NUEVO GRUPO Y AÑADIR PARTICIPANTES-->
                    <div class="col text-center">
                        <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/adminGrupos/nuevo_grupo/">Crear grupo</a>
                        <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/adminGrupos/participantes/">Gestion participantes</a>
                    </div>
            </div>
        </div>
