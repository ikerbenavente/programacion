<?php
include 'conexion.php';

$conn = new Conexion();
$conexion = $conn->conexion;

// Consulta para obtener los usuarios registrados
$result = $conexion->query("SELECT * FROM usuarios");

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="csshito.css">
</head>
<body>
    <div class="container">
        <h2>Usuarios Registrados</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Edad</th>
                    <th>Plan Base</th>
                    <th>Paquetes</th>
                    <th>Duración</th>
                    <th>Costo Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($usuario = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $usuario['id'] ?></td>
                    <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                    <td><?= htmlspecialchars($usuario['correo']) ?></td>
                    <td><?= $usuario['edad'] ?></td>
                    <td><?= htmlspecialchars($usuario['plan_base']) ?></td>
                    <td><?= htmlspecialchars($usuario['paquetes']) ?></td>
                    <td><?= htmlspecialchars($usuario['duracion']) ?></td>
                    <td><?= number_format($usuario['costo_total'], 2, ',', '.') ?> €</td>
                    <td>
                        <a href="editar.php?id=<?= $usuario['id'] ?>" class="btn btn-edit">Editar</a>
                        <a href="eliminar.php?id=<?= $usuario['id'] ?>" class="btn btn-delete">Eliminar</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Botón para volver al registro -->
        <a href="index.php" class="btn btn-secondary">Volver al Registro</a>
    </div>
</body>
</html>
