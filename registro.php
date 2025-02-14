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
<h1 class="h1">Registro</h1>
<a href="index.php" class="button">Volver</a>
<div>
<form method="POST" action="registro.php">
<label for="fnombre">Nombre de Usuario</label>
<input type="text" id="fnombre" name="nombre" placeholder="">

7

<label for="fcorreo">Correo</label>
<input type="text" id="fcorreo" name="correo" placeholder="">
<label for="fcontraseña">Contraseña</label>
<input type="password" id="fcontraseña" name="contraseña"
placeholder="">
<label for="fccontraseña">Confirmar Contraseña</label>
<input type="password" id="fccontraseña" name="ccontraseña"
placeholder="">
<input type="submit" value="Enviar">
</form>
</div>
</body>
</html>
<?php
// Conexión con la base de datos
$conexion = new mysqli("localhost", "root", "curso", "Hito2");
// Verifica el envío del formulario html
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$usuario = $_POST['nombre'];
$correo = $_POST['correo'];
$contraseña = $_POST['contraseña'];
$c_contraseña = $_POST['ccontraseña'];
// Lanza un error si algun campo esta vacío
if (empty($usuario) || empty($correo) || empty($contraseña)) {
die('<div style="color: white; background-color: red; padding:
10px; border-radius: 5px; font-weight: bold; text-align:
center;">Completa todos los campos.</div>');
}
// Verifica que las contraseñas sean iguales
if ($contraseña !== $c_contraseña) {
die('<div style="color: white; background-color: red; padding:
10px; border-radius: 5px; font-weight: bold; text-align: center;">Las
contraseñas no son iguales.</div>');
}
// Verifica que ni el usuario ni el correo ya existan
$declaracion = $conexion->prepare("SELECT id FROM usuarios WHERE
nombreusuario = ? OR correo = ?");
$declaracion->bind_param("ss", $usuario, $correo);

$declaracion->execute();
$declaracion->store_result();
if ($declaracion->num_rows > 0) {
die('<div style="color: white; background-color: red; padding: 10px; border-radius: 5px; font-weight: bold; text-align: center;">El nombre de usuario o el correo electrónico ya están registrados.</div>');
}
$declaracion->close();
// Encripta la contraseña
$contraseña_encriptada = password_hash($contraseña, PASSWORD_DEFAULT);
// Inserta los datos en la base de datos
$declaracion = $conexion->prepare("INSERT INTO usuarios (nombreusuario, correo, contraseña) VALUES (?, ?, ?)");
$declaracion->bind_param("sss", $usuario, $correo, $contraseña_encriptada);
// Lanza un mensaje si nos hemos registrado correctamente o si haocurrido algún error
if ($declaracion->execute()) {
echo '<div style="color: white; background-color: green; padding: 10px; border-radius: 5px; font-weight: bold; text-align: center;">Registrado correctamente.</div>';
} else {
echo '<div style="color: white; background-color: red; padding: 10px; border-radius: 5px; font-weight: bold; text-align: center;">Error al registrar: ' . $declaracion->error . '</div>';
}
$declaracion->close();
$conexion->close();
}
?>