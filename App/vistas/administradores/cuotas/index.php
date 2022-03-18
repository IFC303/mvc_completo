<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div class="">
    <div class="panel">
        <div class="panel-heading">
            CSV SEPA Tragamillas
            <a href="exportData" class="btn btn-success pull-right">Exportar a CSV</a>
        </div>
        <div class="panel-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre Deudor</th>
                        <th>IBAN</th>
                        <th>Importe</th>
                        <th>NIF-CIF</th>
                        <th>Linea 1 (70 caracteres)</th>
                        <th>Linea 2 (70 caracteres)</th>
                        <th>T.Adeudo</th>
                        <th>F.Firma</th>
                        <th>Titular de la cuenta cuando sea distinto del recibo -Opcional-</th>
                        <th>Domicilio -Opcional -</th>
                        <th>Cód.Postal</th>
                        <th>Poblacion</th>
                        <th>Provincia</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    #region db
                    //include database configuration file
                    //DB details
                    $dbHost     = 'mysql';
                    $dbUsername = 'root';
                    $dbPassword = 'toor';
                    $dbName     = 'tragamillas2';

                    //Create connection and select DB
                    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

                    if ($db->connect_error) {
                        die("Unable to connect database: " . $db->connect_error);
                    }
                    #endregion

                    //get records from database
                    $query = $db->query("SELECT id_ingreso_cuota, CONCAT(apellidos, ', ', nombre) AS 'apellidos_nombre', CCC, importe, dni, concepto, concepto, tipo, fecha, concat(apellidos, ', ', nombre) as 'apellidos_nombre', direccion, direccion as 'cod. postal', direccion as 'poblacion', direccion as 'provincia' FROM I_CUOTAS NATURAL JOIN USUARIO");
                    if ($query->num_rows > 0) {
                        while ($row = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo $row['id_ingreso_cuota']; ?></td>
                                <td><?php echo $row['apellidos_nombre']; ?></td>
                                <td><?php echo $row['CCC']; ?></td>
                                <td><?php echo $row['importe']; ?></td>
                                <td><?php echo $row['dni']; ?></td>
                                <td><?php echo $row['concepto']; ?></td>
                                <td><?php echo $row['concepto']; ?></td>
                                <td><?php echo $row['tipo']; ?></td>
                                <td><?php echo $row['fecha']; ?></td>
                                <td><?php echo $row['apellidos_nombre']; ?></td>
                                <td><?php echo $row['direccion']; ?></td>
                                <td><?php echo $row['cod. postal']; ?></td>
                                <td><?php echo $row['poblacion']; ?></td>
                                <td><?php echo $row['provincia']; ?></td>
                            </tr>
                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="5">No member(s) found.....</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>