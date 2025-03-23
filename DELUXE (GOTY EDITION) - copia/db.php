<?php
$servername = "localhost";
$username = "root"; // Cambia estos valores según tu configuración
$password = "";
$dbname = "proyecto"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>