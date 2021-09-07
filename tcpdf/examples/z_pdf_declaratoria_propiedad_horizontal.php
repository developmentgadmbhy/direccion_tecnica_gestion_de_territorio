<?php
include '../../Connections/RootSistemas_Conexion_masterWeb.php';

/**
 * MUNICIPALIDAD DE BABAHOYO
 * @package /urbanismo
 * @abstract TCPDF - certificados
 * @author MUNICIPALIDAD DE BABAHOYO
 * @since 2016-05-01
 */
/**************************************************************/
require_once('tcpdf_include.php');
/**************************************************************/
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//$//numeroMes = date("m")-1;
if (!isset($_GET['Doc'])) {
	header('Location: ../../index.php');
}
$idDoc=$_GET['Doc'];
$Data_Base=mysql_query("SELECT 	bbh_id_dph, 
								bbh_numero_oficio_dph, 
								bbh_solicitante_dph, 
								bbh_parroquia_dph, 
								bbh_calle_dph, 
								bbh_intercepcion_dph, 
								bbh_barrio_urbanizacion_dph, 
								bbh_num_linea_fab_dph, 
								bbh_manzana_dph, 
								bbh_num_lote_dph, 
								bbh_clave_catastral_dph, 
								bbh_detalle_certificado_dph, 
								bbh_usuario_id_dph, 
								bbh_fecha_dph, 
								bbh_hora_dph
								FROM 
								bbh_declaratoria_horizontal 
								WHERE bbh_id_dph=$idDoc")or die(mysql_error());

$GetData=mysql_fetch_assoc($Data_Base);
setlocale(LC_ALL, 'es-ES');
$date=$GetData['bbh_fecha_dph'];
$f = explode('-', $date);
$f0=$f[0];
$f1=$f[1]-1;
$f2=$f[2];
$fecha='Babahoyo, '.$f2.' '.$mes[$f1].' '.$f0; 
$fecha2=$f2.' de '.$mes[$f1].' del '.$f0; 

$num_dcl_ph=$GetData['bbh_numero_oficio_dph'];
$solicitante=strtoupper($GetData['bbh_solicitante_dph']);
$Parroquia=$GetData['bbh_parroquia_dph'];
$calle=$GetData['bbh_calle_dph'];
$Interseccion=$GetData['bbh_intercepcion_dph'];
$barrioUrbanizacion=$GetData['bbh_barrio_urbanizacion_dph'];
$clave=$GetData['bbh_clave_catastral_dph'];
$Nlf=$GetData['bbh_num_linea_fab_dph'];
$manzana=$GetData['bbh_manzana_dph'];
$lote=$GetData['bbh_num_lote_dph'];
$descripcion2=$GetData['bbh_detalle_certificado_dph'];
/**************************************************************/

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

// --------------------------------------------------------

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
'.$num_dcl_ph.' <br>
Fecha: '.$fecha.'<br><br>
Señor:<br>
DIRECTOR TECNICO DE GESTION DEL TERRITORIO.<br><br>
Yo, '.$solicitante.'.<br><br>

Solicito a Usted, conceder el CERTIFICADO DE DECLARATORIA DE PROPIEDAD HORIZONTAL, de mi edificación ubicada en la siguiente dirección:

<br><br>
<table width="100%" border="0">
<tr>
<td width="35%"><b>Zona:</b></td>
<td>BABAHOYO</td>
<td></td>

</tr>
<tr>
<td width="35%"><b>Parroquia:</b></td>
<td>'.$Parroquia.'</td>
<td></td>
</tr>
<tr>
<td width="35%"><b>Calle:</b></td>
<td>'.$calle.'</td>
<td><b>No.</b> '.$Nlf.' <b>.LF</b></td>
</tr>
<tr>
<td width="35%"><b>Intersección Calle:</b></td>
<td>'.$Interseccion.'</td>
<td><b>Manzana No. </b>'.$manzana.'</td>
</tr>
<tr>
<td width="35%"><b>Barrio o Urbanización:</b></td>
<td>'.$barrioUrbanizacion.'</td>
<td><b>Lote No: </b>'.$lote.'</td>
</tr>
<tr>
<td width="35%"><b>Clave Catastral:</b></td>
<td>'.$clave.'</td>
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
<td>FECHA .'.$fecha2.'</td>
<td></td>
</tr>
<tr>
<td>INFORME '.$num_dcl_ph.'</td>
<td></td>
</tr>
<tr>
<td></td>
<td></td>
</tr>
<tr>
<td> SI:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>X</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; NO:                     </td>
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
Por cuanto la documentación presentada por el Sr. '.$solicitante.'. Cumple con lo receptado en la ley y reglamentos de propiedad horizontal y en la disposición de la Ordenanza correspondiente, al suscrito Director del Departamento de DIRECCION TECNICA DE GESTION DEL TERRITORIO. Certifica la recepción final de la edificación '.$descripcion2.', admitiendo el Régimen de Propiedad Horizontal.
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
