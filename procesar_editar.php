<?php
require_once 'backend.php';

// Verificar que llegaron datos
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Función para validar producto en edición
function validarProductoEdicion($datos) {
    $errores = [];
    
    // Validar nombre
    if (empty($datos['nombre'])) {
        $errores[] = "El nombre es obligatorio";
    } elseif (strlen($datos['nombre']) < 3) {
        $errores[] = "El nombre debe tener al menos 3 caracteres";
    }
    
    // Validar descripción
    if (empty($datos['descripcion'])) {
        $errores[] = "La descripción es obligatoria";
    } elseif (strlen($datos['descripcion']) < 5) {
        $errores[] = "La descripción debe tener al menos 5 caracteres";
    }
    
    // Validar precio
    if (empty($datos['precio'])) {
        $errores[] = "El precio es obligatorio";
    } elseif (!is_numeric($datos['precio'])) {
        $errores[] = "El precio debe ser un número";
    } elseif ($datos['precio'] <= 0) {
        $errores[] = "El precio debe ser mayor a cero";
    }
    
    // Validar stock
    if (empty($datos['stock']) && $datos['stock'] !== '0') {
        $errores[] = "El stock es obligatorio";
    } elseif (!is_numeric($datos['stock'])) {
        $errores[] = "El stock debe ser un número";
    } elseif ($datos['stock'] < 0) {
        $errores[] = "El stock no puede ser negativo";
    }
    
    // Validar categoría
    if (empty($datos['categoria'])) {
        $errores[] = "La categoría es obligatoria";
    }
    
    return $errores;
}

// Validar los datos
$errores = validarProductoEdicion($_POST);

if (empty($errores)) {
    // No hay errores - actualizar producto
    $id_original = $_POST['id_original'];
    
    foreach ($_SESSION['productos'] as $key => $producto) {
        if ($producto['id'] == $id_original) {
            $_SESSION['productos'][$key] = [
                'id' => $id_original, // Mantenemos el ID original
                'nombre' => $_POST['nombre'],
                'descripcion' => $_POST['descripcion'],
                'precio' => (float)$_POST['precio'],
                'stock' => (int)$_POST['stock'],
                'categoria' => $_POST['categoria']
            ];
            break;
        }
    }
    
    $_SESSION['mensaje'] = [
        'tipo' => 'exito',
        'texto' => 'Producto actualizado correctamente'
    ];
    
    header('Location: index.php');
} else {
    // Hay errores - mostrar formulario con errores
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Error en edición</title>
        <style>
            body { font-family: Arial; margin: 20px; }
            .error { color: red; background: #FFD2D2; padding: 10px; border-radius: 5px; }
        </style>
    </head>
    <body>
        <div class="error">
            <h2>Errores en el formulario:</h2>
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
            <p><a href="editar_producto.php?id=<?php echo $_POST['id_original']; ?>">← Volver al formulario</a></p>
        </div>
    </body>
    </html>
    <?php
}
?>