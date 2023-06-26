<?php
include("funciones.php");
session_start();

// Verifica si el arreglo 'carrito' no está definido y lo crea si es necesario
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$cantidadProductos = 0;
foreach ($_SESSION['carrito'] as $producto) {
    $cantidadProductos += $producto['cantidad'];
    //print_r($producto);
    //echo "<br>";
}
print_r($_SESSION['carrito']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/styles.css" type="text/css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <title>Tienda virtual</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-************" crossorigin="anonymous" />
</head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-2 col-md-2 col-sm-12 fondoSidebar h-100" id="sidebar">
                <!-- Contenido del sidebar aquí -->
                <div class="row my-5">
                    <div class="col-4 d-flex justify-content-center align-items-center px-0 ">
                        <div id="btn-sidebar">
                            <span class="text-white">&#9776;</span>
                        </div>
                    </div>
                    <div class="col-8 px-0">
                        <img src="imagenes/banners/logo-uady-blanco.png" alt="Mountain View"
                            class="d-none d-xl-block d-lg-block d-md-block img-fluid w-75">
                    </div>
                </div>
                <ul>
                
                <a href="escolares.php"><li>Escolares</li></a>
                <a href="deportivos.php"><li>Deportivos</li></a>
                <a href="tienda_carrito.php" class="link">
                    <li>
                        <div>
                           <div>
                            <span><i class="fas fa-shopping-cart"></i></span>
                            <span>Mi carrito</span>
                            <span class="badge badge-pill badge-light" id="counter"><?= $cantidadProductos?></span>
                          </div>
                        </div>
                    </li>
                </a>
                    <li>
                        <div>
                            <div>
                                <span><i class="fas fa-sign-out-alt" aria-hidden="true"></i></span>
                                <span>Salir</span>
                            </div>
                
                        </div>
                    </li>
                </ul>
            
            </div>

                <!-- Fin del contenido del sidebar -->


            <div class="col-lg-10 col-md-10 col-sm-12" id="contenido">
                <!-- Contenido principal aquí -->
                <div class="row">
                    <div class="col-12 px-0">
                        <img src="imagenes/banners/BANNER-Tienda virtual_siscap_v2.png" class="img-fluid" width="100%">
                    </div>
                </div>
                             
                <div class="row fondo">
                    <div class="col-12 d-flex justify-content-center align-items-center fondoProductos">
                        <h4 class="text-white my-2 fuenteTitulo" id="titulo">Carrito</h4>
                    </div>
                </div>
                 <!-- producto aquí -->
                 
            

                 <div class="d-flex justify-content-center">
                    <div class="row h-75 w-80 m-5 rounded">
                        <div class="col-lg-12 col-sm-12 d-flex justify-content-center align-items-center">
                        <?php
                        
                        if (count($_SESSION['carrito']) > 0) {?>

                        <table class="table bg-light">
                          <thead class="thead-dark">
                            <tr>
                              <th scope="col">Producto</th>
                              <th scope="col">Precio</th>
                              <th scope="col">Cantidad</th>
                            </tr>
                          </thead>
                          <tbody>
                         <?php
                         $precioTotal = number_format(0, 2); 
                         foreach ($_SESSION['carrito'] as $producto) { 
                            $precioTotalProducto = $producto['precio'] * $producto['cantidad'];
                                                        $precioTotal += $precioTotalProducto;
                            ?>
                            <tr>
                              <td><?=  $producto['nombre']?><p>Talla: <?= $producto['tamano'] ?></p></td>
                              <td>$<?= number_format($precioTotalProducto, 2) ?></td>
                              <td><?=  $producto['cantidad'] ?></td>
                            </tr>
                           <?php } ?> 
                            <tr>
                            <td><p class="font-weight-bold">Total</p></td>
                            <td><p class="text-info font-weight-bold">$<?=$precioTotal?></p></td>
                            </tr>
                          </tbody>
                        
                        </table>
                        <?php } else{ ?>
                           <p class="font-weight-bold">Carrito vacio</p>
                        <?php }  ?>
                            
                        </div>
                        
                        </div>
                    </div>
                </div>      
                 <!-- producto aquí -->

            </div>
        </div>
    </div>
  <script src="assets/script.js"></script>
</body>

</html>