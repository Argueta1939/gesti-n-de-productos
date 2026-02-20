<?php
// Incluir funciones
require_once 'backend.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Producto</title>
    <!-- Tu compañero puede agregar aquí los estilos CSS -->
    <style>
        /* Estilos básicos temporales */
        body { font-family: Arial; margin: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; font-weight: bold; }
        input, textarea, select { width: 100%; padding: 8px; }
        .btn { background: #4CAF50; color: white; padding: 10px; border: none; cursor: pointer; }
        .error { color: red; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>Agregar Nuevo Producto</h1>
    
    <!-- Enlace para volver al listado -->
    <p><a href="index.php">← Ver listado de productos</a></p>
    
    <!-- Formulario -->
    <form action="procesar_agregar.php" method="POST">
        <div class="form-group">
            <label>ID del Producto:</label>
            <input type="number" name="id" required min="1">
            <small>Debe ser un número único y positivo</small>
        </div>
        
        <div class="form-group">
            <label>Nombre del Producto:</label>
            <input type="text" name="nombre" required minlength="3">
        </div>
        
        <div class="form-group">
            <label>Descripción:</label>
            <textarea name="descripcion" required rows="3" minlength="5"></textarea>
        </div>
        
        <div class="form-group">
            <label>Precio ($):</label>
            <input type="number" name="precio" required min="0.01" step="0.01">
        </div>
        
        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" required min="0" step="1">
        </div>
        
        <div class="form-group">
            <label>Categoría:</label>
            <select name="categoria" required>
                <option value="">Seleccione una categoría</option>
                <option value="Electrónica">Electrónica</option>
                <option value="Ropa">Ropa</option>
                <option value="Hogar">Hogar</option>
                <option value="Deportes">Deportes</option>
                <option value="Juguetes">Juguetes</option>
                <option value="Otros">Otros</option>
            </select>
        </div>
        
        <button type="submit" class="btn">Guardar Producto</button>
    </form>
</body>
</html>