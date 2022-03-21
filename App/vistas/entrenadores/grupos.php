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


<body>




        <div class="row d-flex justify-content-center" >
           <div class="col-3">
                <h4 id="titulo">Gestion de grupos y marcas</h4>
            </div>           
            <br><br>
        </div>


     <div class="container d-flex justify-content-center">

                <div class=" d-flex col-3 p-1">
                <form method="post" action="<?php echo RUTA_URL?>/entrenador/grupos"> 
                        <select class="form-select"  style="width:330px" name='filtro'>
                            <option  value="" >Selecciona un grupo</option>
                                <?php 
                                foreach($datos['todosEntrenadoresGrupos'] as $info){  
                                    $nombre=$info->nombre_grupo;
                                    $id_grupo=$info->id_grupo;
                                        ?>   
                                        <option name="filtro" value="<?php echo $id_grupo?>"><?php echo $nombre?></option>
                                <?php }
                                ?>
                        </select>
                        <br>
                        <input type="submit" class="btn" value="Cargar">
                </form>
                </div> 




        <div class="d-flex col-9 p-1">
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

                        <?php 
  
                        foreach($datos['alumnosGrupo'] as $todos): ?> 
                            <tr>
                                <td class="datos_tabla"><?php echo $todos->nombre?></td>
                                <td class="datos_tabla"><?php echo $todos->apellidos?></td>

                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[2])):?>   
                                <td class="d-flex justify-content-center">

                                    <!-- MODAL MARCAS -->
                                    &nbsp;&nbsp;&nbsp;
                                    <a data-bs-toggle="modal" data-bs-target="#ModalMarcas_<?php echo $todos->id_usuario?>" >
                                        <img class="icono" src="<?php echo RUTA_Icon?>test.svg"></img>
                                    </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalMarcas_<?php echo $todos->id_usuario ?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                            
                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Anotar marcas: <?php echo $todos->nombre." ".$todos->apellidos?></h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/entrenador/marca/<?php echo $todos->id_usuario?>" class="card-body">
                                                    <div class="row">   
                                                        <div class="col-3">
                                                            <label for="marca"><p>Marca</p></label>   
                                                        </div>
                                                        <div class="col-3">
                                                            <label for="fecha"><p>Fecha</p></label> 
                                                        </div>       
                                                    </div> 

                                                    <div class="row"> 
                                                        <div class="col-2">
                                                            <input type="text" name="marca" id="marca" class="form-control" style="width:100px;">  
                                                        </div>
                                                        <div class="col-1">
                                                            <label for="tiempo"><p>seg.</p></label>
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="date" name="fecha" id="fecha" class="form-control">    
                                                        </div>
                                                        <div class="col-3">
                                                            <select class="form-select" name="idPrueba" id="idPrueba" style="width:300px;">
                                                                <option value="idPrueba">Seleciona una opcion</option>
                                                                <?php foreach($datos['testPruebas'] as $infoP):?>    
                                                                <option name="idPrueba" class="form-control"  value="<?php echo $infoP->id_prueba?>"><?php echo $infoP->nombreTest.": ".$infoP->nombrePrueba." (".$infoP->tipo.")"?></option>
                                                                <?php endforeach ?> 
                                                            </select>
                                                        </div>
                                                    </div>

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



                                    <!-- MODAL RESULTADOS -->
                                    &nbsp;&nbsp;&nbsp;
                                    <a data-bs-toggle="modal" data-bs-target="#ModalVer_<?php echo $todos->id_usuario?>" >
                                        <img class="icono" src="<?php echo RUTA_Icon?>ojo.svg"></img>
                                    </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalVer_<?php echo $todos->id_usuario;?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                                    
                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Resultados: <?php echo $todos->nombre." ".$todos->apellidos?></h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <div class="row">   
                                                    <div class="col-5">
                                                        <label for="nomTest"><p>Test y prueba</p></label>   
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="marca"><p>Marca</p></label>   
                                                    </div>
                                                    <div class="col-5">
                                                        <label for="fecha"><p>Fecha</p></label> 
                                                    </div> 
                                                </div>               
                                                       
                                                
                                                <?php foreach ($datos['marcas'] as $marcas){
                                                if($todos->id_usuario == $marcas->id_usuario){?>
                                                <div class="row"> 

                                                        <div class="col-4">
                                                            <label for="nomTest"><?php echo $marcas->nombreTest.": ".$marcas->nombrePrueba." (".$marcas->tipo.")"?></label>   
                                                        </div>

                                                        <div class="col-2">
                                                            <input type="text" name="marca" id="marca" value="<?php echo $marcas->marca?>" class="form-control" style="width:100px;" readonly>        
                                                        </div>

                                                        <div class="col-3">
                                                            <input type="date" name="fecha" id="fecha" value="<?php echo $marcas->fecha?>" class="form-control" style="width:150px;" readonly>   
                                                        </div> 

                                                        <div class="col-1">
                                                        <!--MODAL BORRAR (javascript)-->
                                                            <img class="icono" id="btnModal_<?php echo $marcas->id_prueba;?>" src="<?php echo RUTA_Icon?>papelera.svg" onclick="abrir(<?php echo $marcas->id_prueba;?>);" ></img>                         
                                                            <!--Ventana-->
                                                            <div id="<?php echo $marcas->id_prueba;?>" class="modalVer">
                                                                <div class="modal-content">
                                                                    <!--Header-->
                                                                    <div id="headerVer" class="row">
                                                                        <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $marcas->id_prueba;?>" onclick="cerrar(<?php echo $marcas->id_prueba;?>);">  
                                                                    </div>
                                                                    <hr>
                                                                    <!--Body-->
                                                                    <div id="bodyVer" class="row m-3">
                                                                        <h6>Seguro que quiere borrar la marca de <?php echo $marcas->nombrePrueba?> ?</h6>
                                                                    </div>
                                                                    <!--Footer-->
                                                                    <div id="footerBorrar">
                                                                        <form action="<?php echo RUTA_URL?>/entrenador/borrarMarca/<?php echo $marcas->id_prueba?>" method="post">
                                                                            <input type="hidden" name="mBorrar" value="<?php echo $marcas->id_prueba?>">
                                                                            <input type="hidden" name="idUsu" value="<?php echo $todos->id_usuario?>">
                                                                            <button type="submit" class="btn m-3">Borrar</button>
                                                                        </form>
                                                                    </div>                           
                                                                </div>   
                                                                </div>    
                                                        </div> 
                                                </div>
                                                <?php
                                                }
                                                }?>              
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

                    <!--VER TODOS LOS RESULTADOS DEL GRUPO-->
                    <!-- <div class="col text-center">
                        <a class="btn" id="añadir" href="<?php echo RUTA_URL?>/entrenador/verTodos/">Ver todos</a>
                    </div>
                     -->
                    <br>

        </div>
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
