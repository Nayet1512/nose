<?php
session_start();
include 'db.php'; // Incluye la conexión a la base de datos

// Obtener todos los usuarios
$query = "SELECT * FROM usuarios";
$result = $conn->query($query);
// Verificar si se ha enviado el formulario para agregar un usuario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['agregar_usuario'])) {
    // Obtener los datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validar los datos (puedes agregar más validaciones si lo deseas)
    if (empty($nombre) || empty($email) || empty($password)) {
        $error = "Todos los campos son obligatorios.";
    } else {
        // Conectar a la base de datos
        // (Asegúrate de que esta conexión esté configurada correctamente)
        require_once 'db.php';

        // Encriptar la contraseña
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos
        $query = "INSERT INTO usuarios (nombre, email, password, activo) VALUES (?, ?, ?, 1)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sss", $nombre, $email, $password_hash);

        if ($stmt->execute()) {
            $success = "Usuario agregado exitosamente.";
        } else {
            $error = "Error al agregar el usuario.";
        }

        // Redirigir para que se recargue la página y se muestren los cambios
        header("Location: crudUsers.php");
        exit;
    }
}
// Actualizar usuario si se envía el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['editar_usuario'])) {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $password = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);
    $tipo_usuario = $_POST['tipo_usuario'];
    $activo = isset($_POST['activo']) ? 1 : 0;

    // Verificar si el correo ya existe en otro usuario
    $verificarQuery = "SELECT id FROM usuarios WHERE email = ? AND id != ?";
    $stmt = $conn->prepare($verificarQuery);
    $stmt->bind_param("si", $email, $id);
    $stmt->execute();
    $verificacion = $stmt->get_result();

    if ($verificacion->num_rows > 0) {
        $error = "El correo electrónico ya está registrado.";
    } else {
        // Actualizar usuario
        $updateQuery = "UPDATE usuarios SET nombre = ?, email = ?, password = ?, tipo_usuario = ?, activo = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("sssisi", $nombre, $email, $password, $tipo_usuario, $activo, $id);

        if ($stmt->execute()) {
            $success = "Usuario actualizado exitosamente.";
            header("Refresh:0"); // Recargar la página para mostrar cambios
        } else {
            $error = "Error al actualizar el usuario.";
        }
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['toggle_activo'])) {
    $id = $_POST['id'];

    // Obtener el estado actual del usuario
    $query = "SELECT activo FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $usuario = $result->fetch_assoc();

    // Alternar el estado de la cuenta
    $nuevo_estado = $usuario['activo'] ? 0 : 1; // Si está activo, desactivarlo, si está inactivo, activarlo

    // Actualizar el estado en la base de datos
    $updateQuery = "UPDATE usuarios SET activo = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ii", $nuevo_estado, $id);

    if ($stmt->execute()) {
        $success = "Estado de la cuenta actualizado exitosamente.";
    } else {
        $error = "Error al actualizar el estado de la cuenta.";
    }

    header("Location: crudUsers.php"); // Redirigir después de la actualización
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
    <link rel="stylesheet" type="text/css" href="masmas.css">
</head>

<body>

    <?php
    echo '';
