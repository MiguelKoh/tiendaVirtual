<?php
session_start();

$id = $_POST['id'];
$cantidad = $_POST['cantidad'];

$_SESSION['carrito'][$id]['cantidad'] = $cantidad;

// Recalcular el total del carrito
$precioTotal = number_format(0, 2);
foreach ($_SESSION['carrito'] as $producto) {
    $precioTotalProducto = $producto['precio'] * $producto['cantidad'];
    $precioTotal += $precioTotalProducto;
}
$precioTotal = number_format($precioTotal, 2);

// Recalcular el costo del producto total
$precioTotalProducto = number_format($_SESSION['carrito'][$id]['precio'] * $cantidad, 2);

// Retornamos un JSON
echo json_encode(array(
    "precioTotalProducto" => $precioTotalProducto,
    "precioTotal" => $precioTotal
));

