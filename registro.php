<?php
include 'conexion.php';

$conn = new Conexion();
$conexion = $conn->conexion;

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$edad = $_POST['edad'];
$plan_base = $_POST['plan_base'];
$paquetes = isset($_POST['paquetes']) ? implode(", ", $_POST['paquetes']) : "";
$duracion = $_POST['duracion'];


// Cálculo del costo
$precios_planes = ["Básico" => 9.99, "Estándar" => 13.99, "Premium" => 17.99];
$precios_paquetes = ["Deporte" => 6.99, "Cine" => 7.99, "Infantil" => 4.99];

$costo_total = $precios_planes[$plan_base];
foreach ($_POST['paquetes'] as $pack) {
    $costo_total += $precios_paquetes[$pack];
}

$sql = "INSERT INTO usuarios (nombre, correo, edad, plan_base, paquetes, duracion, costo_total) 
        VALUES ('$nombre', '$correo', '$edad', '$plan_base', '$paquetes', '$duracion', '$costo_total')";

if ($conexion->query($sql) === TRUE) {
    echo "Usuario registrado correctamente. <a href='index.php'>Volver</a>";
} else {
    echo "Error: " . $conexion->error;
}

$conexion->close();
?>

