<?php require_once RUTA_APP . '/vistas/inc/header-admin.php' ?>



<div class="row text-center">

    <!-- USUARIO  d-flex justify-content-center -->
    <div class="col-xs-12 col-md-6 col-xl-4">
        <div>

            <div id="colorUsu" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuUsu">
                <img src="<?php echo RUTA_Icon ?>usuario.svg" width="100" height="100">
            </div>
            <p id="pUsu" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuUsu">USUARIO</p>

        </div>
    </div>

    <!-- USUARIO  MENU-->
    <div class="offcanvas offcanvas-start" id="menuUsu">
        <div class="offcanvas-header">
            <img src="<?php echo RUTA_Icon ?>usuario.svg" width="50" height="50">
            <h1 class="offcanvas-title">USUARIOS</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <ul id="mUsu">
            <li id="mUsu">
                <a href="<?php echo RUTA_URL ?>/admin/crud_admin" class="nav-link">ADMIN</a>
            </li>
            <li id="mUsu">
                <a href="<?php echo RUTA_URL ?>/admin/crud_entrenadores" class="nav-link ">ENTRENADORES</a>
            </li>
            <li id="mUsu">
                <a href="<?php echo RUTA_URL ?>/admin/crud_socios" class="nav-link ">SOCIOS</a>
            </li>
            <li id="mUsu">
                <a href="<?php echo RUTA_URL ?>/admin/crud_tiendas" class="nav-link ">TIENDAS</a>
            </li>
        </ul>
        <div class="d-flex offcanvas-footer justify-content-center h-100 align-items-end">
            <img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png">
        </div>
    </div>

    <!-- SOLICITUDES -->
    <div class=" col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorSoli" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuSol">
                <img src="<?php echo RUTA_Icon ?>solicitudes.svg" width="100" height="100">
            </div>
            <p id="pSolici" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuSol">SOLICITUDES</p>
        </div>
    </div>

    <!-- SOLICITUDES  MENU-->
    <div class="offcanvas offcanvas-start" id="menuSol">
        <div class="offcanvas-header">
            <img src="<?php echo RUTA_Icon ?>solicitudes.svg" width="50" height="50">
            <h1 class="offcanvas-title">SOLICITUDES</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <ul id="mSol">
            <li id="mUsu">
                <a href="#" class="nav-link">SOCIOS</a>
            </li>
            <li id="mUsu">
                <a href="#" class="nav-link ">GRUPOS</a>
            </li>
            <li id="mUsu">
                <a href="#" class="nav-link ">EVENTOS</a>
            </li>
        </ul>
        <div class="d-flex offcanvas-footer justify-content-center h-100 align-items-end"><img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png"></div>
    </div>

    <!-- GRUPOS -->
    <div class=" col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorGrup" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">
                <img src="<?php echo RUTA_Icon ?>grupos.svg" width="100" height="100">
            </div>
            <p id="pGrupo" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">GRUPOS</p>
        </div>
    </div>

    <!-- EVENTOS -->
    <div class="col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorEven" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">
                <img src="<?php echo RUTA_Icon ?>eventos.svg" width="100" height="100">
            </div>
            <p id="pEven" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">EVENTOS</p>
        </div>
    </div>

    <!-- LICENCIAS -->
    <div class="col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorLice" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">
                <img src="<?php echo RUTA_Icon ?>licencias.svg" width="100" height="100">
            </div>
            <p id="pLicen" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">LICENCIAS</p>
        </div>
    </div>

    <!-- ENTIDADES -->
    <div class="col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorEnti" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">
                <img src="<?php echo RUTA_Icon ?>entidad.svg" width="100" height="100">
            </div>
            <p id="pEnti" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">ENTIDADES</p>
        </div>
    </div>

    <!-- TEMPORADAS -->
    <div class="col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorTemp" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">
                <img src="<?php echo RUTA_Icon ?>temporadas.svg" width="100" height="100">
            </div>
            <p id="pTemp" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#">TEMPORADAS</p>
        </div>
    </div>

    <!-- FACTURACION -->
    <div class="col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorFact" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuFac">
                <img src="<?php echo RUTA_Icon ?>euro.svg" width="100" height="100">
            </div>
            <p id="pFact" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuFac">FACTURACION</p>
        </div>
    </div>

    <!-- FACTURACION  MENU-->
    <div class="offcanvas offcanvas-start" id="menuFac">

        <!-- <div class="offcanvas-header">
            <div class="container-fluid" style="padding: 0;">
                <div class="row d-flex w-100 justify-content-end"><button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button></div>
                <div class="row d-flex w-100 justify-content-center">
                    <div class="col-2"><img src="<?php //echo RUTA_Icon 
                                                    ?>euro.svg" width="50" height="50"></div>
                    <div class="col-10"><h1 class="offcanvas-title">FACTURACION</h1></div>
                </div>
            </div>
        </div> -->
        <div class="offcanvas-header">
            <img src="<?php echo RUTA_Icon ?>euro.svg" width="50" height="50">
            <h1 class="offcanvas-title">FACTURACION</h1>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <table>
            <tr>
                <td id="mUsu"><a href="#">
                        <div>INGRESOS</div>
                    </a></td>
            </tr>

            <tr>
                <td id="mUsu"><a href="#">
                        <div>GASTOS</div>
                    </a></td>
            </tr>
        </table>
        <div class="d-flex offcanvas-footer justify-content-center h-100 align-items-end"><img class="mi-imagen-abajo-derecha img-fluid w-50" id="logo" src="<?php echo RUTA_Foto ?>/logo_tragamillas.png"></div>
    </div>

    <!-- MENSAJERIA -->
    <div class="col-xs-12 col-md-6 col-xl-4">
        <div>
            <div id="colorMens" class="caja mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuMen">
                <img src="<?php echo RUTA_Icon ?>mensajeria.svg" width="100" height="100">
            </div>
            <p id="pMens" class="mx-auto" data-bs-toggle="offcanvas" data-bs-target="#menuMen">MENSAJERIA</p>
        </div>
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