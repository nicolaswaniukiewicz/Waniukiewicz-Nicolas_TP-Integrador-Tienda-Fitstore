<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo   = $_POST['titulo'] ?? '';
    $desc     = $_POST['descripcion'] ?? '';
    $precio   = $_POST['precio'] ?? 0;
    $vnombre  = $_POST['vendedor_nombre'] ?? '';
    $vemail   = $_POST['vendedor_email'] ?? '';

    // -------- Manejo de la imagen subida --------
    $imagen = 'placeholder.jpg'; // valor por defecto

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['imagen']['tmp_name'];
        $origName = $_FILES['imagen']['name'];

        // Carpeta de destino: img/uploads/
        $uploadDir = __DIR__ . '/img/uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Armar un nombre de archivo seguro y único
        $ext = pathinfo($origName, PATHINFO_EXTENSION);
        $base = pathinfo($origName, PATHINFO_FILENAME);
        $safeBase = preg_replace('/[^a-zA-Z0-9_-]/', '', $base);
        if ($safeBase === '') {
            $safeBase = 'producto';
        }

        $newName = $safeBase . '_' . time() . '.' . $ext;
        $destPath = $uploadDir . $newName;

        if (move_uploaded_file($tmpName, $destPath)) {
            // Lo que guardamos en la BD es la ruta relativa desde /img
            // Ej: "uploads/mancuernas_123456.jpg"
            $imagen = 'uploads/' . $newName;
        }
    }

    // -------- Insertar en la BD --------
    $stmt = $pdo->prepare("
        INSERT INTO productos (titulo, descripcion, precio, imagen, vendedor_nombre, vendedor_email)
        VALUES (:t, :d, :p, :i, :vn, :ve)
    ");
    $stmt->execute([
        ':t'  => $titulo,
        ':d'  => $desc,
        ':p'  => $precio,
        ':i'  => $imagen,
        ':vn' => $vnombre,
        ':ve' => $vemail,
    ]);

    header("Location: listado_box.php?ok=1");
    exit;
} else {
    header("Location: publicar_producto.php");
    exit;
}
