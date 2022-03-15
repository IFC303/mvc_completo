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
            width:50%;
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

            <div class="col-12">
                <h4 id="titulo">Gestion de ingresos</h4>
            </div>

            <!-- <div>
                <form method="post"action="">
                    <input type="radio" value="todos" name="tipo">Todos
                    <input type="radio" value="cuotas" name="tipo">Cuotas
                    <input type="radio" value="actividades" name="tipo">Actividades
                    <input type="radio" value="otros" name="tipo">Otros   
                    <input type="submit">
                </form>
            </div> -->
        </div>

           <div class="tabla" style="border:solid 1px #023ef9">
            <table class="table table-hover" >

                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                            <th>Nº INGRESO</th>
                            <th>FECHA</th>
                            <th>CONCEPTO</th>
                            <th>IMPORTE</th>
                            <th>TIPO</th>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                     <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php

                        foreach($datos['ingresos'] as $info):   
                            if($datos['tipoIngreso']==$info->tipo):
                           ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $info->id_ingreso?></td>
                            <td class="datos_tabla"><?php echo $info->fecha?></td>
                            <td class="datos_tabla"><?php echo $info->concepto?></td>
                            <td class="datos_tabla"><?php echo $info->importe?></td>
                            <td class="datos_tabla"><?php echo $info->tipo?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>

                                <!--MODAL VER (javascript)-->
                                    <img id="btnModal_<?php echo $info->id_ingreso ?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir(<?php echo $info->id_ingreso?>);" ></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $info->id_ingreso?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                <h2 class="col-11">Datos del ingreso</h2>
                                                <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $info->id_ingreso ?>" onclick="cerrar(<?php echo $info->id_ingreso ?>);">  
                                            </div>
                                            <hr>

                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="id_ingreso">Numero de ingreso</label>
                                                        <input type="text" name="id_ingreso" id="id_ingreso" class="form-control form-control-lg" value="<?php echo $info->id_ingreso ?>" readonly>
                                                    </div>

                                                    <div class="col-6">
                                                        <label for="fecha">fecha</label>
                                                        <input type="text" name="fecha" id="fecha" class="form-control form-control-lg" value="<?php echo $info->fecha?>" readonly>
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="concepto">Concepto</label>
                                                        <input type="text" name="concepto" id="concepto" class="form-control form-control-lg" value="<?php echo $info->concepto?>" readonly> 
                                                        <br>
                                                    </div>

                                                    <div class="col-6">
                                                        <label for="importe">Importe</label>
                                                        <input type="text" name="importe" id="importe" class="form-control form-control-lg" value="<?php echo $info->importe?>" readonly>
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    
                                                            <!--CAMPOS DE OTROS-->
                                                    <?php 
                                                        if($datos['tipoIngreso']=="otros"){
                                                            foreach($datos['ingresosOtros'] as $otros){
                                                                if($otros->id_ingreso_otros==$info->id_ingreso){
                                                                    $entidad=$otros->nombre;
                                                                }
                                                            }
                                                            ?>
                                                            <div class="col-6">
                                                                <label for="id_entidad">Entidad</label>
                                                                <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" value="<?php echo $entidad?>" readonly>
                                                                <br>
                                                            </div>

                                                            <!--CAMPOS DE CUOTAS-->
                                                        <?php }else if($datos['tipoIngreso']=="cuotas"){
                                                            foreach($datos['ingresosCuotas'] as $cuotas){
                                                                if($cuotas->id_ingreso_cuota==$info->id_ingreso){
                                                                    $usuario=$cuotas->nombre." ".$cuotas->apellidos;
                                                                }
                                                            }
                                                            ?>
                                                            <div class="col-6">
                                                                <label for="id_usuario">Usuario</label>
                                                                <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $usuario?>" readonly>
                                                                <br>
                                                            </div>

                                                            <!--CAMPOS DE ACTIVIDADES-->
                                                        <?php }else if($datos['tipoIngreso']=="actividades"){
                                                            foreach($datos['ingresosActividadesSocios'] as $socios){
                                                                if($socios->id_ingreso_actividades==$info->id_ingreso){
                                                                    $evento=$socios->nom_evento;
                                                                    $participante=$socios->nombre." ".$socios->apellidos;
                                                                }
                                                            }
                                                            foreach($datos['ingresosActividadesExternos'] as $externos){
                                                                if($externos->id_ingreso_actividades==$info->id_ingreso){
                                                                    $evento=$externos->nom_evento;
                                                                    $participante=$externos->nombre." ".$externos->apellidos;
                                                                }
                                                            }

                                                            ?>
                                                            <div class="col-6">
                                                                <label for="tipo">Participante</label>
                                                                <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $participante?>" readonly>
                                                                <br>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="id_evento">Evento</label>
                                                                <input type="text" name="id_evento" id="id_evento" class="form-control form-control-lg" value="<?php echo $evento?>" readonly>
                                                                <br>
                                                            </div>
                                                       <?php };
                                                    ?>
                                                    
                                                </div>

                                                 </div>
                                            
                                            <!-- <div id="footerVer">
                                                <input type="button" style="background-color: #023ef9; color:white"id="cerrar_<?php echo $evento->id_evento ?>" class="close" onclick="cerrar(<?php echo $evento->id_evento ?>);" value="cerrar" >
                                            </div> -->
                                        
                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $info->id_ingreso?>" >
                                  <img src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $info->id_ingreso ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">


                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion del ingreso</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminFacturacion/editarIngreso/<?php echo $iCuotas->id_ingreso_cuota ?>" class="card-body">
                                                        
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="id_ingreso">Numero de ingreso</label>
                                                        <input type="text" name="id_ingreso" id="id_ingreso" class="form-control form-control-lg" value="<?php echo $info->id_ingreso ?>">
                                                    </div>

                                                    <div class="col-6">
                                                        <label for="fecha">fecha</label>
                                                        <input type="text" name="fecha" id="fecha" class="form-control form-control-lg" value="<?php echo $info->fecha?>">
                                                        <br>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="concepto">Concepto</label>
                                                        <input type="text" name="concepto" id="concepto" class="form-control form-control-lg" value="<?php echo $info->concepto?>"> 
                                                        <br>
                                                    </div>

                                                    <div class="col-6">
                                                        <label for="importe">Importe</label>
                                                        <input type="text" name="importe" id="importe" class="form-control form-control-lg" value="<?php echo $info->importe?>">
                                                        <br>
                                                    </div>
                                                </div>
                                                
          

                                                <div class="row">
                                                    
                                                            <!--CAMPOS DE OTROS-->
                                                    <?php 
                                                        if($datos['tipoIngreso']=="otros"){
                                                            foreach($datos['ingresosOtros'] as $otros){
                                                                if($otros->id_ingreso_otros==$info->id_ingreso){
                                                                    $entidad=$otros->nombre;
                                                                }
                                                            }
                                                            ?>
                                                            <div class="col-6">
                                                                <label for="id_entidad">Entidad</label>
                                                                <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" value="<?php echo $entidad?>">
                                                                <br>
                                                            </div>

                                                            <!--CAMPOS DE CUOTAS-->
                                                        <?php }else if($datos['tipoIngreso']=="cuotas"){
                                                            foreach($datos['ingresosCuotas'] as $cuotas){
                                                                if($cuotas->id_ingreso_cuota==$info->id_ingreso){
                                                                    $usuario=$cuotas->nombre." ".$cuotas->apellidos;
                                                                }
                                                            }
                                                            ?>
                                                            <div class="col-6">
                                                                <label for="id_usuario">Usuario</label>
                                                                <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $usuario?>">
                                                                <br>
                                                            </div>

                                                            <!--CAMPOS DE ACTIVIDADES-->
                                                        <?php }else if($datos['tipoIngreso']=="actividades"){
                                                            foreach($datos['ingresosActividadesSocios'] as $socios){
                                                                if($socios->id_ingreso_actividades==$info->id_ingreso){
                                                                    $evento=$socios->nom_evento;
                                                                    $participante=$socios->nombre." ".$socios->apellidos;
                                                                }
                                                            }
                                                            foreach($datos['ingresosActividadesExternos'] as $externos){
                                                                if($externos->id_ingreso_actividades==$info->id_ingreso){
                                                                    $evento=$externos->nom_evento;
                                                                    $participante=$externos->nombre." ".$externos->apellidos;
                                                                }
                                                            }

                                                            ?>
                                                            <div class="col-6">
                                                                <label for="tipo">Participante</label>
                                                                <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $participante?>">
                                                                <br>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="id_evento">Evento</label>
                                                                <input type="text" name="id_evento" id="id_evento" class="form-control form-control-lg" value="<?php echo $evento?>">
                                                                <br>
                                                            </div>
                                                       <?php };
                                                    ?>
                                                    
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
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $info->id_ingreso?>" href="<?php echo RUTA_URL?>/adminFacturacion/borrar/<?php echo $info->id_ingreso?>">
                                  <img src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $info->id_ingreso?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar el ingreso <?php echo $info->id_ingreso?> ?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminFacturacion/borrar/<?php echo $info->id_ingreso?>" method="post">
                                                    <input type="hidden" name="tipo" value="<?php echo $info->tipo?>">
                                                    <button type="submit" class="btn">Borrar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                            </td>
                            <?php endif ?>
                        </tr>
                    
                        <?php
                        endif;
                        endforeach ?>
                    </tbody>

            </table>

                    <!--AÑADIR-->
                    <div class="col text-center">
                        <a class="btn" id="añadir" href="<?php echo RUTA_URL?>/adminFacturacion/nuevoIngreso/">Nuevo ingreso</a>
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
