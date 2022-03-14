<?php require_once RUTA_APP . '/vistas/inc/header_entrenador_miga.php' ?>


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
            width:50%;
            margin: auto;
        }

        #modalEditar{
            margin: auto;
        }

        .modal-title{
            color:#023ef9;
        }

        label{
           color:#023ef9;
        }

        a{
            text-decoration: none;
            color:black;
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

        .datos_tabla{
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
        
        #añadir{
            color:white;
        }

        .btn{
            background-color: #023ef9;  
            color:white;
        }

        #botonVolver{
            background-color:white; 
            color:#023ef9;
            border-color:#023ef9;
        }

        #titulo{
            font-family: 'Anton',sans-serif; 
            color: #023ef9; 
            letter-spacing: 5px;
        }

    </style>



</head>

    <form method="post" action="<?php echo RUTA_URL?>/entrenador/grupos">
        <select class="form-select" name='filtro'>
                <option value="">Selecciona un grupo</option>
                <?php 
                    foreach($datos['grupos'] as $info){
                        $id_grupo=$info->id_grupo;
                        $nombre=$info->nombre;?>
                        <option name="filtro" value="<?php echo $id_grupo?>"><?php echo $nombre?></option>
                <?php }
                ?>
        </select>
        <input type="submit">
    </form>


<div class="container">

        <div class="row" style="text-align:center">     
            <div class="col-12">
                <h4 id="titulo">Gestion de grupos y marcas/test</h4>
            </div>
        </div>


        <div class="tabla" style="border:solid 1px #023ef9">
            <table class="table table-hover">
                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>

                     <!--BODY TABLA-->
                    <tbody class="table-light">
                        <?php foreach($datos['alumnosGrupo'] as $info): ?> 
                            <tr>
                                <td class="datos_tabla"><?php echo $info->nombre?></td>
                                <td class="datos_tabla"><?php echo $info->apellidos?></td>

                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>
                                
                                    <td>
                                            <!-- MODAL EDITAR -->
                                            &nbsp;&nbsp;&nbsp;
                                            <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $info->id_usuario?>" >
                                                <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                            </a>

                                            <!-- Ventana -->
                                            <div class="modal" id="ModalEditar_<?php echo $info->id_usuario ?>">
                                                <div class="modal-dialog modal-lg modal-dialog-centered">
                                                    <div class="modal-content">
                                                    
                                                        <!-- Header -->
                                                        <div class="modal-header">
                                                            <h2 class="modal-title">Anotar marcas</h2>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                        </div>

                                                        <!-- Body -->
                                                        <div class="modal-body">
                                                            <form method="post" action="<?php echo RUTA_URL?>/entrenador/marca/<?php echo $info->id_usuario?>" class="card-body">
                                                                
                                                                    <div class="row">   
                                                                        <div class="col-3">
                                                                           <label for="marca"><p>Marca</p></label>   
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label for="fecha"><p>Fecha</p></label> 
                                                                        </div>       
                                                                    </div> 

                                                                    <?php foreach($datos['testPruebas'] as $info): ?>
                                                                    <div class="row"> 

                                                                            <input type="hidden" name="marca[]" value="<?php echo $info->id_prueba?>">

                                                                            <div class="col-2">
                                                                                <input type="text" name="marca[]" id="marca" class="form-control-xs" style="width:100px;">  
                                                                            </div>
                                                                            <div class="col-1">
                                                                                <label for="marca"><p>seg.</p></label>
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <input type="date" name="marca[]" id="fecha" class="form-control-xs">    
                                                                            </div>
                                                                            <div class="col-6 px-4">
                                                                                <label for="test"><?php echo $info->nombreTest.": ".$info->nombrePrueba." (".$info->tipo.")"?></label>
                                                                            </div>   
                                                                    </div>  
                                                                    <?php endforeach ?>

                                                               <br><br>
                                                                    <div class="row"> 
                                                                        <br>
                                                                        <div class="col-2">
                                                                            <input type="submit" class=" btn" value="Confirmar">
                                                                        </div>
                                                                    
                                                                        <div class="col-3">
                                                                            <a href="<?php echo RUTA_URL?>/entrenador/grupos">
                                                                                <input class="btn" type="button" id="botonVolver" value="Volver">  
                                                                            </a>
                                                                        </div>
                                                                        <br> 
                                                                    </div>
                                                                  
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
                        <a class="btn" id="añadir" href="<?php echo RUTA_URL?>/entrenador/resultados/">Ver resultados</a>
                    </div>
                    <br>

        </div>
</div>



       
   

