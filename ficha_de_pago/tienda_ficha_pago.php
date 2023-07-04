<?php
include('../validate.php');
include('../conexion.php');
include('Funciones.php');
require('PDFTable.php');
include("algoritmo_HSBC.php");
$cn = ConectaBD();

function suma_fechas($fecha,$ndias)
      
{       
      if (preg_match("/[0-9]{1,2}\/[0-9]{1,2}\/([0-9][0-9]){1,2}/",$fecha))
               list($dia,$mes,$año)=explode("/", $fecha);
         
      if (preg_match("/[0-9]{1,2}-[0-9]{1,2}-([0-9][0-9]){1,2}/",$fecha))
          
              list($dia,$mes,$año)=explode("-",$fecha);
        $nueva = mktime(0,0,0, $mes,$dia,$año) + $ndias * 24 * 60 * 60;
        $nuevafecha=date("d/m/Y",$nueva);
         
      return ($nuevafecha);
       
}

function get_nombre_dia($fecha){
   $fechats = strtotime($fecha); //pasamos a timestamp

//el parametro w en la funcion date indica que queremos el dia de la semana
//lo devuelve en numero 0 domingo, 1 lunes,....
switch (date('w', $fechats)){
    case 0: return "Domingo"; break;
    case 1: return "Lunes"; break;
    case 2: return "Martes"; break;
    case 3: return "Miercoles"; break;
    case 4: return "Jueves"; break;
    case 5: return "Viernes"; break;
    case 6: return "Sabado"; break;
  }

}

setlocale(LC_ALL, 'esp');

$pdf = new PDFTable();
$pdf->AliasNbPages();
$pdf->SetHeaderURL('http://www.prepa2.uady.mx/siscap2/seccionAlumnos/tienda_ficha_pago.php');

