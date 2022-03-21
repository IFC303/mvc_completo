<?php require_once RUTA_APP . '/vistas/inc/header-socio-paginas.php' ?>


        <div  style="border:solid 1px #023ef9; height: 1%">
        <table class="table table-striped text-center" style = "margin: 0px;"> 
            <thead class="cabezera">
                <tr>
                        <th scope="col">#</th>
                        <th scope="col">Prueba</th>
                        <th scope="col">Tipo prueba</th>
                        <th scope="col">Marca</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Tipo Test</th>
                
                </tr>
            </thead>
            <tbody>
                
                <?php $contador = 0 ;
                foreach ($datos['usuarios'] as $marcas) : ?>
                    <?php $contador = $contador +1; ?>
                    <tr>
                        <td scope="row"><?php echo $contador ?></td>
                        <td scope="col"><?php if ($marcas->nombrePrueba==''){echo '-';}else {echo $marcas->nombrePrueba;}?></td>
                        <td scope="col"><?php if ($marcas->tipo==''){echo '-';}else {echo $marcas->tipo;}?></td>
                        <td scope="col"><?php if ($marcas->marca==''){echo '-';}else {echo $marcas->marca;}?></td>
                        <td scope="col"><?php if ($marcas->fecha==''){echo '-';}else {echo $marcas->fecha;}?></td>
                        <td scope="col"><?php if ($marcas->nombreTest==''){echo '-';}else {echo $marcas->nombreTest;}?></td>
                    </tr>
                    
                <?php endforeach ?>
                
            </tbody>
            
        </table>
    
        </div>
        
        <?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>