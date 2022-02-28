<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>Login</title>
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/assets/fonts/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/assets/css/Login-Form-Dark.css">
  <link rel="stylesheet" href="<?php echo RUTA_URL ?>/assets/css/styles.css">
</head>

<body>
  <section class="login-dark">
    <form method="post">
      <h2 class="visually-hidden">Login Form</h2>
      <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>

      <div class="mb-3">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="Email" required>
      </div>
      <div class="mb-3">
        <input type="password" name="passw" class="form-control" id="passw" placeholder="Password" required>
      </div>
      <div class="mb-3">
        <input type="submit" class="btn btn-primary d-block w-100" value="Login">
      </div>
    </form>

    <?php if (isset($datos['error']) && $datos['error'] == 'error_1') : ?>

      <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
          <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
      </svg>

      <div class="alert alert-danger d-flex align-items-center" role="alert">
        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
          <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
          Intentelo de nuevo. <strong>El Email y la contraseña no coinciden</strong>
        </div>
      </div>

    <?php endif ?>
  </section>
  <script src="<?php echo RUTA_URL ?>/assets/bootstrap/js/bootstrap.min.js"></script>
</body>
<?php require_once RUTA_APP . '/vistas/inc/footer.php' ?>
