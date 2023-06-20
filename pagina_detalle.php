<?php 
include("funciones.php");
$productoID = $_GET["id"];
//print_r(obtenerProducto($productoID));
?>

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
                    <li>
                        <div>
                            <div>
                                <span><i class="fas fa-shopping-cart"></i></span>
                                <span>Mi carrito</span>
                            </div>
                        </div>
                    </li>
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
                        <h4 class="text-white my-2 fuenteTitulo" id="titulo">Producto</h4>
                    </div>
                </div>
                 <!-- producto aquí -->
                 
                 <?php
                
                $producto = obtenerProducto($productoID);
                $tamanos = ''; 
                
                //Guardar las tallas 
                
                foreach ($producto[0]["tamanos"] as $tamano) {

                    $tamanos .= '<input type="radio" class="talla" name="idTamanos" value="'.$tamano['idTamanos'].'">' . $tamano['tallas'];

                
                }//fin de foreach

                ?>
            

                 <div class="d-flex justify-content-center">
                    <div class="row bg-light h-75 w-100 m-5 rounded">
                        <div class="col-lg-3 col-sm-12 d-flex justify-content-center align-items-center">
                            <img class="w-75" src="imagenes/productos/<?= $producto[0]["rutaimagen"] ?>" alt="Card image cap">
                        </div>
                        <div class="col-lg-4 col-sm-12 mt-5 px-0">
                            <div class="ml-5">
                                <h5 class="card-title"><?= $producto[0]["nombre"] ?></h5>
                                <form id="myForm">
                            <div class="product-info">
                                <div class="title">Precio:</div>
                                <div class="value"><?= "$ ",$producto[0]["precio"] ?></div>
                            </div>
                            
                                <div class="title mb-3">Seleccionar cantidad:</div>
                                <div class="value mb-3">
                                    <input type="number" class="custom-input" id="cantidad" min="1" value="0">
                                </div>
                            
                            <div>
                                <div class="title">Seleccionar Talla:</div>
                                <div class="value"><?= $tamanos ?></div>
                            </div>
                            <div class="mb-5">
                                <a href="#" class="btn btn-primary" id="carrito">
                                    <i class="fas fa-shopping-cart fa-sm"></i> Agregar al carrito
                                </a>
                                <input class="btn btn-primary" id="enviar" type="submit" value="Agregar a mi carrito">
                
                            </div>
                        </form>

                            </div>
                        </div>
                        <div class="col-lg-5 d-flex justify-content-start align-items-center" id="medidas">
                            <!-- imagen de la talla -->

                        </div>
                        

                    </div>
                        <div class="notificacion" id="notificacion">
                            <p class="notificacion__titulo">Agregado al carrito</p>
                                <img src="imagenes/productos/<?= $producto[0]["rutaimagen"] ?>" alt="" class="notificacion__thumb w-25" />
                                <a href="#" class="notificacion__link" data-accion="abrir-carrito">Ver carrito</a>
                       </div>


                </div>
                 <!-- producto aquí -->

            </div>
        </div>
    </div>
  <script src="assets/script.js"></script>
</body>

</html>