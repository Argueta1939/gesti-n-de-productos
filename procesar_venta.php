<?php
require_once 'backend.php';

// Verificar que llegaron datos
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Validar que llegaron los campos necesarios
if (!isset($_POST['id']) || !isset($_POST['cantidad'])) {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Datos incompletos para realizar la venta'
    ];
    header('Location: index.php');
    exit;
}

$id_producto = $_POST['id'];
$cantidad = $_POST['cantidad'];
$producto_encontrado = false;
$venta_realizada = false;

// Validar cantidad
if (empty($cantidad) || !is_numeric($cantidad)) {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'La cantidad debe ser un número'
    ];
    header('Location: index.php');
    exit;
}

if ($cantidad <= 0) {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'La cantidad debe ser mayor a cero'
    ];
    header('Location: index.php');
    exit;
}

// Buscar el producto y actualizar stock
foreach ($_SESSION['productos'] as $key => $producto) {
    if ($producto['id'] == $id_producto) {
        $producto_encontrado = true;
        
        // Validar stock suficiente
        if ($producto['stock'] >= $cantidad) {
            // Actualizar stock
            $_SESSION['productos'][$key]['stock'] -= $cantidad;
            
            // Calcular total de la venta
            $total_venta = $cantidad * $producto['precio'];
            
            // Guardar detalle de la venta en sesión (para historial)
            if (!isset($_SESSION['ventas'])) {
                $_SESSION['ventas'] = [];
            }
            
            $_SESSION['ventas'][] = [
                'producto' => $producto['nombre'],
                'cantidad' => $cantidad,
                'precio_unitario' => $producto['precio'],
                'total' => $total_venta,
                'fecha' => date('Y-m-d H:i:s')
            ];
            
            $_SESSION['mensaje'] = [
                'tipo' => 'exito',
                'texto' => "Venta realizada exitosamente. Total: $" . number_format($total_venta, 2)
            ];
            
            $venta_realizada = true;
        } else {
            $_SESSION['mensaje'] = [
                'tipo' => 'error',
                'texto' => "Stock insuficiente. Disponible: {$producto['stock']} unidades"
            ];
        }
        break;
    }
}

if (!$producto_encontrado) {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Producto no encontrado'
    ];
}

header('Location: index.php');
exit;
?>