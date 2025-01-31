<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

include 'conexion.php';

// Instanciar la clase de conexión
$conexion = new Conexion();

// Verificar si se recibe un ID válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: ID inválido.");
}

$id = intval($_GET['id']); // Convertir el ID a un número entero
$result = $conexion->conexion->query("SELECT * FROM usuarios WHERE id = $id");

if ($result->num_rows == 0) {
    die("Error: Usuario no encontrado.");
}

$usuario = $result->fetch_assoc();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener los nuevos datos del formulario
    $nombre = $conexion->conexion->real_escape_string($_POST['nombre']);
    $correo = $conexion->conexion->real_escape_string($_POST['correo']);
    $edad = intval($_POST['edad']);
    $plan_base = $conexion->conexion->real_escape_string($_POST['plan_base']);
    $paquetes = isset($_POST['paquetes']) ? implode(", ", $_POST['paquetes']) : "";
    $duracion = $conexion->conexion->real_escape_string($_POST['duracion']);

    // Validaciones
    if ($edad < 18 && $paquetes != "Infantil") {
        die("Error: Los menores de 18 años solo pueden contratar el Pack Infantil.");
    }

    if ($plan_base == "Básico" && count($_POST['paquetes']) > 1) {
        die("Error: Los usuarios del Plan Básico solo pueden elegir un paquete adicional.");
    }

    if ($duracion == "Mensual" && in_array("Deporte", $_POST['paquetes'])) {
        die("Error: El Pack Deporte solo puede ser contratado si la duración es de 1 año.");
    }

    // Cálculo del costo
    $precios_planes = ["Básico" => 9.99, "Estándar" => 13.99, "Premium" => 17.99];
    $precios_paquetes = ["Deporte" => 6.99, "Cine" => 7.99, "Infantil" => 4.99];

    $costo_total = $precios_planes[$plan_base];
    foreach ($_POST['paquetes'] as $pack) {
        $costo_total += $precios_paquetes[$pack];
    }

    // Mostrar la consulta SQL para depurar
    $sql = "UPDATE usuarios SET 
            nombre='$nombre', 
            correo='$correo', 
            edad=$edad, 
            plan_base='$plan_base', 
            paquetes='$paquetes', 
            duracion='$duracion', 
            costo_total=$costo_total 
            WHERE id=$id";

    // Ejecutar la consulta
    if ($conexion->conexion->query($sql) === TRUE) {
        echo "Usuario actualizado correctamente. <a href='lista.php'>Volver</a>";
    } else {
        echo "Error al actualizar: " . $conexion->conexion->error;
    }

    $conexion->cerrar(); // Cerrar la conexión
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="csshito.css">
</head>
<body>
    <div class="container">
        <h2>Editar Usuario</h2>
        <form action="editar.php?id=<?= $usuario['id'] ?>" method="POST">
            <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

            <label>Nombre y Apellidos:</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

            <label>Correo Electrónico:</label>
            <input type="email" name="correo" value="<?= htmlspecialchars($usuario['correo']) ?>" required>

            <label>Edad:</label>
            <input type="number" name="edad" value="<?= $usuario['edad'] ?>" required>

            <label>Plan Base:</label>
            <select name="plan_base">
                <option value="Básico" <?= ($usuario['plan_base'] == 'Básico') ? 'selected' : '' ?>>Básico</option>
                <option value="Estándar" <?= ($usuario['plan_base'] == 'Estándar') ? 'selected' : '' ?>>Estándar</option>
                <option value="Premium" <?= ($usuario['plan_base'] == 'Premium') ? 'selected' : '' ?>>Premium</option>
            </select>

            <label>Paquetes Adicionales:</label>
            <select name="paquetes[]" multiple>
                <option value="Deporte" <?= (strpos($usuario['paquetes'], 'Deporte') !== false) ? 'selected' : '' ?>>Deporte</option>
                <option value="Cine" <?= (strpos($usuario['paquetes'], 'Cine') !== false) ? 'selected' : '' ?>>Cine</option>
                <option value="Infantil" <?= (strpos($usuario['paquetes'], 'Infantil') !== false) ? 'selected' : '' ?>>Infantil</option>
            </select>

            <label>Duración:</label>
            <select name="duracion">
                <option value="Mensual" <?= ($usuario['duracion'] == 'Mensual') ? 'selected' : '' ?>>Mensual</option>
                <option value="Anual" <?= ($usuario['duracion'] == 'Anual') ? 'selected' : '' ?>>Anual</option>
            </select>

            <button type="submit" class="btn">Actualizar</button>
        </form>
        <a href="lista.php" class="btn btn-secondary">Cancelar</a>
    </div>
</body>
</html>
