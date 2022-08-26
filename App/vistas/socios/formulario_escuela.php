<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>
  

        <header>              
            <div class="row">
                <div class="col-10"><span id="tHead">Inscripciones</span></div>     
                <div class="col-2">
                    <a type="button" class="btn" style="background-color:#0b2a85" href="<?php echo RUTA_URL ?>/login/logout">
                        <span style="font-size:25px;color:white">Logout</span>
                        <img class="ms-2" id="salirHeader" src="<?php echo RUTA_Icon ?>logout.png" style="width:35px;height:35px" >
                    </a>
                </div>
            </div>                                 
        </header>



        <article>
        <div class="d-flex align-items-center justify-content-around mt-5 ">
             

                        <!-- FORMULARIO ESCUELA-->               
                        <div class="col-6 col-xs-12 col-md-6 " style="width:500px">                           
                                <div class="shadow-lg p-3 mb-3" style="height:650px; background-color:white">                               

                                    <div class="row">
                                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:100px; height:100px; background-color:#264475"><img src="<?php echo RUTA_Icon ?>escuela.png" width="70" height="60"></div>
                                        <div class="col-8"><p style="margin-top:25px;  margin-left:30px; font-size:20px">INSCRIPCION ESCUELA</p></div>                                       
                                    </div>

                                    <form method="post" ENCTYPE="multipart/form-data" class="card-body">

                                        <!-- <div class="row mt-4 w-100">
                                            <label for="grup">Grupo entrenamiento</label>
                                            <select class="form-control ms-2" name="grup" id="grup" required>
                                                <option value=""></option>
                                                <?php foreach ($datos['grupos'] as $gru) : ?>
                                                    <option value="<?php echo $gru->id_grupo ?>"><?php echo $gru->nombre ?></option>
                                                <?php endforeach ?>
                                            </select>                        
                                        </div>

                                        <div class="row mt-4 w-100">                                          
                                            <label for="cat">Categoría</label>
                                            <select class="form-control ms-2" name="cat" id="cat" required>
                                                <option value=""></option>
                                                <?php foreach ($datos['categorias'] as $cat) : ?>
                                                    <option value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nombre ?></option>
                                                <?php endforeach ?>
                                            </select>                                          
                                        </div>
                                        
                                        <div class="row">
                                        <div class="col d-flex align-items-center mt-5">
                                            <label class="me-3">Consiento la toma y el uso de fotos</label>
                                            <input type="radio" id="siFotos" name="fotos" value="si" required><label for="siFotos">&nbspSI</label><span style="margin-left: 20px;"></span>
                                            <input type="radio" id="noFotos" name="fotos" value="no" required><label for="noFotos">&nbspNO</label>                 
                                        </div>
                                        </div>
                                     
                                        <div class="row">
                                        <div class="col d-flex align-items-center mt-3">
                                            <label class="me-3">He leido y acepto el reglamento</label>
                                            <input type="radio" id="siReglamento" name="reglamento" value="si" required><label for="siReglamento">&nbspSI</label>                        
                                        </div>
                                        </div> -->

                                        <!-- <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mt-3 mb-5">
                                            <label class="mb-2" for="imagen">Foto reciente tamaño carnet</label>
                                            <input type="file" id="imagen" name="imgCarnet" accept="image/*" required>
                                        </div> 
                                        </div> -->
                                        
                                        <div class="row justify-content-center">
                                            <input type="submit" id="confirmar" class="btn w-25 " value="Confirmar">
                                        </div>

                                    </form>
                                </div>
                           
                        </div>

                        
                        <div class="col-6 col-xs-12 col-md-6 " style="width:500px">
                                <div id="colorMarcas" class="shadow-lg p-3 mb-3" style="height:650px; background-color:white" onmouseover="colorear(this);" onmouseleave="decolorear(this);">                               
                                    <div class="row">
                                        <div class="col-3 mt-2 ms-3 d-flex justify-content-center align-items-center " style="width:100px; height:100px; background-color:#abdbe3"><img src="<?php echo RUTA_Icon ?>eventos.png" width="60" height="60"></div>
                                        <div class="col-8"><p style="margin-top:25px;  margin-left:30px; font-size:20px">INSCRIPCION EVENTO</p></div>
                                    </div>


                                <form method="post" action="<?php echo RUTA_URL ?>/socio/ins_evento" ENCTYPE="multipart/form-data" class="card-body">
                                    <div class="row w-100 mt-4 ">                                 
                                        <label for="even">Selecciona un evento <sup>* </sup></label>
                                        <select class="form-control" name="id_evento" id="even" required>
                                            <option value=""></option>
                                            <?php foreach ($datos['eventos'] as $even) : ?>
                                                <option id="id_evento" value="<?php echo $even->id_evento ?>"><?php echo $even->nombre ?></option>
                                            <?php endforeach ?>
                                        </select>                           
                                    </div>
                                    
                                    <div class="row w-100 mt-4 ">                                
                                        <label for="even">Subir archivo pago <sup>* </sup></label>
                                                              
                                    </div>
                         

                                    <div class="row justify-content-center">
                                        <input type="submit" id="confirmar" class="btn w-25 mt-5 " value="Confirmar">
                                    </div>
                                    </form>

                                </div>
                        </div>
    </div>
</article>


 <!-- <div id="ventana" class="card card-m bg-light w-75">


    <form method="post" ENCTYPE="multipart/form-data" class="card-body">
        <div class="row">

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="cat">Categoría<sup>* </sup></label>
                <select class="form-control" name="cat" id="cat" required>
                    <option value=""></option>
                    <?php foreach ($datos['categorias'] as $cat) : ?>
                        <option value="<?php echo $cat->id_categoria ?>"><?php echo $cat->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="grup">Grupo entrenamiento<sup>*</sup></label>
                <select class="form-control" name="grup" id="grup" required>
                    <option value=""></option>
                    <?php foreach ($datos['grupos'] as $gru) : ?>
                        <option value="<?php echo $gru->id_grupo ?>"><?php echo $gru->nombre ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">Consiento la toma y el uso de fotos <sup>*</sup></label> <span style="margin-left: 10px;"></span>
                <input type="radio" id="siFotos" name="fotos" value="si" required><label for="siFotos">&nbspSI</label><span style="margin-left: 20px;"></span>
                <input type="radio" id="noFotos" name="fotos" value="no" required><label for="noFotos">&nbspNO</label>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label for="">He leido y acepto el reglamento <sup>*</sup></label> <span style="margin-left: 10px;"></span>
                <input type="radio" id="siReglamento" name="reglamento" value="si" required><label for="siReglamento">&nbspSI</label>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 mb-3 mt-3">
                <label class="mb-2" for="imagen">Foto reciente tamaño carnet <sup>* </sup></label>
                <input type="file" id="imagen" name="imgCarnet" accept="image/*" required>
            </div>       
        </div>

        <div class="row justify-content-end mb-3">
                <div class="col-1">
                    <input type="submit" id="confirmar" class="btn" value="Confirmar">
                </div>
                <div class="col-2 ps-5">
                    <a href="<?php echo RUTA_URL?>/socio">
                        <input type="button" class="btn" id="botonVolver" value="Volver">  
                    </a>
                </div>
            </div>
    </form>
    </div>  -->





    <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>


    <script src="<?php echo RUTA_URL ?>/public/js/validar.js"></script>