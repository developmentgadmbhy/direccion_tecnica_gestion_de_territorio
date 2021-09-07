<?php
require_once('../../Connections/RootSistemas_Conexion_masterWeb.php');
require('../fpdf.php');

$DATADOC=mysql_query("SELECT 	id_tramite, 
								cedula, 
								nombres, 
								ruc, 
								claves_municipales, 
								fecha, 
								hora, 
								id_preceso, 
								id_usuario, 
								descripcion, 
								estado, 
								representante, 
								solciClaves
								FROM 
								db_master_bbh.tramite 
								WHERE
								id_tramite=00000001")or die(mysql_error());
$RESULDATA=mysql_fetch_assoc($DATADOC);

$Id=$RESULDATA['id_tramite'];
$Nombre=$RESULDATA['nombres'];
$Cedula=$RESULDATA['cedula'];
$Ruc=$RESULDATA['ruc'];
$clavesm=$RESULDATA['claves_municipales'];
$fecha=$RESULDATA['fecha'];
$hora=$RESULDATA['hora'];
$id_proceso=$RESULDATA['id_preceso'];
$id_usuario=$RESULDATA['id_usuario'];
$descripcion=$RESULDATA['descripcion'];
$representantelegal=$RESULDATA['representante'];
$clavesSolicitada=$RESULDATA['solciClaves'];

$GETDATAPERSONA=mysql_query("SELECT 	idPersona, 
											Cedula, 
											Nombres, 
											Apellidos
											FROM 
											db_master_bbh.persona, usuario
											WHERE persona.idPersona=usuario.id_Persona
											AND usuario.idUsuario=$id_usuario")	or die(mysql_error());
$inicialN1 = explode(' ', $Nombre);
 $n1=$inicialN1[0];
$n1=substr($n1, 0,1);

$inicialN2 = explode(' ', $Nombre);
$n2=$inicialN2[2];
$n2=substr($n2, 0,1);

$v1='';
$v2='';
$v3='';
$v4='';
$v5='';
$v6='';
$v7='';
$v8='';
$v9='';
$v10='';
$v11='';
$v12='';
$v13='';
$v14='';


	if ($id_proceso==1) {
		$v1='X';
	}
	if ($id_proceso==2) {
		$v2='X';
	}
	if ($id_proceso==3) {
		$v3='X';
	}
	if ($id_proceso==4) {
		$v4='X';
	}
	if ($id_proceso==5) {
		$v5='X';
	}
	if ($id_proceso==6) {
		$v6='X';
	}
	if ($id_proceso==7) {
		$v7='X';
	}
	if ($id_proceso==8) {
		$v8='X';
	}
	if ($id_proceso==9) {
		$v9='X';
	}
	if ($id_proceso==10) {
		$v10='X';
	}
	if ($id_proceso==11) {
		$v11='X';
	}
	if ($id_proceso==12) {
		$v12='X';
	}
	if ($id_proceso==13) {
		$v13='X';
	}
	if ($id_proceso==14) {
		$v14='X';
	}

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
//cabecera
//$pdf->Write(5,"$n1");
$pdf->Cell(0, 10, '', 0, 0,'L');
$pdf->Ln();
$pdf->Cell(0, 8, 'GADM BABAHOYO', 0, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 6, 'SOLICITUD DE TRAMITE', 0, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 6, 'N : '.$Id.' '.$n1.$n2 , 0, 0,'R');
$pdf->Ln();
//membrete

$pdf->SetFont('Arial','',10);
$pdf->Cell(0, 6, $fecha.'  '.$hora, 0, 0,'R');
$pdf->Ln();
$pdf->SetFont('Arial','B',12);
$pdf->Cell(75, 6, 'YO ', 0, 0,'L');
$pdf->Cell(2, 6, ': ', 0, 0,'L');
$pdf->Cell(0, 6, $Nombre, 0, 0,'L');
$pdf->Ln();
$pdf->Cell(75, 6, 'CON C.I. ', 0, 0,'L');
$pdf->Cell(2, 6, ': ', 0, 0,'L');
$pdf->Cell(0, 6, $Cedula, 0, 0,'L');
$pdf->Ln();
$pdf->Cell(75, 6, 'REPRESENTANTE LEGAL DE LA CIA ', 0, 0,'L');
$pdf->Cell(2, 6, ': ', 0, 0,'L');
$pdf->Cell(0, 6, $representantelegal , 0, 0,'L');
$pdf->Ln();
$pdf->Cell(75, 6, 'CON RUC ', 0, 0,'L');
$pdf->Cell(2, 6, ': ', 0, 0,'L');
$pdf->Cell(0, 6, $Ruc, 0, 0,'L');
$pdf->Ln();
$pdf->Cell(75, 6, 'CON CLAVES MUNICIPALES ', 0, 0,'L');
$pdf->Cell(2, 6, ': ', 0, 0,'L');
$pdf->Cell(0, 6, $clavesm, 0, 0,'L');
//salto en blanco
$pdf->Ln();
$pdf->Cell(0, 20, '', 0, 0,'L');
//cuerpo

$pdf->Ln();
$pdf->Cell(85, 6, 'SOLICITO DE LA CLAVE MUNICIPAL N :', 0, 0,'L');
$pdf->Cell(0, 6, $clavesSolicitada , 0, 0,'L');
//salto en blanco
$pdf->Ln();
$pdf->Cell(0, 20, '', 0, 0,'L');
$pdf->Ln();
$pdf->SetFont('Arial','',10);
//cuadricula
$pdf->Cell(70, 7, 'CERTIFICADO DE NO SER DEUDOR', 0, 0,'L');
$pdf->Cell(25, 7, $v1, 1, 0,'C');
$pdf->Cell(70, 7, 'PERMISO DE CONSTRUCCION', 0, 0,'L');
$pdf->Cell(25, 7, $v2, 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2,'' , 0, 0,'L');
$pdf->Ln();
//**************************************
$pdf->Cell(70, 7, 'REBAJA POR 3ERA EDAD', 0, 0,'L');
$pdf->Cell(25, 7, $v3, 1, 0,'C');
$pdf->Cell(70, 7, 'PERMISO DE PATENTE', 0, 0,'L');
$pdf->Cell(25, 7, $v4, 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2, '', 0, 0,'L');
$pdf->Ln();
//**************************************
$pdf->Cell(70, 7, 'CERTIFICADO DE AVALUO', 0, 0,'L');
$pdf->Cell(25, 7, $v5, 1, 0,'C');
$pdf->Cell(70, 7, 'CIERRE DE PATENTE', 0, 0,'L');
$pdf->Cell(25, 7, $v6, 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2, '', 0, 0,'L');
$pdf->Ln();
//**************************************
$pdf->Cell(70, 7, 'CATASTRO DE ESCRITURA', 0, 0,'L');
$pdf->Cell(25, 7, $v7, 1, 0,'C');
$pdf->Cell(70, 7, 'PERMISO DE CONSTRUCCION', 0, 0,'L');
$pdf->Cell(25, 7, $v8, 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2, '', 0, 0,'L');
$pdf->Ln();
//**************************************
$pdf->Cell(70, 7, 'CERTIFICADO DE NO SER DEUDOR', 0, 0,'L');
$pdf->Cell(25, 7, $v9, 1, 0,'C');
$pdf->Cell(70, 7, 'PERMISO DE CONSTRUCCION', 0, 0,'L');
$pdf->Cell(25, 7, $v10, 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2, '', 0, 0,'L');
$pdf->Ln();
//**************************************
$pdf->Cell(70, 7, 'MEDICION DE SOLAR', 0, 0,'L');
$pdf->Cell(25, 7, $v11, 1, 0,'C');
$pdf->Cell(70, 7, 'PERMISO DE VIA PUBLICA', 0, 0,'L');
$pdf->Cell(25, 7, $v12, 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2, '', 0, 0,'L');
$pdf->Ln();
//**************************************
$pdf->Cell(70, 7, 'LINEA DE FABRICA', 0, 0,'L');
$pdf->Cell(25, 7, $v13, 1, 0,'C');
$pdf->Cell(70, 7, 'PRESCRIPCION', 0, 0,'L');
$pdf->Cell(25, 7, $v14, 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2, '', 0, 0,'L');
$pdf->Ln();
//**************************************
$pdf->Cell(70, 7, 'PERMISO HIGIENE AMBIENTAL', 0, 0,'L');
$pdf->Cell(25, 7, '', 1, 0,'C');
$pdf->Cell(70, 7, 'PLAN REGULADOR', 0, 0,'L');
$pdf->Cell(25, 7, '', 1, 0,'C');
$pdf->Ln();
$pdf->Cell(0, 2, '', 0, 0,'L');
$pdf->Ln();
$pdf->Cell(0, 20, '', 0, 0,'L');
//cuadricula
$pdf->Ln();
//obcervacion
$pdf->Cell(0, 7, 'OTROS :', 0, 0,'L');
$pdf->Ln();
$pdf->Write(5,$descripcion);
$pdf->Ln();
$pdf->Cell(0, 25, '', 0, 0,'L');
$pdf->Ln();
$pdf->Cell(80, 1, '', 0, 0,'L');
$pdf->Cell(110, 0.1, '', 1, 0,'L');
$pdf->Ln();
$pdf->Cell(80, 1, '', 0, 0,'L');
$pdf->Cell(110, 7,$Nombre, 0, 0,'C');
$pdf->Output();
?>
