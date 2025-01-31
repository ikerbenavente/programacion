<?php
include 'conexion.php';

$conn = new Conexion();
$conexion = $conn->conexion;

$id = $_GET['id'];
$conexion->query("DELETE FROM usuarios WHERE id=$id");

header("Location: lista.php");
?>
