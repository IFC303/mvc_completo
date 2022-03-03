<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

<div class="tabla" style="border:solid 1px #023ef9">

        <table class="table table-hover">


                <!--CABECERA TABLA-->
                <thead>
                        <tr style="background-color:#023ef9; color:white;">
                                <th>ID</th>
                                <th>NOMBRE</th>
                                <th>APELLIDOS</th>
                                <th>EMAIL</th>
                                <th>TELEFONO</th>
                                <th>HA SIDO SOCIO</th>
                                <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                        <th>Acciones</th>
                                <?php endif ?>
                        </tr>
                </thead>


                <tbody class="table-light">

                        <?php foreach ($datos['soliSocio'] as $usuarios) : ?>
                                <tr>
                                        <td><?php echo $usuarios->id_solicitud_soc ?></td>
                                        <td><?php echo $usuarios->nombre ?></td>
                                        <td><?php echo $usuarios->apellidos ?></td>
                                        <td><?php echo $usuarios->email ?></td>
                                        <td><?php echo $usuarios->telefono ?></td>
                                        <td><?php if($usuarios->es_socio==1){echo "SI";}elseif($usuarios->es_socio==0){echo "NO";}else{echo "";} ?></td>


                                        <?php if (tienePrivilegios($datos['usuarioSesion']->id_rol, [1])) : ?>
                                                <td>
                                                        hola
                                                </td>
                                        <?php endif ?>
                                </tr>
                        <?php endforeach ?>
                </tbody>

        </table>


        <!-- AÑADIR-->
        <div class="col text-center">
                <a class="btn" style="background-color: #023ef9; color:white" href="<?php echo RUTA_URL ?>/admin/nuevoUsuario/<?php echo $datos['idTengo'] ?>">Añadir</a>
        </div>
        <br>

</div>
<script>
        function abrir(idAbrir) {
                console.log(idAbrir);
                var modal = document.getElementById(idAbrir);
                var body = document.getElementsByTagName("body")[0];
                modal.style.display = "block"; 
                body.style.overflow = "hidden";
        }

        function cerrar(idCerrar) {
                var modal = document.getElementById(idCerrar);
                var body = document.getElementsByTagName("body")[0];
                modal.style.display = "none";
                body.style.overflow = "visible";
        }
</script>

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>