<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FitStore — Iniciar Sesión</title>
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/styles.css"/>
</head>

<body class="login-body">
  <div class="login-container">
  <h2>Iniciar sesión</h2>
  <form id="login-form" class="login-form">
    <div class="input-group">
      <input type="email" id="email" name="email" placeholder="Correo Electrónico" required>
        </div>
        <div class="input-group">
      <input type="password" id="password" name="password" placeholder="Contraseña" required>
        </div>
        <button type="submit" class="btn-login">Iniciar sesión</button>
        </form>
        <p class="create-account">¿No tienes cuenta? 
          <a href="registro.php" class="create-account-link">Crea una aquí</a>
        </p>
    </div>

  <script src="js/login.js"></script>
  <script src="js/auth.js"></script>
</body>
</html>