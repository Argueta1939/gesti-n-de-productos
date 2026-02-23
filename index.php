<?php
require_once 'backend.php';

// Obtener productos
$productos = $_SESSION['productos'] ?? [];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Productos</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
            background-color: #f5f5f5;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            color: #333;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 10px;
        }
        table { 
            border-collapse: collapse; 
            width: 100%; 
            margin-top: 20px;
        }
        th, td { 
            border: 1px solid #ddd; 
            padding: 12px; 
            text-align: left; 
        }
        th { 
            background-color: #4CAF50; 
            color: white; 
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .btn-agregar { 
            background: #4CAF50; 
            color: white; 
            padding: 12px 20px; 
            text-decoration: none; 
            display: inline-block; 
            margin-bottom: 20px;
            border-radius: 5px;
            font-weight: bold;
        }
        .btn-agregar:hover {
            background: #45a049;
        }
        .btn-editar { 
            background: #2196F3; 
            color: white; 
            padding: 6px 12px; 
            text-decoration: none; 
            display: inline-block; 
            border-radius: 3px;
            font-size: 14px;
        }
        .btn-editar:hover {
            background: #0b7dda;
        }
        .btn-vender { 
            background: #FF9800; 
            color: white; 
            padding: 6px 12px; 
            text-decoration: none; 
            display: inline-block; 
            border-radius: 3px;
            font-size: 14px;
            margin: 0 5px;
        }
        .btn-vender:hover {
            background: #e68900;
        }
        .btn-eliminar { 
            background: #f44336; 
            color: white; 
            padding: 6px 12px; 
            border: none; 
            cursor: pointer; 
            border-radius: 3px;
            font-size: 14px;
        }
        .btn-eliminar:hover {
            background: #da190b;
        }
        .btn-historial {
            background: #9C27B0;
            color: white;
            padding: 12px 20px;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            font-weight: bold;
            margin-left: 10px;
        }
        .btn-historial:hover {
            background: #7b1fa2;
        }
        .mensaje { 
            padding: 15px; 
            margin-bottom: 20px; 
            border-radius: 5px; 
        }
        .exito { 
            background: #DFF2BF; 
            color: #4F8A10; 
            border: 1px solid #4F8A10;
        }
        .error { 
            background: #FFD2D2; 
            color: #D8000C; 
            border: 1px solid #D8000C;
        }
        .header-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .total-productos {
            background: #e7f3ff;
            padding: 10px 15px;
            border-radius: 5px;
            color: #2196F3;
            font-weight: bold;
        }
        .stock-bajo {
            color: #f44336;
            font-weight: bold;
        }
        .stock-normal {
            color: #4CAF50;
        }
        .acciones {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1> Gestión de Productos</h1>
        
        <!-- Mostrar mensajes de éxito/error -->
        <?php if (isset($_SESSION['mensaje'])): ?>
            <div class="mensaje <?php echo $_SESSION['mensaje']['tipo']; ?>">
                <?php echo $_SESSION['mensaje']['texto']; ?>
            </div>
            <?php unset($_SESSION['mensaje']); ?>
        <?php endif; ?>
        
        <!-- Botones de acción -->
        <div class="header-actions">
            <div>
                <a href="agregar_producto.php" class="btn-agregar">+ Agregar Nuevo Producto</a>
                <a href="historial_ventas.php" class="btn-historial"> Ver Historial de Ventas</a>
            </div>
            <div class="total-productos">
                Total de productos: <strong><?php echo count($productos); ?></strong>
            </div>
        </div>
        
        <!-- Tabla de productos -->
        <?php if (empty($productos)): ?>
            <div style="text-align: center; padding: 40px; background: #f9f9f9; border-radius: 5px;">
                <p style="font-size: 1.2em; color: #666;">No hay productos registrados</p>
                <p>¡Haz clic en "Agregar Nuevo Producto" para comenzar!</p>
            </div>
        <?php else: ?>
            <table>
                <thead>
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
                            <?php echo $producto['stock']; ?> unidades
                            <?php if ($producto['stock'] < 5): ?>
                                
                            <?php endif; ?>
                        </td>
                        <td><?php echo $producto['categoria']; ?></td>
                        <td class="acciones">
                            <!-- Botón Editar -->
                            <a href="editar_producto.php?id=<?php echo $producto['id']; ?>" class="btn-editar"> Editar</a>
                            
                            <!-- Botón Vender -->
                            <a href="vender_producto.php?id=<?php echo $producto['id']; ?>" class="btn-vender"> Vender</a>
                            
                            <!-- Formulario para Eliminar (con confirmación) -->
                            <form action="procesar_eliminar.php" method="POST" style="display: inline;" 
                                  onsubmit="return confirm('¿Estás seguro de eliminar el producto \"<?php echo $producto['nombre']; ?>\"?\n\nEsta acción no se puede deshacer.');">
                                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">
                                <button type="submit" class="btn-eliminar"> Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
        
        <!-- Información adicional -->
        <div style="margin-top: 30px; padding: 15px; background: #f5f5f5; border-radius: 5px; font-size: 0.9em; color: #666;">
            <p><strong> Leyenda:</strong></p>
            <p> Stock normal |  Stock bajo (menos de 5 unidades) |  Alerta de stock</p>
        </div>
    </div>
</body>
</html>