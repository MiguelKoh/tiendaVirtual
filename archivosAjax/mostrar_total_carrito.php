<?php
session_start();

// Verifica si el arreglo 'carrito' no está definido y lo crea si es necesario
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$cantidadProductos = 0;
foreach ($_SESSION['carrito'] as $producto) {
    $cantidadProductos += $producto['cantidad'];
    
}

// Solo se imprime el total de productos 
$json[]= array(
    'cantidadTotalCarrito'=> $cantidadProductos
);
echo json_encode($json); 

?>
