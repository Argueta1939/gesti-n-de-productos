<?php
// backend.php - Funciones compartidas
session_start();

// Inicializar productos si no existen
if (!isset($_SESSION['productos'])) {
    $_SESSION['productos'] = [];
}

// Función para validar producto NUEVO
function validarProductoNuevo($datos) {
    $errores = [];
    
    // Validar ID
    if (empty($datos['id'])) {
        $errores[] = "El ID es obligatorio";
    } elseif (!is_numeric($datos['id'])) {
        $errores[] = "El ID debe ser un número";
    } elseif ($datos['id'] <= 0) {
        $errores[] = "El ID debe ser un número positivo";
    } else {
        // Verificar ID duplicado
        foreach ($_SESSION['productos'] as $producto) {
            if ($producto['id'] == $datos['id']) {
                $errores[] = "El ID ya existe. Por favor usa otro.";
                break;
            }
        }
    }
    
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

// Función para guardar producto
function guardarProducto($datos) {
    $nuevoProducto = [
        'id' => (int)$datos['id'],
        'nombre' => $datos['nombre'],
        'descripcion' => $datos['descripcion'],
        'precio' => (float)$datos['precio'],
        'stock' => (int)$datos['stock'],
        'categoria' => $datos['categoria']
    ];
    
    $_SESSION['productos'][] = $nuevoProducto;
    return true;
}
?>