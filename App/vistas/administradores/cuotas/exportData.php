<?php

if (count($datos['cuotas']) > 0) {
    $delimiter = ",";
    $filename = "norma_" . date('Y-m-d') . ".csv";

    //create a file pointer
    $f = fopen('php://memory', 'w');

    //set column headers
    $fields = array('Código', 'Nombre Deudor', 'IBAN', 'Importe', 'NIF-CIF', 'Linea 1 (70 caracteres)', 'Linea 2  (70 caracteres)', 'T.Adeudo', 'F.Firma', 'Titular de la cuenta cuando sea distinto del recibo -Opcional-', 'Domicilio  -Opcional -', 'Cód.Postal', 'Poblacion', 'Provincia');
    fputcsv($f, $fields, $delimiter);

    //output each row of the data, format line as csv and write to file pointer
    foreach ($datos['cuotas'] as $cuota) {
        $lineData = array($cuota->id_ingreso_cuota, $cuota->apellidos_nombre, $cuota->CCC, $cuota->importe, $cuota->dni, $cuota->concepto, $cuota->concepto, $cuota->concepto, $cuota->fecha, $cuota->apellidos_nombre, $cuota->direccion, $cuota->cod_postal, $cuota->poblacion, $cuota->provincia);
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
