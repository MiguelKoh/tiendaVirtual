<?php 
include("funciones.php");
session_start();
$productoID = $_GET["id"];
//print_r(obtenerProducto($productoID));

// Verifica si el arreglo 'carrito' no está definido y lo crea si es necesario
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = array();
}

$cantidadProductos = 0;
foreach ($_SESSION['carrito'] as $producto) {
    $cantidadProductos += $producto['cantidad'];
}


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
    <title>Tienda virtual - Producto</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-************" crossorigin="anonymous" />
</head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row">
            
            <!-- Inicio del sidebar -->
                <?php
                include("sidebar.php");
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
                      <h4 class="text-white my-2 fuenteTitulo mx-auto" id="titulo">Producto</h4>
                   </div>  
               </div>
                 <!-- producto aquí -->
                 
                 <?php
                
                $producto = obtenerProducto($productoID);
                $tamanos = ''; 
                
                //Guardar las tallas 
                
                foreach ($producto[0]["tamanos"] as $tamano) {

                    $tamanos .= '<label class="mr-2 pointer">
                                
                                <input type="radio" class="talla" name="idTamanos" 
                                value="'.$tamano['idTamanos'].'">'.$tamano['tallas'].'
                                
                                </label>';

                
                }//fin de foreach

                ?>
            

                 <div class="d-flex justify-content-center">
                    <div class="row bg-light h-75 w-80 m-5 rounded">
                        <div class="col-lg-3 col-sm-12 d-flex justify-content-center align-items-center">
                            <img class="w-lg-75 w-sm-50 mt-sm-5-c" src="imagenes/productos/<?= $producto[0]["rutaimagen"] ?>" alt="Card image cap">
                        </div>
                        <div class="col-lg-4 col-sm-12 mt-5 px-0">
                            <div class="ml-5">
                                <h4><?= $producto[0]["nombre"] ?></h4>
                                <hr>
                                <form id="myForm">
                            <div class="d-flex align-items-center mb-3">
                                <div class="font-weight-bold mr-3">Precio:</div>
                                <div class="value"><?= "$ ",$producto[0]["precio"] ?></div>
                            </div>
                                <div class="value mb-3 d-flex align-items-center">
                                <p class="mb-0 d-flex font-weight-bold mr-3">Cantidad:</p>
                               
                                    <input type="number" class="custom-input w-20" id="cantidad" min="1" value="1">
                                </div>
                            
                            <div>
                                <div class="font-weight-bold mb-2">Seleccionar Talla:</div>
                                <div class="value mb-2"><?= $tamanos ?></div>
                            </div>
                            <div class="mb-5">
                                <input class="btn btn-primary" id="enviar" type="submit" value="Agregar a mi carrito">
                
                            </div>
                        </form>

                            </div>
                        </div>
                        <div class="col-lg-5 d-flex justify-content-lg-start align-items-center mb-sm-4-custom justify-content-sm-center" id="medidas">
                            <!-- imagen de la talla -->

                        </div>
                        

                    </div>
                        <div class="notificacion w-lg-13 h-25 row w-sm-35 bg-light rounded" id="notificacion">
                          <div class="col-12">  
                        <p class="notificacion__titulo d-flex justify-content-center mt-3 mb-0">Agregado al carrito</p>
                           </div>
                           <div class="col-12 d-flex justify-content-center">  
                                <img src="imagenes/productos/<?= $producto[0]["rutaimagen"] ?>" alt="" class="w-50 h-auto"/>
                                </div>
                                <div class="col-12 d-flex justify-content-center">  
                                <a href="tienda_carrito.php" class="notificacion__link mb-2">Ver carrito</a>
                                </div>
                       </div>


                </div>
                 <!-- producto aquí -->

            </div>
        </div>
    </div>
  <script src="assets/sidebar.js"></script>
  <script src="assets/script.js"></script>
</body>

</html>