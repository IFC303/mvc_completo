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

        #tabla{
            border:solid 2px #023ef9; 
            margin:auto;
            width: 800px;
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


            
           <table id="tabla" class="table table-hover" >
                    <!--CABECERA TABLA-->
                    <thead style="border-bottom:solid #023ef9">
                        <tr style="background-color:#023ef9; color:white">                       
                            <th>NOMBRE</th> 
                            <th>TEMPORADA</th>  
                            <th>PRECIO</th>                                   
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
                            <td class="datos_tabla"><?php echo $equipacion->temporada?></td>
                            <td class="datos_tabla"><?php echo $equipacion->precio?> €</td>
                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td class="d-flex justify-content-center">


                                <!-- MODAL VER -->
                                <a data-bs-toggle="modal" data-bs-target="#ModalVer_<?php echo $equipacion->id_equipacion?>">
                                  <img class="icono" src="<?php echo RUTA_Icon?>ojo.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalVer_<?php echo $equipacion->id_equipacion?>">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">

                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Info.Equipacion</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body mb-5">                                             
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div>
                                                                <img id="outputVer" width="300px" height="300px" 
                                                                <?php if ($equipacion->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php ;
                                                                     }else {?> src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';} ?>'                                                                                             
                                                                >
                                                            </div>                                                      
                                                        </div>

                                                        <div class="col-7">
                                                            <div class="form-floating mb-3 mt-3">
                                                                <input autocomplete="off" type="text" class="form-control" id="nombre" placeholder="Enter nombre" name="nombre" value="<?php echo $equipacion->tipo?>" readonly>
                                                                <label for="nombre">Nombre</label>
                                                            </div>
                                                            <div class="form-floating mt-3 mb-3">
                                                                <input autocomplete="off" type="text" class="form-control" id="precio" placeholder="Enter precio" name="precio" value="<?php echo $equipacion->precio?>" readonly>
                                                                <label for="precio">Precio</label>
                                                            </div>
                                                            <div class="form-floating mt-3 mb-4">
                                                                <input autocomplete="off" type="text" class="form-control" id="temporada" placeholder="Enter temporada" name="temporada" value="<?php echo $equipacion->temporada?>" readonly>
                                                                <label for="temporada">Temporada</label>
                                                            </div>                                                                                                                   
                                                        </div>
                                                    </div>
                                                                                                

                                                    <div class="form-floating mt-3 mb-3">
                                                        <textarea type="text" style="height:200px" class="form-control" id="descripcion" placeholder="Enter descripcion" name="descripcion" readonly><?php echo $equipacion->descripcion?></textarea>
                                                        <label for="descripcion">Descripcion</label>
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
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                    <div class="modal-content">
                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- Body -->
                                            <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data"  action="<?php echo RUTA_URL?>/adminEquipaciones/editarEquipacion/<?php echo $equipacion->id_equipacion?>" class="card-body">                                                 
                                                <div class="row">

                                                        <div class="col-5">
                                                            <div>
                                                            <img id="outputEdit<?php echo $equipacion->id_equipacion?>" width="300px" height="300px" 
                                                            <?php if ($equipacion->imagen==''){?> src='<?php echo RUTA_Equipacion?>noFoto.jpg'<?php ;
                                                                     }else {?> src='<?php echo RUTA_Equipacion.$equipacion->id_equipacion.'.jpg';} ?>' 
                                    
                                                            >
                                                            </div>                                                      
                                                        </div>

                                                        <div class="col-7">
                                                            <div class="form-floating mb-3 mt-3">
                                                                <input autocomplete="off" type="text" class="form-control" id="nombre" placeholder="Enter nombre" name="nombre" value="<?php echo $equipacion->tipo?>" required>
                                                                <label for="nombre">Nombre</label>
                                                            </div>
                                                            <div class="form-floating mt-3 mb-3">
                                                                <input autocomplete="off" type="text" class="form-control" id="precio" placeholder="Enter precio" name="precio" value="<?php echo $equipacion->precio?>" required>
                                                                <label for="precio">Precio</label>
                                                            </div>
                                                            <div class="form-floating mt-3 mb-4">
                                                                <input autocomplete="off" type="text" class="form-control" id="temporada" placeholder="Enter temporada"value="<?php echo $equipacion->temporada?>" name="temporada">
                                                                <label for="temporada">Temporada</label>
                                                            </div>                                                                 
                                                        
                                                            <label for="editarFoto" class="editarFoto">
                                                                <input accept="image/*" type="file"  onchange="loadFile2(event,<?php echo $equipacion->id_equipacion?>)" id="editarFoto" name="editarFoto" value ="<?php echo $equipacion->imagen?>">  
                                                            </label>  
                                                            
                                                            <input type="hidden" name="idEquipacion" value="<?php echo $equipacion->id_equipacion?>">
                                                        </div>
                                                </div>   
                                                    <div class="form-floating mt-3 mb-3">
                                                        <textarea autocomplete="off" type="text" style="height:200px" class="form-control" id="descripcion" placeholder="Enter descripcion" name="descripcion"><?php echo $equipacion->descripcion?></textarea>
                                                        <label for="descripcion">Descripcion</label>
                                                    </div>


                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <input type="hidden" name="id_equipacion" value="<?php echo $equipacion->id_equipacion?>">
                                                <input type="submit" class="btn" value="Guardar">                                               
                                            </div>
                           
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


                   <br>

    

                    <!--AÑADIR EQUIPACION-->
                    <div class="col text-center">
                        <a data-bs-toggle="modal" data-bs-target="#ModalNuevo" class="btn" id="añadir">Nueva equipacion</a>
                    </div>
                              <!-- VENTANA -->
                              <div class="modal" id="ModalNuevo">
                              <div class="modal-dialog modal-lg modal-dialog-centered">
                              <div class="modal-content">

                                             <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Nueva equipacion</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                            <div class="modal-body">
                                            <div class="row">
                                            <form  class="card-body" action="<?php echo RUTA_URL?>/adminEquipaciones/nuevaEquipacion" enctype="multipart/form-data" method="POST">                                     
                                               
                                                    <div class="row">
                                                        <div class="col-5">
                                                            <div>
                                                                <img id="output" width="300px" height="300px" src='<?php echo RUTA_Equipacion?>noFoto.jpg'>
                                                            </div>                                                      
                                                        </div>

                                                        <div class="col-7">
                                                            <div class="form-floating mb-3 mt-3">
                                                                <input autocomplete="off" type="text" class="form-control" id="nombre" placeholder="Enter nombre" name="nombre" required>
                                                                <label for="nombre">Nombre</label>
                                                            </div>
                                                            <div class="form-floating mt-3 mb-3">
                                                                <input autocomplete="off" type="text" class="form-control" id="precio" placeholder="Enter precio" name="precio" required>
                                                                <label for="precio">Precio</label>
                                                            </div>
                                                            <div class="form-floating mt-3 mb-4">
                                                                <input autocomplete="off" type="text" class="form-control" id="temporada" placeholder="Enter temporada" name="temporada">
                                                                <label for="temporada">Temporada</label>
                                                            </div>  

                                                            <label for="subirFoto" class="subirFoto">
                                                                <input  accept="image/*" type="file"  onchange="loadFile(event)" id="subirFoto" name="subirFoto">  
                                                            </label>  
                                                                                                            
                                                        </div>
                                                    </div>
                                                                                                

                                                    <div class="form-floating mt-3 mb-3">
                                                        <textarea autocomplete="off" type="text" style="height:200px" class="form-control" id="descripcion" placeholder="Enter descripcion" name="descripcion"></textarea>
                                                        <label for="descripcion">Descripcion</label>
                                                    </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <input type="submit" name="subir" class="btn" value="Guardar">                                               
                                            </div>

                                        </form>
                                        </div>
                                        </div>
                                    </div>
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

                    var loadFile2 = function(event,id) {
                    var output = document.getElementById('outputEdit'+id);
                    console.log(output);
                    output.src = URL.createObjectURL(event.target.files[0]);
                    //console.log(output.src);
                    output.onload = function() {
                    URL.revokeObjectURL(output.src)
                    }
                    };

            </script>







