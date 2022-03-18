<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
    <script src="js/validar.js"></script>

    <style>
        label[id^="error"] {
            color: red;
            font-size: 15px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

    </style>

</head>


<body>

    <form action="" onsubmit="return validar()">

        <label for="nombre">NOMBRE</label>
        <input type="text" id="nombre" name="nombre" placeholder="NOMBRE" required>
        <br><br>

        <label for="apellidos">APELLIDOS</label>
        <input type="text" id="apellidos" name="apellidos" placeholder="APELLIDOS" required>
        <br><br>

        <label for="dni">DNI</label>
        <input type="text" id="dniSoc" name="dniSoc" placeholder="DNI" onchange="return dni(this.id)" required><label for="" id="error"></label>
        <br><br>

        <label for="fechaNac">FECHA NACIMIENTO</label>
        <input type="date" id="fechaNac" name="fechaNac" placeholder="FECHA NACIMIENTO" required>
        <br><br>
      
        <label for="email">EMAIL</label>
        <input type="text" id="emailSoc" name="emailSoc" placeholder="EMAIL" onblur="return correo(this.id)" required><label for="" id="errorMail"></label>
        <br><br>

        <label for="telefono">TELÉFONO</label>
        <input type="text" id="telefono" name="telefono" placeholder="TELÉFONO" maxlength="9" onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;" required>
        <br><br>

        <label for="eventos">EVENTOS</label>
        <select name="eventos" id="eventos" required>
            <option value=""></option>
            <option value="1">a</option>

        </select>
        <br><br>

        <input type="submit" value="CONFIRMAR"  readonly>

    </form>
</body>
</html>
