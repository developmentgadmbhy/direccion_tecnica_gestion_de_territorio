<?php
require('../fpdf.php');

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(65);
$pdf->Cell(10,10,'GADM BABAHOYO');
$pdf->Cell(-18);
$pdf->Cell(10,22,'SOLICITUD DE TRAMITE');
$pdf->Cell(70);
$pdf->Cell(10,22,'N° : 00000001 AM');

$pdf->SetFont('Arial','B',14);
$pdf->Cell(-140);
$pdf->Cell(10,42,'YO: ANGEL MOSQUERA' );

$pdf->Cell(-10);
$pdf->Cell(10,58,'CON C.I.: 1207340470' );
$pdf->Cell(20,10,'Title',10,10,'C');
$pdf->Write(70,'Para saber qué hay de nuevo en este tutorial, pulse ');


$pdf->Output();
?>
