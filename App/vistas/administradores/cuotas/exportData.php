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
$query = $db->query("SELECT id_ingreso_cuota AS Código, CONCAT(apellidos, ', ', nombre) AS 'Nombre Deudor', CCC AS IBAN, Importe, dni AS 'NIF-CIF', concepto AS 'Linea 1 (70 caracteres)', concepto AS 'Linea 2  (70 caracteres)', tipo AS 'T.Adeudo', fecha AS 'F.Firma', concat(apellidos, ', ', nombre) as 'Titular de la cuenta cuando sea distinto del recibo -Opcional-', direccion as 'Domicilio  -Opcional -', direccion as 'Cód.Postal', direccion as 'Poblacion', direccion as 'Provincia' FROM I_CUOTAS NATURAL JOIN USUARIO");

if ($query->num_rows > 0) {
    $delimiter = ",";
    $filename = "norma_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('Código', 'Nombre Deudor', 'IBAN', 'Importe', 'NIF-CIF', 'Linea 1 (70 caracteres)', 'Linea 2  (70 caracteres)', 'T.Adeudo', 'F.Firma', 'Titular de la cuenta cuando sea distinto del recibo -Opcional-', 'Domicilio  -Opcional -', 'Cód.Postal', 'Poblacion', 'Provincia');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    while ($row = $query->fetch_assoc()) {
        // $status = ($row['status'] == '1')?'Active':'Inactive';
        $lineData = array($row['Código'], $row['Nombre Deudor'], $row['IBAN'], $row['Importe'], $row['NIF-CIF'], $row['Linea 1 (70 caracteres)'], $row['Linea 2  (70 caracteres)'], $row['T.Adeudo'], $row['F.Firma'], $row['Titular de la cuenta cuando sea distinto del recibo -Opcional-'], $row['Domicilio  -Opcional -'], $row['Cód.Postal'], $row['Poblacion'], $row['Provincia']);
        fputcsv($f, $lineData, $delimiter);
    }

    //move back to beginning of file
    fseek($f, 0);

    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
}
exit;
