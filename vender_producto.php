<?php
require_once 'backend.php';

// Verificar si llegó un ID
if (!isset($_GET['id'])) {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'No se especificó el producto para la venta'
    ];
    header('Location: index.php');
    exit;
}

// Buscar el producto
$producto = null;
foreach ($_SESSION['productos'] as $p) {
    if ($p['id'] == $_GET['id']) {
        $producto = $p;
        break;
    }
}

// Si no existe el producto
if (!$producto) {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Producto no encontrado'
    ];
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Vender Producto</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; }
        .btn { background: #4CAF50; color: white; padding: 10px; border: none; cursor: pointer; }
        .btn-cancelar { background: #999; color: white; padding: 10px; text-decoration: none; display: inline-block; }
        .info-producto { background: #e3f2fd; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        .precio { font-size: 1.2em; color: #2196F3; }
        .stock { font-weight: bold; color: <?php echo ($producto['stock'] > 0) ? 'green' : 'red'; ?>; }
    </style>
</head>
<body>
    <h1>Vender Producto</h1>
    
    <p><a href="index.php">← Volver al listado</a></p>
    
    <!-- Información del producto -->
    <div class="info-producto">
        <h2><?php echo $producto['nombre']; ?></h2>
        <p><strong>Descripción:</strong> <?php echo $producto['descripcion']; ?></p>
        <p><strong>Precio unitario:</strong> <span class="precio">$<?php echo number_format($producto['precio'], 2); ?></span></p>
        <p><strong>Stock disponible:</strong> <span class="stock"><?php echo $producto['stock']; ?> unidades</span></p>
        <p><strong>Categoría:</strong> <?php echo $producto['categoria']; ?></p>
    </div>
    
    <?php if ($producto['stock'] <= 0): ?>
        <div style="background: #FFD2D2; color: #D8000C; padding: 15px; border-radius: 5px;">
            <strong>¡No hay stock disponible para este producto!</strong>
        </div>
    <?php else: ?>
        <!-- Formulario de venta -->
        <form action="procesar_venta.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
            
            <div class="form-group">
                <label>Cantidad a vender:</label>
                <input type="number" name="cantidad" required min="1" max="<?php echo $producto['stock']; ?>" step="1">
                <small>Máximo disponible: <?php echo $producto['stock']; ?> unidades</small>
            </div>
            
            <button type="submit" class="btn">Realizar Venta</button>
            <a href="index.php" class="btn-cancelar">Cancelar</a>
        </form>
    <?php endif; ?>
</body>
</html>