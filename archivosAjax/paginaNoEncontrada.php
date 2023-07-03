<?php
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
    <title>Tienda virtual</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-************" crossorigin="anonymous" />

</head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row h-100">
            
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
                        <h3 class="text-white my-2 mx-auto" id="titulo">Producto</h3>
                    </div>
                </div>
                
                <div class="d-flex justify-content-center">
                
                
                    <div class="row h-75 w-75 m-5">
                        
                        
                        <div id="panel-productos" class="col-lg-12 col-sm-12 d-flex justify-content-center align-items-center px-0 rounded">
                     
                          <div class="alert alert-danger w-100 d-flex justify-content-center align-items-center mb-0" role="alert">
                                La página solicitada no existe
                          </div>

                         </div>
                        
                        </div>
                    
                        </div>
                    </div>
                </div>      
            </div>
        </div>
    </div>
  
  <script src="assets/jquery-3.1.1.min.js"></script>
  <script src="assets/sidebar.js"></script>

</body>

</html>