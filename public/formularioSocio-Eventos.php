<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Document</title>
</head>
<body>

    <form action="">

        <label for="nombre">NOMBRE</label>
        <input type="text" id="nombre" name="nombre" placeholder="NOMBRE">
        <br><br>

        <label for="apellidos">APELLIDOS</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="APELLIDOS">
        <br><br>

        <label for="dni">DNI</label>
        <input type="text" id="dni" name="dni" placeholder="DNI" onchange="return dni(dni)">
        <br><br>

        <label for="fechaNac">FECHA NACIMIENTO</label>
        <input type="date" id="fechaNac" name="fechaNac" placeholder="FECHA NACIMIENTO">
        <br><br>
      
        <label for="email">EMAIL</label>
        <input type="text" id="email" name="email" placeholder="EMAIL">
        <br><br>

        <label for="telefono">TELÉFONO</label>
        <input type="text" id="telefono" name="telefono" placeholder="TELÉFONO">
        <br><br>

        <label for="eventos">EVENTOS</label>
        <select name="eventos" id="eventos">
            <option value=""></option>

        </select>
        <br><br>

        <input type="submit" value="CONFIRMAR">

    </form>
</body>
</html>
<script>

function dni(m) {
    var dni = document.getElementById(m).value
    var letraSupuesta
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H',
        'L', 'C', 'K', 'E', 'T'
    ];
    let re = new RegExp('[0-9]{8}[A-Z]');
    var numeros = 0;

    if (re.test(dni)) {
        numeros = Number.parseInt(dni.substring(0, 8));
        letraSupuesta = letras[numeros % 23];

        if (letraSupuesta == dni.charAt(dni.length - 1)) {
            document.getElementById("error").innerHTML="";
            return true;
        } else {
            document.getElementById("error").innerHTML=" ¡LETRA DNI INCORRECTA!";
            //document.getElementById(m).setCustomValidity("'LETRA DNI INCORRECTA!");
            return false;
        }
    } else {
        document.getElementById("error").innerHTML=" ¡DNI INCORRECTO!";
        //document.getElementById(m).setCustomValidity("¡DNI INCORRECTO!");
        return false;
    }

}
</script>