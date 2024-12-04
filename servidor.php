<?php
session_start();

// Ejemplo: Productos en el carrito
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Agregar producto
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product'])) {
    $_SESSION['cart'][] = $_POST['product'];
}

// Mostrar carrito
if (!empty($_SESSION['cart'])) {
    echo "<h3>Carrito de productos:</h3>";
    echo "<ul>";
    foreach ($_SESSION['cart'] as $product) {
        echo "<li>$product</li>";
    }
    echo "</ul>";
} else {
    echo "<p>El carrito está vacío.</p>";
}
?>
