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

/**************************************************************/
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//$//numeroMes = date("m")-1;
if (!isset($_GET['Doc'])) {
	header('Location: ../../index.php');
}
$idDoc=$_GET['Doc'];
$Data_Base=mysql_query("SELECT 	bbh_id_permiso_cont_pc,
								bbh_numero_permiso_pc,
								bbh_propietario_pc,
								bbh_parroquia_pc,
								bbh_sector_pc,
								bbh_calle_pc,
								bbh_clave_catastral_pc,
								bbh_descripcion_pc,
								bbh_area_pc,
								bbh_usuario_id_pc,
								bbh_fecha_pc,
								bbh_hora_pc
								FROM
								bbh_permiso_construccion
								WHERE bbh_id_permiso_cont_pc=$idDoc")or die(mysql_error());
$GetData=mysql_fetch_assoc($Data_Base);
setlocale(LC_ALL, 'es-ES');
$date=$GetData['bbh_fecha_pc'];
$f = explode('-', $date);
$f0=$f[0];
$f1=$f[1]-1;
$f2=$f[2];
$fecha='Babahoyo, '.$f2.' '.$mes[$f1].' '.$f0;
$fecha2=$f2.' de '.$mes[$f1].' del '.$f0;

$num_permiso=$GetData['bbh_numero_permiso_pc'];
$bbh_propietario_pc=$GetData['bbh_propietario_pc'];
$parroquia=$GetData['bbh_parroquia_pc'];
$sector=$GetData['bbh_sector_pc'];
$calle=$GetData['bbh_calle_pc'];
$clave=$GetData['bbh_clave_catastral_pc'];
$descripcion=$GetData['bbh_descripcion_pc'];
$area=$GetData['bbh_area_pc'];
/**************************************************************/
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

// set font
$pdf->SetFont('dejavusans', '', 10);

// add a page
$pdf->AddPage();

// writeHTML($html, $ln=true, $fill=false, $reseth=false, $cell=false, $align='')
// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)
//$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
$pdf->Image('photo.png', 15, 10, 180, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
// create some HTML content
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 16);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
//$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('dejavusans', '', 12);

$html = '<b><h3>PERMISO DE CONSTRUCCIÓN.</h3></b> <br>
<b>'.$fecha.'</b><br>
Permiso de construcción. '.$num_permiso.' <br>
Propietario(a):<br>
'.$bbh_propietario_pc.'<br>
Ubicacion del Predio:<br><br>
<table width="100%" border="0">
<tr>
<td width="25%"><b>Parroquia:</b></td>
<td width="75%">'.$parroquia.'</td>
</tr>
<tr>
<td width="25%"><b>Sector:</b></td>
<td width="75%">'.$sector.'</td>
</tr>
<tr>
<td width="25%"><b>Calle:</b></td>
<td width="75%">'.$calle.'</td>
</tr>
<tr>
<td width="25%"><b>Clave Catastral:</b></td>
<td  width="75%">'.$clave.'</td>
</tr>
</table>
<br>
<br>

Descripción del Proyecto:<br><br>

'.$descripcion.' Con un área total de '.$area.' m<sup>2</sup> de Construcción, cuyos Planos han sido presentados y aprobados por el Departamento de Dirección Técnica de Gestión del Territorio el '.$fecha2.'.<br><br>
Artículo de la ordenanza a tener en cuenta durante la construcción:<br><br>
Artículo 44 literal "C" de la Ordenanza de zonificación Urbano de Babahoyo: El nivel de las aceras tanto externas, como hacia la vía y las internas que correspondan al soportal deberán ser continuas, sin barreras, interrupciones ni cualquier tipo de elementos o variaciones que obstaculice su desarrollo y el desplazamiento de los peatones o sillas de ruedas.
<br>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', 'B', 8);

$html1='
<table width="100%" border="0">
	<tr>

		<td>Arq. Marcos Quintana Vera</td>

	</tr>
	<tr>

		<td><b>DIRECTOR TECNICO DE GESTION DEL TERRITORIO</b></td>

	</tr>

</table>
<br><br><br><br>
';
$pdf->writeHTML($html1, true, false, true, false, 'C');

$pdf->SetFont('dejavusans', '', 12);
$html2='<b>NOTA.</b> El Permiso de Construcción es sujeto a renovaciones anualmente, a partir de la fecha de emisión, asi como también las inspecciones periódicas durante el proceso de construcción; <b>COLOCAR LETRERO VISIBLE DONDE INDIQUE EL NOMBRE DEL RESPONSABLE TÉCNICO DE LA OBRA, CON EL NÚMERO DEL PERMISO DE CONSTRUCCIÓN. SE DEBE MANTENER UN JUEGO DE PLANOS EN OBRA.</b>

';

$pdf->writeHTML($html2, true, false, true, false, 'J');

// reset pointer to the last page
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Print a table


// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('example_006.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
