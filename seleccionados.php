<?php
include("funciones.php");
include("validate.php");
include("conexion.php");
$cn = ConectaBD();
//include("../validate.php");


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
    <title>Tienda virtual - Deportivos</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
    <link rel="stylesheet" href="assets/fontawesome-free-5.15.2-web/css/all.min.css">
</head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row">
            
            <!-- Inicio sidebar -->
                <?php
                include("archivosAjax/sidebar.php");
                ?>
            <!-- Fin del del sidebar -->


            <div class="col-lg-10 col-md-10 col-sm-12" id="contenido">
                <!-- Contenido principal aquí -->
                <div class="row">
                    <div class="col-12 px-0">
                        <img src="imagenes/banners/BANNER-Tienda virtual_siscap_v2.png" class="img-fluid" width="100%">
                    </div>
                </div>
                             
                <div class="row fondo d-flex justify-content-center">
                   <div class="col-12 d-flex justify-content-start align-items-center fondoProductos">
                      <div id="btn-sidebar"> <span class="text-white">&#9776;</span></div>
                      <h3 class="text-white my-2 mx-auto" id="titulo">Productos selección deportiva</h3>
                   </div>  
                   <div class="col-11 mt-4 px-0">
                   
                    <div id="accordion">
                      <div class="card">
                        <div class="card-header d-flex justify-content-center" id="headingOne">
                          <h4 class="mb-0">
                            <button class="btn btn-link text-dark font-weight-bold" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                              Información de compra
                            </button>
                          </h4>
                        </div>

                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                          <div class="card-body">
                            Al hacer clic sobre el nombre del producto, el usuario es redirigido a la página del producto, donde se despliega la información del producto y adicionalmente un campo en el que puede colocar la cantidad que desea de ese producto y seleccionar la talla, los shorts no cuentan con un costo debido a que la prenda es complementaria a los uniformes por tanto debe seleccionar el juego completo, excepto el mandil y la playera de actividades culturales los cuales son por separado.
                          </div>
                        </div>
                      </div>
                    </div>
                       
                   </div>
               </div>

                <div class="mb-5">
                 <!-- productos aquí -->
                    <?php 
                    $contador = 0;
                    $productos = obtenerProductoDeportivo($cn);

                    foreach ($productos as $producto) {
                        $contador++;
                        if ($contador % 4 == 1) { 
                    ?>
                            <div class="row mx-3">
                    <?php
                        }
                    ?>
                        <div class="col-lg-3 col-md-4 col-12 mt-5 d-flex justify-content-center"> 
                            <div class="card" style="width: 16rem;">
                                <a class="d-flex justify-content-center mt-3" href="pagina_producto.php?id=<?= $producto["id"]?>">
                                    <img class="w-50" src="imagenes/productos/<?= $producto["rutaimagen"] ?>" loading="lazy" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                <a href="pagina_producto.php?id=<?= $producto["id"]?>"><h5 class="card-title" style="cursor:pointer;"><?= $producto["nombre"] ?></h5></a>
                                    <p class="h6 my-3"><?="$ ",$producto["precio"] ?></p>
                                    <p class="mb-0"><span class="font-weight-bold">Tallas:</span> <?= $producto["tallas"] ?></p>
                                </div>
                            </div>
                        </div>
                <?php
                        if ($contador % 4 === 0 || $contador === count($productos)) {
                ?>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
    <script src="assets/sidebar.js"></script>
</body>

</html>