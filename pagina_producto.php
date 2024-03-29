<?php 
include("funciones.php");
include("validate.php");
include("conexion.php");
$cn = ConectaBD();
//include("../validate.php");

$productoID = isset($_GET["id"]) ? $_GET["id"] : null;

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

<?php 
 
 /*
   Validaciones en caso de que el usuario escriba en la barra de direcciones un id que no exista,
   por ejemplo: "pagina_producto.php?id=10000" y tambien otra validacion por si no escribe el parametro id  y solamente escribe sin nada: "pagina_producto.php" en la barra de direcciones. En ambos casos se invoca la pagina "paginaNoEncontrada.php" ubicada en "archivosAjax/paginaNoEncontrada.php"
*/

 $producto = null;
 
 if ($productoID !== null) {
    
    $producto = obtenerProducto($cn,$productoID);

}//fin del if

if (!empty($producto)) {


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
      <title><?= $producto[0]["nombre"] ?></title>
      <link rel="shortcut icon" type="image/x-icon" href="imagenes/banners/favicon_uady.ico">
      <link rel="stylesheet" href="assets/fontawesome-free-5.15.2-web/css/all.min.css">
   </head>

<body class="fondo">
    <div class="container-fluid h-100">
        <div class="row h-lg-100">
            
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
                 



                <!-- Inicio producto-->
                 
                 <?php
                
                $tamanos = ''; 
                
                //Guardar las tallas 
                
                foreach ($producto[0]["tamanos"] as $tamano) {

                    $tamanos .= '<label class="mr-2 pointer">
                                
                                <input type="radio" class="talla" name="idTamanos" 
                                value="'.$tamano['idTamanos'].'">'.$tamano['tallas'].'
                                
                                </label>';

                
                }//fin de foreach

                ?>
             
             <?php if ($productoID ==11 || $productoID ==12) { ?>
             
             <div class="row d-flex justify-content-center">
                    <div class="w-80  mt-4 px-0">
                    
                    <div class="col-12">
                    <div class="bg-light rounded pb-2 pt-3 pl-3" role="alert">
                     <p class="font-weight-bold mb-1">De preferencia solo compra este producto, si perteneces a alguno de los siguientes talleres:</p>
    
                    <?php if ($productoID == 11) { ?>
                    <div class="row">
                    <div class="col-2 pr-0">
                      <ul class="mt-2">
                        <li class="font-weight-normal">Folcklore</li>
                        <li class="font-weight-normal">Sóftbol</li>
                        <li class="font-weight-normal">Béisbol</li>
                    </ul>
                   </div>
                   <div class="col-10 pl-0">
                     <ul class="mt-2">
                        <li class="font-weight-normal">Ajedrez</li>
                        <li class="font-weight-normal">Karate</li>
                        <li class="font-weight-normal">Banda de guerra</li>
                    </ul>
                       
                   </div>

                   </div>
                 <?php } elseif ($productoID == 12) { ?>
                  
                  <div class="row">
                 
                 <div class="col-2 pr-0">
                    <ul class="mt-2">
                      <li class="font-weight-normal">Fútbol</li>
                      <li class="font-weight-normal">Handball</li>
                      <li class="font-weight-normal">Voleibol</li>
                   </ul>
                </div>

                <div class="col-10 pl-0"> 
                 
                 <ul class="mt-2">
                    <li class="font-weight-normal">Básquetbol</li>
                 </ul>
                
                </div>

               </div>
                 
                 <?php } ?>

                </div>

                </div>  
                   </div>
               
               </div>
                
        <?php } ?>

                 <div class="d-flex justify-content-center">
               
               
               <div class="row bg-light h-75 w-80 rounded <?php echo ($productoID == 11 || $productoID == 12) ? "m-4 mb-5" : "m-5"; ?>">

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
                                          <label class="mb-0 d-flex font-weight-bold mr-3" for="cantidad">Cantidad:</label>
                                          <input type="number" class="custom-input w-20" id="cantidad" min="1" value="1">
                                      </div>
                                  
                                  <div>
                                      <div class="font-weight-bold mb-2">Seleccionar Talla:</div>
                                      <div class="value mb-2"><?= $tamanos ?></div>
                                  </div>
                                  

                                  <div class="mb-5">
                                   
                                     <button class="btn btn-primary" id="enviar" type="submit">
                                       <i class="fas fa-shopping-cart fa-sm"></i> Agregar a mi carrito 
                                     </button>

                                     
                                  </div>
                              
                              </form>

                          </div>
                    </div>


                        <div class="col-lg-5 d-flex justify-content-lg-start align-items-center mb-sm-4-custom justify-content-sm-center" id="medidas">
                            <!-- imagen de la talla -->

                        </div>
                        

            </div>


                <div class="notificacion w-lg-13 h-25 row w-sm-35 bg-light rounded" id="notificacion">
                    
                     <div class="col-12 mx-1">
                        
                        <button type="button" class="close mt-1 mb-3" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                       </button> 

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


                 <!-- producto Fin -->

            </div>
        </div>
    </div>
  <script src="assets/sidebar.js"></script>
  <script src="assets/script.js"></script>
</body>

</html>

<?php 
 
 }//fin del if
 
 else {
 
 include("archivosAjax/paginaNoEncontrada.php");
  
  }
  
 ?>