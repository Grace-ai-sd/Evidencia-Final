<?php
session_start();

// Definir productos (en un caso real, probablemente se obtendrían de una base de datos)
$products = [
    'serum1' => ['name' => 'Serum 1', 'price' => 150],
    'serum2' => ['name' => 'Serum 2', 'price' => 200],
    'serum3' => ['name' => 'Serum 3', 'price' => 250],
];

// Inicializar el carrito si no existe
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Función para agregar productos al carrito
function addToCart($productId) {
    global $products;
    if (isset($products[$productId])) {
        $_SESSION['cart'][] = $products[$productId];
    }
}

// Función para aplicar el descuento
function applyDiscount($code) {
    $discount = 0;
    if ($code === "DESCUENTO10") {
        $discount = 0.1;  // Descuento del 10%
    }
    return $discount;
}

// Lógica para agregar productos al carrito desde el formulario
if (isset($_GET['add'])) {
    $productId = $_GET['add'];
    addToCart($productId);
}

// Lógica para aplicar el código de descuento
$discount = 0;
if (isset($_POST['promo_code'])) {
    $discount = applyDiscount($_POST['promo_code']);
}

// Calcular el total con el descuento
$total = 0;
foreach ($_SESSION['cart'] as $item) {
    $total += $item['price'];
}

$total -= $total * $discount; // Aplicar el descuento

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
</head>
<body>

    <h1>Carrito de Compras</h1>

    <h2>Productos en el carrito:</h2>
    <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <li><?php echo $item['name']; ?> - $<?php echo $item['price']; ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Total: $<?php echo number_format($total, 2); ?></h3>

    <!-- Formulario para aplicar el código de descuento -->
    <form action="cart.php" method="POST">
        <input type="text" name="promo_code" placeholder="Código promocional">
        <button type="submit">Aplicar Código</button>
    </form>

    <!-- Enlace para agregar productos al carrito -->
    <h3>Productos disponibles:</h3>
    <ul>
        <li><a href="cart.php?add=serum1">Agregar Serum 1 - $150</a></li>
        <li><a href="cart.php?add=serum2">Agregar Serum 2 - $200</a></li>
        <li><a href="cart.php?add=serum3">Agregar Serum 3 - $250</a></li>
    </ul>

</body>
</html>
