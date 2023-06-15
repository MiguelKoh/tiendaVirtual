<?php

include("conexion.php");
session_start();
$cn = ConectaBD();
$id = isset($_POST['id']) ? $_POST['id'] : "";
$cantidad = isset($_POST['cantidad']) ? $_POST['cantidad'] : 1;

// Verifica que el ID que recibe existe.
$consultaTamanos = "SELECT nombre, codigoInventario, precio, tamano FROM productos_almacen_tamanos pat
                         INNER JOIN productos_almacen pa ON pat.idProducto = pa.id
                         WHERE pat.id = '" . $id . "'";
$resultadoTamanos = mysqli_query($cn, $consultaTamanos);

if (mysqli_num_rows($resultadoTamanos) <= 0) {
    echo"no existe el id";
}

// Checa si el arreglo de carrito ya ha sido creado.
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

// Checa si el item ya existe en el carrito.
if (!array_key_exists($id, $_SESSION['carrito'])) {
    $fila = mysqli_fetch_array($resultadoTamanos);
    $item = array(
        'nombre' => $fila['nombre'],
        'precio' => number_format($fila['precio'], 2),
        'tamano' => $fila['tamano'],
        'codigo' => $fila['codigoInventario'],
        'cantidad' => $cantidad
    );

   $_SESSION['carrito'][$id] = $item;
} else {
    $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
}

header('Location: escolares.php');
