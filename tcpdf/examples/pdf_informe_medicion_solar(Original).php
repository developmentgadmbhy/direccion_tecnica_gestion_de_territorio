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
$mes = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
//$//numeroMes = date("m")-1;
if (!isset($_GET['Doc'])) {
	header('Location: ../../index.php');
}

$idDoc=$_GET['Doc'];
$Data_Base=mysql_query("SELECT 	bbh_id_infr_ms, 
								bbh_mun_inf_ms, 
								bbh_solicitante_ms, 
								bbh_superficie_ms, 
								bbh_manzana_ms, 
								bbh_solar_ms, 
								bbh_parroquia_ms, 
								bbh_codigo_catastral_ms, 
								bbh_sector_ms, 
								bbh_limite_norte_ms, 
								bbh_ln_ms, 
								bbh_limite_sur_ms, 
								bbh_ls_ms, 
								bbh_limite_este_ms, 
								bbh_le_ms, 
								bbh_limite_oeste_ms, 
								bbh_lo_ms, 
								bbh_observacion_ms, 
								bbh_usuario_id_ms, 
								bbh_fecha_ms, 
								bbh_hora_ms 
								FROM 
								bbh_informe_ms 
								WHERE bbh_id_infr_ms=$idDoc")or die(mysql_error());

$GetData=mysql_fetch_assoc($Data_Base);
setlocale(LC_ALL, 'es-ES');
$date=$GetData['bbh_fecha_ms'];
$f = explode('-', $date);
$f0=$f[0];
$f1=$f[1]-1;
$f2=$f[2];
$fecha='Babahoyo, '.$f2.' '.$mes[$f1].' '.$f0; 
$fecha2=$f2.' de '.$mes[$f1].' del '.$f0; 

$num_iinf_mds=$GetData['bbh_mun_inf_ms'];
$Solicitante=$GetData['bbh_solicitante_ms'];
$Superficie=$GetData['bbh_superficie_ms'];
$manzana=$GetData['bbh_manzana_ms'];
$solar=$GetData['bbh_solar_ms'];
$Parroquia=$GetData['bbh_parroquia_ms'];
$clave=$GetData['bbh_codigo_catastral_ms'];
$sector=$GetData['bbh_sector_ms'];

$lnd=$GetData['bbh_limite_norte_ms'];
$ln=$GetData['bbh_ln_ms'];
$lsd=$GetData['bbh_limite_sur_ms'];
$ls=$GetData['bbh_ls_ms'];
$led=$GetData['bbh_limite_este_ms'];
$le=$GetData['bbh_le_ms'];
$lod=$GetData['bbh_limite_oeste_ms'];
$lo=$GetData['bbh_lo_ms'];

$observacion=$GetData['bbh_observacion_ms'];


$datd=mysql_query("SELECT * FROM bbh_parroquia WHERE bbh_parroquia = '$Parroquia'")or die(mysql_error());
                    	$gt=mysql_fetch_assoc($datd);
                    	$vga=$gt['bbh_tipo_parroquia'];
                    	
                    
if($vga==1){
	$gtt="Parroquia Urbana";
}elseif($vga==2){
	$gtt="Parroquia Rural";
}

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
//$numeroMes = date("m")-1;

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
$pdf->Write(8, 'INFORME DE MEDICION DE SOLAR', '', 0, 'C', true, 0, false, false, 0);

$pdf->SetFont('dejavusans', '', 11);
$pdf->Write(8, $num_iinf_mds, '', 0, 'L', true, 0, false, false, 0);
$pdf->Write(8, $fecha, '', 0, 'R', true, 0, false, false, 0);
$pdf->Ln();

$html = '<b>El siguiente informe de medición de solar es solicitado por: </b> '.strtoupper($Solicitante).'<br>
<br><br>
';


$pdf->writeHTML($html, true, false, true, false, 'J');
$pdf->SetFont('dejavusans', '', 11);
$html1='
<table width="100%" border="0">
<tr>
<td width="70%"></td>
<td width="30%"><b>Superficie:</b> '.$Superficie.' m<sup>2</sub></td>
</tr>
</table>
<br><br>
<table width="100%" border="0">
<tr>
<td width="30%"><b>Manzana N°:</b>   '.$manzana.'</td>
<td width="25%"><b>Solar N°:</b>   '.$solar.'</td>
<td width="45%"><b>'.$gtt.':</b>  '.$Parroquia.'</td>
</tr>
</table>
<br><br>
<table width="100%" border="0">
<tr>
<td width="50%"><b>CODIGO CATASTRAL:</b> '.$clave.'</td>
<td width="50%"></td>
</tr>
<tr>
<td width="50%"><b></b> </td>
<td width="50%"></td>
</tr>
<tr>
<td width="50%"><b>SECTOR:</b> '.$sector.'</td>
<td width="50%"></td>
</tr>
</table>
';
$pdf->writeHTML($html1, true, false, true, false, 'J');
$pdf->SetFont('dejavusans', 'B', 11);


$pdf->SetFont('dejavusans', 'B', 12);

$pdf->Write(8, 'ESPECIFICACION', '', 0, 'C', true, 0, false, false, 0);

$pdf->writeHTML($html2, true, false, true, false, 'J');
$pdf->SetFont('dejavusans', 'B', 14);
$pdf->Write(8, 'LINDEROS', '', 0, 'C', true, 0, false, false, 0);
// output the HTML content
//$pdf->writeHTML($html, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', '', 10);

$html3='<br><table width="100%" border="0">
<tr>
<td width="10%"><b>NORTE:</b></td>
<td width="60%">'.$lnd.'</td>
<td width="10%"><b>CON</b></td>
<td width="20%">'.$ln.' <b>ML</b></td>

</tr>
<tr>
<td><b>SUR:</b></td>
<td>'.$lsd.'</td>
<td><b>CON</b></td>
<td>'.$ls.' <b>ML</b></td>
</tr>
<tr>
<td><b>ESTE:</b> </td>
<td>'.$led.'</td>
<td><b>CON</b></td>
<td>'.$le.' <b>ML</b></td>
</tr>
<tr>
<td><b>OESTE:</b></td>
<td>'.$lod.'</td>
<td><b>CON</b></td>
<td>'.$lo.' <b>ML</b></td>
</tr>
</table>
<br><br><br><br>
';
$pdf->writeHTML($html3, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', 'B', 12);
$pdf->Write(8, 'OBSERVACION:', '', 0, 'L', true, 0, false, false, 0);
$pdf->SetFont('dejavusans', '', 10);

$html4=$observacion;
$pdf->writeHTML($html4, true, false, true, false, 'J');

$pdf->SetFont('dejavusans', 'B', 8);
$html5='
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>
<table width="100%" border="0">
	<tr>
		<td>ARQ. MARCOS QUINTANA VERA</td>
		<td></td>
	</tr>
	<tr>
		<td>DIRECTOR TÉCNICO DE GESTIÓN DEL TERRITORIO</td>
		<td>RESPONSABLE TECNICO</td>
	</tr>
</table>
';

$pdf->writeHTML($html5, true, false, true, false, 'C');

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
