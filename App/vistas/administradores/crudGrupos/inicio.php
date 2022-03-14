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
            width:60%;
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

                                        <div class="col-md-5 px-4">
                                                <div class="row mt-3 mb-3">
                                                    <label for="nombreTest">Nombre<sup>*</sup></label>
                                                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $grupo->nombre?>" readonly>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <label for="nombreTest">Fecha inicio<sup>*</sup></label>
                                                    <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control form-control-lg" value="<?php echo $grupo->fecha_ini?>" readonly>
                                                </div>
                                                <div class="row mt-3 mb-3">
                                                    <label for="nombreTest">Fecha fin<sup>*</sup></label>
                                                    <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $grupo->fecha_fin?>" readonly>
                                                </div>
                                        </div>
  
                                        <div class="col-md-7 px-5"> 
                                        <br>  
                                            <p>Selecciona dia, hora de inicio y hora de fin</p>
                                            
                                            <?php 
                                                $lunesCK="";
                                                $martesCK="";
                                                $miercolesCK="";
                                                $juevesCK="";
                                                $viernesCK="";
                                                $lunesIni="";
                                                $lunesFin="";
                                                $martesIni="";
                                                $martesFin="";
                                                $miercolesIni="";
                                                $miercolesFin="";
                                                $juevesIni="";
                                                $juevesFin="";
                                                $viernesIni="";
                                                $viernesFin="";

                                                foreach($datos['grupos_y_horarios'] as $info){
                                                    
                                                    if($info->id_grupo==$grupo->id_grupo){
                                                        if ($info->dia_sem=="Lunes"){
                                                            $lunesCK="checked";
                                                            $lunesIni=$info->hora_ini;
                                                            $lunesFin=$info->hora_fin; 
                                                        }else if($info->dia_sem=="Martes"){
                                                            $martesCK="checked";
                                                            $martesIni=$info->hora_ini;
                                                            $martesFin=$info->hora_fin; 
                                                        }else if($info->dia_sem=="Miercoles"){
                                                            $miercolesCK="checked";
                                                            $miercolesIni=$info->hora_ini;
                                                            $miercolesFin=$info->hora_fin; 
                                                        }else if($info->dia_sem=="Jueves"){
                                                            $juevesCK="checked";   
                                                            $juevesIni=$info->hora_ini;
                                                            $juevesFin=$info->hora_fin; 
                                                        }else if($info->dia_sem=="Viernes"){
                                                            $viernesCK="checked";
                                                            $viernesIni=$info->hora_ini;
                                                            $viernesFin=$info->hora_fin; 
                                                        }  

                                                    }
                                                }  
                                            ?>

                                            <div class="row">
                                                <div class="col-3 mb-3">
                                                    <input type="checkbox" id="lunes" name="lunesDia" value="Lunes" <?php echo $lunesCK ?> disabled> 
                                                    <label for="Lunes">Lunes</label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="time" id="lunesIni" name="lunesIni" value="<?php echo $lunesIni?>" class="form-control form-control-sm" disabled>  
                                                </div>   
                                                <div class="col-3">   
                                                    <input type="time" name="lunesFin" id="hora_fin" value="<?php echo $lunesFin?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 mb-3">
                                                    <input type="checkbox" name="martesDia" value="Martes" <?php echo $martesCK?> disabled> 
                                                    <label for="Martes">Martes</label>
                                                </div>  
                                                <div class="col-3">
                                                    <input type="time" name="martesIni" id="hora_ini" value="<?php echo $martesIni?>" class="form-control form-control-sm" disabled>  
                                                </div>   
                                                <div class="col-3">   
                                                    <input type="time" name="martesFin" id="hora_fin" value="<?php echo $martesFin?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 mb-3">
                                                    <input type="checkbox" name="miercolesDia" value="Miercoles" <?php echo $miercolesCK?> disabled> 
                                                    <label for="Miercoles">Miercoles</label>
                                                </div>  
                                                <div class="col-3">
                                                    <input type="time" name="miercolesIni" id="hora_ini" value="<?php echo $miercolesIni?>" class="form-control form-control-sm" disabled>  
                                                </div>   
                                                <div class="col-3">   
                                                    <input type="time" name="miercolesFin" id="hora_fin" value="<?php echo $miercolesFin?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3 mb-3">
                                                    <input type="checkbox" name="juevesDia" value="Jueves" <?php echo $juevesCK?> disabled> 
                                                    <label for="Jueves">Jueves</label>
                                                </div>
                                                <div class="col-3">
                                                    <input type="time" name="juevesIni" id="hora_ini" value="<?php echo $juevesIni?>" class="form-control form-control-sm" disabled>  
                                                </div>   
                                                <div class="col-3">   
                                                    <input type="time" name="juevesFin" id="hora_fin" value="<?php echo $juevesFin?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-3">
                                                    <input type="checkbox" name="viernesDia" value="Viernes" <?php echo $viernesCK?> disabled> 
                                                    <label for="Viernes">Viernes</label>
                                                </div>  
                                                <div class="col-3">
                                                    <input type="time" name="viernesIni" id="hora_ini" value="<?php echo $viernesIni?>" class="form-control form-control-sm" disabled>  
                                                </div>   
                                                <div class="col-3">   
                                                    <input type="time" name="viernesFin" id="hora_fin" value="<?php echo $viernesFin?>" class="form-control form-control-sm" disabled>
                                                </div>
                                            </div> 
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
                                                <form method="post" action="<?php echo RUTA_URL?>/adminGrupos/editarGrupo/<?php echo $grupo->id_grupo?>" class="card-body">
                                                 <div class="row">
                                                    <div class="col-md-5 px-4">
                                                        <div class="row mt-3 mb-3">
                                                            <label for="nombreTest">Nombre<sup>*</sup></label>
                                                            <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $grupo->nombre?>">
                                                        </div>
                                                        <div class="row mt-3 mb-3">
                                                            <label for="nombreTest">Fecha inicio<sup>*</sup></label>
                                                            <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control form-control-lg" value="<?php echo $grupo->fecha_ini?>">
                                                        </div>
                                                        <div class="row mt-3 mb-3">
                                                            <label for="nombreTest">Fecha fin<sup>*</sup></label>
                                                            <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $grupo->fecha_fin?>">
                                                        </div>
                                                    </div>


                                                    <div class="col-md-7 px-5"> 
                                                    <br>  
                                                    <p>Selecciona dia, hora de inicio y hora de fin</p>
                                            
                                                    <?php 
                                                        $lunesCK="";
                                                        $martesCK="";
                                                        $miercolesCK="";
                                                        $juevesCK="";
                                                        $viernesCK="";

                                                        $lunesIni="";
                                                        $lunesFin="";
                                                        $lunesId="";

                                                        $martesIni="";
                                                        $martesFin="";
                                                        $martesId="";

                                                        $miercolesIni="";
                                                        $miercolesFin="";
                                                        $miercolesId="";

                                                        $juevesIni="";
                                                        $juevesFin="";
                                                        $juevesId="";

                                                        $viernesIni="";
                                                        $viernesFin="";
                                                        $viernesId="";

                                                        foreach($datos['grupos_y_horarios'] as $info){
                                                            
                                                            if($info->id_grupo==$grupo->id_grupo){
                                                                if ($info->dia_sem=="Lunes"){
                                                                    $lunesCK="checked";
                                                                    $lunesIni=$info->hora_ini;
                                                                    $lunesFin=$info->hora_fin; 
                                                                    $lunesId="$info->id_horario";
                                                                }else if($info->dia_sem=="Martes"){
                                                                    $martesCK="checked";
                                                                    $martesIni=$info->hora_ini;
                                                                    $martesFin=$info->hora_fin; 
                                                                    $martesId="$info->id_horario";
                                                                }else if($info->dia_sem=="Miercoles"){
                                                                    $miercolesCK="checked";
                                                                    $miercolesIni=$info->hora_ini;
                                                                    $miercolesFin=$info->hora_fin; 
                                                                    $miercolesId="$info->id_horario";
                                                                }else if($info->dia_sem=="Jueves"){
                                                                    $juevesCK="checked";   
                                                                    $juevesIni=$info->hora_ini;
                                                                    $juevesFin=$info->hora_fin; 
                                                                    $juevesId="$info->id_horario";
                                                                }else if($info->dia_sem=="Viernes"){
                                                                    $viernesCK="checked";
                                                                    $viernesIni=$info->hora_ini;
                                                                    $viernesFin=$info->hora_fin; 
                                                                    $viernesId="$info->id_horario";
                                                                }  

                                                            }
                                                        }  
                                                    ?>

                                                        <div class="row">
                                                            <div class="col-3 mb-3">
                                                                <input type="checkbox" id="lunes" name="lunesDia" value="Lunes" <?php echo $lunesCK ?>> 
                                                                <label for="Lunes">Lunes</label>
                                                            </div>
                                                            <div class="col-3">
                                                                <input type="time" id="lunesIni" name="lunesIni" value="<?php echo $lunesIni?>" class="form-control form-control-sm">  
                                                            </div>   
                                                            <div class="col-3">   
                                                                <input type="time" name="lunesFin" id="lunesFin" value="<?php echo $lunesFin?>" class="form-control form-control-sm">
                                                            </div>
                                                            <input type="hidden" name="horario[]" value="<?php echo $lunesId?>">
                                                        </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3">
                                                            <input type="checkbox" name="martesDia" value="Martes" <?php echo $martesCK?>> 
                                                            <label for="Martes">Martes</label>
                                                        </div>  
                                                        <div class="col-3">
                                                            <input type="time" name="martesIni" id="martesIni" value="<?php echo $martesIni?>" class="form-control form-control-sm">  
                                                        </div>   
                                                        <div class="col-3">   
                                                            <input type="time" name="martesFin" id="martesFin" value="<?php echo $martesFin?>" class="form-control form-control-sm">
                                                        </div>
                                                        <input type="hidden" name="horario[]" value="<?php echo $martesId?>">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3">
                                                            <input type="checkbox" name="miercolesDia" value="Miercoles" <?php echo $miercolesCK?>> 
                                                            <label for="Miercoles">Miercoles</label>
                                                        </div>  
                                                        <div class="col-3">
                                                            <input type="time" name="miercolesIni" id="hora_ini" value="<?php echo $miercolesIni?>" class="form-control form-control-sm">  
                                                        </div>   
                                                        <div class="col-3">   
                                                            <input type="time" name="miercolesFin" id="hora_fin" value="<?php echo $miercolesFin?>" class="form-control form-control-sm">
                                                        </div>
                                                        <input type="hidden" name="horario[]" value="<?php echo $miercolesId?>">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3 mb-3">
                                                            <input type="checkbox" name="juevesDia" value="Jueves" <?php echo $juevesCK?>> 
                                                            <label for="Jueves">Jueves</label>
                                                        </div>
                                                        <div class="col-3">
                                                            <input type="time" name="juevesIni" id="hora_ini" value="<?php echo $juevesIni?>" class="form-control form-control-sm">  
                                                        </div>   
                                                        <div class="col-3">   
                                                            <input type="time" name="juevesFin" id="hora_fin" value="<?php echo $juevesFin?>" class="form-control form-control-sm">
                                                        </div>
                                                        <input type="hidden" name="horario[]" value="<?php echo $juevesId?>">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-3">
                                                            <input type="checkbox" name="viernesDia" value="Viernes" <?php echo $viernesCK?>> 
                                                            <label for="Viernes">Viernes</label>
                                                        </div>  
                                                        <div class="col-3">
                                                            <input type="time" name="viernesIni" id="hora_ini" value="<?php echo $viernesIni?>" class="form-control form-control-sm">  
                                                        </div>   
                                                        <div class="col-3">   
                                                            <input type="time" name="viernesFin" id="hora_fin" value="<?php echo $viernesFin?>" class="form-control form-control-sm">
                                                        </div>
                                                        <input type="hidden" name="horario[]" value="<?php echo $viernesId?>">
                                                    </div> 
                                                </div>
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
                                <a href="<?php echo RUTA_URL?>/adminGrupos/participantes/<?php echo $grupo->id_grupo?>">
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