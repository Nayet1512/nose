<?php
session_start(); // Iniciar la sesión
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Comprobar si el usuario ha iniciado sesión al hacer clic en el botón
    if (isset($_SESSION['usuario_id'])) {
        // Si la sesión está activa, redirigir a 'comprar.php'
        header('Location: comprar.php');
        exit();
    } else {
        // Si no está activo, redirigir a 'login.php'
        header('Location: login.php');
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">

</head>

<div class="hero">
    <div class="hero-image-overlay"></div>
    <img src="img/fondo.webp" alt="image" class="hero-image">

    <div class="hero-text">
        <hr style="border: 0; border-top: 2px solid #fff; width: 100%; margin: 20px auto;">

        <h1>Nuestras<br>colecciones de<br>bolsos<br>atemporales</h1>
        <p>Diseñados para tu estilo de vida, los Deluxe son<br>hermosos en su simplicidad.</p>
        <form method="POST">
            <button type="submit" class="btn-coffee">Ir a la tienda</button>
        </form>

    </div>
</div>




<?php
        echo'';
        ?>
<header>
    <a href="#" class="LOGO">DELUXE</a>
    <nav>
        <ul>
            <li><a href="loginAdmin.php">Administrar</a></li>
            <li><a href="UBI.php"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
                        <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6" />
                    </svg></a></li>
        </ul>
    </nav>
</header>






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

<!-- Enlace a Bootstrap Icons -->
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