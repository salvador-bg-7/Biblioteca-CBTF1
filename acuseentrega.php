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

$consulta = "SELECT *
            FROM prestados
            ORDER BY id DESC
            LIMIT 1";
$buscador = mysqli_query($mysqli, $consulta);
$numero = mysqli_num_rows($buscador);


$diassemana = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");


$hoy = date('d M Y'); 
 





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

    $this->SetFont('Arial','I',10);
    $this->Cell(-170,50,utf8_decode(' 2021: Año de la Independencia '),0,0,'C');

    $this->Image('img/logopdf.png',145,25,40);
    // Salto de línea
    $this->Ln(25);

    

}

// Pie de página
function Footer()
{
    $this->Image('img/logopie.png',170,250,28);
    //fuente
    $this->SetFont('Arial','',8);
    //color de linea
    $this->SetDrawColor(160,150,91);
    //linea
    $this->Line(20,260,175,260);
    //color de fuente
    $this->SetTextColor(160,150,91);
    $this->Cell(170,120,utf8_decode('Mesa del Tecnológico s/n, Col. Americana. C.P. 34948. El Salto P.N Durango.'),0,0,'C');
    $this->Cell(-170,130,utf8_decode('Tel. 678 87 6 00 48'),0,0,'C');

    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    
}
}

while ($row = mysqli_fetch_assoc($buscador)) { 


$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetMargins(25, 10 , 25);
$pdf->AddPage();
$pdf->Cell(50);

$pdf->SetFont('Arial','B',12);


$pdf->Cell(80,10, (''), 0, 1, 'R');
$pdf->Cell(80,10, (''), 0, 1, 'R');
$pdf->Cell(160,10, ('Ficha de prestamo del Libro: '), 0, 1, 'L');
$pdf->Cell(80,10, utf8_decode($row['titulo']), 0, 0, 'L');
$pdf->Cell(80,10, 
utf8_decode($diassemana[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y'))
, 0, 1, 'R');
$pdf->Cell(160,10, (''), 0, 1, 'R');
$pdf->Cell(160,10, (''), 0, 1, 'R');

$pdf->SetFont('Arial','',12);

$pdf->MultiCell(w:0, h:10, txt: 'Yo '.utf8_decode($row['nombresoli'].' hago constar que he recibido en préstamo el Libro '.utf8_decode($row['titulo']).' con numero de folio: '
.$row['folio'].', por parte de la Biblioteca del Centro de Bachillerato Tecnológico Forestal 1 (CBTF1) con fecha de solicitud '
.(str_replace('-', '/', date('d-m-Y', strtotime($row['fechaPedido'])))).' el cual tendre que devolver en buenas condiciones en la fecha de: '
.(str_replace('-', '/', date('d-m-Y', strtotime($row['fechadev'])))).' de manera puntual.'));



$pdf->Cell(160,10, (''), 0, 1, 'R');
$pdf->Cell(160,10, (''), 0, 1, 'R');


$pdf->Cell(20,10, ('Nombre: '), 0, 0, 'L');
$pdf->Cell(100,10, $row['nombresoli'], 0, 1, 'L');
$pdf->Cell(20,10, ('Matricula: '), 0, 0, 'L');
$pdf->Cell(100,10, $row['matriculasoli'], 0, 1, 'L');
$pdf->Cell(160,10, (''), 0, 1, 'L');
$pdf->Cell(160,10, (''), 0, 1, 'L');
$pdf->Cell(160,10, ('Firma'), 0, 1, 'C');
$pdf->Line(60,230,150,230);


}


$pdf->Output();

?>
<html lang="es">
<head>
	<title>Biblioteca</title>

	
</head>

</html>