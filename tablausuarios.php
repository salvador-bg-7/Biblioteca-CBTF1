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
            FROM usuarios 
            ORDER BY id_tipo";
$buscador = mysqli_query($mysqli, $consulta);
$numero = mysqli_num_rows($buscador);
$contador = 1;


$diassemana = array("Domingo", "Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sábado");
$meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

$hoy = date('D d M Y');





class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('img/logoeducacion.png', 20, 10, 60);

        // Arial bold 15
        $this->SetFont('Arial', '', 8);
        // Movernos a la derecha
        $this->Cell(50);

        // color 
        $this->SetDrawColor(0, 0, 180);
        // Título
        $this->Cell(0, -30, utf8_decode('Subsecretaría de Educación Media Superior'), 0, 0, 'R');
        $this->Cell(0, -22, utf8_decode('Dirección General de Educación Tecnológica'), 0, 0, 'R');
        $this->Cell(0, -14, utf8_decode('Agropecuaria y Ciencias del Mar'), 0, 0, 'R');

        $this->SetFont('Arial', 'BI', 10);
        $this->Cell(-250, 20, utf8_decode(' 2021: Año de la Independencia '), 0, 0, 'C');

        $this->Image('img/logopdf.png', 230, 25, 40);
        // Salto de línea
        $this->Ln(25);
    }

    // Pie de página
    function Footer()

    {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);
        $this->Image('img/logopie.png', 250, 175, 25);
        //fuente
        $this->SetFont('Arial', '', 8);
        //color de linea
        $this->SetDrawColor(160, 150, 91);
        //linea
        $this->Line(25, 182, 245, 182);
        //color de fuente
        $this->SetTextColor(160, 150, 91);
        $this->Cell(250, -20, utf8_decode('Mesa del Tecnológico s/n, Col. Americana. C.P. 34948. El Salto P.N Durango.'), 0, 0, 'C');
        $this->Cell(-250, -10, utf8_decode('Tel. 678 87 6 00 48'), 0, 0, 'C');

        $this->SetTextColor(0, 0, 0);
        $this->Write(-20, $this->PageNo());
        //
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
    }
}


$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetMargins(25, 30, 25, 35);
$pdf->AddPage('LANDSCAPE');


$pdf->SetFont('Arial', 'B', 12);



$pdf->Cell(245, 10, ('Reporte completo de Usuarios del Sistema: '), 0, 1, 'L');
$pdf->Cell(100, 10, (''), 0, 0, 'L');
$pdf->Cell(
    145,
    10,
    utf8_decode($diassemana[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y')),
    0,
    1,
    'R'
);

$pdf->SetFont('Arial', '', 12);

$pdf->MultiCell(w: 0, h: 10, txt: 'En la siguiente tabla se muestra el reporte completo de todos los Usuarios activos en el sistema administrativo de la '
    . 'Biblioteca del Centro de Bachillerato Forestal 1 (CBTF1) hasta la fecha de: ' . utf8_decode($diassemana[date('w')] . " " . date('d') . " de " . $meses[date('n') - 1] . " del " . date('Y'))
    . '.');

$pdf->SetFont('Arial', 'B', 11);
$pdf->SetFillColor(242, 242, 242);
$pdf->SetDrawColor(255, 255, 255);
$pdf->Cell(245, 5, (''), 0, 1, 'L');
$pdf->Cell(245,5, ('Total de Usuarios: '.$numero), 0, 1, 'R');

$pdf->Cell(10, 10, utf8_decode(('N°')), 1, 0, 'C', 1);
$pdf->Cell(60, 10, utf8_decode(('Nombre y Apellido')), 1, 0, 'C', 1);
$pdf->Cell(30, 10, utf8_decode(('Matricula')), 1, 0, 'C', 1);
$pdf->Cell(60, 10, utf8_decode(('Email')), 1, 0, 'C', 1);
$pdf->Cell(50, 10, utf8_decode(('Ultimo Inicio de Sesion')), 1, 0, 'C', 1);
$pdf->Cell(40, 10, utf8_decode(('Tipo U')), 1, 1, 'C', 1);



$pdf->SetFont('Arial', '', 11);
$pdf->SetFillColor(255, 255, 255);
$pdf->SetDrawColor(242, 242, 242);
while ($row = mysqli_fetch_assoc($buscador)) {

    switch ($row['id_tipo']) {
        case 1:
            $row['id_tipo'] = "Administrador";
            break;

        case 2:
            $row['id_tipo'] = "Alumno";
            break;

        case 3:
            $row['id_tipo'] = "Docente";
            break;

        case 4:
            $row['id_tipo'] = "P. Administrativo";
            break;
    }

    $pdf->Cell(10, 10, utf8_decode($contador++), 1, 0, 'C', 1);
    $pdf->Cell(60, 10, utf8_decode($row['nombre']), 1, 0, 'C', 1);
    $pdf->Cell(30, 10, utf8_decode($row['usuario']), 1, 0, 'C', 1);
    $pdf->Cell(60, 10, utf8_decode($row['correo']), 1, 0, 'C', 1);
    $pdf->Cell(50, 10, utf8_decode((str_replace('-', '/', date('d-m-Y H:i', strtotime($row['last_session'])))) . ' Hrs'), 1, 0, 'C', 1);
    $pdf->Cell(40, 10, utf8_decode($row['id_tipo'].' '.$row['especialidad']), 1, 1, 'C', 1);
}






$pdf->Output();

?>
<html lang="es">

<head>
    <title>Biblioteca</title>


</head>

</html>