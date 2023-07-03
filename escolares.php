<?php
include("funciones.php");
include("validate.php");

// Verifica si el arreglo 'carrito' no está definido y lo crea si es necesario
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

/* La variable $cantidadProductos esta insertada en un <li> del sidebar, el cual esta invocado desde 
   archivosAjax/sidebar.php 
*/

$cantidadProductos = 0;

foreach ($_SESSION['carrito'] as $producto) {
    
    $cantidadProductos += $producto['cantidad'];
 
}//fin del foreach
 
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

    <title>Tienda virtual - Escolares</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-************" crossorigin="anonymous" />
</head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row" id="desplazar">
           
           <!-- Inicio del sidebar -->
            <?php
            include("archivosAjax/sidebar.php");
            ?>
            <!-- Fin del sidebar -->

            <div class="col-lg-10 col-md-10 col-sm-12" id="contenido">
                <!-- Contenido principal aquí -->
                
                <div class="row">
                    <div class="col-12 px-0">
                        <img src="imagenes/banners/BANNER-Tienda virtual_siscap_v2.png" class="img-fluid" width="100%">
                    </div>
                </div>
                             
               
               <div class="row fondo">
                   <div class="col-12 d-flex justify-content-start align-items-center fondoProductos">
                      <div id="btn-sidebar"> <span class="text-white">&#9776;</span></div>
                      <h3 class="text-white mx-auto my-2" id="titulo">Productos Escolares</h3>
                   </div>  
               </div>
   


                 <div class="mb-5">
                 <!-- productos aquí -->
                
                <?php 
                    
                    $contador = 0;
                    $productos = obtenerProductosEscolares();

                    foreach ($productos as $producto) {
                        $contador++;
                        
                        if ($contador % 4 == 1) { ?>
                
                            <div class="row mx-3">
                          
                          <?php } ?>

                        <div class="col-lg-3 col-md-4 col-12 mt-5 d-flex justify-content-center"> 
                            <div class="card" style="width: 16rem;">
                                
                                <div class="d-flex justify-content-center mt-3">
                                    <img class="w-50" src="imagenes/productos/<?= $producto["rutaimagen"] ?>" loading="lazy" alt="Card image cap">
                                </div>
                                
                                <div class="card-body">
                                    <a href="pagina_producto.php?id=<?= $producto["id"]?>">
                                       <h5><?= $producto["nombre"] ?></h5>
                                   </a>
                                    
                                    <p class="h6 my-3"><?="$ ",$producto["precio"] ?></p>
                                    <p class="mb-0">
                                      <span class="font-weight-bold">Tallas:</span> 
                                      <?= $producto["tallas"] ?>
                                   </p>
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
    <script src="assets/sidebar.js"></script>
</body>

</html>