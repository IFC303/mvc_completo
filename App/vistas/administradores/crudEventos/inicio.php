
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

            <div class="row" style="text-align:center">
                <div class="col-12"><h4 id="titulo">Gestion de eventos</h4></div>
            </div>

           <div class="tabla" style="border:solid 1px #023ef9">
            
           <table class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                        
                            <th>NOMBRE</th>
                            <th>TIPO</th>
                            <th>FECHA INICIO</th>
                            <th>FECHA FIN</th>
                            

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                     <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['evento'] as $evento): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $evento->nombre?></td>
                            <td class="datos_tabla"><?php echo $evento->tipo?></td>
                            <td class="datos_tabla"><?php echo $evento->fecha_ini?></td>
                            <td class="datos_tabla"><?php echo $evento->fecha_fin?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td class="d-flex justify-content-center">

                                <!--MODAL VER (javascript)-->
                                    <img class="icono mt-1" id="btnModal_<?php echo $evento->id_evento ?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir(<?php echo $evento->id_evento ?>);"></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $evento->id_evento ?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                <h2 class="col-11">Datos del evento</h2>
                                                <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $evento->id_evento?>" onclick="cerrar(<?php echo $evento->id_evento?>);">  
                                            </div>
                                            <hr>

                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">

                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg"value="<?php echo $evento->nombre?>" readonly>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="tipo">Tipo</label>
                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $evento->tipo?>" readonly>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_ini">Fecha inicio</label>
                                                        <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg"value="<?php echo $evento->fecha_ini?>" readonly>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_fin">Fecha fin</label>
                                                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $evento->fecha_fin?>" readonly>
                                                    </div>
                                                </div>

                                          
                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="precio">Precio<sup>*</sup></label>
                                                        <input type="text" name="precio" id="precio" class="form-control form-control-lg" value="<?php echo $evento->precio?>" readonly>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="descuento">Descuento<sup>*</sup></label>
                                                        <input type="text" name="descuento" id="descuento" class="form-control form-control-lg" value="<?php echo $evento->descuento?>" readonly>
                                                    </div>
                                                </div>

                                         
                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_ini_inscrip">Fecha inicio inscripcion<sup>*</sup></label>
                                                        <input type="date" name="fecha_ini_inscrip" id="fecha_ini_inscrip" class="form-control form-control-lg" value="<?php echo $evento->fecha_ini_inscrip?>" readonly>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_fin_inscrip">Fecha fin inscripcion<sup>*</sup></label>
                                                        <input type="date" name="fecha_fin_inscrip" id="fecha_fin_inscrip" class="form-control form-control-lg" value="<?php echo $evento->fecha_fin_inscrip?>" readonly>
                                                    <br>
                                                    </div>
                                                    
                                                </div>

                                       
                                            </div>
                    
                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $evento->id_evento ?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $evento->id_evento ?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion del evento</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminEventos/editarEvento/<?php echo $evento->id_evento ?>" class="card-body">
                                                  

                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg"value="<?php echo $evento->nombre?>" required>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="tipo">Tipo</label>
                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $evento->tipo?>" required>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_ini">Fecha inicio</label>
                                                        <input type="date" name="fecha_ini" id="fecha_ini" class="form-control form-control-lg"value="<?php echo $evento->fecha_ini?>" required>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_fin">Fecha fin</label>
                                                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control form-control-lg" value="<?php echo $evento->fecha_fin?>" required>
                                                    </div>
                                                </div>

                                          
                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="precio">Precio<sup>*</sup></label>
                                                        <input type="text" name="precio" id="precio" class="form-control form-control-lg" value="<?php echo $evento->precio?>" required>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="descuento">Descuento<sup>*</sup></label>
                                                        <input type="text" name="descuento" id="descuento" class="form-control form-control-lg" value="<?php echo $evento->descuento?>" required>
                                                    </div>
                                                </div>

                                                  
                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_ini_inscrip">Fecha inicio inscripcion<sup>*</sup></label>
                                                        <input type="date" name="fecha_ini_inscrip" id="fecha_ini_inscrip" class="form-control form-control-lg" value="<?php echo $evento->fecha_ini_inscrip?>" required>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="fecha_fin_inscrip">Fecha fin inscripcion<sup>*</sup></label>
                                                        <input type="date" name="fecha_fin_inscrip" id="fecha_fin_inscrip" class="form-control form-control-lg" value="<?php echo $evento->fecha_fin_inscrip?>" required>
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




                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $evento->id_evento ?>" href="<?php echo RUTA_URL?>/adminEventos/borrar/<?php echo $evento->id_evento ?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $evento->id_evento ?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar el evento <?php echo $evento->nombre?> ?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEventos/borrar/<?php echo $evento->id_evento ?>" method="post">
                                                    <button type="submit" class="btn">Borrar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>

                                     <!-- PARTICIPANTES -->
                                &nbsp;&nbsp;&nbsp;
                                <a href="<?php echo RUTA_URL?>/adminEventos/participantes/<?php echo $evento->id_evento?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>grupos.svg"></img>
                                </a> 

                            </td>
                            <?php endif ?>
                        </tr>
                        <?php endforeach ?>
                    </tbody>

            </table>

                    <!--AÑADIR-->
                    <div class="col text-center">
                        <a class="btn" id="añadir" href="<?php echo RUTA_URL?>/adminEventos/nuevo_evento/">Nuevo evento</a>
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

