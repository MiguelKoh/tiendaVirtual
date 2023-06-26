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
?>

<!-- Resto del código HTML -->


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="assets/styles.css" type="text/css" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Tienda virtual</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-************" crossorigin="anonymous" />
</head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-2 col-md-2 col-sm-12 fondoSidebar h-lg-100 h-sm-50" id="sidebar">
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
                        <h4 class="text-white my-2 fuenteTitulo" id="titulo">Productos Escolares</h4>
                    </div>
                </div>
                 <div class="mb-5">
                 <!-- productos aquí -->
                
                <?php 
                    
                    $contador = 0;
                    $productos = obtenerProductoEscolar();

                    foreach ($productos as $producto) {
                        $contador++;
                        
                        if ($contador % 4 == 1) { ?>
                
                            <div class="row mx-3">
                          
                          <?php } ?>

                        <div class="col-lg-3 col-md-4 col-12 mt-5 d-flex justify-content-center"> 
                            <div class="card" style="width: 16rem;">
                                <div class="d-flex justify-content-center mt-3"><img class="w-50" src="imagenes/productos/<?= $producto["rutaimagen"] ?>" alt="Card image cap"></div>
                                <div class="card-body">
                                    <a href="pagina_detalle.php?id=<?= $producto["id"]?>"><h5 class="card-title" style="cursor:pointer;"><?= $producto["nombre"] ?></h5></a>
                                    <p class="card-text"><?="$ ",$producto["precio"] ?></p>
                                    <p class="mb-0"><span class="font-weight-bold">Tallas:</span> <?= $producto["tallas"] ?></p>
                                </div>
                            </div>
                        </div>
                
                      <?php  if ($contador % 4 === 0 || $contador === count($productos)) { ?>
                
                            </div>
                <?php
                        }
                    }//fin de foreach
                ?>

              
                
                 <!-- productos aquí -->
                 </div>
            </div>
        </div>
    </div>
</body>

</html>