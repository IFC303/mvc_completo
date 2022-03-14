
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
            width:50%;
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
        
       
        .btn{
            background-color: #023ef9; 
            color:white;
        }

        #añadir{
            color:white;
        }

        #titulo{
            font-family: 'Anton',sans-serif; 
            color: #023ef9; 
            letter-spacing: 5px;
        }

    </style>

</head>
<body>



        <div class="container">
            <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Gestion de licencias</h4></div>
            </div>
            
           <div class="tabla">
            <table class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>USUARIO</th>
                            <th>NUM_LICENCIA</th>
                            <th>TIPO_LICENCIA</th>
                            <th>AUTONÓMICA/NACIONAL</th>
                            <th>DORSAL</th>
                            <th>FECHA_CADUCIDAD</th>
                            <th>IMÁGEN</th>
                   
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['licencia'] as $licencia): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $licencia->nombre?></td>
                            <td class="datos_tabla"><?php echo $licencia->num_licencia?></td>
                            <td class="datos_tabla"><?php echo $licencia->tipo?></td>
                            <td class="datos_tabla"><?php if ($licencia->regional_nacional==''){echo '-';}else {echo $licencia->regional_nacional;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->dorsal==''){echo '-';}else {echo $licencia->dorsal;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->fecha_cad==''){echo '-';}else {echo $licencia->fecha_cad;}?></td>
                            <td class="datos_tabla"><?php if ($licencia->imagen==''){echo '-';}else {?> <img width="30" height="30" src="<?php echo RUTA_ImgDatos. $licencia->imagen?>"><?php ;}?></td>
                                                    
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            
                            <td>

                                <!--MODAL VER (javascript)-->
                                    
                                    <a data-bs-toggle="modal" data-bs-target="#ModalVer_<?php echo $licencia->num_licencia ?>">
                                    <img class="icono" src="<?php echo RUTA_Icon?>ojo.svg"></img>
                                    </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalVer_<?php echo $licencia->num_licencia ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div class="modal-header">
                                                    <h2 class="modal-title">Datos de la liciencia</h2>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>                             
                                            </div>
                                            
                                            <!-- <div class="modal-header">
                                                <h2 class="modal-title">Edicion de la licencia</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div> -->


                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">
                                                <div class="col-12">
                                                    <label for="id_usuario">USUARIO</label>
                                                    <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $licencia->nombre ?>" readonly>
                                                    <br><br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="num_licencia">NUM_LICENCIA</label>
                                                    <input type="text" name="num_licencia" id="num_licencia" class="form-control form-control-lg" value="<?php echo $licencia->num_licencia?>" readonly> 
                                                    <br><br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="tipo">TIPO_LICENCIA</label>
                                                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $licencia->tipo?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="regional_nacional">AUTONÓMICA/NACIONAL</label>
                                                    <input type="text" name="regional_nacional" id="regional_nacional" class="form-control form-control-lg" value="<?php echo $licencia->regional_nacional?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="dorsal">DORSAL</label>
                                                    <input type="text" name="dorsal" id="dorsal" class="form-control form-control-lg" value="<?php echo $licencia->dorsal?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="fecha_cad">FECHA_CADUCIDAD</label>
                                                    <input type="text" name="fecha_cad" id="fecha_cad" class="form-control form-control-lg" value="<?php echo $licencia->fecha_cad?>" readonly>    
                                                    <br><br>
                                                </div>

                                                <div class="col-12">
                                                    <label for="imagen">IMÁGEN</label><br>
                                                    <img id="imagen" name="imagen" <?php if ($licencia->imagen=='') {?> width="100" height="100" src='<?php echo RUTA_Icon?>licencias.svg'<?php ;}else {?> width="150" height="150" src='<?php echo RUTA_ImgDatos.$licencia->imagen;} ?>' >   
                                                    <br><br>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    </div>

                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $licencia->num_licencia  ?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $licencia->num_licencia  ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de la licencia</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" ENCTYPE="multipart/form-data" action="<?php echo RUTA_URL?>/adminLicencias/editarLicencia/<?php echo $licencia->num_licencia?>" class="card-body">
                                                    
                                                    <div class="col-12">
                                                        <label for="id_usuario">USUARIO</label>
                                                        <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $licencia->nombre ?>" readonly>
                                                        <br><br>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <label for="num_licencia">NUM_LICENCIA</label>
                                                        <input type="text" name="num_licencia" id="num_licencia" class="form-control form-control-lg" value="<?php echo $licencia->num_licencia?>" required> 
                                                        <br><br>
                                                    </div>
                                                    
                                                    <div class="col-12">
                                                        <label for="tipo">TIPO_LICENCIA</label>
                                                        <select name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $licencia->tipo?>" required>
                                                            <?php if ($licencia->tipo == Federativa) { ?>
                                                    
                                                                <option value="1" selected>Federativa</option>
                                                                <option value="2">Escolar</option> <?php
                                                            }elseif ($licencia->tipo == Escolar) { ?>
                                                          
                                                                <option value="1">Federativa</option>
                                                                <option value="2" selected>Escolar</option><?php
                                                            }
                                                            ?>    
                                                        </select>   
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="regional_nacional">AUTONÓMICA/NACIONAL</label>
                                                        <select name="regional_nacional" id="regional_nacional" class="form-control form-control-lg">
                                                            <?php if ($licencia->regional_nacional == Autonómica) { ?>
                                                                <option value="0">Puedes elegir...</option>
                                                                <option value="1" selected>Autonómica</option>
                                                                <option value="2">Nacional</option> <?php
                                                            }elseif ($licencia->regional_nacional == Nacional) { ?>
                                                                <option value="0">Puedes elegir...</option>
                                                                <option value="1">Autonómica</option>
                                                                <option value="2" selected>Nacional</option><?php
                                                            }elseif ($licencia->regional_nacional == "") {?>
                                                                <option value="0" selected>Puedes elegir...</option>
                                                                <option value="1">Autonómica</option>
                                                                <option value="2">Nacional</option><?php
                                                            }
                                                            ?>
                                                            
                                                        </select>
                                                        
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="dorsal">DORSAL</label>
                                                        <input type="number" min="0" name="dorsal" id="dorsal" class="form-control form-control-lg" value="<?php echo $licencia->dorsal?>" >    
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="fecha_cad">FECHA_CADUCIDAD</label>
                                                        <input type="date" name="fecha_cad" id="fecha_cad" class="form-control form-control-lg" value="<?php echo $licencia->fecha_cad?>" >    
                                                        <br><br>
                                                    </div>

                                                    <div class="col-12">
                                                        <label for="imagen">IMÁGEN</label>
                                                        <input type="file" accept="image/*" name="imagen" id="imagen" class="form-control form-control-lg">
                                                        <br><br>
                                                    </div>
                                                    <br>
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
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $licencia->num_licencia ?>" href="<?php echo RUTA_URL?>/adminLicencias/borrar/<?php echo $licencia->num_licencia  ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $licencia->num_licencia ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar la licencia <?php echo $licencia->num_licencia?> ?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminLicencias/borrar/<?php echo $licencia->num_licencia?>" method="post">
                                                    <button type="submit" class="btn">Borrar</button>
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
                        <a class="btn" id="añadir" href="<?php echo RUTA_URL?>/adminLicencias/nueva_licencia/">Nueva licencia</a>
                    </div>
                    <br>

            </div>
        </div>

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>

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
