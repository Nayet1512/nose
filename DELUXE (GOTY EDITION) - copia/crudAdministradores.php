<?php
session_start();
include 'db.php'; // Incluye la conexión a la base de datos

// Obtener todos los administradores
$query = "SELECT * FROM administradores";
$result = $conn->query($query);

// Verificar si se ha enviado el formulario para agregar un administrador
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_administrador'])) {
    // Obtener los datos del formulario
    $nombre_usuario = $_POST['nombre_usuario'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar los datos (puedes agregar más validaciones si lo deseas)
    if (empty($nombre_usuario) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Conectar a la base de datos
        require_once 'db.php';

        // Encriptar la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo administrador en la base de datos
        $query = "INSERT INTO administradores (nombre_usuario, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $nombre_usuario, $email, $password_hash);

        if ($stmt->execute()) {
            $success = "Administrador agregado exitosamente.";
        } else {
            $error = "Error al agregar el administrador.";
        }

        // Redirigir para que se recargue la página y se muestren los cambios
        header("Location: crudAdministradores.php");
        exit;
    }
}

// Actualizar administrador si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_administrador'])) {
    $id = $_POST['id'];
    $nombre_usuario = trim($_POST['nombre_usuario']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    // Verificar si el correo ya existe en otro administrador
    $verificarQuery = "SELECT id FROM administradores WHERE email = ? AND id != ?";
    $stmt = $conn->prepare($verificarQuery);
    $stmt->bind_param("si", $email, $id);
    $stmt->execute();
    $verificacion = $stmt->get_result();

    if ($verificacion->num_rows > 0) {
        $error = "El correo electrónico ya está registrado.";
    } else {
        // Actualizar administrador
        $updateQuery = "UPDATE administradores SET nombre_usuario = ?, email = ?, password = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssi", $nombre_usuario, $email, $password, $id);

        if ($stmt->execute()) {
            $success = "Administrador actualizado exitosamente.";
            header("Refresh:0"); // Recargar la página para mostrar cambios
        } else {
            $error = "Error al actualizar el administrador.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Gestión de Administradores</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="masmas.css">
    <style>
    /* Ajustar los formularios para que los campos estén centrados con márgenes */
    form input {
        width: 100%;
        max-width: 400px;
        padding: 10px;
        margin: 10px auto;
        display: block;
        box-sizing: border-box;
    }

    form button {
        width: 100%;
        max-width: 400px;
        padding: 10px;
        margin: 10px auto;
        display: block;
        box-sizing: border-box;
        cursor: pointer;
    }
    </style>
</head>

<body>
    <header>
        <a href="#" class="LOGO">DELUXE</a>
        <nav>
            <ul>
                <li><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                            fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg></a></li>
                <li><a href="crudUsers.php">Usuarios</a></li>
                <li>
                    <a href="login.php" style="text-decoration: none; display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" fill="currentColor"
                            class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        <?php if (isset($_SESSION['nombre'])): ?>
                        <span style="margin-left: 10px; font-size: 18px; color: #000;">
                            <?php echo htmlspecialchars($_SESSION['nombre']); ?>
                        </span>
                        <?php endif; ?>
                    </a>
                </li>
            </ul>
        </nav>
    </header>

    <br><br><br><br><br><br>
    <center>
        <h1>Gestión de Administradores</h1>
    </center>

    <!-- Botón Agregar Administrador -->
    <div style="text-align: center; margin-bottom: 20px;">
        <button class="action-btn" onclick="abrirModalAgregar()">Agregar Administrador</button>
    </div>

    <div class="crud-container">
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Contraseña (cifrada)</th>
                    <th>Email</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['nombre_usuario']); ?></td>
                    <td><?= htmlspecialchars($row['password']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td>
                        <!-- Botón Modificar -->
                        <button class="action-btn"
                            onclick="editarAdministrador(<?= htmlspecialchars(json_encode($row)); ?>)">Editar</button>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal para editar administrador -->
    <div id="editar-modal" style="display: none;">
        <div class="form-header">
            <div class="circle">
                <center>Editar Administrador</center>
            </div>
        </div>
        <form method="POST" action="crudAdministradores.php">
            <input type="hidden" name="id" id="edit-id">
            <input type="text" name="nombre_usuario" id="edit-nombre_usuario" placeholder="Nombre de Usuario" required>
            <input type="email" name="email" id="edit-email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" id="edit-password" placeholder="Nueva Contraseña">
            <button type="submit" name="editar_administrador">Guardar Cambios</button>
            <button type="button" onclick="cerrarModal()">Cancelar</button>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <?php if (isset($success)) echo "<p>$success</p>"; ?>
    </div>

    <!-- Modal para agregar administrador -->
    <div id="agregar-modal" class="modal">
        <div class="form-header">
            <div class="circle">
                <center>Agregar Administrador</center>
            </div>
        </div>
        <form method="POST" action="crudAdministradores.php">
            <input type="text" name="nombre_usuario" id="add-nombre_usuario" placeholder="Nombre de Usuario" required>
            <input type="email" name="email" id="add-email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" id="add-password" placeholder="Contraseña" required>
            <button type="submit" name="agregar_administrador">Guardar Administrador</button>
            <button type="button" onclick="cerrarModalAgregar()">Cancelar</button>
        </form>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">



    <div class="sexo">
        <input type="checkbox" id="btn-mas">
        <div class="redes">
            <a href="https://www.instagram.com/amor.in.un.fiore_mx/" class="bi bi-instagram"></a>
            <a href="https://www.facebook.com/profile.php?id=61558685136571&mibextid=ZbWKwL" class="bi bi-facebook"></a>
            <a href="https://twitter.com/i/flow/login?redirect_after_login=%2FAmoreinunfiore" class="bi bi-twitter"></a>
            <a href="https://pin.it/14SUXYDzc" class="bi bi-pinterest"></a>
        </div>
        <div class="btn-mas">
            <label for="btn-mas" class="bi bi-plus"></label>
        </div>
    </div>
    <script>
    // Abre el modal de agregar administrador
    function abrirModalAgregar() {
        document.getElementById('agregar-modal').style.display = 'block';
    }

    // Cierra el modal de agregar administrador
    function cerrarModalAgregar() {
        document.getElementById('agregar-modal').style.display = 'none';
    }

    // Función para abrir el modal de edición
    function editarAdministrador(administrador) {
        document.getElementById('editar-modal').style.display = 'block';
        document.getElementById('edit-id').value = administrador.id;
        document.getElementById('edit-nombre_usuario').value = administrador.nombre_usuario;
        document.getElementById('edit-email').value = administrador.email;
        document.getElementById('edit-password').value = ''; // Campo de contraseña en blanco
    }

    // Función para cerrar el modal de edición
    function cerrarModal() {
        document.getElementById('editar-modal').style.display = 'none';
    }
    </script>
</body>

</html>