$SQLAlumno = sprintf("SELECT DISTINCT(a.idAlumno), a.matricula, apPaterno, apMaterno, a.nombres 
	                   FROM alumnos a
	                   WHERE a.idAlumno=%s", comillas_inteligentes($idAlumno));
$queryAlumno = mysqli_query($cn, $SQLAlumno);
$alumno = mysqli_fetch_array($queryAlumno);
$matricula = htmlentities($alumno['matricula']);
$nombre = $alumno['apPaterno'] . " " . $alumno['apMaterno'] . " " . $alumno['nombres'];

echo $nombre;
print_r($_SESSION['carrito']);

// TÍTULO
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(0, 5,'FICHA DE PAGO PARA BANCO HSBC', 0, 1, 'C');

// INFORMACIÓN DEL ESTUDIANTE
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(15, 5, "", 0, 0, 'C');
$pdf->Cell(110, 5, "Alumno: " . utf8_decode($nombre) . " [" . $matricula . "]", 0, 1, 'L');
$pdf->Ln(2);


// CONCEPTO

//$pdf->Cell(15, 5, "", 0, 0, 'C');
$pdf->SetFont('Arial', 'B', 11);
//$pdf->Cell(160, 5, utf8_decode("INFORMACIÓN DE PAGO"), 0, 1, 'C');
//$pdf->Cell(3, 5, "", 0, 0, 'C');
//$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 5, "", 0, 0, 'C');
$pdf->Cell(20, 5, utf8_decode("Código"), 1, 0, 'C');
$pdf->Cell(20, 5, "Cantidad", 1, 0, 'C');
$pdf->Cell(65, 5, utf8_decode("Descripción"), 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode("Importe"), 1, 0, 'C');
$pdf->Cell(35, 5, "Referencia bancaria", 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

// PRODUCTOS
foreach ($_SESSION['carrito'] as $producto) {
    $precioTotalProducto = $producto['precio'] * $producto['cantidad'];
    $precioTotal += $precioTotalProducto;

    $pdf->Cell(15, 5, "", 0, 0, 'C');
    $pdf->Cell(20, 5, $producto['codigo'], 1, 0, 'C');
    $pdf->Cell(20, 5, $producto['cantidad'], 1, 0, 'C');
    $pdf->Cell(65, 5, utf8_decode($producto['nombre'] . ', talla ' . $producto['tamano']), 1, 0, 'L');
    $pdf->Cell(20, 5, utf8_decode('$' . number_format($precioTotalProducto, 2)), 1, 0, 'L');

     $rest1 = substr($matricula, -4); //obtengo los 4 digitos
     $rest2 = substr($matricula, -7,1);
     //$formato="03/12/2018";
     $usuario=$producto['codigo'].$rest2.$rest1;

     $vig=date("Y-m-d");



     if(get_nombre_dia($vig)=='Lunes' || get_nombre_dia($vig)=='Martes' || get_nombre_dia($vig)=='Miercoles')
         {
            $Segundafecha = strtotime('+2 day', strtotime($vig)); //+2
            $fechaV = date('Y-m-d', $Segundafecha);
            $fechavigencia=cambiafnormal($fechaV);
            
         }
         
         if(get_nombre_dia($vig)=='Jueves' || get_nombre_dia($vig)=='Viernes')
         {
            $Segundafecha = strtotime('+4 day', strtotime($vig)); //+2
            $fechaV = date('Y-m-d', $Segundafecha);
            $fechavigencia=cambiafnormal($fechaV);
            
         }
    

         if(get_nombre_dia($vig)=='Sabado')
         {
            $Segundafecha = strtotime('+3 day', strtotime($vig)); //+2
            $fechaV = date('Y-m-d', $Segundafecha);
            $fechavigencia=cambiafnormal($fechaV);
            
         }
         if(get_nombre_dia($vig)=='Domingo')
         {
            $Segundafecha = strtotime('+2 day', strtotime($vig)); //+2
            $fechaV = date('Y-m-d', $Segundafecha);
            $fechavigencia=cambiafnormal($fechaV);
            
         }
    
     
       $anio=date("Y", strtotime($fechaV)); 
       $mes=date("m", strtotime($fechaV)); 
       $dia=date("d", strtotime($fechaV));
       $mes=(int)$mes;
      
      $quitarP=str_replace(".", "", number_format($precioTotalProducto, 2));;
      $pago=$quitarP;
      $contante=4; //hacerefencia al almacen
      $clave="021180550300016431"; 
     
      $referencia=createReferenceHSBC($usuario, $anio, $mes, $dia, $pago, $contante);

     //$referencia=createReferenceHSBC('19000001', 2018, 10, 12, '300000', '2');
    //$referencia=createReferenceHSBC($usuario, $anio, $mes, $dia, $pago, $contante); //08
   // $referencia=createReferenceHSBC($usuario, 2021, 03,08, '39400', 1);

    $pdf->Cell(35, 5, $referencia, 1, 1, 'C');
}
 

$pdf->Cell(15, 5, "", 0, 0, 'C');
$pdf->Cell(105, 5, utf8_decode("Importe Total"), 1, 0, 'R');
$pdf->Cell(55, 5, utf8_decode('$' . number_format($precioTotal, 2)), 1, 1, 'L');

$pdf->Ln(3);
$pdf->SetFont('Arial','B',9); 
$pdf->MultiCell(180,5,utf8_decode("DATOS PARA PAGO PARA PERSONAS CON CUENTA HSBC: PUEDEN REALIZARLO A TRAVES DE PAGO  POR INTERNET, PAGO VENTANILLA BANCARIA O CAJEROS  DEPOSITADORES."),0,1);
  
    $pdf->SetFont('Arial','B',9);    
    $pdf->Cell(34,5,"Clave RAP (convenio): ",0,0,'L');
     $pdf->SetFont('Arial','',9);
    $pdf->Cell(80,5,utf8_decode(" 1643"),0,1,'L');

    $pdf->SetFont('Arial','B',9);  
    $pdf->Cell(82,5,"Referencia bancaria (concepto o motivo de pago):",0,1,'L');
    $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(180,5,utf8_decode("Son las referencias que se encuentran en la tabla del lado derecho después de la columna 'Importe'. Debes realizar los pagos por cada referencia a 16 dígitos."),0,1);
   
    $pdf->SetFont('Arial','B',9);    
    $pdf->Cell(34,5,"Importe: ",0,1,'L');
     $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(190,5,utf8_decode("El importe a pagar es por cada referencia y se encuentra entre las columnas 'Descripción' y 'Referencia' bancaria."),0,1);

     $pdf->SetFont('Arial','B',9);    
    $pdf->Cell(34,5,"Pagos por internet HSBC: ",0,1,'L');
     $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(190,5,utf8_decode("En este caso quien hace el pago, entra a su Banca por Internet Personal, selecciona pago de servicios, coloca la clave RAP (1643) en el campo denominado 'buscar servicio' que se encuentra en la pantalla de pago de servicios, automáticamente aparecerá el nombre de la Universidadad Autónoma de Yucatán, lo seleccionan y posteriormente coloca la referencia bancaria(concepto o motivo de pago) e ingresa el importe."),0,1);
$pdf->Ln(2);
$pdf->SetFont('Arial','B',9); 
$pdf->MultiCell(190,5,utf8_decode("DATOS PARA PAGO A TRAVES DE OTROS BANCOS: PUEDEN REALIZARLO POR SPEI REFERENCIADO."),0,1);
 $pdf->Ln(2);

    $pdf->SetFont('Arial','B',9);  
    $pdf->Cell(82,5,"CLABE SPEI (cuenta bancaria o cuenta destinataria):",0,0,'L');
     $pdf->SetFont('Arial','',9);
    $pdf->Cell(30,5,$clave,0,1,'L');
    $pdf->SetFont('Arial','B',9);


    $pdf->Cell(43,5,utf8_decode("Beneficiario o destinatario: "),0,0,'L');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(30,5,utf8_decode("Preparatoria Dos"),0,0,'L');
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(30,5,utf8_decode("Tipo de institución: "),0,0,'L');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(30,5,utf8_decode("Persona moral"),0,1,'L');
    $pdf->SetFont('Arial','B',9);     
    $pdf->Cell(77,5,"Referencia bancaria (concepto o motivo de pago):",0,1, 'L');
     $pdf->SetFont('Arial','',9);
    $pdf->MultiCell(190,5,utf8_decode("Son las referencias que se encuentran en la tabla del lado derecho después de la columna Importe. Debes realizar los pagos por cada referencia a 16 dígitos. "),0,1);
    
    $pdf->SetFont('Arial','B',9);
    $pdf->Cell(60,5,utf8_decode("Referencia numérica (convenio SPEI): "),0,0, 'L');
     $pdf->SetFont('Arial','',9);
    $pdf->Cell(30,5,"5503",0,1,'L');   
   
    $pdf->SetFont('Arial','B',9);     
    $pdf->Cell(15,5,"Importe:",0,0,'L');
    $pdf->SetFont('Arial','',9);
    $pdf->Cell(30,5,utf8_decode("El importe a pagar es por cada referencia y se encuentra entre las columnas 'Descripción' y 'Referencia bancaria'."),0,1,'L');

$pdf->MultiCell(190,5,utf8_decode("Para que los pagos sean correctamente completados lo que tienen que hacer es lo siguiente: Colocar el número de cuenta (CLABE) 021180550300016431, en el campo concepto o motivo de pago se coloca la referencia bancaria (16 dígitos sin espacios en blanco, letras o cualquier carácter) que está en este documento y por último, en el campo referencia numérica, colocarás el número 5503 el cual es el código de transacción para los pagos RAP (en algunos bancos éste número es de más de 4 dígitos, te recomendamos poner ceros a la izquierda en caso de que el banco lo requiera) de esa manera el pago a través de SPEI deberá pasar correctamente."),0,1);
$pdf->Ln(2);
       
     $pdf->SetFont('Arial','B',9);
    $pdf->Cell(53,5,utf8_decode("Fecha límite para realizar el pago:"),0,0,'L');
     $pdf->SetFont('Arial','',9);    
    $pdf->Cell(100,5,$fechavigencia.utf8_decode("  (En caso de no realizar el pago en la fecha límite establecida, podrás acceder "),0,1,'L');
    $pdf->Cell(100,5,"de nuevo al sistema para generar otra ficha.)",0,1,'L');
    
     $pdf->SetFont('Arial','B',9);
    $pdf->Cell(75,5,utf8_decode("Horario establecido para pago por transferencia:"),0,0,'L');
     $pdf->SetFont('Arial','',9);    
    $pdf->Cell(100,5,"08:00 hrs. hasta las 19:00 hrs.",0,1,'L');    
     
     $pdf->SetFont('Arial','',9);
  
   // $txt1="Para que los pagos sean correctamente completados lo que tienes que hacer es lo siguiente: Colocar el número de cuenta (CLABE) 021180550300016431, en el campo concepto o motivo de pago tendrás que colocar la referencia bancaria (16 dígitos sin espacios en blanco, letras o cualquier carácter) que está en este documento y por último, en el campo referencia numérica, tendrás que colocar el número 5503 el cual es el código de transacción para los pagos RAP,(en algunos bancos éste número es de más de 4 dígitos, te recomendamos poner ceros a la izquierda en caso de que el banco lo requiera) de esa manera el pago a través de SPEI deberá pasar correctamente.";
   
   // $pdf->MultiCell(190,5,utf8_decode($txt1),0,1);
   
    // $pdf->Ln(2);     
    //$txt3="Pagos por internet HSBC, en este caso quien hace el pago, entra a su Banca por Internet Personal, aquí lo que tienes que hacer es seleccionar el pago de servicios, en la pantalla de pago de servicios, hay un campo que se llama buscar servicio, ahí tendrás que colocar la clave RAP (1643), el mismo buscador te va a arrojar el nombre de la Universidad Autónoma de Yucatán solo tienes que seleccionarlo, posteriormente coloca la referencia bancaria (concepto o motivo de pago) e ingresar el monto; si tienes problemas, tendrías que llamar a tu centro de atención a clientes para persona física de banca por internet, en esa línea te pueden asesorar a realizar el pago de servicios.";
      
        //$pdf->MultiCell(190,5,utf8_decode($txt3),0,1);
    $pdf->Ln(2); 
    
    $txt4="Recuerda respetar la fecha límite de pago y tener en cuenta el horario establecido para el pago de servicio por transferencias bancarias, ya que el banco receptor la validará y en caso de no cumplir las condiciones establecidas la transferencia podría ser rechazada por algún error u omisión. Todos los depósitos o transferencias SPEI serán confirmados al día siguiente hábil bancario después de las 12:00 h. (Los días hábiles bancarios son de lunes a viernes; sábado, domingo y días festivos son días inhábiles bancarios, Dic/12 es inhábil bancario). Por aspectos de seguridad no podemos confirmar transacciones el mismo día. Si presentas algún problema te sugerimos llamar al centro de atención a clientes de tu banco para asesorarte en la realización de tu pago del servicio.";
       
        $pdf->MultiCell(190,5,utf8_decode($txt4),0,1);

        $pdf->Ln(1); 
    
        $txt5="Dudas exclusivamente para la realización del pago, enviar correo electrónico a paty.leon@correo.uady.mx";
       
        $pdf->MultiCell(190,5,utf8_decode($txt5),0,1);

          
$pdf->Ln(1);

// OBSERVACIONES
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(80, 5, "IMPORTANTE", 0, 1, 'L');
$pdf->SetFont('Arial', '', 9);
$pdf->MultiCell(200,5,utf8_decode("Para cualquier cambio de prenda es INDISPENSABLE presentar tu COMPROBANTE DE PAGO, así como entregar la prenda sin malo olor, olor a perfume o algún defecto, de lo contrario evita la pena de negarte el cambio. Revisa tu prenda en el momento de tu entrega."),0,1);

$pdf->Output();





