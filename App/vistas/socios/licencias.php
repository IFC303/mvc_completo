<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>

<div class="container">
        <div  style="border:solid 1px #023ef9;">
        <table class="table table-striped text-center" style = "margin: 0px;"> 
            <thead class="cabezera">
                <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nº LICENCIA</th>
                        <th scope="col">GIR</th>
                        <th scope="col">TIPO_LICENCIA</th>
                        <th scope="col">AUTONÓMICA/NACIONAL</th>
                        <th scope="col">DORSAL</th>
                        <th scope="col">FECHA_CADUCIDAD</th>
                        <th scope="col">IMÁGEN_LICENCIA</th>
                
                </tr>
            </thead>
            <tbody>
                
                <?php $contador = 0 ;
                foreach ($datos['usuarios'] as $licencias) : ?>
                    <?php $contador = $contador +1; ?>
                    <tr>
                        <td scope="row"><?php echo $contador ?></td>
                        <td scope="col"><?php if ($licencias->num_licencia==''){echo '-';}else {echo $licencias->num_licencia;}?></td>
                        <td scope="col"><?php if ($licencias->gir=='' || !($licencias->num_licencia=='')){echo '-';}else {echo $licencias->gir;}?></td>
                        <td scope="col"><?php if ($licencias->tipo==''){echo '-';}else {echo $licencias->tipo;}?></td>
                        <td scope="col"><?php if ($licencias->regional_nacional==''){echo '-';}else {echo $licencias->regional_nacional;}?></td>
                        <td scope="col"><?php if ($licencias->dorsal==''){echo '-';}else {echo $licencias->dorsal;}?></td>
                        <td scope="col"><?php if ($licencias->fecha_cad==''){echo '-';}else {echo $licencias->fecha_cad;}?></td>
                        <td title="Ver licencia" scope="col"><?php if ($licencias->imagen==''){echo '-';}else {?><a href="<?php echo RUTA_URL?>/Socio/verFoto/<?php echo $licencias->id_licencia?>" target="_blank"><img width="30" height="30" src="<?php echo RUTA_ImgDatos.'licencias/'.$licencias->imagen?>"></a><?php ;}?></td>
                    </tr>
                    
                <?php endforeach ?>
                
            </tbody>
            
        </table>
        
        <!-- AÑADIR -->
        <!-- <div class="col text-center">
                <a class="btn" style="background-color: #023ef9; color:white; margin-top: 0.5cm;" href="<?php echo RUTA_URL ?>/socio/nuevaLicencia">Añadir</a>
        </div>
        <br> -->

        </div>
  </div>      


        <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
