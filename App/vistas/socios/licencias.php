<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>
<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">


<div class="container">
  
        <div class="row">
            <div class="col-12"><h4 id="titulo">Mis licencias</h4></div>
        </div>


        <table id="tabla" class="table table-hover"> 
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
            <tbody class="table-light">               
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
  </div>      


<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
