<?php
session_start(); // Asegúrate de que la sesión esté iniciada
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="estilo.css">
</head>
<br><br><br><br>
<?php
        echo'';
        ?>
<header>
    <a href="#" class="LOGO">DELUXE</a>
    <nav>
        <ul>
            <li>
                <input type="text" id="searchBar" placeholder="Buscar Bolso..." onkeyup="searchProducts()" />
            </li>
            <li><a href="UBI.php"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor"
                        class="bi bi-map" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M15.817.113A.5.5 0 0 1 16 .5v14a.5.5 0 0 1-.402.49l-5 1a.5.5 0 0 1-.196 0L5.5 15.01l-4.902.98A.5.5 0 0 1 0 15.5v-14a.5.5 0 0 1 .402-.49l5-1a.5.5 0 0 1 .196 0L10.5.99l4.902-.98a.5.5 0 0 1 .415.103M10 1.91l-4-.8v12.98l4 .8zm1 12.98 4-.8V1.11l-4 .8zm-6-.8V1.11l-4 .8v12.98z" />
                    </svg></a></li>
            <li><a href="index.php"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                        class="bi bi-house" viewBox="0 0 16 16">
                        <path
                            d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z" />
                    </svg></a></li>
            <li><a href="nosotros.php">Blog</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle">Comercio &#9660;
                    <!-- ▼ -->
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#promo">Ofertas</a></li>
                    <li><a href="#bolsas">Bolsas</a></li>
                </ul>
            </li>

            <!-- Barra de búsqueda -->

            <li>
                <svg onclick="showCart(this)" class="cart" xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                    <path
                        d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z" />
                    <text x="50%" y="60%" text-anchor="middle" stroke="#000" stroke-width="0" dy=".3em" font-size="7"
                        font-family="system-ui" fill="white" class="count-product">0</text>
                </svg>

                <script type="text/javascript" src="https://cdn.emailjs.com/dist/email.min.js"></script>


                <div class="cart-products" id="products-id">
                    <p class="close-btn" onclick="closeBtn()"><svg xmlns="http://www.w3.org/2000/svg" width="40"
                            height="40" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path
                                d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                        </svg></p>
                    <h3>Mi carrito</h3>
                    <div class="card-items"></div>
                    <h2>Total: $<strong class="price-total">0</strong></h2><br>
                    <link rel="stylesheet" type="text/css" href="pagar.css">
                    <!-- Tu botón de pedido -->
                    <center>
                        <a href="#" class="btn-pedido" onclick="realizarPedido()">HACER PEDIDO</a>
                    </center>

                    <!-- Contenedor del mensaje de éxito -->
                    <div id="mensajeExito" style="display:none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); 
background-color: #f5deb3; /* Café muy claro */
color: #4b3f29; /* Color oscuro pero suave */
padding: 25px 50px;
border-radius: 20px;
text-align: center; 
font-size: 24px; font-weight: bold;
box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15); z-index: 9999;
border: 3px solid #e5c09a;">
                        Pedido realizado con éxito
                        <span onclick="cerrarMensaje()" style="cursor: pointer; color: #4b3f29; font-size: 35px; font-weight: bold; 
    position: absolute; top: 5px; right: 15px;">&times;</span>
                    </div>

                    <script type="text/javascript">
                    function realizarPedido() {
                        // Mostrar el mensaje de éxito
                        document.getElementById("mensajeExito").style.display = "block";

                        // Estilo para el botón "Hacer Pedido"
                        document.querySelector('.btn-pedido').style.backgroundColor = '#f5deb3'; // Color café muy claro
                        document.querySelector('.btn-pedido').style.color = '#4b3f29'; // Color oscuro para el texto
                        document.querySelector('.btn-pedido').style.transform =
                            'scale(1.1)'; // Aumentar el tamaño del botón al hacer clic

                        // Mostrar un mensaje de éxito en consola (solo para comprobar si funciona)
                        console.log('Pedido realizado con éxito!');

                        // Esperar 2 segundos antes de recargar la página
                        setTimeout(function() {
                            // Recargar la página (simula el cierre del pedido)
                            location.reload();
                        }, 2000); // 2000 milisegundos = 2 segundos
                    }

                    // Función para cerrar el mensaje de éxito
                    function cerrarMensaje() {
                        document.getElementById("mensajeExito").style.display = "none";
                        // Recargar la página
                        location.reload();
                    }
                    </script>

                    <!-- Estilo del botón con colores café muy claros -->
                    <style>
                    .btn-pedido {
                        background-color: #f5deb3;
                        /* Café muy claro */
                        color: #4b3f29;
                        /* Color oscuro pero suave para el texto */
                        padding: 15px 30px;
                        text-decoration: none;
                        font-size: 22px;
                        border-radius: 30px;
                        /* Bordes más redondeados */
                        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.1);
                        transition: background-color 0.3s, transform 0.3s;
                        border: none;
                        cursor: pointer;
                    }

                    .btn-pedido:hover {
                        background-color: #e5c09a;
                        /* Café muy suave al pasar el ratón */
                        transform: scale(1.1);
                        /* Aumentar tamaño al pasar el ratón */
                    }

                    .btn-pedido:active {
                        transform: scale(1);
                        /* Volver al tamaño normal cuando se presiona el botón */
                    }

                    /* Mejorar visibilidad del mensaje */
                    #mensajeExito {
                        font-size: 24px;
                        font-weight: bold;
                        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
                        /* Añadir sombra al texto para mejor visibilidad */
                    }

                    #mensajeExito span {
                        font-size: 35px;
                        /* Tamaño más grande para el icono de cierre */
                        cursor: pointer;
                    }
                    </style>



                    <br>
                </div>
            </li>

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



