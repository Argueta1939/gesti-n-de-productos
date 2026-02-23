<?php
require_once 'backend.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Historial de Ventas</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #FF9800; color: white; }
        .btn-volver { background: #4CAF50; color: white; padding: 10px; text-decoration: none; display: inline-block; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Historial de Ventas</h1>
    
    <a href="index.php" class="btn-volver">← Volver a Productos</a>
    
    <?php if (empty($_SESSION['ventas'])): ?>
        <p>No hay ventas realizadas aún.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Fecha</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unit.</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total_general = 0;
                foreach ($_SESSION['ventas'] as $venta): 
                    $total_general += $venta['total'];
                ?>
                <tr>
                    <td><?php echo $venta['fecha']; ?></td>
                    <td><?php echo $venta['producto']; ?></td>
                    <td><?php echo $venta['cantidad']; ?></td>
                    <td>$<?php echo number_format($venta['precio_unitario'], 2); ?></td>
                    <td>$<?php echo number_format($venta['total'], 2); ?></td>
                </tr>
                <?php endforeach; ?>
                <tr style="font-weight: bold; background: #f0f0f0;">
                    <td colspan="4" style="text-align: right;">Total General:</td>
                    <td>$<?php echo number_format($total_general, 2); ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>