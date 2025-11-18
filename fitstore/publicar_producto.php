<?php
require 'config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Publicar producto — FitStore</title>
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <header class="header">
    <a href="index.php"><img class="header__logo" src="img/logo_header.png" alt="logo"></a>
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
    <a class="navegacion__enlace navegacion__enlace--activo" href="publicar_producto.php#contenido">Publicar producto</a>
    <a class="navegacion__enlace" href="#" onclick="logoutAndGoHome(); return false;">
    Cerrar sesión
  </a>
  </nav>

  <main id="contenido" class="contenedor">
    <h1>Publicar un producto</h1>

    <!-- Formulario para publicar producto -->
    <form action="guardar_producto.php" method="post" enctype="multipart/form-data">

      <div class="input-group">
        <label for="titulo">Título del producto</label>
        <input type="text" id="titulo" name="titulo" placeholder ="Ej: Mancuerna 30kg" required>
      </div>

      <div class="input-group">
        <label for="descripcion">Descripción</label>
        <textarea id="descripcion" name="descripcion"
            class="textarea-descripcion"
            rows="3"
            placeholder="Escribí una breve descripción del producto"></textarea>
      </div>

      <div class="input-group">
        <label for="precio">Precio</label>
        <input type="number" id="precio" name="precio" step="0.01" min="0" placeholder="Ej: 5000" required>
      </div>

      <div class="input-group">
        <label for="imagen">Imagen del producto</label>
        <input type="file" id="imagen" name="imagen"
         class="file-input"
         accept="image/*">
          <small class="form-hint">Subí una foto de tu producto (JPG, PNG, etc.).</small>
      </div>


      <h2>Datos del vendedor</h2>
      <div class="input-group">
        <input type="text" name="vendedor_nombre" placeholder="Tu nombre" required>
      </div>
      <div class="input-group">
        <input type="email" name="vendedor_email" placeholder="Tu correo" required>
      </div>
      
      <button type="submit" class="btn-login">Publicar</button>
    </form>
  </main>

  <footer class="footer">
    <p class="footer__texto">FitStore - Todos los derechos reservados 2025.</p>
  </footer>

  <script src="js/modo.js"></script>
  <script src="js/auth.js"></script>
  <script>
    // Solo usuarios logueados pueden publicar
    requireAuth();
  </script>
</body>
</html>
