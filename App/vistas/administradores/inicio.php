<?php require_once RUTA_APP . '/vistas/inc/header.php' ?>

<div class="container">

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

        <title>Document</title>
    </head>

    <body style="background-color: #F5F5F5;">
        <div class="container-fluid min-vh-100" style="border: solid;">
            <header class="p-5 row">
                <div class="col-3"><img id="logo" src="img/logo_tragamillas.png" width="150"></div>
                <div class="col-7 text-center">
                    <h1 id="titulo" style="font-family: 'Anton',sans-serif; color: #023EF9; font: bold; letter-spacing: 5px;">ZONA DE ADMINISTRADOR</h1>
                </div>
                <div class="col-2 text-center"><img src="<?php echo RUTA_Icon ?>salirUsu.svg" alt=""></div>
            </header>

            <div class="row text-center">
                <!-- USUARIO  d-flex justify-content-center -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>

                        <div id="colorUsu" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuUsu"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                            </svg></div>
                        <p id="pUsu" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuUsu">USUARIO</p>

                    </div>
                </div>

                <!-- USUARIO  MENU-->
                <div class="offcanvas offcanvas-start" id="menuUsu">
                    <div class="offcanvas-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                        </svg>
                        <h1 class="offcanvas-title">USUARIOS</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <table>
                        <tr>
                            <td id="mUsu">ADMIN</td>
                        </tr>
                        <tr>
                            <td id="mUsu"><a href="entrenador.php">
                                    <div>ENTRENADORES</div>
                                </a></td>
                        </tr>
                        <tr>
                            <td id="mUsu">SOCIOS</td>
                        </tr>
                        <tr>
                            <td id="mUsu">TIENDAS</td>
                        </tr>
                    </table>
                    <div class="d-flex offcanvas-footer justify-content-center h-100 align-items-end">
                        <img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="img/logo_tragamillas.png">
                    </div>
                </div>

                <!-- SOLICITUDES style="border: solid; height: 100%; width: 150px;" -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorSoli" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuSol"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-file-earmark-fill" viewBox="0 0 16 16">
                                <path d="M4 0h5.293A1 1 0 0 1 10 .293L13.707 4a1 1 0 0 1 .293.707V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm5.5 1.5v2a1 1 0 0 0 1 1h2l-3-3z" />
                            </svg></div>
                        <p id="pSolici" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuSol">SOLICITUDES</p>
                    </div>
                </div>

                <!-- GRUPOS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorGrup" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuGru"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                <path fill-rule="evenodd" d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                            </svg></div>
                        <p id="pGrupo" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuGru">GRUPOS</p>
                    </div>
                </div>

                <!-- EVENTOS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorEven" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuEve"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-bicycle" viewBox="0 0 16 16">
                                <path d="M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z" />
                            </svg></div>
                        <p id="pEven" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuEve">EVENTOS</p>
                    </div>
                </div>

                <!-- LICENCIAS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorLice" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuLic"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-postcard-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm8.5.5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7ZM2 5.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5ZM2.5 7a.5.5 0 0 0 0 1H6a.5.5 0 0 0 0-1H2.5ZM2 9.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1H2.5a.5.5 0 0 1-.5-.5Zm8-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-3ZM11 8h2V6h-2v2Z" />
                            </svg></div>
                        <p id="pLicen" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuLic">LICENCIAS</p>
                    </div>
                </div>

                <!-- ENTIDADES -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorEnti" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuEnt"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-bank2" viewBox="0 0 16 16">
                                <path d="M8.277.084a.5.5 0 0 0-.554 0l-7.5 5A.5.5 0 0 0 .5 6h1.875v7H1.5a.5.5 0 0 0 0 1h13a.5.5 0 1 0 0-1h-.875V6H15.5a.5.5 0 0 0 .277-.916l-7.5-5zM12.375 6v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zm-2.5 0v7h-1.25V6h1.25zM8 4a1 1 0 1 1 0-2 1 1 0 0 1 0 2zM.5 15a.5.5 0 0 0 0 1h15a.5.5 0 1 0 0-1H.5z" />
                            </svg></div>
                        <p id="pEnti" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuEnt">ENTIDADES</p>
                    </div>
                </div>

                <!-- TEMPORADAS -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorTemp" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuTem"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-calendar3" viewBox="0 0 16 16">
                                <path d="M14 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM1 3.857C1 3.384 1.448 3 2 3h12c.552 0 1 .384 1 .857v10.286c0 .473-.448.857-1 .857H2c-.552 0-1-.384-1-.857V3.857z" />
                                <path d="M6.5 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm-9 3a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2zm3 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                            </svg></div>
                        <p id="pTemp" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuTem">TEMPORADAS</p>
                    </div>
                </div>

                <!-- FACTURACION -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorFact" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuFac"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-currency-euro" viewBox="0 0 16 16">
                                <path d="M4 9.42h1.063C5.4 12.323 7.317 14 10.34 14c.622 0 1.167-.068 1.659-.185v-1.3c-.484.119-1.045.17-1.659.17-2.1 0-3.455-1.198-3.775-3.264h4.017v-.928H6.497v-.936c0-.11 0-.219.008-.329h4.078v-.927H6.618c.388-1.898 1.719-2.985 3.723-2.985.614 0 1.175.05 1.659.177V2.194A6.617 6.617 0 0 0 10.341 2c-2.928 0-4.82 1.569-5.244 4.3H4v.928h1.01v1.265H4v.928z" />
                            </svg></div>
                        <p id="pFact" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuFac">FACTURACION</p>
                    </div>
                </div>

                <!-- MENSAJERIA -->
                <div class="col-xs-12 col-md-6 col-xl-4">
                    <div>
                        <div id="colorMens" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuMen"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                                <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                            </svg></div>
                        <p id="pMens" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuMen">MENSAJERIA</p>
                    </div>
                </div>
            </div>

        </div>



        <!-- SOLICITUDES  MENU-->
        <div class="offcanvas offcanvas-start" id="menuSol">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

        <!-- GRUPOS MENU-->
        <div class="offcanvas offcanvas-start" id="menuGru">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

        <!-- EVENTOS MENU-->
        <div class="offcanvas offcanvas-start" id="menuEve">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

        <!-- LICENCIAS MENU-->
        <div class="offcanvas offcanvas-start" id="menuLic">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

        <!-- ENTIDADES MENU-->
        <div class="offcanvas offcanvas-start" id="menuEnt">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

        <!-- TEMPORADAS MENU-->
        <div class="offcanvas offcanvas-start" id="menuTem">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

        <!-- FACTURACION MENU-->
        <div class="offcanvas offcanvas-start" id="menuFac">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

        <!-- MENSAJERIA MENU-->
        <div class="offcanvas offcanvas-start" id="menuMen">
            <div class="offcanvas-header">
                <h1 class="offcanvas-title">Heading</h1>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <p>Some text lorem ipsum.</p>
                <button class="btn btn-secondary" type="button">A Button</button>
            </div>
        </div>

</div>

<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
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