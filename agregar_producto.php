<?php
require_once 'backend.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="bg-light">
<div class="container mt-4">
    <h2 class="text-center mb-4">Agregar Nuevo Producto</h2>
    
    <div class="card">
        <div class="card-header bg-primary text-white">
            Formulario de registro
        </div>
        <div class="card-body">
            <form method="POST" action="procesar_agregar.php">
                <div class="row">
                    <div class="col-md-2 mb-3">
                        <input type="number" name="id" class="form-control" placeholder="ID" required min="1">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required minlength="3">
                    </div>
                    <div class="col-md-3 mb-3">
                        <input type="text" name="descripcion" class="form-control" placeholder="Descripción" required minlength="5">
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="number" name="precio" class="form-control" placeholder="Precio" required min="0.01" step="0.01">
                    </div>
                    <div class="col-md-2 mb-3">
                        <input type="number" name="stock" class="form-control" placeholder="Stock" required min="0">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <input type="text" name="categoria" class="form-control" placeholder="Categoría" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <button type="submit" class="btn btn-success w-100">Guardar producto</button>
                    </div>
                    <div class="col-md-4 mb-3">
                        <a href="index.php" class="btn btn-secondary w-100">Cancelar</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>