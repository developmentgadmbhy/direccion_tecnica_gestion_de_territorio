<?php
//============================================================+
// File name   : example_006.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 006 for TCPDF class
//               WriteHTML and RTL support
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: WriteHTML and RTL support
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('tcpdf_include.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Municipalidad Babahoyo');
$pdf->SetTitle('DTGT 2016');
$pdf->SetSubject('DTGT 2016');
$pdf->SetKeywords('DTGT 2016');

// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$pdf->setPrintHeader(false); //no imprime la cabecera ni la linea
$pdf->setPrintFooter(false); //no imprime el pie ni la linea 
// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
//if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
//	require_once(dirname(__FILE__).'/lang/eng.php');
//	$pdf->setLanguageArray($l);
//}

// ---------------------------------------------------------

//$serie=$GETEntrega['serie'];
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
$numeroMes = date("m")-1;

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
// create some HTML content
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 16);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write(8, 'DECLARATORIA DE PROPIEDAD HORIZONTAL', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('dejavusans', '', 12);

$html = '
No. ### <br>
Fecha: 23 de Abril del 2016<br><br>
Señor:<br>
DIRECTOR TECNICO DE GESTION DEL TERRITORIO.<br><br>
Yo, NNNNNNNNN NNNNNNNN NNNNNNNNN.<br><br>

Solicito a Usted, conceder el CERTIFICADO DE DECLARATORIA DE PROPIEDAD HORIZONTAL, de mi edificación ubicada en la siguiente dirección:

<br><br>
<table width="100%" border="1">
<tr>
<td width="35%"><b>Zona:</b></td>
<td></td>
<td></td>

</tr>
<tr>
<td width="35%"><b>Parroquia:</b></td>
<td></td>
<td></td>
</tr>
<tr>
<td width="35%"><b>Calle:</b></td>
<td></td>
<td><b>No.</b> 349 <b>.LF</b></td>
</tr>
<tr>
<td width="35%"><b>Intersección Calle:</b></td>
<td></td>
<td><b>Manzana No. </b>08</td>
</tr>
<tr>
<td width="35%"><b>Barrio o Urbanización:</b></td>
<td></td>
<td><b>Lote No: </b>17</td>
</tr>
<tr>
<td width="35%"><b>Clave Catastral:</b></td>
<td></td>
<td></td>
</tr>
</table>
<br>
<br>
Predio cuya Linea de Fabrica (Certificado de Normas Particulares) y Certificado de Habitabilidad adjunto a la presente y que se pretende acojer al Régimen de Propiedad Horizontal, segun consta en los planos cuya copia se anexa.
<br>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', 'B', 8);

$html1='
<table width="100%" border="0">
	<tr>
		
		<td>___________________________________</td>
		
	</tr>
	<tr>
		
		<td><b>EL PROPIETARIO</b></td>
		
	</tr>
	
</table>
<br><br><br><br>
';
$pdf->writeHTML($html1, true, false, true, false, 'C');

$pdf->SetFont('dejavusans', '', 11);
$html2='
<table width="100%" border="1">
<tr>
<td>
<br><br>
&nbsp;&nbsp;
<!--***********************************************************-->
<table width="98%" border="">
<tr>
<td>

<table width="100%" border="">

<tr>
<td>FECHA .24 de Febrero del 2016</td>
<td></td>
</tr>
<tr>
<td>INFORME No. #####</td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td> SI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NO:                     </td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>

<tr>
<td colspan="2">Se concede la Declaratoria de Propiedad Horizontal al edificio referido en atención a: la inspección realizada al inmueble el cual es favorable, ya que esta coincide con los planos presentados, en este Departamento.</td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;__________________________</td>
</tr>
<tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUPERVISOR</td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;DIRECTOR</td>
</tr>

</table>
</td>
</tr>
</table>
<!--***********************************************************-->
&nbsp;&nbsp;
</td>
</tr>
</table>
';

$pdf->writeHTML($html2, true, false, true, false, 'J');

// reset pointer to the last page
$pdf->lastPage();

// add a page
$pdf->AddPage();
// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table
$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 16);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);
$pdf->Ln();
$pdf->Ln();

// ---------------------------------------------------------
$pdf->SetFont('helvetica', 'B', 12);
$pdf->Write(8, 'CERTIFICADO DE RECEPCIÓN FINAL', '', 0, 'C', true, 0, false, false, 0);

$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('dejavusans', '', 12);

$html0 = '
Por cuanto la documentación presentada por el Sr. NNNNNNNNN NNNNNNNNN NNNNNNNNN. Cumple con lo receptado en la ley y reglamentos de propiedad horizontal y en la disposición de la Ordenanza correspondiente, al suscrito Director del Departamento de DIRECCION TECNICA DE GESTION DEL TERRITORIO. Certifica la recepción final de la edificación ubicada en el sector Cmte. Nvo. SUBURBIO, en las calles: Rocafuerte y calle ............................
<br>
';

// output the HTML content
$pdf->writeHTML($html0, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', '', 12);
$pdf->Write(8, 'Atentamente,', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('dejavusans', 'B', 8);
$html5='
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
<table width="100%" border="0">
	<tr>

		<td>ARQ. MARCOS QUINTANA VERA</td>
		
	</tr>
	<tr>
		<td>DIRECTOR TÉCNICO DE GESTIÓN DEL TERRITORIO</td>
		
	</tr>
</table>
';

$pdf->writeHTML($html5, true, false, true, false, 'C');

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
