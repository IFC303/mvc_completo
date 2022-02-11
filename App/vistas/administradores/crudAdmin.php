<?php require_once RUTA_APP . '/vistas/inc/header-admin-miga.php' ?>
<!--
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
-->

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