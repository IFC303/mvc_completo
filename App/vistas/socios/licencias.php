<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>


    <!------------------------------ CABECERA -------------------------------->
        <header>
            <div class="row mb-5">
                <div class="col-10 d-flex align-items-center justify-content-center">
                    <span id="textoHead">Visualizacion de licencias</span>
                </div>
                <div class="col-2 mt-2">
                    <a type="button" id="botonLogout" class="btn" href="<?php echo RUTA_URL ?>/login/logout">
                        <span>Logout</span>
                        <img class="ms-2" src="<?php echo RUTA_Icon ?>logout.png">
                    </a>
                </div>
            </div>                                   
        </header>
    <!----------------------------------------------------------------------->


        <article>
            <table id="tabla" class="table"> 
                <!--CABECERA TABLA-->
                <thead>
                    <tr>
                        <th>Numero</th>  
                        <th>GIR</th>
                        <th>Tipo</th>
                        <th>Autonomica/Nacional</th>      
                        <th>Dorsal</th>
                        <th>Fecha caducidad</th>
                        <th>Imagen</th>                                                
                    </tr>
                </thead>

                <!--BODY TABLA-->
                <tbody>               
                    <?php foreach ($datos['usuarios'] as $licencias) :?>
                        <tr>
                            <td class="datos_tabla"><?php echo $licencias->num_licencia?></td>
                            <td class="datos_tabla"><?php echo $licencias->gir?></td>
                            <td class="datos_tabla"><?php echo $licencias->tipo?></td>
                            <td class="datos_tabla"><?php echo $licencias->regional_nacional?></td>
                            <td class="datos_tabla"><?php echo $licencias->dorsal?></td>
                            <td class="datos_tabla"><?php echo $licencias->fecha_cad?></td>
                            <td class="datos_tabla"><?php if ($licencias->imagen==''){echo '-';}else {?><a href="<?php echo RUTA_URL?>/Socio/verFoto/<?php echo $licencias->id_licencia?>" target="_blank"><img width="30" height="30" src="<?php echo RUTA_ImgDatos.'licencias/'.$licencias->imagen?>"></a><?php ;}?></td>
                        </tr>                   
                    <?php endforeach ?>                
                </tbody>            
            </table>
        </article>

                

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
