<?php
// Incluir funciones
require_once 'backend.php';

// Verificar que llegaron datos
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // Si no es POST, redirigir al formulario
    header('Location: agregar_producto.php');
    exit;
}

// Validar los datos
$errores = validarProductoNuevo($_POST);

if (empty($errores)) {
    // No hay errores - guardar producto
    guardarProducto($_POST);
    
    // Mensaje de éxito
    $mensaje = "Producto agregado correctamente";
    $tipo_mensaje = "exito";
    
    // Redirigir al listado después de 2 segundos
    header("refresh:2;url=index.php");
} else {
    // Hay errores - mostrar al usuario
    $mensaje = "Hay errores en el formulario";
    $tipo_mensaje = "error";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .exito { color: green; background: #DFF2BF; padding: 10px; border-radius: 5px; }
        .error { color: red; background: #FFD2D2; padding: 10px; border-radius: 5px; }
        .volver { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="<?php echo $tipo_mensaje; ?>">
        <h2><?php echo $mensaje; ?></h2>
        
        <?php if (!empty($errores)): ?>
            <h3>Errores encontrados:</h3>
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?php echo $error; ?></li>
                <?php endforeach; ?>
            </ul>
            <p><a href="agregar_producto.php">← Volver al formulario</a></p>
        <?php else: ?>
            <p>Redirigiendo al listado de productos...</p>
            <p><a href="index.php">Ir ahora</a></p>
        <?php endif; ?>
    </div>
</body>
</html>