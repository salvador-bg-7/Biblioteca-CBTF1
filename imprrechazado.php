<?php 

require('fpdf.php');

session_start();
require 'funcs/conexion.php';
require 'funcs/funcs.php';

if (!isset($_SESSION["id_usuario"])) {
	header("Location: index.php");
}

$idUsuario = $_SESSION['id_usuario'];
$sql = "SELECT id, usuario, nombre, id_tipo FROM usuarios WHERE id = '$idUsuario'";
$resultado = $mysqli->query($sql);
$row2 = $resultado->fetch_assoc();

$tit = $mysqli->real_escape_string($_POST['tit']);
$fol = $mysqli->real_escape_string($_POST['fol']);
$nos = $mysqli->real_escape_string($_POST['nos']);
$mas = $mysqli->real_escape_string($_POST['mas']);
$fes = $mysqli->real_escape_string($_POST['fes']);
$mot = $mysqli->real_escape_string($_POST['mot']);
$fec = $mysqli->real_escape_string($_POST['fec']);


$diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");



$hoy = date('D d M Y'); 
 

switch ($fes) {
    case ' -11- ':
        $fes =  "Noviembre";
        break;
    
    case 'Tue':
            $hoy = "Martes";
            break;
}



class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('img/logoeducacion.png',20,10,60);
    
    // Arial bold 15
    $this->SetFont('Arial','',8);
    // Movernos a la derecha
    $this->Cell(50);

    // color 
    $this->SetDrawColor(0,0,180);
    // Título
    $this->Cell(0,10,utf8_decode('Subsecretaría de Educación Media Superior'),0,0,'R');
    $this->Cell(0,17,utf8_decode('Dirección General de Educación Tecnológica'),0,0,'R');
    $this->Cell(0,24,utf8_decode('Agropecuaria y Ciencias del Mar'),0,0,'R');

    $this->SetFont('Arial','BI',10);
    $this->Cell(-170,50,utf8_decode(' 2021: Año de la Independencia '),0,0,'C');

    $this->Image('img/logopdf.png',145,25,40);
    // Salto de línea
    $this->Ln(25);

    

}

// Pie de página
function Footer()
{
    //Posición: a 1,5 cm del final
    $this->SetY(-15);
    $this->Image('img/logopie.png',170,250,28);
    //fuente
    $this->SetFont('Arial','',8);
    //color de linea
    $this->SetDrawColor(160,150,91);
    //linea
    $this->Line(20,260,175,260);
    //color de fuente
    $this->SetTextColor(160,150,91);
    $this->Cell(150,-40,utf8_decode('Mesa del Tecnológico s/n, Col. Americana. C.P. 34948. El Salto P.N Durango.'),0,0,'C');
    $this->Cell(-150,-30,utf8_decode('Tel. 678 87 6 00 48'),0,0,'C');

    //
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    
}
}


$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetMargins(25, 10 , 25);
$pdf->AddPage();
$pdf->Cell(50);

$pdf->SetFont('Arial','B',12);


$pdf->Cell(80,10, (''), 0, 1, 'R');
$pdf->Cell(80,10, (''), 0, 1, 'R');
$pdf->Cell(160,10, ('Reporte de Libro rechazado: '), 0, 1, 'L');
$pdf->Cell(80,10, $tit, 0, 0, 'L');
$pdf->Cell(80,10, 
utf8_decode($diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y'))

, 0, 1, 'R');
$pdf->Cell(160,10, (''), 0, 1, 'R');
$pdf->Cell(160,10, (''), 0, 1, 'R');

$pdf->SetFont('Arial','',12);

$pdf->MultiCell(w:0, h:10,  txt: utf8_decode('El Libro '.$tit.' con número de folio '.$fol.
'. No ha podido ser prestado por la Biblioteca del Centro de Bachillerato Tecnológico Forestal 1 (CBTF1) por los siguientes motivos: '
.$mot.', por lo cual la solicitud de préstamo fue rechazada en la fecha de '.(str_replace('-', '/', date('d-m-Y', strtotime($fec)))).'.'), border:0, align:'J');



$pdf->Cell(160,10, (''), 0, 1, 'R');
$pdf->Cell(160,10, (''), 0, 1, 'R');


$pdf->Cell(20,10, ('Nombre: '), 0, 0, 'L');
$pdf->Cell(100,10, $nos, 0, 1, 'L');
$pdf->Cell(20,10, ('Matricula: '), 0, 0, 'L');
$pdf->Cell(100,10, $mas, 0, 1, 'L');
$pdf->Cell(160,10, (''), 0, 1, 'L');
$pdf->Cell(160,10, (''), 0, 1, 'L');



$pdf->Output();

?>
<html lang="es">
<head>
	<title>Biblioteca</title>

	
</head>

</html>