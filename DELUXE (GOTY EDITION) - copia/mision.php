<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">

</head>


<?php
        echo'';
        ?>
<header>
    <a href="#" class="LOGO">DELUXE</a>
    <nav>
        <ul>

            <li><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-house" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                    </svg></a></li>
            <li><a href="comprar.php">Comprar</a></li>
            <li><a href="nosotros.php">Nosotros</a></li>

            <li><a href="vision.php">Vision</a></li>
            <li>
                <?php
session_start(); // Asegúrate de que la sesión esté iniciada
?>

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
<style>
/* Estilo general para la sección */
.contenido {
    margin: 20px auto;
    /* Márgenes automáticos para centrar */
    width: 90%;
    /* Ancho del 90% de la página */
    max-width: 1200px;
    /* Ancho máximo para pantallas grandes */
    background-color: #ffffff;
    /* Fondo completamente blanco */
    padding: 20px;
    /* Espaciado interno */
    border-radius: 10px;
    /* Bordes redondeados */
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    /* Sombra ligera */
}

/* Estilo para la tabla */
.contenido table {
    width: 100%;
    /* La tabla ocupará todo el ancho disponible */
    border-collapse: collapse;
    /* Quita espacios entre las celdas */
}

/* Estilo para las celdas de la tabla */
.contenido td {
    vertical-align: top;
    /* Alinea el contenido al inicio de las celdas */
    padding: 10px;
    /* Espaciado interno en las celdas */
}

/* Estilo para la imagen */
.contenido img {
    display: block;
    /* Asegura que no haya espacio debajo de la imagen */
    margin: auto;
    /* Centra la imagen dentro de la celda */
    border-radius: 5px;
    /* Bordes redondeados para la imagen */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
    /* Sombra ligera */
}

/* Estilo para el texto */
.contenido p {
    text-align: justify;
    /* Justifica el texto */
    line-height: 1.5;
    /* Espaciado entre líneas */
    font-family: 'Arial', sans-serif;
    /* Fuente limpia y legible */
    font-size: 0.9rem;
    /* Tamaño de texto más pequeño */
    color: #333;
    /* Color de texto oscuro */
}

/* Estilo para los títulos */
.contenido h2 {
    margin: 0 0 10px 0;
    /* Márgenes superiores e inferiores */
    color: #444;
    /* Color gris oscuro */
    font-size: 1.5rem;
    /* Tamaño del texto más pequeño */
}

/* Estilo para los elementos importantes */
.contenido strong {
    color: #8B4513;
    /* Café claro (SaddleBrown) */
    font-weight: bold;
    /* Negrita */
}
</style>
<br><br><br><br><br>
<section class="contenido">
    <table border="0" width="95%">
        <tr>
            <td><img src="img/cecy.webp" alt="image" height="500px" width="500px"></td>
            <td>
                <h2>
                    <p align="justify">
                        En Deluxe, nuestra misión es proporcionar moda de lujo de alta calidad que permita a nuestros
                        clientes expresar su individualidad y estilo único.
                        Nos dedicamos a ofrecer una experiencia de compra excepcional y personalizada, desde la
                        selección de materiales premium hasta el diseño exclusivo de cada prenda.
                        Creemos en la importancia de la sustentabilidad y la ética en la moda, por lo que nos esforzamos
                        por utilizar prácticas responsables y amigables con el medio ambiente.
                        Nos comprometemos a superar las expectativas de nuestros clientes, creando una conexión
                        emocional con cada pieza y elevando el estándar de lo que significa vestir con clase y
                        distinción.
                    </p>
                </h2>
            </td>
        </tr>
    </table>
</section>
<section class="zona1">

</section>



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