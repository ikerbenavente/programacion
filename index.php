<?php 
include 'conexion.php'; 

// Inicializamos el mensaje de error
$error_message = "";

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $edad = $_POST['edad'];
    $plan_base = $_POST['plan_base'];
    $paquetes = isset($_POST['paquetes']) ? implode(", ", $_POST['paquetes']) : "";
    $duracion = $_POST['duracion'];

    // Validaciones
    if ($edad < 18 && $paquetes != "Infantil") {
        $error_message = "Error: Los menores de 18 años solo pueden contratar el Pack Infantil.";
    }

    if ($plan_base == "Básico" && count($_POST['paquetes']) > 1) {
        $error_message = "Error: Los usuarios del Plan Básico solo pueden elegir un paquete adicional.";
    }

    if ($duracion == "Mensual" && in_array("Deporte", $_POST['paquetes'])) {
        $error_message = "Error: El Pack Deporte solo puede ser contratado si la duración es de 1 año.";
    }

    // Si no hay errores, insertar el usuario en la base de datos
    if ($error_message == "") {
        // Cálculo del costo
        $precios_planes = ["Básico" => 9.99, "Estándar" => 13.99, "Premium" => 17.99];
        $precios_paquetes = ["Deporte" => 6.99, "Cine" => 7.99, "Infantil" => 4.99];

        $costo_total = $precios_planes[$plan_base];
        foreach ($_POST['paquetes'] as $pack) {
            $costo_total += $precios_paquetes[$pack];
        }

        // Instanciamos la conexión a la base de datos
        $conn = new Conexion();
        $conexion = $conn->conexion;

        // Insertar los datos en la base de datos
        $sql = "INSERT INTO usuarios (nombre, correo, edad, plan_base, paquetes, duracion, costo_total) 
                VALUES ('$nombre', '$correo', '$edad', '$plan_base', '$paquetes', '$duracion', '$costo_total')";

        if ($conexion->query($sql) === TRUE) {
            echo "Usuario registrado correctamente. <a href='index.php'>Volver</a>";
            exit;
        } else {
            $error_message = "Error: " . $conexion->error;
        }

        $conexion->close(); // Cerrar la conexión
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="csshito.css">
</head>
<body>
    <div class="container">
        <h2>Registro de Usuarios</h2>

        <!-- Mostrar mensaje de error si existe -->
        <?php if ($error_message): ?>
            <div class="error-message" style="color: red; font-weight: bold; margin-bottom: 20px;">
                <?php echo $error_message; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de registro -->
        <form action="index.php" method="POST">
            <label>Nombre y Apellidos:</label>
            <input type="text" name="nombre" required>

            <label>Correo Electrónico:</label>
            <input type="email" name="correo" required>

            <label>Edad:</label>
            <input type="number" name="edad" required>

            <label>Plan Base:</label>
            <select name="plan_base">
                <option value="Básico">Básico</option>
                <option value="Estándar">Estándar</option>
                <option value="Premium">Premium</option>
            </select>

            <label>Paquetes Adicionales:</label>
            <select name="paquetes[]" multiple>
                <option value="Deporte">Deporte</option>
                <option value="Cine">Cine</option>
                <option value="Infantil">Infantil</option>
            </select>

            <label>Duración:</label>
            <select name="duracion">
                <option value="Mensual">Mensual</option>
                <option value="Anual">Anual</option>
            </select>

            <button type="submit" class="btn">Registrar</button>
        </form>

        <a href="lista.php" class="btn btn-secondary">Ver Usuarios Registrados</a>
    </div>
</body>
</html>
