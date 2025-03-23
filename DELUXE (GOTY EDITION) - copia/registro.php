<?php
include 'db.php'; // Incluir archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirmar_contraseña = trim($_POST['confirmar_contraseña']);

    // Verificar si las contraseñas coinciden
    if ($password !== $confirmar_contraseña) {
        $error = "Las contraseñas no coinciden.";
    } else {
        // Verificar si el correo ya está registrado
        $query = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "El correo electrónico ya está registrado.";
        } else {
            // Si el correo no está registrado, insertar el nuevo usuario
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $query = "INSERT INTO usuarios (nombre, email, password, tipo_usuario) VALUES (?, ?, ?, 'usuario')";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("sss", $nombre, $email, $password_hash);
            if ($stmt->execute()) {
                $success = "Registro exitoso. Ya puedes iniciar sesión.";
            } else {
                $error = "Error al registrar el usuario.";
            }
        }
    }
}
?>
<link rel="stylesheet" href="mas.css">

<!-- Formulario de Registro -->
<form method="POST" action="registro.php">
    <div class="form-header">
        <div class="circle">Deluxe</div>
    </div>
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Correo Electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <input type="password" name="confirmar_contraseña" placeholder="Confirmar Contraseña" required>
    <button type="submit">Registrar</button>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <?php if (isset($success)) { echo "<p>$success</p>"; } ?>
    <a href="login.php">¿Ya tienes cuenta? Inicia sesión</a>
</form>