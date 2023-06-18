<?php

function ConectaBD() {
    if (!($link = mysqli_connect("localhost", "root",""))) {
   
        echo "Error conectando a la base de datos.";
        exit();
    }
    if (!mysqli_select_db($link,"carrito")) {
        echo "Error seleccionando la base de datos.";
        exit();
    }
    return $link;
}



?>

