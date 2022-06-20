<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>
<link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">


<div class="container">
  
        <div class="row">
            <div class="col-12"><h4 id="titulo">Mis marcas personales</h4></div>
        </div>

        <table id="tabla" class="table table-hover"> 
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
</div>
        

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>