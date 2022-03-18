<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="<?php echo RUTA_URL ?>/public/css/estilos.css">
    <!-- <link rel="stylesheet" href="css/estilos.css"> -->


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">

    <title><?php echo NOMBRE_SITIO ?></title>

    <style>
        /*modal javascript */

        .modalVer {
            display: none;
            position: fixed;
            z-index: 1;
            padding: 100px 100px 0px 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modalVer .modal-content {
            width: 50%;
            margin: auto;
        }

        #modalEditar {
            width: 50%;
            margin: auto;
        }

        .modal-title {
            color: #023ef9;
        }

        label {
            color: #023ef9;
        }

        a {
            text-decoration: none;
            color: black;
        }

        /*ESTILOS TABLA */

        .tabla {
            border: solid 1px #023ef9;
            width: 60%;
            margin: auto;
        }

        thead tr {
            background-color: #023ef9;
            color: white;
            text-align: center;
        }

        .datos_tabla {
            text-align: center;
        }

        .icono {
            width: 20px;
            height: 20px;
        }


        #headerVer h2 {
            padding: 30px;
            color: #023ef9;
        }

        #añadir {
            color: white;
        }

        .btn {
            background-color: #ffe193;
            color: white;
        }

        #titulo {
            font-family: 'Anton', sans-serif;
            color: #023ef9;
            letter-spacing: 5px;
        }
    </style>

</head>

<body>
    <div class="container">
        <div class="panel">
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Nombre Deudor</th>
                            <th>IBAN</th>
                            <th>Importe</th>
                            <th>NIF-CIF</th>
                            <th>Linea 1</th>
                            <th>Linea 2</th>
                            <th>T.Adeudo</th>
                            <th>F.Firma</th>
                            <th>Titular</th>
                            <th>Domicilio</th>
                            <th>Cód.Postal</th>
                            <th>Poblacion</th>
                            <th>Provincia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($datos['cuotas'] as $cuota) : ?>
                            <tr>
                                <td class="datos_tabla"><?php echo $cuota->id_ingreso_cuota ?></td>
                                <td class="datos_tabla"><?php echo $cuota->apellidos_nombre ?></td>
                                <td class="datos_tabla"><?php echo $cuota->CCC ?></td>
                                <td class="datos_tabla"><?php echo $cuota->importe ?></td>
                                <td class="datos_tabla"><?php echo $cuota->dni ?></td>
                                <td class="datos_tabla"><?php echo $cuota->concepto ?></td>
                                <td class="datos_tabla"><?php echo $cuota->concepto ?></td>
                                <td class="datos_tabla"><?php echo $cuota->tipo ?></td>
                                <td class="datos_tabla"><?php echo $cuota->fecha ?></td>
                                <td class="datos_tabla"><?php echo $cuota->apellidos_nombre ?></td>
                                <td class="datos_tabla"><?php echo $cuota->direccion ?></td>
                                <td class="datos_tabla"><?php echo $cuota->cod_postal ?></td>
                                <td class="datos_tabla"><?php echo $cuota->poblacion ?></td>
                                <td class="datos_tabla"><?php echo $cuota->provincia ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel">
            <?php echo $this->datos['paginator']->createLinks($this->links, 'pagination') ?>
            <h4 id="titulo" class="pagination">
                <a href="exportData" class="btn">Exportar a CSV</a>
            </h4>
        </div>
    </div>