<?php
require 'config.php';

$publicado_ok = isset($_GET['ok']) && $_GET['ok'] == 1;
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FitStore — Catálogo</title>
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
    <a class="navegacion__enlace navegacion__enlace--activo" href="listado_box.php#contenido">Catálogo</a>
    <a class="navegacion__enlace" href="comprar.php#contenido">Comprar</a>
    <a class="navegacion__enlace" href="carrito.php">Carrito</a>
    <a class="navegacion__enlace" href="publicar_producto.php#contenido">Publicar producto</a>
    <a class="navegacion__enlace" href="#" onclick="logoutAndGoHome(); return false;">
    Cerrar sesión
  </a>
  </nav>

  <main id="contenido" class="ancla-destino contenedor">
    <section class="listado-box">
      <h1 class="listado-box__titulo">Nuestros productos</h1>

      <?php if ($publicado_ok): ?>
        <div class="mensaje-exito">
          ✅ Tu producto se publicó correctamente y ya está visible en el catálogo.
        </div>
      <?php endif; ?>

      <div class="grid">
        <?php
        // Traer TODOS los productos de la BD
        $stmt = $pdo->query("SELECT * FROM productos ORDER BY creado_en DESC");
        while ($p = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
          <div class="producto">
            <a href="producto.php?id=<?= $p['id'] ?>">
              <img
                class="producto__imagen"
                src="img/<?= htmlspecialchars($p['imagen']) ?>"
                alt="<?= htmlspecialchars($p['titulo']) ?>"
              >
              <div class="producto__informacion">
                <p class="producto__nombre"><?= htmlspecialchars($p['titulo']) ?></p>
                <p class="producto__precio">
                  $<?= number_format($p['precio'], 2, ',', '.') ?>
                </p>
                <?php if (!empty($p['vendedor_nombre'])): ?>
                  <p class="producto__vendedor">Vende: <?= htmlspecialchars($p['vendedor_nombre']) ?></p>
                <?php endif; ?>
              </div>
            </a>
          </div>
        <?php endwhile; ?>
      </div>
    </section>
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
