<?php 
 include("conexion.php");
 
 $idTamano =$_GET['idTamano'];
 
 $cn = ConectaBD();
    if (!$cn) {
    die('Error al conectarse a la base de datos');
    }

 $consultaTamanos = "SELECT * FROM productos_almacen_tamanos WHERE id = " . $idTamano;
 $resultadoTamanos = mysqli_query($cn,$consultaTamanos);

 $filaTamanos = mysqli_fetch_assoc($resultadoTamanos);

 $rutaImagen = $filaTamanos["rutaImagen"];

$json = array();

$json[]= array(
    'rutaImagen'=> $rutaImagen
);


 $jsonString = json_encode($json);

 echo $jsonString;











?>