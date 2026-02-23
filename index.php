<?php
require_once 'backend.php';

// Obtener productos
$productos = $_SESSION['productos'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Productos</title>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Nuestro CSS externo -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">

<div class="container mt-4">
    <!-- Mostrar mensajes de éxito/error -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-<?php echo $_SESSION['mensaje']['tipo'] == 'exito' ? 'success' : 'danger'; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['mensaje']['texto']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <h2 class="text-center mb-4">Sistema CRUD Productos</h2>

    <!-- ENLACE PARA AGREGAR PRODUCTO -->
    <div class="text-end mb-3">
        <a href="agregar_producto.php" class="btn btn-primary">➕ Agregar Nuevo Producto</a>
        <a href="historial_ventas.php" class="btn btn-info">📊 Historial de Ventas</a>
    </div>

    <!-- TABLA PRODUCTOS -->
    <div class="card">
        <div class="card-header bg-dark text-white">
            Lista de productos
        </div>

        <div class="card-body">

            <?php if (empty($productos)): ?>
                <div class="alert alert-info text-center">
                    No hay productos registrados. ¡Agrega el primero!
                </div>
            <?php else: ?>
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Precio</th>
                            <th>Stock</th>
                            <th>Categoría</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?php echo $producto['id']; ?></td>
                            <td><strong><?php echo $producto['nombre']; ?></strong></td>
                            <td><?php echo $producto['descripcion']; ?></td>
                            <td>$<?php echo number_format($producto['precio'], 2); ?></td>
                            <td class="<?php echo ($producto['stock'] < 5) ? 'stock-bajo' : 'stock-normal'; ?>">
                                <?php echo $producto['stock']; ?>
                            </td>
                            <td><?php echo $producto['categoria']; ?></td>
                            <td class="acciones">
                                <!-- Botón Editar -->
                                <a href="editar_producto.php?id=<?php echo $producto['id']; ?>" class="btn btn-warning btn-sm">✏️ Editar</a>
                                
                                <!-- Botón Vender -->
                                <a href="vender_producto.php?id=<?php echo $producto['id']; ?>" class="btn btn-info btn-sm">💰 Vender</a>
                                
                                <!-- Formulario Eliminar -->
                                <form action="procesar_eliminar.php" method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Eliminar producto <?php echo $producto['nombre']; ?>?')">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                
                <div class="mt-3">
                    <strong>Total de productos:</strong> <?php echo count($productos); ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS (opcional pero recomendado) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>