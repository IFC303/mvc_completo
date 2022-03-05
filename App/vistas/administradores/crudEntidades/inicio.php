
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
        
       
        .btn{
            background-color: #023ef9; 
            color:white;
        }


    </style>

</head>
<body>


        <div class="container">
           <div class="tabla">
            <table class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr>
                            <th>Nº ENTIDAD</th>
                            <th>NOMBRE</th>
                            <th>TIPO</th>
                   
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['entidad'] as $entidad): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $entidad->id_entidad?></td>
                            <td class="datos_tabla"><?php echo $entidad->nombre?></td>
                            <td class="datos_tabla"><?php echo $entidad->tipo?></td>
     
                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                
                            <td>

                                <!--MODAL VER (javascript)-->
                                    <img class="icono" id="btnModal_<?php echo $entidad->id_entidad ?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir(<?php echo $entidad->id_entidad  ?>);" ></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $entidad->id_entidad  ?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                    <h2 class="col-11">Visualizacion de entidad</h2>
                                                    <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $entidad->id_entidad ?>" onclick="cerrar(<?php echo $entidad->id_entidad ?>);">                                              
                                            </div>
                                            <hr>

                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">
                                                <div class="col-12">
                                                    <label for="id_evento">Identificador</label>
                                                    <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" value="<?php echo $entidad->id_entidad ?>" readonly>
                                                    <br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="nombre">Nombre</label>
                                                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $entidad->nombre?>" readonly> 
                                                    <br>
                                                </div>
                                                
                                                <div class="col-12">
                                                    <label for="tipo">Tipo</label>
                                                    <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $entidad->tipo?>" readonly>    
                                                    <br><br>
                                                </div>
                                            </div>
                                            
                                            <!-- Footer -->
                                            <!-- <div id="footerVer">
                                                <input type="button" class="btn" id="cerrar_<?php echo $entidad->id_entidad  ?>" onclick="cerrar(<?php echo $entidad->id_entidad  ?>);" value="cerrar" >
                                                <br>
                                                <br>
                                            </div> -->

                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $entidad->id_entidad  ?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $entidad->id_entidad  ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content" id="modalEditar">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de entidad</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminEntidades/editarEntidad/<?php echo $entidad->id_entidad?>" class="card-body">
                                                    
                                                    <div class="mt-3 mb-3">
                                                        <label for="id_evento">Identificador</label>
                                                        <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" value="<?php echo $entidad->id_entidad  ?>" readonly>
                                                    </div>
                                                   
                                                    <div class="mt-3 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $entidad->nombre ?>">
                                                    </div>
                                                  
                                                    <div class="mt-3 mb-3">
                                                        <label for="tipo">Tipo</label>
                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $entidad->tipo ?>">
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
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $entidad->id_entidad ?>" href="<?php echo RUTA_URL?>/adminEntidades/borrar/<?php echo $entidad->id_entidad  ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $entidad->id_entidad ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar la entidad con identificador <?php echo $entidad->id_entidad ?> ?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEntidades/borrar/<?php echo $entidad->id_entidad?>" method="post">
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
                        <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL?>/adminEntidades/nueva_entidad/">Añadir</a>
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

