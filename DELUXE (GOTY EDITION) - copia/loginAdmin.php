<?php
session_start();
include 'db.php'; // Incluir archivo de conexión a la base de datos

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Consultar si el usuario existe
    $query = "SELECT * FROM administradores WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verificar la contraseña
        if (password_verify($password, $user['password'])) {
            // Iniciar sesión
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nombre_usuario'] = $user['nombre_usuario'];

            // Redirigir al usuario a comprar.php
            header("Location: crudUsers.php");
            exit;
        } else {
            header("Location: crudUsers.php");
        }
    } else {
        $error = "El correo electrónico no está registrado.";
    }
}
?>
<link rel="stylesheet" href="mas.css">

<!-- Formulario de Login -->
<form method="POST" action="loginAdmin.php">
    <div class="form-header">
        <div class="circle">ADMINISTRAR</div>
    </div>
    <input type="email" name="email" placeholder="Correo Electrónico" required>
    <input type="password" name="password" placeholder="Contraseña" required>
    <button type="submit">Iniciar sesión</button>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

</form>