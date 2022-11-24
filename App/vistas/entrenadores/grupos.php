<?php require_once RUTA_APP . '/vistas/inc/navE.php' ?>

      
    <!------------------------------ CABECERA -------------------------------->
    <header>
        <div class="row mb-5">
            <div class="col-10 d-flex align-items-center justify-content-center ">
                <span id="textoHead">Grupos de entrenamiento</span>
            </div>
            <div class="col-2 mt-1">
                <a href="<?php echo RUTA_URL ?>/login/logout">
                    <button class="btn" id="btn_logout"><img class="me-2" src="<?php echo RUTA_Icon ?>logout.png">Logout</button>
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
                            <th>GRUPO</th>
                            <th>DIAS / HORAS ENTRENAMIENTO</th>

                        </tr>
                    </thead>


                    <!--BODY TABLA-->
                    <tbody>
                        <?php foreach ($datos['info_grupos'] as $todos) : ?>
                            <tr>
                                <td><?php echo $todos->nombre ?></td>
                                <td><?php 
                                    $tam=sizeof($datos['horarios_grupos']);
                                    for ($i=0; $i<$tam;$i++){
                                        if($todos->id_grupo==$datos['horarios_grupos'][$i]->id_grupo){
                                            echo $datos['horarios_grupos'][$i]->dia_sem.' ('.$datos['horarios_grupos'][$i]->hora_ini.'-'.$datos['horarios_grupos'][$i]->hora_fin.') ;  '; 
                                        } 
                                    }
  
                                ?>
                                </td>
 
                                <td><a href="<?php echo RUTA_URL?>/entrenador/alumnos/<?php echo $todos->id_grupo?>">
                                    <button type="button" class="btn" id="botonVolver">
                                         Atletas
                                    </button>
                                </a></td>



                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
</article>


