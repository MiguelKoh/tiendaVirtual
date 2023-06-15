<?php
include("conexion.php");

function obtenerProductos($query){

$cn = ConectaBD();
if (!$cn) {
die('Error al conectarse a la base de datos');
}

#$query = "SELECT * FROM productos_almacen WHERE id NOT IN(9,10,13,14,15) AND tipo=1";

$result = mysqli_query($cn,$query);
if (!$result) {
  die('Consulta fallida');
}
$productos = array();
    
while ($filaProductos = mysqli_fetch_array($result)) {
    $tamanos = array();
    $precios = array();
    
    $consultaTamanos = "SELECT * FROM productos_almacen_tamanos
                        WHERE idProducto = " . $filaProductos['id'];
    
    $resultadoTamanos = mysqli_query($cn, $consultaTamanos);

    if ($resultadoTamanos && (mysqli_num_rows($resultadoTamanos) > 0)) {
        while ($filaTamanos = mysqli_fetch_assoc($resultadoTamanos)){
        
            if (!in_array($filaTamanos['precio'], $precios)) {
                $precios[] = number_format($filaTamanos['precio'], 2);
            }

            if (!in_array($filaTamanos['tamano'], $tamanos)) {
                $tamanos[] = $filaTamanos['tamano'];
            }
            
            $tamanosLista = implode(' / ', $tamanos);
            $preciosLista = implode(' - ', $precios);
        
        }//fin de filaTamanos
       
$productos[] = array(
            'id' => $filaProductos['id'],
            'nombre' => $filaProductos['nombre'],
            'rutaimagen' => $filaProductos['rutaImagen'],
            'tipo' => $filaProductos['tipo'],
            'precio'=> $preciosLista,
            'tallas' => $tamanosLista
        );
        


    }//fin del if

    }//fin de while


return $productos;


}//fin de la funcion


function obtenerProductoEscolar(){
$query = "SELECT * FROM productos_almacen WHERE id NOT IN(9,10,13,14,15) AND tipo=1";
$productoEscolar = obtenerProductos($query);

return $productoEscolar;

}//fin de la funcion


function obtenerProductoDeportivo(){
$query = "SELECT * FROM productos_almacen WHERE tipo=2";
$productoDeportivo = obtenerProductos($query);

return $productoDeportivo;

}//fin de funcion




function obtenerProducto($productoID){
    
    $cn = ConectaBD();
    if (!$cn) {
      die('Error al conectarse a la base de datos');
    }
    
    $producto = array();
    $precios = array();
    
    $consultaProducto = "SELECT * FROM productos_almacen WHERE id = " . $productoID . " LIMIT 1";
    
    $resultadoProducto = mysqli_query($cn, $consultaProducto);
    
    if (!$resultadoProducto) {
      die('Consulta fallida');
    }
    
    while ($producto = mysqli_fetch_array($resultadoProducto)) {
        
        $nombreProducto = $producto['nombre'];
        $rutaImagenProducto = $producto['rutaImagen'];
                                
     }//fin del while

     //Obtener lista de tamaños del producto
     
     $consultaTamanos = "SELECT * FROM productos_almacen_tamanos 
                        WHERE id NOT IN(17,41,42,48,49,53,53,54,66,56) AND idProducto = " . $productoID;

     $resultadoTamanos = mysqli_query($cn, $consultaTamanos);

     while ($filaTamanos = mysqli_fetch_assoc($resultadoTamanos)) {
            
            $tamanos[] = $filaTamanos;
                                        
        }//fin del while
    
    foreach ($tamanos as $tamano) {
           
        if (!in_array($tamano['precio'], $precios)) {
                $precios[] = number_format($tamano['precio'], 2);
               
            }//fin del if
    

    }//fin de foreach

    $preciosLista = implode(' - ', $precios);
    
    foreach ($tamanos as $tamano) {
        
        $listaTamanos[] = array(
            'tallas'=> $tamano['tamano'],
            'idTamanos'=> $tamano['id']
        );
  
  }//fin de foreach


     $producto[] = array(
            'nombre' => $nombreProducto,
            'rutaimagen' => $rutaImagenProducto,
            'precio'=> $preciosLista,
            'tamanos'=> $listaTamanos 
            );
    
   return $producto;

}//fin de funcion





?>

