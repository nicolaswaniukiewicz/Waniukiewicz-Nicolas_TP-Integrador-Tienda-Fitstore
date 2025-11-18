<?php
// index.php
require 'config.php'; // si querés usar la BD después
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FitStore — Tienda</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>

<body>
  <header class="header">
    <a href="index.php"><img class="header__logo" src="img/logo_header.png" alt="logotipo FitStore"></a>
    <button id="modo-toggle" class="theme-toggle" aria-label="Cambiar tema" title="Cambiar tema">
      <span class="icon sun" aria-hidden="true">🌞</span>
      <span class="icon moon" aria-hidden="true">🌙</span>
      <span class="knob" aria-hidden="true"></span>
    </button>
  </header>

  <nav class="navegacion">
  <a class="navegacion__enlace" href="index.php">Tienda</a>
  <a class="navegacion__enlace" href="listado_box.php#contenido">Catálogo</a>
  <a class="navegacion__enlace" href="comprar.php#contenido">Comprar</a>
  <a class="navegacion__enlace" href="carrito.php">Carrito</a>
  <a class="navegacion__enlace" href="publicar_producto.php#contenido">Publicar producto</a>
   <a class="navegacion__enlace" href="#" onclick="logoutAndGoHome(); return false;">
    Cerrar sesión
  </a>
</nav>


  <main class="contenedor">
  <h1>Bienvenido a FitStore</h1>
  <p class="intro">Tu tienda de accesorios de entrenamiento. Calidad y resistencia al mejor precio.</p>

  <h2>Productos destacados</h2>
  <div class="grid">
    <div class="producto">
      <a href="producto.php?id=1">
        <img class="producto__imagen" src="img/almohadilla.jpg" alt="almohadilla">
        <div class="producto__informacion">
          <p class="producto__nombre">Almohadilla para Barras Olímpicas</p>
          <p class="producto__precio">$20.000</p>
        </div>
      </a>

    </div>
    <div class="producto">
      <a href="producto.php?id=2">
        <img class="producto__imagen" src="img/muñequera.jpg" alt="muñequera">
        <div class="producto__informacion">
          <p class="producto__nombre">Muñequeras Nike PRO</p>
          <p class="producto__precio">$35.000</p>
        </div>
      </a>
    </div>

    <div class="producto">
      <a href="producto.php?id=3">
        <img class="producto__imagen" src="img/ruedita.jpg" alt="ruedita">
        <div class="producto__informacion">
          <p class="producto__nombre">Rueda abdominal</p>
          <p class="producto__precio">$15.200</p>
        </div>
      </a>
    </div>
  </div>

  <div class="catalogo">
    <a class="navegacion__enlace" href="listado_box.php">Ver catálogo completo</a>
  </div>

</main>

  <footer class="footer">
    <p class="footer__texto">FitStore - Todos los derechos reservados 2025.</p>
  </footer>
  
  <script src="js/modo.js"></script>
  <script src="js/auth.js"></script>
  <script>
   requireAuth();
  </script>
</body>
</html>