<!DOCTYPE html>
<html>
<style>

body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  background-color: #f1f1f1;
  margin: 0;
  padding: 0;
}


.container {
  max-width: 600px;
  margin: 40px auto;
  padding: 20px;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
}


h1, h2, h3 {
  color: #333;
  text-align: center;
  font-size: 2rem;
  margin-bottom: 20px;
  font-weight: 600;
}

h3 {
  font-size: 1.5rem;
  color:rgb(76, 175, 175);
}


.button {
  background-color:rgb(76, 175, 175);
  color: white;
  padding: 14px 40px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  border-radius: 30px;
  margin-top: 10px;
  transition: all 0.3s ease;
  width: 100%;
  max-width: 250px;
  cursor: pointer;
  border: none;
}

.button:hover {
  background-color:rgb(76, 175, 175);
  transform: translateY(-2px);
}


form {
  padding: 20px;
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
}

input[type="text"], input[type="password"], select {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 8px;
  box-sizing: border-box;
  font-size: 16px;
  transition: border-color 0.3s ease;
}

input[type="text"]:focus, input[type="password"]:focus {
  border-color: #4CAF50;
}


input[type="submit"] {
  background-color:rgb(76, 175, 175);
  color: white;
  padding: 14px;
  margin: 10px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
  background-color: #45a049;
}


.message {
  padding: 15px;
  text-align: center;
  font-weight: bold;
  border-radius: 5px;
  margin: 20px 0;
  color: white;
}

.message.success {
  background-color: #28a745;
}

.message.error {
  background-color: #dc3545;
}

.message.info {
  background-color: #17a2b8;
}


@media (max-width: 768px) {
  .container {
    margin: 20px;
    padding: 15px;
  }
  .button {
    width: 100%;
    max-width: 100%;
  }
}
</style>
<body>
<h3>Añadir Tareas</h3>
<div>
<form method="POST" action="añadirtareas.php">



<label for="nombre">Nombre de la tarea</label>
<input type="text" id="nombre" name="nombre" placeholder="">
<label for="descripcion">Descripción</label>
<input type="text" id="descripcion" name="descripcion" placeholder="">
<input type="submit" value="Guardar">
</form>
</div>
<a href="tareas.php" class="button">Volver</a>
</body>
</html>
<?php
// Iniciar la sesión
session_start();
// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "curso", "Hito2");
if ($conexion->connect_error) {
die("Error de conexión: " . $conexion->connect_error);
}
// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['id'])) {
die("Debes iniciar sesión para añadir tareas.");
}
// Procesar el formulario para agregar tareas
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$nombre = $_POST['nombre'];
$descripcion = $_POST['descripcion'];
$usuario_id = $_SESSION['id'];
if (!empty($nombre) && !empty($descripcion)) {
$declaracion = $conexion->prepare("INSERT INTO tareas (nombre, descripcion) VALUES (?, ?)");
$declaracion->bind_param("ss", $nombre, $descripcion);
if ($declaracion->execute()) {
echo '<div style="color: green;">Tarea agregada correctamente.</div>';
} else {
echo '<div style="color: red;">Error al agregar la tarea: ' . $declaracion->error . '</div>';
}
$declaracion->close();


} else {
echo '<div style="color: red;">Todos los campos son obligatorios.</div>';
}
}
$conexion->close();
?>