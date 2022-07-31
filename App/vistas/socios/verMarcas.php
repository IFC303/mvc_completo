<?php require_once RUTA_APP . '/vistas/inc/nav.php' ?>

        <header>              
            <div class="row">
                <div class="col-10"><span id="tHead">Mis marcas</span></div>     
                <div class="col-2">
                    <a type="button" class="btn" style="background-color:#0b2a85" href="<?php echo RUTA_URL ?>/login/logout">
                        <span style="font-size:25px;color:white">Logout</span>
                        <img class="ms-2" id="salirHeader" src="<?php echo RUTA_Icon ?>logout.png" style="width:35px;height:35px" >
                    </a>
                </div>
            </div>                                 
        </header>


        <article>
            <table id="tabla" class="table"> 
                <!--CABECERA TABLA-->
                <thead>
                    <tr>
                        <th>Nombre test</th>  
                        <th>Prueba</th>
                        <th>Fecha</th>
                        <th>Marca</th>                                                    
                    </tr>
                </thead>
                <!--BODY TABLA-->
                <tbody>               
                    <?php foreach ($datos['usuarios'] as $marcas) :?>
                        <tr>
                            <td class="datos_tabla"><?php echo $marcas->nombreTest?></td>
                            <td class="datos_tabla"><?php echo $marcas->tipo.' ('.$marcas->nombrePrueba.')'?></td>
                            <td class="datos_tabla"><?php echo $marcas->fecha?></td>
                            <td class="datos_tabla"><?php echo $marcas->marca?></td>
                        </tr>                   
                    <?php endforeach ?>                
                </tbody>           
            </table>     
        </article>
        

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>