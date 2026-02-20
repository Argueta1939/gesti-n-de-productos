<?php
require_once 'backend.php';

// Verificar si llegó un ID
if (!isset($_GET['id'])) {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'No se especificó el producto a editar'
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
    <title>Editar Producto</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; }
        .btn { background: #2196F3; color: white; padding: 10px; border: none; cursor: pointer; }
        .btn-cancelar { background: #999; color: white; padding: 10px; text-decoration: none; display: inline-block; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>Editar Producto: <?php echo $producto['nombre']; ?></h1>
    
    <p><a href="index.php">← Volver al listado</a></p>
    
    <form action="procesar_editar.php" method="POST">
        <!-- Campo oculto con el ID original -->
        <input type="hidden" name="id_original" value="<?php echo $producto['id']; ?>">
        
        <div class="form-group">
            <label>ID del Producto:</label>
            <input type="number" name="id" value="<?php echo $producto['id']; ?>" readonly>
            <small>El ID no se puede modificar</small>
        </div>
        
        <div class="form-group">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" value="<?php echo $producto['nombre']; ?>" required minlength="3">
        </div>
        
        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" required rows="3" minlength="5"><?php echo $producto['descripcion']; ?></textarea>
        </div>
        
        <div class="form-group">
            <label>Precio ($):</label>
            <input type="number" name="precio" value="<?php echo $producto['precio']; ?>" required min="0.01" step="0.01">
        </div>
        
        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" value="<?php echo $producto['stock']; ?>" required min="0" step="1">
        </div>
        
        <div class="form-group">
            <label>Categoría:</label>
            <select name="categoria" required>
                <option value="">Seleccione una categoría</option>
                <option value="Electrónica" <?php echo ($producto['categoria'] == 'Electrónica') ? 'selected' : ''; ?>>Electrónica</option>
                <option value="Ropa" <?php echo ($producto['categoria'] == 'Ropa') ? 'selected' : ''; ?>>Ropa</option>
                <option value="Hogar" <?php echo ($producto['categoria'] == 'Hogar') ? 'selected' : ''; ?>>Hogar</option>
                <option value="Deportes" <?php echo ($producto['categoria'] == 'Deportes') ? 'selected' : ''; ?>>Deportes</option>
                <option value="Juguetes" <?php echo ($producto['categoria'] == 'Juguetes') ? 'selected' : ''; ?>>Juguetes</option>
                <option value="Otros" <?php echo ($producto['categoria'] == 'Otros') ? 'selected' : ''; ?>>Otros</option>
            </select>
        </div>
        
        <button type="submit" class="btn">Actualizar Producto</button>
        <a href="index.php" class="btn-cancelar">Cancelar</a>
    </form>
</body>
</html>