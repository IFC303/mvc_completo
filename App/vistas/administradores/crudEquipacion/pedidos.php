<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>


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






    <div class="container">

            <div class="row pb-3">
                <div class="col-4">
                    <label for="filtro">Filtro por nombre: </label>
                    <input type="text" name="filtro" id="filtro" class="filtro">
                </div>   
                <div class="col-8" style="text-align:center">
                    <div class="col-12"><h4 id="titulo">Pedidos de equipaciones</h4></div>
                </div>
            </div>

            


            


           <div class="tabla" style="border:solid 1px #023ef9">
            
           <table id="tabla" class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                        
                            <th>N SOCIO</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>FECHA PEDIDO</th> 
                            <th>TALLA</th>  
                            <th>TIPO</th>  
                            <th>DESCRIPCION</th>                         
                        
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                                <th>ENTREGADO</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                     <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        $id="";
                        foreach($datos['pedidos'] as $pedido): ?>
                        
                        <tr>    
                            <?php
                                if($id!=$pedido->id_usuario){
                                     ?>
                                
                                <td class="datos_tabla" id="idUsu" ><?php echo $pedido->id_usuario?></td>
                                <td class="datos_tabla" id="nombreUsu"><?php echo $pedido->nombre?></td>
                                <td class="datos_tabla" id="apellidosUsu"><?php echo $pedido->apellidos?></td>
                                <td class="datos_tabla" id="emailusu"><?php echo $pedido->fecha_peticion?></td>
                                <td class="datos_tabla" id="talla"><?php echo $pedido->talla?></td>
                            <?php
                                }else{?>
                                    <td style="visibility:hidden"><?php echo $pedido->id_usuario?></td>
                                    <td style="visibility:hidden"><?php echo $pedido->nombre?></td>
                                    <td style="visibility:hidden"><?php echo $pedido->apellidos?></td>
                                    <td style="visibility:hidden"><?php echo $pedido->email?></td>
                                    <td style="visibility:hidden"><?php echo $pedido->telefono?></td>
                                    <?php
                                }

                            ?>

                            <td class="datos_tabla" id="tipoUsu"><?php echo $pedido->tipo?></td>
                            <td class="datos_tabla" id="telefonoUsu"><?php echo $pedido->descripcion?></td>
                                                     

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td class="d-flex flex-row-reverse">


                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $pedido->id_soli_equi?>" href="<?php echo RUTA_URL?>/adminEquipaciones/borrarPedido/<?php echo $pedido->id_soli_equi?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $pedido->id_soli_equi?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar el pedido <?php echo $pedido->id_soli_equi?>?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEquipaciones/borrarPedido/<?php echo $pedido->id_soli_equi?>" method="post">
                                                    <button type="submit" class="btn">Borrar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                               
                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $tienda->id_equipacion?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $tienda->id_equipacion ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion del pedido</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">

                                                <form method="post" action="<?php echo RUTA_URL?>/adminEquipaciones/editar_equipacion/<?php echo $tienda->id_equipacion?>" class="card-body">
                                                    <div class="row">
                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="tipo">Concepto</label>
                                                            <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $tienda->tipo?>" required>
                                                        </div>
                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="talla">Talla</label>
                                                            <input type="text" name="talla" id="talla" class="form-control form-control-lg" value="<?php echo $tienda->talla?>" required>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="id_evento" value="<?php echo $evento->id_evento?>">
                                                    <br>
                                                    <input type="submit" class="btn" value="Confirmar">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>                        


                                    <?php
                                if($id!=$pedido->id_usuario){
                                    $id=$pedido->id_usuario; ?>
                                    
                                <!-- MODAL NUEVO PEDIDO -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalPedido_<?php echo $tienda->id_usuario?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>carrito.svg"></img>
                                </a>
                                <?php } ?>
                                    <!-- Ventana -->
                                    <div class="modal" id="ModalPedido_<?php echo $tienda->id_usuario?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Nuevo pedido</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminEquipaciones/nueva_equipacion" class="card-body">

                                                    <div class="row">
                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="tipo">Concepto</label>
                                                            <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" required>
                                                        </div>

                                                        <div class="col-6 mt-3 mb-3">
                                                            <label for="talla">Talla</label>
                                                            <input type="text" name="talla" id="talla" class="form-control form-control-lg" required>
                                                        </div>
                                                    </div>

                                                      <input type="hidden" name="usu" value="<?php echo $tienda->id_usuario?>">

                                                    <br>
                                                    <div class="row">
                                                    <div class="col-3">
                                                        <input type="submit" class="btn" value="Confirmar">
                                                        <!-- <a href="<?php echo RUTA_URL?>/tienda">
                                                            <input type="button" class="btn" id="botonVolver" value="Volver">  
                                                        </a> -->
                                                    </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                    </div>


      <!--MODAL VER (javascript)-->
      &nbsp;&nbsp;&nbsp;
      <img class="icono mt-1" id="btnModal_<?php echo $pedido->id_soli_equi?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir('<?php echo $pedido->id_soli_equi?>');" ></img>

        <!--Ventana-->
        <div id="<?php echo $pedido->id_soli_equi?>" class="modalVer">
            <div class="modal-content">

                <!--Header-->
                <div id="headerVer" class="row">
                    <h2 class="col-11">Informacion del pedido Nº: <?php echo $pedido->id_soli_equi?></h2>
                    <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $pedido->id_soli_equi?>" onclick="cerrar('<?php echo $pedido->id_soli_equi?>');">                                              
                </div><hr>

                <!--Body-->
                <div id="bodyVer" class="row m-3">
                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="nombre">Nombre</label>
                            <input  type="text" name="nombre" id="nombre" class="form-control form-control-lg" value="<?php echo $pedido->nombre?>" readonly>
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" name="apellidos" id="apellidos" class="form-control form-control-lg" value="<?php echo $pedido->apellidos?>" readonly>
                        </div>               
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="email">Email</label>
                            <input  type="text" name="email" id="email" class="form-control form-control-lg" value="<?php echo $pedido->email?>" readonly>
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="telefono">Telefono</label>
                            <input type="text" name="telefono" id="telefono" class="form-control form-control-lg" value="<?php echo $pedido->telefono?>" readonly>
                        </div>               
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="fecha">Fecha peticion</label>
                            <input  type="text" name="fecha" id="fecha" class="form-control form-control-lg" value="<?php echo $pedido->fecha_peticion?>" readonly>
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="talla">Talla</label>
                            <input type="text" name="talla" id="talla" class="form-control form-control-lg" value="<?php echo $pedido->talla?>" readonly>
                        </div>               
                    </div>
                    <div class="row">
                        <div class="col-6 mt-3 mb-3">
                            <label for="tipo">Tipo</label>
                            <input  type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $pedido->tipo?>" readonly>
                        </div>
                        <div class="col-6 mt-3 mb-3">
                            <label for="descripcion">Descripcion</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg" value="<?php echo $pedido->descripcion?>" readonly>
                        </div>            
                    </div>
                </div>
        </div>  
    </div> 



                                <!-- MODAL ENVIO MAIL -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEnvio<?php echo $pedido->id_soli_equi?>" href="<?php echo RUTA_URL?>/adminEquipaciones/envio/<?php echo $pedido->id_soli_equi?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>envelope.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalEnvio<?php echo $pedido->id_soli_equi?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminEquipaciones/enviar"class="card-body">
                                                    <div class="mt-3 mb-3">
                                                        <label for="destinatario">Email destinatario</label>
                                                        <input type="text" name="destinatario" id="destinatario" class="form-control form-control-lg" value="<?php echo $pedido->email?>" required>
                                                    </div>
                                                    <div class="mt-3 mb-3">
                                                        <label for="asunto">Asunto</label>
                                                        <input type="text" name="asunto" id="asunto" class="form-control form-control-lg"  value="Recogida equipacion Club Tragamillas" required>
                                                    </div>

                                                    <div class="mt-3 mb-3">
                                                        <label for="mensaje">Mensaje</label>
                                                        <textarea type="text" rows="7" name="mensaje" id="mensaje" class="form-control form-control-lg" required></textarea>
                                                    </div>

                                                    <input type="hidden" name="enviarCorreos" id="enviarCorreos" value="">
                                                    <input type="submit" class="btn" value="Enviar">
                                                </form>
                                            </div>
                                    </div>
                                    </div>
                                    </div>
























                                  </td>


                                     <!-- MODAL CAMBIAR ESTADO ENTREGA -->
                                    <td id="datos_tabla">
                                            <?php 
                                        if ($pedido->recogido == 1){ ?>
                                            <a data-bs-toggle="modal" data-bs-target="#ModalCambiar_<?php echo $pedido->id_soli_equi?>" href="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>">
                                                <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                            </a>
                                            <?php
                                        }else{?>
                                            <a data-bs-toggle="modal" data-bs-target="#ModalCambiar_<?php echo $pedido->id_soli_equi?>" href="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>">
                                                <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                            </a>
                                            <?php
                                        }
                                        ?>

                                        <!-- VENTANA -->
                                        <div class="modal" id="ModalCambiar_<?php echo $pedido->id_soli_equi?>">
                                        <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Va a cambiar el estado del pedido, esta seguro?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEquipaciones/cambiar_estado/<?php echo $pedido->id_soli_equi?>" method="post">
                                                    <input type="hidden" name="estado" value="<?php echo $pedido->recogido?>">
                                                    <button type="submit" class="btn">Confirmar</button>
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




        function filtrar(){
            var campo=document.getElementById("filtro");
            var valor=(campo.value).toUpperCase().trim();
            //console.log(valor););

            var filas=document.getElementById("tabla").getElementsByTagName("tbody")[0].rows;
            //console.log(filas);
            
               for(var i=0; i<filas.length; i++){
                   console.log(filas[i]);
                   //console.log(filas[i].innerText.toLocaleUpperCase())
                   //console.log(filas[i].cells.namedItem("nombreUsu").innerText.toLocaleUpperCase())
                   if(filas[i].innerText.toLocaleUpperCase().indexOf(valor) !== -1 ){
                           filas[i].style.display = null;
                         }else{
                           filas[i].style.display = 'none';
                        }

                  
                
     
                //    
                       
            }
        }


    window.onload=function(){
        var filtro=document.getElementById("filtro");        
        filtro.onkeyup=function(){
            filtrar();
        }
    }

            </script>












