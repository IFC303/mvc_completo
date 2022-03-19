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
                        //var_dump($datos['participantes']);
                        foreach($datos['ingresos'] as $info):  
                            
                        
                           ?>
                        <tr>
                            <td class="datos_tabla"><?php echo $info->fecha?></td>
                            <td class="datos_tabla"><?php echo $info->concepto?></td>
                            <td class="datos_tabla"><?php echo $info->importe?></td>
                            <td class="datos_tabla"><?php echo $info->tipo?></td>

                            <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol,[1])):?>
                            <td>

                                <!--MODAL VER (javascript)-->
                                    <img id="btnModal_<?php echo $info->id_ingreso?>" src="<?php echo RUTA_Icon?>ojo.svg" onclick="abrir('<?php echo $info->id_ingreso.$info->tipo?>');"></img>

                                    <!--Ventana-->
                                    <div id="<?php echo $info->id_ingreso.$info->tipo?>" class="modalVer">
                                        <div class="modal-content">

                                            <!--Header-->
                                            <div id="headerVer" class="row">
                                                <h2 class="col-11">Datos del ingreso</h2>
                                                <input class="col-1 btn-close m-3" type="button" id="cerrar_<?php echo $info->id_ingreso?>" onclick="cerrar('<?php echo $info->id_ingreso.$info->tipo?>');">  
                                            </div>
                                            <hr>

                                            <!--Body-->
                                            <div id="bodyVer" class="row m-3">
                                             
                                                <div class="row">
                                     
                                                    <div class="col-6">
                                                        <label for="fecha">Fecha del ingreso</label>
                                                        <input type="text" name="fecha" id="fecha" class="form-control form-control-lg" value="<?php echo $info->fecha?>" readonly>
                                                        <br>
                                                    </div>

                                                    <div class="col-6">
                                                        <label for="tipo">Categoria</label>
                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $info->tipo?>" readonly>
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
                                                        if($info->tipo=="otros"){
                                                            foreach($datos['ingresosOtros'] as $ingresosOtros){
                                                            //     var_dump($ingresosOtros);
                                                            //     echo " --------------------";
                                                            //    var_dump($info);
                                                                if($ingresosOtros->id_ingreso_otros == $info->id_ingreso){?>
                                                                    <div class="col-6">
                                                                    <label for="id_entidad">Entidad</label>
                                                                    <input type="text" name="id_entidad" id="id_entidad" class="form-control form-control-lg" value="<?php echo $ingresosOtros->nombre?>" readonly>
                                                                    <br>
                                                                </div>


                                                                <?php }
                                                            ?>
                                                            

                                                            <!--CAMPOS DE CUOTAS-->
                                                    <?php }
                                                        }else if($info->tipo=="cuotas"){
                                                            foreach($datos['ingresosCuotas'] as $ingresosCuotas){   
                                                            ?>
                                                            <div class="col-6">
                                                                <label for="id_usuario">Usuario</label>
                                                                <input type="text" name="id_usuario" id="id_usuario" class="form-control form-control-lg" value="<?php echo $ingresosCuotas->nombre." ".$ingresosCuotas->apellidos?>" readonly>
                                                                <br>
                                                            </div>

                                                            <!--CAMPOS DE ACTIVIDADES-->
                                                        <?php }
                                                        }else if($info->tipo=="actividades"){
                                                            foreach($datos['todosIngresosParticipantes'] as $part){
                                                                //var_dump($part);
                                                                //echo " --------------------";
                                                                   // var_dump($info);
                                                                if($part->id_ingreso_actividades==$info->id_ingreso){?>
                                                                    <div class="col-6">
                                                                        <label for="tipo">Participante</label>
                                                                        <input type="text" name="tipo" id="tipo" class="form-control form-control-lg" value="<?php echo $part->nombre." ".$part->apellidos?>" readonly>
                                                                    <br>

                                                                    
                                                                </div>

                                                               <?php }
                                                               if($part->id_ingreso_actividades==$info->id_ingreso){?>

                                                                    <div class="col-6">
                                                                        <label for="id_evento">Evento</label>
                                                                        <input type="text" name="id_evento" id="id_evento" class="form-control form-control-lg" value="<?php echo $part->id_evento?>" readonly>
                                                                        <br>
                                                                    </div>
                                                              <?php }
                                                               
                                                                ?>      
                                                               
                                                        <?php }       
                                                            ?>
                                                            
                                                            
                                                       <?php };
                                                    ?>
                                                    
                                                </div>

                                                 </div>
                                        
                                        </div>  
                                    </div> 



                                <!-- MODAL EDITAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalEditar_<?php echo $info->id_ingreso.$info->tipo?>" >
                                  <img src="<?php echo RUTA_Icon?>editar.svg"></img>
                                </a>

                                    <!-- Ventana -->
                                    <div class="modal" id="ModalEditar_<?php echo $info->id_ingreso.$info->tipo?>">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">


                                            <!-- Header -->
                                            <div class="modal-header">
                                                <h2 class="modal-title">Edicion del ingreso</h2>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Body -->
                                            <div class="modal-body">
                                                <form method="post" action="<?php echo RUTA_URL?>/adminFacturacion/editarIngreso/<?php echo $info->id_ingreso?>" class="card-body">
                                                        
                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="fecha">Fecha<sup>*</sup></label>
                                                    </div>   
                                                    <div class="col-6">
                                                    <label for="tipo" class="form-label">Tipo de ingreso:</label>
                                                    </div>   
                                                </div>  
                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3"> 
                                                        <input type="date" name="fecha" id="fecha" class="form-control form-control-lg" value="<?php echo $info->fecha?>">
                                                    </div>
                                                    <div class="col-6 mt-3 mb-3">    
                                                        <select class="form-control form-control-lg" name="tipoSelect" id="tipoSelect<?php echo $info->id_ingreso?>" onchange="opciones(this.id)" required >
                                                            <option value="">-- Selecciona un tipo de ingreso --</option>
                                                            <option value="cuotas">Cuotas</option>
                                                            <option value="actividades">Actividades</option>
                                                            <option value="otros">Otros</option>
                                                        </select>
                                                    </div>  
                                                </div>


                                                <div class="row">
                                                    <div class="col-6">
                                                        <label for="importe">Importe<sup>*</sup></label>
                                                    </div>   
                                                    <div class="col-6" id="labelSocios<?php echo $info->id_ingreso?>" style="display:none">
                                                        <label for="browser" class="form-label">Socio<sup>*</sup></label>
                                                    </div> 
                                                    <div class="col-6" id="labelParticipantes<?php echo $info->id_ingreso?>" style="display:none">
                                                        <label for="browser" class="form-label">Participante<sup>*</sup></label>
                                                    </div> 
                                                    <div class="col-6" id="labelEntidades<?php echo $info->id_ingreso?>" style="display:none" >
                                                        <label for="browser" class="form-label">Entidades<sup>*</sup></label>
                                                    </div> 
                                                </div>             

                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">
                                                        <input type="text" name="importe" id="importe" class="form-control form-control-lg" value="<?php echo $info->importe?>">
                                                    </div>   
                                                    <!--div SOCIOS -->
                                                    <div class="col-6 mt-3 mb-3" id="inputSocios<?php echo $info->id_ingreso?>" style="display:none">  
                                                        <input class="form-control form-control-lg" list="browsers" name="browser" id="browser">
                                                        <datalist id="browsers" name="socio">
                                                            <?php foreach($datos['socios'] as $socios){
                                                                ?><option  value="<?php echo $socios->id_socio?>"><?php echo $socios->nombre." ".$socios->apellidos?></option><?php
                                                            }?>    
                                                        </datalist>  
                                                    </div>
                                                    <!--div PARTICIPANTES -->
                                                    <div class="col-6 mt-3 mb-3" id="inputParticipantes<?php echo $info->id_ingreso?>" style="display:none">  
                                                        <input class="form-control form-control-lg" list="browsers2" name="browser2" id="browser2">
                                                    
                                                        <datalist id="browsers2" name="participante">
                                                            <?php foreach($datos['participantes'] as $participante){   
                                                            
                                                                    ?><option value="<?php echo $participante->id_participante?>-<?php echo $participante->tipoParticipante?>"><?php echo $participante->nombre." ".$participante->apellidos?></option> 
                                                                    <?php   
                                                            }?>  
                                                            
                                                        
                                                        </datalist>  
                                                
                                                    </div> 

                                                    <!--div ENTIDADES -->
                                                    <div class="col-6 mt-3 mb-3" id="inputEntidades<?php echo $info->id_ingreso?>" style="display:none">   
                                                        <input class="form-control form-control-lg" list="browsers3" name="browser3" id="browser3">
                                                        <datalist id="browsers3" name="entidad">
                                                            <?php foreach($datos['entidades'] as $entidad){
                                                                ?><option name="idEntidades" value="<?php echo $entidad->id_entidad?>"><?php echo $entidad->nombre?></option>                          
                                                                <?php
                                                            }?>    
                                                        </datalist> 
                                            
                                                    </div> 
                                                </div>
                                                
          
                                                <div class="row">
                                                    <div class="col-6" >
                                                        <label for="concepto">Concepto<sup>*</sup></label>
                                                    </div>   
                                                    <div class="col-6" id="labelEvento<?php echo $info->id_ingreso?>" style="display:none">
                                                        <label for="labelEvento">Evento<sup>*</sup></label>
                                                    </div>   
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 mt-3 mb-3">  
                                                        <input type="text" name="concepto" id="concepto" class="form-control form-control-lg" value="<?php echo $info->concepto?>">
                                                    </div>
                                                    <div class="col-6 mt-3 mb-3" id="inputEvento<?php echo $info->id_ingreso?>" style="display:none" >  
                                                        <input class="form-control form-control-lg" list="browsers4" name="browser4" id="browser4">
                                                        <datalist id="browsers4" name="inputEvento">
                                                            <?php foreach($datos['eventos'] as $eventos){
                                                                ?><option value="<?php echo $eventos->nombre?>"></option><?php
                                                            }?>    
                                                        </datalist>  
                                                       
                                                    </div>
                                                </div>
                                                <br>
                                                    <input type="submit" class="btn" value="Confirmar">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    </div>


                                <!-- MODAL BORRAR -->
                                &nbsp;&nbsp;&nbsp;
                                <a data-bs-toggle="modal" data-bs-target="#ModalBorrar_<?php echo $info->id_ingreso.$info->tipo?>" href="<?php echo RUTA_URL?>/adminFacturacion/borrarIngreso/<?php echo $info->id_ingreso?>">
                                  <img src="<?php echo RUTA_Icon?>papelera.svg"></img>
                                </a>

                                    <!-- VENTANA -->
                                    <div class="modal" id="ModalBorrar_<?php echo $info->id_ingreso.$info->tipo?>">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                             <!-- Modal Header -->
                                             <div class="modal-header">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
 
                                            <!-- Modal body -->
                                            <div class="modal-body">
                                                <h6>Seguro que quiere borrar el ingreso <?php echo $info->concepto?> del tipo <?php echo $info->tipo?>?</h6>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <form action="<?php echo RUTA_URL?>/adminFacturacion/borrarIngreso/<?php echo $info->id_ingreso?>" method="post">
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


                     function opciones(id) {
                            console.log(id);
                            var numero=id.slice(10);
                            console.log(numero);
                            var opcion=document.getElementById(id).value;
                            console.log(opcion);

                            if(opcion=="actividades"){
                                //alert("hola");

                                document.getElementById("labelSocios"+numero).style.display ="none";
                                document.getElementById("labelParticipantes"+numero).style.display="block";
                                document.getElementById("labelEntidades"+numero).style.display="none";

                                document.getElementById("labelEvento"+numero).style.display="block";
                                document.getElementById("inputEvento"+numero).style.display="block";

                                document.getElementById("inputParticipantes"+numero).style.display = "block";
                                document.getElementById("inputEntidades"+numero).style.display = "none";
                                document.getElementById("inputSocios"+numero).style.display = "none";

                            }else if (opcion=="cuotas"){
                                //alert("adios");

                                document.getElementById("labelSocios"+numero).style.display ="block";
                                document.getElementById("labelParticipantes"+numero).style.display="none";
                                document.getElementById("labelEntidades"+numero).style.display="none";

                                document.getElementById("labelEvento"+numero).style.display="none";
                                document.getElementById("inputEvento"+numero).style.display="none";

                                document.getElementById("inputParticipantes"+numero).style.display = "none";
                                document.getElementById("inputEntidades"+numero).style.display = "none";
                                document.getElementById("inputSocios"+numero).style.display = "block";
                                
                            }else if(opcion=="otros") {

                                document.getElementById("labelSocios"+numero).style.display ="none";
                                document.getElementById("labelParticipantes"+numero).style.display="none";
                                document.getElementById("labelEntidades"+numero).style.display="block";

                                document.getElementById("labelEvento"+numero).style.display="none";
                                document.getElementById("inputEvento"+numero).style.display="none";

                                document.getElementById("inputParticipantes"+numero).style.display = "none";
                                document.getElementById("inputEntidades"+numero).style.display = "block";
                                document.getElementById("inputSocios"+numero).style.display = "none";
                            }

            }







            </script>
