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
    $consultaProducto = "SELECT * FROM productos_almacen WHERE id = " . $productoID . " LIMIT 1";
    
    $result = mysqli_query($cn, $consultaProducto);
    if (!$result) {
      die('Consulta fallida');
    }
    $producto = array();
        
    while ($filaProducto = mysqli_fetch_array($result)) {
        $tamanos = array();
        $precios = array();
        
        $consultaTamanos = "SELECT * FROM productos_almacen_tamanos
        WHERE id NOT IN(17,41,42,48,49,53,53,54,66,56) AND idProducto = " . $productoID;;
        
        $resultadoTamanos = mysqli_query($cn, $consultaTamanos);
    
        if ($resultadoTamanos && (mysqli_num_rows($resultadoTamanos) > 0)) {
            while ($filaTamanos = mysqli_fetch_assoc($resultadoTamanos)){
            
                if (!in_array($filaTamanos['precio'], $precios)) {
                    $precios[] = number_format($filaTamanos['precio'], 2);
                }
    
                if (!in_array($filaTamanos['tamano'], $tamanos)) {
                    $tamanos[] = $filaTamanos['tamano'];
                }
                
                
                $preciosLista = implode(' - ', $precios);
            
            }//fin de filaTamanos
           
    $producto[] = array(
                'id' => $filaProducto['id'],
                'nombre' => $filaProducto['nombre'],
                'rutaimagen' => $filaProducto['rutaImagen'],
                'tipo' => $filaProducto['tipo'],
                'precio'=> $preciosLista,
                'tallas' => $tamanos
            );
            
    
    
        }//fin del if
    
        }//fin de while
    
    return $producto;
    
    

}//fin de funcion


?>

