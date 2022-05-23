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
                <div class="col-12"><h4 id="titulo">Gestion de equipaciones</h4></div>
            </div>

           <div class="tabla" style="border:solid 1px #023ef9">
            
           <table class="table table-hover" >


                    <!--CABECERA TABLA-->
                    <thead>
                        <tr style="background-color:#023ef9; color:white">
                        
                            <th>NOMBRE</th>   
                            <th>DESCRIPCION</th>                         

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                                <th>OPCIONES</th>
                            <?php endif ?>
                        </tr>
                    </thead>


                     <!--BODY TABLA-->
                    <tbody class="table-light">

                        <?php
                        foreach($datos['equipacion'] as $equipacion): ?>
                        <tr>

                            <td class="datos_tabla"><?php echo $equipacion->tipo?></td>
                            <td class="datos_tabla"><?php echo $equipacion->descripcion?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td class="d-flex justify-content-center">

                                <!--MODAL VER (javascript)-->
                                    <img class="icono mt-1" id="btnModal_<?php echo $equipacion->id_equipacion?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir(<?php echo $equipacion->id_equipacion?>);"></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $equipacion->id_equipacion?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                <h2 class="col-11">Datos de la equipacion</h2>
                                                <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $equipacion->id_equipacion?>" onclick="cerrar(<?php echo $equipacion->id_equipacion?>);">  
                                            </div>
                                            <hr>

                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">

                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg"value="<?php echo $equipacion->tipo?>" readonly>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="descripcion">Descripcion</label>
                                                        <input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg" value="<?php echo $equipacion->descripcion?>" readonly>
                                                    </div>
                                                </div>

                                            </div>
                    
                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $equipacion->id_equipacion?>" >
                                  <img class="icono" src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $equipacion->id_equipacion?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion de la equipacion</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminEquipaciones/editarEquipacion/<?php echo $equipacion->id_equipacion?>" class="card-body">
                                                  

                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg"value="<?php echo $equipacion->tipo?>" required>
                                                    </div>

                                                    <div class="col-6 mt-3 mb-3">
                                                        <label for="descripcion">Descripcion</label>
                                                        <input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg" value="<?php echo $equipacion->descripcion?>" required>
                                                    </div>
                                                </div>

                                                    <input type="hidden" name="id_equipacion" value="<?php echo $equipacion->id_equipacion?>">

                                                    <br>
                                                    <input type="submit" class="btn" value="Confirmar">
                                                </form>

                                            </div>

                                        </div>
                                    </div>
                                    </div>

                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $equipacion->id_equipacion?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>
                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $equipacion->id_equipacion?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar la equipacion <?php echo $equipacion->tipo?> ?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminEquipaciones/borrarEquipacion/<?php echo $equipacion->id_equipacion?>" method="post">
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



                    <!--AÑADIR EQUIPACION-->
                    <div class="col text-center">
                        <a data-bs-toggle="modal" data-bs-target="#ModalNuevo" class="btn" id="añadir">Nueva equipacion</a>
                    </div>
                              <!-- VENTANA -->
                              <div class="modal" id="ModalNuevo">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                            <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                            <div class="row">

                                                 <form enctype="multipart/form-data" class="card-body" action="<?php echo RUTA_URL?>/adminEquipaciones/nuevaEquipacion" method="POST"> 
                                                    
                                                    <label for="foto"> 
                                                            <img id="output" src="" width="200px" height="200px">    
                                                            <input accept="image/*" onchange="loadFile(event)" style="visibility:hidden;" type="file" id="foto" name="foto">
                                                    </label>
                                        
                                                    <div class="row mt-3 mb-3">
                                                        <label for="nombre">Nombre</label>
                                                        <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" required>
                                                    </div>

                                                    <div class="row mt-3 mb-3">
                                                        <label for="descripcion">Descripcion</label>
                                                        <input type="text" name="descripcion" id="descripcion" class="form-control form-control-lg" required>
                                                    </div>
                                            </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                    <button type="submit" class="btn">Guardar</button>
                                                
                                            </div>
                                        </form>
                                        </div>
                                    </div>
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

var loadFile = function(event) {
    var output = document.getElementById('output');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
  };



            </script>







