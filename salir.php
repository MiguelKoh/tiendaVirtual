<?php 

session_start();
unset ( $_SESSION['idUsuario'] );
unset ( $_SESSION['idALumno'] );
//session_unset();   // destruye las variables de sesion
session_destroy(); // destruye la sesion
header("Location: https://siscap.uady.mx/siscap/login.php");

?>