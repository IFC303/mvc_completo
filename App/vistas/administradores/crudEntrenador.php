<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anton&family=Doppio+One&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    <title>Document</title>
</head>

<body style="background-color: #F5F5F5;">
    <div class="container-fluid min-vh-100" style="border: solid;">
        <header class="p-5 row">
            <div class="col-3"><img id="logo" src="img/logo_tragamillas.png" width="150"></div>
            <div class="col-7 text-center">
                <h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px;">ZONA DE ADMINISTRADOR</h1>

                <div class="perspective">
                    <svg>
                        <defs>
                            <filter id="drop-shadow" width="200%" height="200%">
                                <feMerge>
                                    <feMergeNode />
                                    <feMergeNode in="SourceGraphic" />
                                </feMerge>
                            </filter>
                        </defs>
                    </svg>

                    <div class="breadcrumb-item breadcrumb-active">
                        <svg>
                            <polygon class="breadcrumb-arrow" points="0,0, 20,15, 0,30, 150,30, 170, 15, 150,0">
                                <text dx="90" dy="22" text-anchor="middle"> Lorema </text>
                        </svg>
                    </div>
                    <div class="breadcrumb-item">
                        <svg>
                            <polygon class="breadcrumb-arrow" points="0,0, 20,15, 0,30, 150,30, 170, 15, 150,0">
                                <text dx="90" dy="22" text-anchor="middle"> 2222 </text>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="col-2 text-center"><svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-person-x-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm6.146-2.854a.5.5 0 0 1 .708 0L14 6.293l1.146-1.147a.5.5 0 0 1 .708.708L14.707 7l1.147 1.146a.5.5 0 0 1-.708.708L14 7.707l-1.146 1.147a.5.5 0 0 1-.708-.708L13.293 7l-1.147-1.146a.5.5 0 0 1 0-.708z" />
                </svg></div>
        </header>

        <div class="row text-center">



        </div>

    </div>

</body>

</html>


<script>
    window.onload = function() {
        vOpciones = [
            ["pUsu", "colorUsu"],
            ["pSolici", "colorSoli"],
            ["pGrupo", "colorGrup"],
            ["pEven", "colorEven"],
            ["pLicen", "colorLice"],
            ["pEnti", "colorEnti"],
            ["pTemp", "colorTemp"],
            ["pFact", "colorFact"],
            ["pMens", "colorMens"]
        ];

        for (let i = 0; i < vOpciones.length; i++) {
            var elemento = document.getElementById(vOpciones[i][0]);
            var elemento2 = document.getElementById(vOpciones[i][1]);
            elemento.onmouseover = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#FFBF1C';
            };
            elemento.onmouseout = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#F5F5F5';
            };
            elemento2.onmouseover = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#FFBF1C';
            };
            elemento2.onmouseout = function(e) {
                document.getElementById(vOpciones[i][1]).style.backgroundColor = '#F5F5F5';
            };
            /*elemento.onclick = function(e) {
                location.href="http://www.elmiradordelaserrania.com"
            };
            elemento2.onclick = function(e) {
                location.href="http://www.elmiradordelaserrania.com"
            };*/

        }

    }
</script>