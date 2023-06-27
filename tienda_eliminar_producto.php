<?php
session_start();

$id = $_POST["id"];
unset($_SESSION['carrito'][$id]);

if (count($_SESSION['carrito']) > 0) {
    // Recalcular el total
    $precioTotal = number_format(0, 2);
    foreach ($_SESSION['carrito'] as $producto) {
        $precioTotalProducto = $producto['precio'] * $producto['cantidad'];
        $precioTotal += $precioTotalProducto;
    }

    echo '<strong class="text-primary">&dollar;' . number_format($precioTotal, 2) . '</strong>';
}