<section class="zona1"></section>
<section>

    <head>

        <link rel="stylesheet" type="text/css" href="comprar.css">

    </head>


    <section class="container" class="searchBar">
        <div class="products" id="promo">
            <div class="carts">
                <div>
                    <img src="img/promo%20(1).jpg" alt="image" height="100%" width="100%">
                    <p><strike>1000</strike>/<span>750</span>$</p>
                </div>
                <p class="title">BOLSA BONITA 1<br> Deluxe</p>
                <a href="" data-id="1" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                <a onclick="showCart(this)" data-id="1" class="btn-add-cart">COMPRAR</a>
            </div>
            <div class="carts">
                <div>
                    <img src="img/promo%20(4).jpg" alt="image" height="100%" width="100%">
                    <p><strike>1000</strike>/<span>750</span>$</p>
                </div>
                <p class="title">BOLSA BONITA 2<br> Deluxe</p>
                <a href="" data-id="2" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                <a onclick="showCart(this)" data-id="2" class="btn-add-cart">COMPRAR</a>
            </div>
            <div class="carts">
                <div>
                    <img src="img/promo%20(3).jpg" alt="image" height="100%" width="100%">
                    <p><strike>1000</strike>/<span>750</span>$</p>
                </div>
                <p class="title">BOLSA BONITA 3<br> Deluxe</p>
                <a href="" data-id="3" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                <a onclick="showCart(this)" data-id="3" class="btn-add-cart">COMPRAR</a>
            </div>
            <div class="carts">
                <div>
                    <img src="img/promo%20(2).jpg" alt="image" height="100%" width="100%">
                    <p><strike>1000</strike>/<span>750</span>$</p>
                </div>
                <p class="title">BOLSA BONITA 4<br> Deluxe</p>
                <a href="" data-id="4" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                <a onclick="showCart(this)" data-id="4" class="btn-add-cart">COMPRAR</a>
            </div>


            <h1 class="custom-title">NUESTRAS BOLSAS PARA TUS OCACIONES</h1>

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



            <div class="products" id="bolsas">
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(1).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 1<br> Deluxe</p>
                    <a href="" data-id="5" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="5" class="btn-add-cart">COMPRAR</a>
                </div>
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(2).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 2<br> Deluxe</p>
                    <a href="" data-id="6" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="6" class="btn-add-cart">COMPRAR</a>
                </div>
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(3).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 3<br> Deluxe</p>
                    <a href="" data-id="7" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="7" class="btn-add-cart">COMPRAR</a>
                </div>
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(4).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 4<br> Deluxe</p>
                    <a href="" data-id="8" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="8" class="btn-add-cart">COMPRAR</a>
                </div>
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(5).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 5<br> Deluxe</p>
                    <a href="" data-id="9" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="9" class="btn-add-cart">COMPRAR</a>
                </div>
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(6).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 6<br> Deluxe</p>
                    <a href="" data-id="10" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="10" class="btn-add-cart">COMPRAR</a>
                </div>
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(7).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 7<br> Deluxe</p>
                    <a href="" data-id="11" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="11" class="btn-add-cart">COMPRAR</a>
                </div>
                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(8).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 8<br> Deluxe</p>
                    <a href="" data-id="12" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="12" class="btn-add-cart">COMPRAR</a>
                </div>

                <div class="carts">
                    <div>
                        <img src="img/bolsa%20(9).jpeg" alt="image" height="400" width="400">
                        <p><span>750</span>$</p>
                    </div>
                    <p class="title">BOLSA 9<br> Deluxe</p>
                    <a href="" data-id="13" class="btn-add-cart">Agregar al Carrito</a><br><br><br>
                    <a onclick="showCart(this)" data-id="13" class="btn-add-cart">COMPRAR</a>
                </div>
            </div>


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
    <br><br><br><br><br><br><br><br>
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
    <hr><br><br>
    <center>
        © 2024. Todos los derechos reservados Deluxe.
        <br><br><br><br>
    </center>
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