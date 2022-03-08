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
      /*modal javascript */

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

        .modalVer .modal-content{
            width:40%;
            margin: auto;
        }

        #modalEditar{
            width:60%;
            margin: auto;
        }

        .modal-title{
            color:#023ef9;
        }

        label{
           color:#023ef9;
        }

        a{
            color:black;
            text-decoration: none;
        }

/*ESTILOS TABLA */

        .tabla{
            border:solid 1px #023ef9;
            width:60%;   
            margin:auto;
        }

        thead tr{
            background-color:#023ef9; 
            color:white;
            text-align:center;
        }

        .icono{
            width:20px;
            height:20px;
        }


        #headerVer h2{
            padding: 30px;
            color:#023ef9;
        }
        
       
        .btn{
            background-color: #023ef9; 
            color:white;
        }
      

    </style>

</head>

<body>

        <div class="container">
            <div class="tabla">
                <table class="table table-hover">


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>Nº GRUPO</th>
                            <th>NOMBRE</th>
                            <th>FECHA INCIO</th>
                            <th>FECHA FIN</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <tbody class="table-light">
                        
                        <?php
                            foreach($datos['grupo'] as $grupo):
                            ?>

                            <tr>
                                <td><span class="d-flex justyfy-content-center"><?php echo $grupo->id_grupo?></span></td>
                                <td><span class="d-flex justyfy-content-center"><?php echo $grupo->nombre?></span></td>
                                <td><span class="d-flex justyfy-content-center"><?php echo $grupo->fecha_ini?></span></td>
                                <td><span class="d-flex justyfy-content-center"><?php echo $grupo->fecha_fin?></span></td>
                                
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <td><span class="d-flex justify-content-center">
                                   
                                
                            <!--MODAL VER (javascript)-->
                            <img class="icono mt-1" id="btnModal_<?php echo $grupo->id_grupo ?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir(<?php echo $grupo->id_grupo ?>);" ></img>

                            <!--Ventana-->
                            <div id="<?php echo $grupo->id_grupo ?>" class="modalVer">

                                <div class="modal-content">

                                    <!--Header-->
                                    <div id="headerVer" class="row">
                                        <h2 class="col-11">Datos del grupo</h2>
                                        <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $grupo->id_grupo ?>" onclick="cerrar(<?php echo $grupo->id_grupo ?>);">                                              
                                    </div>
                                    <hr>

                                    <!--Body-->
                                    <div id="bodyVer" class="row m-3">
                                            <div class="col-12">
                                                <label for="id_grupo">Identificador</label>
                                                <input type="text" name="id_grupo" id="id_grupo" class="form-control form-control-lg" value="<?php echo $grupo->id_grupo?>" readonly>
                                                <br>
                                            </div>

                                            <div class="col-12">
                                                <label for="nombreGrupo">Nombre</label>
                                                <input type="text" name="nombreGrupo" id="nombreGrupo" class="form-control form-control-lg" value="<?php echo $grupo->nombre?>" readonly>
                                                <br>
                                            </div>
                                        
                                            <div class="col-12">
                                                <label for="fecha_ini">Fecha inicio</label>
                                                <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg" value="<?php echo $grupo->fecha_ini?>" readonly>
                                                <br>
                                            </div>

                                            <div class="col-12">
                                                <label for="fecha_fin">Fecha fin</label>
                                                <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $grupo->fecha_fin?>" readonly>
                                                <br>
                                            </div>    
                                              
                                    </div>
                                    
                                    <!-- <div id="footerVer">
                                        <input type="button" style="background-color: #023ef9; color:white"id="cerrar_<?php echo $grupo->id_grupo ?>" class="close" onclick="cerrar(<?php echo $grupo->id_grupo ?>);" value="cerrar" >
                                    </div> -->
                                <br>
                                </div>  
                                
                            </div> 



                                  <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $grupo->id_grupo ?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $grupo->id_grupo ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edicion de grupo</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/grupo/editarGrupo/<?php echo $grupo->id_grupo?>" class="card-body">
                                                    <!-- id test -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="id_grupo">Identificador</label>
                                                        <input type="text" name="id_grupo" id="id_grupo" class="form-control form-control-lg" value="<?php echo $grupo->id_grupo?>" readonly>
                                                    </div>
                                                    <!-- nombre test -->
                                                    <div class="mt-3 mb-3">
                                                        <label for="nombre_grupo">Nombre</label>
                                                        <input type="text" name="nombre_grupo" id="nombre_grupo" class="form-control form-control-lg" value="<?php echo $grupo->nombre?>">     
                                                    </div>
                                                     <!-- fecha inicio -->
                                                     <div class="mt-3 mb-3">
                                                        <label for="fecha_ini">Fecha inicio</label>
                                                        <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg" value="<?php echo $grupo->fecha_ini?>">   
                                                    </div>
                                                     <!-- fecha fin -->
                                                     <div class="mt-3 mb-3">
                                                        <label for="fecha_fin">Fecha fin</label>
                                                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $grupo->fecha_fin?>">    
                                                    </div>
                            
                                                    <input type="submit" class="btn" value="Confirmar">
                                                </form>

                                            </div>
                                            <!-- Footer -->
                                            <!-- <div class="modal-footer">
                                                <button type="button" style="background-color: #023ef9; color:white" data-bs-dismiss="modal">Cerrar</button>
                                            </div> -->

                                        </div>
                                    </div>
                                    </div>  


                       
                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $grupo->id_grupo ?>" href="<?php echo RUTA_URL?>/adminGrupos/borrar/<?php echo $grupo->id_grupo?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
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
                                                <p>Seguro que quiere borrar el test con identificador <?php echo $grupo->id_grupo ?> ?</p>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminGrupos/borrar/<?php echo $grupo->id_grupo ?>" method="post">
                                                    <button type="submit" class="btn">Borrar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                <!-- PARTICIPANTES -->
                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo RUTA_URL?>/adminGrupos/participantes/">
                                  <img class="icono" src="<?php echo RUTA_Icon?>grupos.svg"></img>
                                </a>  

                                </span> 
                            </td>
                            <?php endif ?>
                        </tr>
                        <?php endforeach ?>       
                    </tbody>
                </table>


                    <!--CREAR NUEVO GRUPO Y AÑADIR PARTICIPANTES-->
                    <div class="col text-center">
                        <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/adminGrupos/nuevo_grupo/">Crear grupo</a>
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