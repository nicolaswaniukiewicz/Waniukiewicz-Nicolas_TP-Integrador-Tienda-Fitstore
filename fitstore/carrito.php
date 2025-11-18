<?php
session_start();
require 'config.php';

// Inicializar carrito
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];   // [ id_producto => cantidad ]
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $id = (int)($_POST['id'] ?? 0);

    if ($_POST['action'] === 'add' && $id > 0) {
        if (!isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id] = 0;
        }
        $_SESSION['carrito'][$id]++;
    }

    if ($_POST['action'] === 'remove' && $id > 0) {
        unset($_SESSION['carrito'][$id]);
    }
}

// Obtener info de los productos en el carrito
$items = [];
$total = 0;

if ($_SESSION['carrito']) {
    $ids = implode(',', array_map('intval', array_keys($_SESSION['carrito'])));
    $stmt = $pdo->query("SELECT * FROM productos WHERE id IN ($ids)");
    while ($p = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cant = $_SESSION['carrito'][$p['id']];
        $p['cantidad'] = $cant;
        $p['subtotal'] = $cant * $p['precio'];
        $total += $p['subtotal'];
        $items[] = $p;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <title>Carrito — FitStore</title>
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
  <a class="navegacion__enlace" href="publicar_producto.php#contenido">Publicar producto</a>
  <a class="navegacion__enlace" href="#" onclick="logoutAndGoHome(); return false;">
    Cerrar sesión
  </a>
</nav>

  <main class="contenedor">
    <h1>Carrito</h1>

    <?php if (!$items): ?>
      <h1>Tu carrito está vacío.</h1>
    <?php else: ?>
      <table>
        <thead>
          <tr>
            <th>Producto</th>
            <th>Cant.</th>
            <th>Precio</th>
            <th>Subtotal</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items as $it): ?>
            <tr>
              <td><?= htmlspecialchars($it['titulo']) ?></td>
              <td><?= $it['cantidad'] ?></td>
              <td>$<?= number_format($it['precio'], 2, ',', '.') ?></td>
              <td>$<?= number_format($it['subtotal'], 2, ',', '.') ?></td>
              <td>
                <form action="carrito.php" method="post">
                  <input type="hidden" name="id" value="<?= $it['id'] ?>">
                  <button type="submit" name="action" value="remove" class="btn-quitar">Quitar</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>

      <h2>Total: $<?= number_format($total, 2, ',', '.') ?>
      <?php endif; ?>
        <?php if ($total > 0): ?>
          <div style="margin-top: 1.5rem; text-align: right;">
            <a href="comprar.php" class="btn-compra">
              Finalizar compra
            </a>
          </div>
      <?php endif; ?>
  </main>

  <script src="js/modo.js"></script>
  <script src="js/auth.js"></script>
  <script>
    requireAuth();
  </script>

</body>
</html>
