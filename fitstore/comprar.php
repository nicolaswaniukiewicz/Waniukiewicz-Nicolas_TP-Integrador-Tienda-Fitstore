<?php
session_start();
require 'config.php';

// Carrito en sesión
$carrito = $_SESSION['carrito'] ?? [];

// Armar listado de productos del carrito
$items = [];
$total = 0;

if (!empty($carrito)) {
    $ids = array_keys($carrito);

    // Buscar los productos de esos IDs
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $stmt = $pdo->prepare("SELECT id, titulo, precio FROM productos WHERE id IN ($placeholders)");
    $stmt->execute($ids);

    $prods = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $prods[$row['id']] = $row;
    }

    foreach ($carrito as $id => $cant) {
        if (!isset($prods[$id])) continue;
        $precio = (float)$prods[$id]['precio'];
        $sub    = $precio * $cant;
        $items[] = [
            'id'       => $id,
            'titulo'   => $prods[$id]['titulo'],
            'precio'   => $precio,
            'cantidad' => $cant,
            'subtotal' => $sub,
        ];
        $total += $sub;
    }
}

$pedido_ok = false;

// Procesar envío del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $total > 0) {
    $nombre   = $_POST['nombre']   ?? '';
    $direccion= $_POST['direccion']?? '';
    $telefono = $_POST['telefono'] ?? '';
    $email    = $_POST['email']    ?? '';
    $medio    = $_POST['medio_pago'] ?? '';

    // Acá podrías guardar el pedido en otra tabla "pedidos" si quisieras.
    // Para el TP, con mostrar el resumen y limpiar el carrito alcanza.

    $_SESSION['carrito'] = []; // vaciar carrito
    $pedido_ok = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FitStore — Comprar</title>
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
    <a class="navegacion__enlace navegacion__enlace--activo" href="comprar.php#contenido">Comprar</a>
    <a class="navegacion__enlace" href="carrito.php">Carrito</a>
    <a class="navegacion__enlace" href="publicar_producto.php#contenido">Publicar producto</a>
    <a class="navegacion__enlace" href="#" onclick="logoutAndGoHome(); return false;">
    Cerrar sesión
  </a>
  </nav>

  <main id="contenido" class="ancla-destino contenedor">
    <h1>Formulario de compra</h1>

    <?php if ($pedido_ok): ?>
      <div class="mensaje-exito">
        ✅ ¡Gracias por tu compra! Tu pedido fue registrado correctamente.
      </div>
      <h2>Puedes seguir navegando en la <a href="index.php">tienda</a>.</h2>

    <?php elseif (empty($items)): ?>
      <div class="mensaje-error">
        Tu carrito está vacío. Agregá productos antes de finalizar la compra.
      </div>
      <p><a href="index.php" class="btn-compra">Ir a la tienda</a></p>

    <?php else: ?>

      <form action="comprar.php" method="post" class="login-form">
        <div class="formulario__fila">
          <div class="input-group">
            <input type="text" name="nombre" placeholder="Nombre del cliente" required>
          </div>
          <div class="input-group">
            <input type="text" name="direccion" placeholder="Dirección" required>
          </div>
        </div>

        <div class="formulario__fila">
          <div class="input-group">
            <input type="tel" name="telefono" placeholder="Teléfono" required>
          </div>
          <div class="input-group">
            <input type="email" name="email" placeholder="E-mail" required>
          </div>
        </div>

        <div class="input-group">
          <select name="medio_pago" required>
            <option value="" disabled selected>Seleccione medio de pago</option>
            <option value="efectivo">Efectivo</option>
            <option value="transferencia">Transferencia</option>
            <option value="tarjeta">Tarjeta</option>
          </select>
        </div>

        <div class="checkout-resumen">
          <h2>Resumen de la compra</h2>
          <table class="checkout-table">
            <thead>
              <tr>
                <th>Producto</th>
                <th>Cant.</th>
                <th>Precio</th>
                <th>Subtotal</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($items as $it): ?>
                <tr>
                  <td><?= htmlspecialchars($it['titulo']) ?></td>
                  <td><?= $it['cantidad'] ?></td>
                  <td>$<?= number_format($it['precio'], 2, ',', '.') ?></td>
                  <td>$<?= number_format($it['subtotal'], 2, ',', '.') ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
          <h2>Total: $<?= number_format($total, 2, ',', '.') ?></h2>
        </div>

        <button type="submit" class="btn-compra checkout-btn" name="confirmar">
          Confirmar compra
        </button>

      </form>

    <?php endif; ?>
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
