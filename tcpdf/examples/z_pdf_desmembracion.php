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
/*
if (!isset($_GET['Doc'])) {
	header('Location: ../../index.php');
}*/
$idDoc=$_GET['Doc'];
//$idDoc=8;
$Data_Base=mysql_query("SELECT 	bbh_id_desm, 
								bbh_numero_desmen, 
								bbh_descripcion_desm, 
								bbh_delm_norte, 
								bbh_delm_sur, 
								bbh_delm_este, 
								bbh_delm_oeste, 
								bbh_aclaratoria_dems, 
								bbh_solicitante_dems, 
								bbh_fecha_dems, 
								bbh_hora__dems, 
								bbh_id_usuario, 
								bbh_tipo_desm
								FROM 
								bbh_desmenbracion 
								WHERE bbh_id_desm=$idDoc")or die(mysql_error());

$GetData=mysql_fetch_assoc($Data_Base);
setlocale(LC_ALL, 'es-ES');
$date=$GetData['bbh_fecha_dems'];
$f = explode('-', $date);
$f0=$f[0];
$f1=$f[1]-1;
$f2=$f[2];
$fecha='Babahoyo, '.$f2.' '.$mes[$f1].' '.$f0; 
$fecha2=$f2.' de '.$mes[$f1].' del '.$f0; 

$bbh_numero_desmen=$GetData['bbh_numero_desmen'];
$bbh_descripcion_desm=$GetData['bbh_descripcion_desm'];
$bbh_delm_norte=$GetData['bbh_delm_norte'];
$bbh_delm_sur=$GetData['bbh_delm_sur'];
$bbh_delm_este=$GetData['bbh_delm_este'];
$bbh_delm_oeste=$GetData['bbh_delm_oeste'];
$bbh_solicitante_dems=$GetData['bbh_solicitante_dems'];
$bbh_aclaratoria_dems=$GetData['bbh_aclaratoria_dems'];
$tipo=$GetData['bbh_tipo_desm'];;

$Ciclo=mysql_query("SELECT 	bbh_id_solar_desm, 
							bbh_id_desmenb, 
							bbh_aclaratoria_sl_dem, 
							bbh_delm_norte_sl_d, 
							bbh_delm_sur_sl_d, 
							bbh_delm_este_sl_d, 
							bbh_delm_oeste_sl_d
							FROM 
							bbh_desmenbracion_sl_d 
							WHERE bbh_id_desmenb=$idDoc")or die(mysql_error());
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
$pdf->Image('photo.png', 90, 10, 30, 30, 'PNG', '', '', true, 200, '', false, false, 0, false, false, false);
// create some HTML content
$pdf->Ln();
$pdf->SetFont('helvetica', 'B', 16);

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(8, 'DIRECCION TECNICA DE GESTION DEL TERRITORIO', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('helvetica', 'B', 14);

if($tipo==1){
$pdf->Write(8, 'DESMEMBRACION URBANA', '', 0, 'C', true, 0, false, false, 0);
}elseif ($tipo==2) {
$pdf->Write(8, 'DESMEMBRACION EXTRAJUDICIAL', '', 0, 'C', true, 0, false, false, 0);
}
$pdf->SetFont('dejavusans', '', 13);

$Dats='
'.$fecha.'<br>
Oficio N° '.$bbh_numero_desmen.'
<br>
';
$pdf->writeHTML($Dats, true, false, true, false, 'R');

$html = '
Sr(a)s<br>
'.$bbh_solicitante_dems.'
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, 'J');

$des=$bbh_descripcion_desm;

$pdf->writeHTML($des, true, false, true, false, 'J');

$limites='<br><br>
<table width="100%" border="0">
<tr>
	<td width="20%">Por el NORTE:</td>
	<td width="80%">'.$bbh_delm_norte.'</td>
</tr>

<tr>
	<td>Por el SUR:</td>
	<td>'.$bbh_delm_sur.'</td>
</tr>

<tr>
	<td>Por el ESTE:</td>
	<td>'.$bbh_delm_este.'</td>
</tr>

<tr>
	<td>Por el OESTE:</td>
	<td>'.$bbh_delm_oeste.'</td>
</tr>
</table>
<br><br>

Subdividido en Las Siguientes áreas
<br>
';

$pdf->writeHTML($limites, true, false, true, false, 'J');

while ($fill=mysql_fetch_array($Ciclo)) {
	
$aclaratoriaFinal='
'.$fill["bbh_aclaratoria_sl_dem"].'<br><br>
<table width="100%" border="0">
<tr>
	<td width="20%">Por el NORTE:</td>
	<td width="80%">'.$fill["bbh_delm_norte_sl_d"].'</td>
</tr>

<tr>
	<td>Por el SUR:</td>
	<td>'.$fill["bbh_delm_sur_sl_d"].'</td>
</tr>

<tr>
	<td>Por el ESTE:</td>
	<td>'.$fill["bbh_delm_este_sl_d"].'</td>
</tr>

<tr>
	<td>Por el OESTE:</td>
	<td>'.$fill["bbh_delm_oeste_sl_d"].'</td>
</tr>
</table>';

$pdf->writeHTML($aclaratoriaFinal, true, false, true, false, 'J');

}


$expl='
<br>
<br>
Si los propietarios de estos solares desearen realizar alguna construcción o mejoras a sus viviendas, deberán solicitar en esta Dirección sus respectivas líneas de fábrica, requisito previo a la obtención del permiso de construcción.
<br>
<br>
Particular que comunico a usted, para los fines de ley pertinentes.
<br>
<br>

Atentamente,
<br>
<br>
';

$pdf->writeHTML($expl, true, false, true, false, 'J');



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

';
$pdf->writeHTML($html1, true, false, true, false, 'C');


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
