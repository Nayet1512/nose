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


<br><br><br><br><br><br><br>
<center>
    <h1 class="custom-title">UBICACION</h1>

    <style>
    .custom-title {
        font-family: 'Poppins', sans-serif;
        /* Tipografía moderna */
        font-size: 2.5rem;
        /* Tamaño del texto */
        color: #D8B29A;
        /* Color café claro */
        text-align: center;
        /* Centrar el texto */
        text-transform: uppercase;
        /* Convertir a mayúsculas */
        letter-spacing: 3px;
        /* Espaciado entre letras */
        font-weight: 700;
        /* Negrita */
        margin-top: 20px;
        margin-bottom: 20px;
        position: relative;
        /* Posicionamiento para decoraciones adicionales */
    }

    .custom-title::after {
        content: '';
        width: 80px;
        /* Ancho de la línea */
        height: 4px;
        /* Grosor de la línea */
        background: #D8B29A;
        /* Mismo color que el texto */
        display: block;
        margin: 10px auto 0;
        /* Centrar debajo del texto */
        border-radius: 2px;
        /* Bordes redondeados en la línea */
    }
    </style>



    <br>



    <div style="display: flex; align-items: center; justify-content: space-between; width: 100%; height: 80vh;">

        <!-- Mapa de Google a la izquierda -->
        <div style="flex: 1; height: 100%;">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d278.20185242548433!2d-99.15663351509097!3d19.685266409124015!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d1f535e5b9d92f%3A0x645fede614a12741!2sFloreria%20Amore%20in%20un%20fiore!5e1!3m2!1ses-419!2smx!4v1714071542543!5m2!1ses-419!2smx"
                width="100%" height="100%" style="border: 0; display: block;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>

        <!-- Imágenes a la derecha -->
        <div
            style="display: flex; justify-content: center; align-items: center; height: 100%; position: relative; width: 35%;">

            <!-- Imagen 1: Rectángulo con bordes redondeados y desplazada -->
            <img id="img1" src="img/local%20(1).jpeg" alt="image"
                style="width: 90%; height: auto; object-fit: cover; border-radius: 15px; position: absolute; top: 0; left: 5%; transform: rotate(-10deg); cursor: move;">

            <!-- Imagen 2: Rectángulo con bordes redondeados y desplazada -->
            <img id="img2" src="img/local%20(2).jpeg" alt="image"
                style="width: 85%; height: auto; object-fit: cover; border-radius: 15px; position: absolute; top: 10%; left: 10%; transform: rotate(5deg); cursor: move;">

            <!-- Imagen 3: Rectángulo con bordes redondeados y desplazada -->
            <img id="img3" src="img/local%20(3).jpeg" alt="image"
                style="width: 80%; height: auto; object-fit: cover; border-radius: 15px; position: absolute; top: 20%; left: 15%; transform: rotate(-5deg); cursor: move;">

        </div>

        <script>
        // Función para hacer las imágenes arrastrables
        function dragElement(elmnt) {
            var pos1 = 0,
                pos2 = 0,
                pos3 = 0,
                pos4 = 0;
            elmnt.onmousedown = dragMouseDown;

            function dragMouseDown(e) {
                e = e || window.event;
                e.preventDefault();
                // Obtiene la posición del cursor en el momento en que se hace clic
                pos3 = e.clientX;
                pos4 = e.clientY;
                document.onmouseup = closeDragElement;
                document.onmousemove = elementDrag;
            }

            function elementDrag(e) {
                e = e || window.event;
                e.preventDefault();
                // Calcula la nueva posición del cursor
                pos1 = pos3 - e.clientX;
                pos2 = pos4 - e.clientY;
                pos3 = e.clientX;
                pos4 = e.clientY;
                // Establece la nueva posición del elemento
                elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
            }

            function closeDragElement() {
                // Detiene el movimiento cuando se suelta el mouse
                document.onmouseup = null;
                document.onmousemove = null;
            }
        }

        // Aplica la funcionalidad a las imágenes
        dragElement(document.getElementById("img1"));
        dragElement(document.getElementById("img2"));
        dragElement(document.getElementById("img3"));
        </script>



    </div>

</center>







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