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

</head>

<style>
 
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



 
 #ventana{
    margin: auto;
    width:60%;
    background-color:#EBECEC;
} 

label, h2,p,h4{
   color:#023ef9;
}

p{
    margin-left:35px;
}

.btn{
    background-color: #023ef9; 
    color:white;
    margin-left:35px;
}

#botonVolver{
    background-color:#023ef9; 
    color:white;
    border-color:#023ef9;
}

#entrenadores, #alumnos,#cajaEntrenador,#cajaAlumnos{
    background-color:white;
}

#titulo{
            font-family: 'Anton',sans-serif; 
            color: #023ef9; 
            letter-spacing: 5px;
        }
</style>



<body>
<div class="container">
        <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Participantes del evento</h4></div>
            </div>
           <div class="tabla" style="border:solid 1px #023ef9">
            <table class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">

                            <th>TIPO PARTICIPANTE</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>DNI</th>
                            <th>EMAIL</th>
                            <th>DORSAL</th>
                            <th>MARCA</th>
                            

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th></th>
                            <?php endif ?>
                        </tr>
                    </thead>


                    <?php 
                        $id_evento=$datos['id_evento'][0];
                        //echo $id_evento;  
                        //var_dump($datos['participantesEventos']);
                        
                    ?>

                     <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['participantesEventos'] as $pEventos): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $pEventos->tipo?></td>
                            <td class="datos_tabla"><?php echo $pEventos->nombre?></td>
                            <td class="datos_tabla"><?php echo $pEventos->apellidos?></td>
                            <td class="datos_tabla"><?php echo $pEventos->dni?></td>
                            <td class="datos_tabla"><?php echo $pEventos->email?></td>
                            <td class="datos_tabla"><input type="text" id="<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" style="width:100px" oninput="cambiarDorsal(this,this.id);" value="<?php echo $pEventos->dorsal?>"></td>
                            <td class="datos_tabla"><input type="text" id="<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" style="width:100px" oninput="cambiarMarca(this,this.id)" value="<?php echo $pEventos->marca?>"></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>

    
                                 <!-- BOTON ACEPTAR-->
                                 &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" id="<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" data-bs-target="#ModalAceptar_<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" >
                                  <img class="icono" width="30" height="30" src="<?php echo RUTA_Icon?>tick.png"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalAceptar_<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header"> 
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Marca y dorsal registrados correctamente</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEventos/guardarMarcas/<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" method="post">
                                                        <input type="hidden" name="marca" id="marca<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" value="">
                                                        <input type="hidden" name="dorsal" id="dorsal<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" value="">
                                                        <input type="hidden" name="id_evento" id="id_evento" value="<?php echo $datos['id_evento'][0]?>">
                                                    <button type="submit" class="btn" >Volver</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>



                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>">
                                  <img class="icono" width="30" height="30" src="<?php echo RUTA_Icon?>x1.png"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar al participante <?php echo $pEventos->nombre." ".$pEventos->apellidos ?></h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEventos/borrarMarcas/<?php echo $pEventos->id_usuario."_".$pEventos->tipo?>" method="post">
                                                    <input type="hidden" name="id_evento" id="id_evento" value="<?php echo $datos['id_evento'][0]?>">
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
                        <a class="btn" id="botonVolver" href="<?php echo RUTA_URL?>/adminEventos">Volver</a>
                    </div>
                    <br>

            </div>
        </div>

     
<script>
 
function cambiarMarca(id,nombre) {
    console.log(id)
    console.log(nombre)
    var x = id.value;
    console.log(x);
    var texto="marca"+nombre;
    console.log(texto)
    var d=document.getElementById(texto)
    console.log(d)
    d.setAttribute("value",x);
}

function cambiarDorsal(id,nombre) {
    console.log(id)
    console.log(nombre)
    var x = id.value;
    console.log(x);
    var texto="dorsal"+nombre;
    console.log(texto)
    var d=document.getElementById(texto)
    console.log(d)
    d.setAttribute("value",x);
}

</script>
