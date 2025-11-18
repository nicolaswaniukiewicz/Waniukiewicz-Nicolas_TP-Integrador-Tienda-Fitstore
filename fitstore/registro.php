<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FitStore — Crear Cuenta</title>
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/styles.css"/>
</head>

<body>
  <header class="header">
    <a href="index.php"><img class="header__logo" src="img/logo_header.png" alt="logo"></a>
  </header>

  <main class="contenedor">
    <h2>Crear Cuenta</h2>

    <form id="register-form" class="login-form">
      <div class="input-group">
        <input type="text" id="name" name="name" placeholder="Nombre Completo" required>
      </div>
      <div class="input-group">
        <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
      </div>
      <div class="input-group">
        <input type="password" id="password" name="password" placeholder="Contraseña" required>
      </div>
      <div class="input-group">
        <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirmar Contraseña" required>
      </div>

      <button type="submit" class="btn-login">Crear Cuenta</button>
    </form>

    <p class="create-account">¿Ya tienes cuenta? 
      <a href="login.php" class="create-account-link">Inicia sesión aquí</a>
    </p>
  </main>

  <footer class="footer">
    <p class="footer__texto">FitStore - Todos los derechos reservados 2025.</p>
  </footer>

  <script src="js/registro.js"></script>
  <script src="js/auth.js"></script>
</body>
</html>