<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
</head>



<body>
<a href="añadirtareas.php" class="button">Añadir tareas</a>
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

// Obtener las tareas del usuario
$usuario_id = $_SESSION['id'];
$declaracion = $conexion->prepare("SELECT nombre, descripcion FROM tareas WHERE id = ? ORDER BY id DESC");
$declaracion->bind_param("i", $usuario_id);
$declaracion->execute();
$resultado = $declaracion->get_result();
echo "<h2>Lista de Tareas de {$_SESSION['usuario']}</h2>";
echo '<ul>';
while ($fila = $resultado->fetch_assoc()) {
echo "<li>{$fila['nombre']} - {$fila['descripcion']}</li>";
}
echo '</ul>';
$declaracion->close();
$conexion->close();
?>
</body>
</html>

