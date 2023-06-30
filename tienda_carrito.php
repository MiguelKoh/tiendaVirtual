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
//print_r($_SESSION['carrito']);
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
    <title>Tienda virtual - Carrito</title>
    <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"
        integrity="sha512-************" crossorigin="anonymous" />

</head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-lg-2 col-md-2 col-sm-12 fondoSidebar" id="sidebar">
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
                        <h4 class="text-white my-2 fuenteTitulo" id="titulo"><span><i class="fas fa-shopping-cart"></i></span> Carrito</h4>
                    </div>
                </div>
                 <!-- producto aquí -->
                 
            
             
                 
                <div class="d-flex justify-content-center">
                
                
                    <div class="row h-75 w-75 m-5">
                        
                        <div class="col-lg-12 mb-3 px-0">
                         <a href="#" class="btn btn-secondary btn-ficha" id="generar-ficha">
                         <i class="fas fa-file"></i>  Generar ficha de pago</a>   
                        </div>
                        
                        <div id="panel-productos" class="col-lg-12 col-sm-12 d-flex justify-content-center align-items-center px-0 bg-light rounded">
                     
                     <?php if (count($_SESSION['carrito']) > 0) {?>
                        <table class="table bg-light rounded">
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
                         foreach ($_SESSION['carrito'] as $id => $producto) { 
                            $precioTotalProducto = $producto['precio'] * $producto['cantidad'];
                                                        $precioTotal += $precioTotalProducto;
                            ?>
                            <tr id="<?=$id?>">
                              

                              <td class="col-5">
                               <div class="row">
                                 <div class="col-lg-7 col-sm-8">
                                  <h6><?=  $producto['nombre']?></h6>
                                 <p><span class="font-weight-500">Talla: </span><?= $producto['tamano'] ?></p>
                                 <a class="delete-item font-weight-500" href="#">Eliminar</a>
                                 </div>
                                 <div class="col-lg-5  col-sm-4 d-flex align-items-center">
                                   <img src="imagenes/productos/<?= $producto['rutaImagen'] ?>" class="w-70" alt="">
                                 </div>
                                </div>
                              </td>

                             



                              <td class="col-4 text-align-center">
                                 <p class="precio-producto">$<?= number_format($precioTotalProducto,2)?></p>
                              </td>
                              
                              <td class="col-3 cantidad">
                                <div class="row ml-2 d-flex align-items-end">
                                    <div class="col-lg-3 col-sm-12 px-0">
                                      <input type="number" class="custom-input input-cart" name="cantidad" min="1" max="100" value="<?=$producto['cantidad']?>">
                                    </div>
                                </div>
                              </td>

                            

                            </tr>
                           <?php } ?> 
                            <tr>
                             <td><p class="font-weight-bold">Total</p></td>
                             
                             <td class="text-align-center"><p class="text-info font-weight-bold" id="total">$<?=number_format($precioTotal,2)?></p></td>
                             <td></td>
                            </tr>
                          
                          </tbody>
                        
                        </table>
                     <?php } else {?> 
                          <p class="my-4 mr-1">Carrito vacio.</p> <a href="escolares.php" class="font-weight-500"> Ir a tienda para agregar productos.</a>

                         </div>
                        </div>
                     

                     
                        
                    
                        </div>
                     
                           
                           
                        
                      <?php }  ?> 
                        

                    </div>
                </div>      
                 <!-- producto aquí -->

            </div>
        </div>
    </div>

  <script src="assets/jquery-3.1.1.min.js"></script>
  <script src="assets/carrito.js"></script>

</body>

</html>