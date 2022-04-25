
<?php require_once RUTA_APP . '/vistas/inc/header-tienda.php' ?>


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

            <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Gestion de equipaciones</h4></div>
            </div>



           <div class="tabla" style="border:solid 1px #023ef9">
            
           <table class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                        
                            <th>N SOCIO</th>
                            <th>NOMBRE</th>
                            <th>APELLIDOS</th>
                            <th>EMAIL</th>
                            <th>TELEFONO</th>
                            <th>TALLA</th>
                            
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[4])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                     <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['tienda'] as $tienda): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $tienda->id_usuario?></td>
                            <td class="datos_tabla"><?php echo $tienda->nombre?></td>
                            <td class="datos_tabla"><?php echo $tienda->apellidos?></td>
                            <td class="datos_tabla"><?php echo $tienda->email?></td>
                            <td class="datos_tabla"><?php echo $tienda->telefono?></td>
                            <td class="datos_tabla"><?php echo $tienda->talla?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[4])):?>
                            <td class="d-flex justify-content-center">

                                <?php 
                                  if ($tienda->entregado == 1){ ?>
                                    <img src="<?php echo RUTA_Icon ?>tick.png" width="30" height="30"></img>
                                  <?php
                                  }else{?>
                                    <img src="<?php echo RUTA_Icon ?>x1.png" width="30" height="30"></img>
                                  <?php
                                  }
                                ?>



                                <!-- MODAL NUEVO PEDIDO -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalPedido_<?php echo $tienda->id_usuario?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>carrito.svg"></img>
                                </a>

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
                                                <form method="post" action="<?php echo RUTA_URL?>/tienda/nueva_equipacion" class="card-body">
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
                                                        <a href="<?php echo RUTA_URL?>/tienda">
                                                            <input type="button" class="btn" id="botonVolver" value="Volver">  
                                                        </a>
                                                    </div>
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












