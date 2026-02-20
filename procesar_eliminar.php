<?php
require_once 'backend.php';

// Verificar que llegaron datos
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['id'])) {
    header('Location: index.php');
    exit;
}

$id_eliminar = $_POST['id'];
$encontrado = false;

// Buscar y eliminar el producto
foreach ($_SESSION['productos'] as $key => $producto) {
    if ($producto['id'] == $id_eliminar) {
        unset($_SESSION['productos'][$key]);
        $_SESSION['productos'] = array_values($_SESSION['productos']); // Reindexar
        $encontrado = true;
        break;
    }
}

if ($encontrado) {
    $_SESSION['mensaje'] = [
        'tipo' => 'exito',
        'texto' => 'Producto eliminado correctamente'
    ];
} else {
    $_SESSION['mensaje'] = [
        'tipo' => 'error',
        'texto' => 'Producto no encontrado'
    ];
}

header('Location: index.php');
exit;
?>