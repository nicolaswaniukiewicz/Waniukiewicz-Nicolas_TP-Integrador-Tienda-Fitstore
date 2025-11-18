<?php
// producto.php
require 'config.php'; // conexión PDO ($pdo)

// Tomo el id de la URL: producto.php?id=4
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    die('Producto no encontrado.');
}

// Busco el producto en la tabla "productos"
$stmt = $pdo->prepare("SELECT * FROM productos WHERE id = :id");
$stmt->execute([':id' => $id]);
$prod = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$prod) {
    die('Producto no encontrado.');
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FitStore — <?= htmlspecialchars($prod['titulo']) ?></title>
  <link rel="stylesheet" href="css/normalize.css"/>
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/styles.css"/>
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
  <a class="navegacion__enlace" href="publicar_producto.php#contenido">Publicar producto</a>
  <a class="navegacion__enlace" href="#" onclick="logoutAndGoHome(); return false;">
    Cerrar sesión
  </a>
</nav>


  <main id="contenido" class="ancla-destino contenedor">
    <div class="producto-detalle">
      <img
        id="producto-imagen"
        class="producto__imagen-detalle"
        src="img/<?= htmlspecialchars($prod['imagen']) ?>"
        alt="<?= htmlspecialchars($prod['titulo']) ?>"
      >
      <div class="producto__informacion-detalle">
        <h1 id="producto-nombre" class="producto__nombre-detalle">
          <?= htmlspecialchars($prod['titulo']) ?>
        </h1>

        <p id="producto-precio" class="producto__precio-detalle">
          $<?= number_format($prod['precio'], 2, ',', '.') ?>
        </p>

        <p id="producto-descripcion" class="producto__descripcion-detalle">
          <?= nl2br(htmlspecialchars($prod['descripcion'])) ?>
        </p>

        <!-- Botón para añadir al carrito -->
        <form action="carrito.php" method="post">
          <input type="hidden" name="id" value="<?= $prod['id'] ?>">
          <button type="submit" name="action" value="add" class="btn-compra">
            Añadir al carrito
          </button>
        </form>
      </div>
    </div>
  </main>

  <footer class="footer">
    <p class="footer__texto">FitStore - Todos los derechos reservados 2025.</p>
  </footer>
  
  <script src="js/modo.js"></script>
  <script src="js/auth.js"></script>
  <script>
    if (typeof requireAuth === 'function') {
      requireAuth();
    }
  </script>

</body>
</html>
