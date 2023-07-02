<?php

session_start();
   
   // Sesiones de prueba para probar en la tienda virtual en localHost
 
   $_SESSION['idAlumno'] = 10;  
   $_SESSION['Access'] = true; 
   $_SESSION['idUsuario'] = 7;
   $_SESSION['NombreCompleto'] = "KOH AVILA MIGUEL ELIAS";

if (($_SESSION['Access']) and ($_SESSION['idAlumno'] <> "")) {
  
  $idAlumno = $_SESSION['idAlumno'];  
  $nombre_completo_alumno = $_SESSION['NombreCompleto'];
  //$matricula = $_SESSION['matricula']; 

  
} else {
   header("Location: https://siscap.uady.mx/siscap/login.php");
   //echo "Acceso no autorizado";
   die;

  }
  
 //proceso interno para ejecutar

 
?>