?>
    <header>
        <a href="#" class="LOGO">DELUXE</a>
        <nav>
            <ul>
                <li><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                            fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                        </svg></a></li>
                <li><a href="crudAdministradores.php">Administradores</a></li>
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
        <h1>Gestión de Usuarios</h1>
    </center>

    <!-- Botón Agregar Usuario -->
    <div style="text-align: center; margin-bottom: 20px;">
        <button class="action-btn" onclick="abrirModalAgregar()">Agregar Usuario</button>

    </div>

    <div class="crud-container">
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Tipo Usuario</th>
                    <th>Activo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= htmlspecialchars($row['nombre']); ?></td>
                    <td><?= htmlspecialchars($row['email']); ?></td>
                    <td><?= 'usuario'; ?></td> <!-- Siempre muestra "usuario" -->
                    <td><?= $row['activo'] ? 'Activo' : 'Inactivo'; ?></td>
                    <td>
                        <!-- Botón Modificar -->
                        <button class="action-btn"
                            onclick="editarUsuario(<?= htmlspecialchars(json_encode($row)); ?>)">Editar</button>

                        <!-- Botón Activar/Desactivar -->
                        <form action="crudUsers.php" method="POST" style="display:inline;">
                            <input type="hidden" name="id" value="<?= $row['id']; ?>">
                            <button class="action-btn" type="submit" name="toggle_activo">
                                <?= $row['activo'] ? 'Desactivar' : 'Activar'; ?>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Ventana emergente para editar usuario -->
    <div id="editar-modal" style="display: none;">
        <div class="form-header">
            <div class="circle">
                <center>Editar Usuario</center>
            </div>
        </div>
        <form method="POST" action="">
            <input type="hidden" name="id" id="edit-id">
            <input type="text" name="nombre" id="edit-nombre" placeholder="Nombre" required>
            <input type="email" name="email" id="edit-email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" id="edit-password" placeholder="Nueva Contraseña">
            <button type="submit" name="editar_usuario">Guardar Cambios</button>
            <button type="button" onclick="cerrarModal()">Cancelar</button>
        </form>
        <?php if (isset($error)) echo "<p>$error</p>"; ?>
        <?php if (isset($success)) echo "<p>$success</p>"; ?>
    </div>


    <!-- Modal para agregar usuario -->
    <div id="agregar-modal" class="modal">
        <div class="form-header">
            <div class="circle">
                <center>Agregar Usuario</center>
            </div>
        </div>
        <form method="POST" action="crudUsers.php">
            <input type="text" name="nombre" id="add-nombre" placeholder="Nombre" required>
            <input type="email" name="email" id="add-email" placeholder="Correo Electrónico" required>
            <input type="password" name="password" id="add-password" placeholder="Contraseña" required>
            <button type="submit" name="agregar_usuario">Guardar Usuario</button>
            <button type="button" onclick="cerrarModalAgregar()">Cancelar</button>
        </form>
    </div>




    <script>
    // Abre el modal de agregar usuario
    function abrirModalAgregar() {
        document.getElementById('agregar-modal').style.display = 'block';
    }

    // Cierra el modal de agregar usuario
    function cerrarModalAgregar() {
        document.getElementById('agregar-modal').style.display = 'none';
    }


    // Función para abrir el modal de edición
    function editarUsuario(usuario) {
        document.getElementById('editar-modal').style.display = 'block';
        document.getElementById('edit-id').value = usuario.id;
        document.getElementById('edit-nombre').value = usuario.nombre;
        document.getElementById('edit-email').value = usuario.email;
        document.getElementById('edit-password').value = '';
    }

    // Función para abrir el modal de agregar usuario
    function abrirModalAgregar() {
        document.getElementById('agregar-modal').style.display = 'block';
    }

    // Función para cerrar el modal de edición
    function cerrarModal() {
        document.getElementById('editar-modal').style.display = 'none';
    }

    // Función para cerrar el modal de agregar usuario
    function cerrarModalAgregar() {
        document.getElementById('agregar-modal').style.display = 'none';
    }
    </script>












    <script>
    function showCart(x) {
        document.getElementById("products-id").style.display = "block";
    }

    function closeBtn() {
        document.getElementById("products-id").style.display = "none";
    }
    </script>
    <script src="./custom.js"></script>

    <link rel="stylesheet" type="text/css" href="redes.css">

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



    </section>
    <script>
    function mostrarCarrito() {
        var carrito = document.querySelector('.cart-items');
        var total = document.querySelector('.price-total').textContent;

        // Verificar si hay productos en el carrito
        if (carrito.innerHTML.trim() === '') {
            alert('Agrega algo al carrito antes de hacer el pedido');
            return;
        }

        // Crear una ventana emergente con los productos y el total al pagar
        var ventanaEmergente = window.open('', 'Pedido', 'width=400,height=400');
        ventanaEmergente.document.write('<h2>Mi Carrito</h2>');
        ventanaEmergente.document.write(carrito.innerHTML);
        ventanaEmergente.document.write('<h2>Total: $' + total + '</h2>');
    }
    </script>
    <script type="text/javascript">
    window.addEventListener("scroll", function() {
        var header = document.querySelector("header");
        header.classList.toggle("abajo", window.scrollY > 0);
    })

    function searchProducts() {
        // Obtener el valor de búsqueda
        const searchValue = document.getElementById("searchBar").value.toLowerCase();

        // Obtener todos los productos
        const products = document.querySelectorAll(".carts");

        // Iterar sobre cada producto y mostrar/ocultar según la coincidencia
        products.forEach(product => {
            const title = product.querySelector(".title").textContent.toLowerCase();
            if (title.includes(searchValue)) {
                product.classList.remove("hidden");
            } else {
                product.classList.add("hidden");
            }
        });
    }
    </script>

</html>